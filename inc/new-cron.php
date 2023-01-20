<?php
if (!function_exists('chromium_cron_add_four_hour')) {
    add_filter('cron_schedules', 'chromium_cron_add_four_hour');
    function chromium_cron_add_four_hour($schedules)
    {
        $schedules['four_hour'] = array(
            'interval' => 14400,
            'display'  => 'Раз в 4 часа'
        );
        return $schedules;
    }
}

if (!function_exists('chromium_cron_activation')) {
    add_action('wp', 'chromium_cron_activation');
    function chromium_cron_activation()
    {
        if (!wp_next_scheduled('chromium_update_currency_rate_event')) {
//            wp_schedule_event(time(), 'four_hour', 'chromium_update_currency_rate_event');
            wp_schedule_event(time(), 'daily ', 'chromium_update_currency_rate_event');
        }
    }
}


if (!function_exists('chromium_update_currency_rate')) {
    add_action('chromium_update_currency_rate_event', 'chromium_update_currency_rate');
    function chromium_update_currency_rate()
    {
        error_log('Qwerty');

        chromium_write_log('My custom cron');
        $currencyJson = wp_remote_get('http://resources.finance.ua/ru/public/currency-cash.json');
        if (is_wp_error($currencyJson)) {
            return;
        }

        $currencyInfo = findValue(json_decode($currencyJson['body'], true)['organizations'], array('title' => 'ПриватБанк'), true);
//        $currencyInfo[0]['currencies']['EUR']['ask'] = 20;
//        $currencyInfo[0]['currencies']['USD']['ask'] = 10;

        if (empty($currencyInfo[0]['currencies'])) {
            return;
        }

        update_option('chromium_currency_info', $currencyInfo[0]['currencies']);
        update_option('chromium_currency_info_date', current_time('d m Y H:i'));

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => '-1',
            'fields'         => 'ids'
        );

        $products = get_posts($args);
        $currencyInfo = get_option('chromium_currency_info');

        if (!empty($currencyInfo)) {
            foreach ($products as $inner_key => $product_id) {
                $currency = get_post_meta(intval($product_id), 'chromium_product_currency', true);
                $product = new WC_Product($product_id);
                $currencyRate = $currencyInfo[$currency]['ask'];
                if ($currencyRate) {
                    $regular_price = (get_post_meta(intval($product_id), 'chromium_product_price') ? floatval(get_post_meta(intval($product_id), 'chromium_product_price', true) * $currencyRate) : '');
                    if ($regular_price) {
                        $product->set_regular_price($regular_price);
                    }

                    $sale_price = (get_post_meta(intval($product_id), 'chromium_product_sale_price') ? floatval(get_post_meta(intval($product_id),
                            'chromium_product_sale_price',
                            true) * $currencyRate) : '');
                    if ($sale_price) {
                        $product->set_sale_price($sale_price);
                    }
                    $price = ($sale_price ? $sale_price : $regular_price);
                    $product->set_price($price);
                    $product->save();
                }
            }

            $args = array(
                'post_type'      => 'product_variation',
                'posts_per_page' => '-1',
                'fields'         => 'ids'
            );
            $variable_products = get_posts($args);
            foreach ($variable_products as $inner_key => $product_id) {
                $currency = get_post_meta(intval($product_id), 'chromium_product_currency', true);
                $product = new WC_Product_Variation($product_id);
                $currencyRate = $currencyInfo[$currency]['ask'];
                if ($currencyRate) {
                    $regular_price = (get_post_meta(intval($product_id), 'chromium_product_price') ? floatval(get_post_meta(intval($product_id), 'chromium_product_price', true) * $currencyRate) : '');
                    if ($regular_price) {
                        $product->set_regular_price($regular_price);
                    }
                    $sale_price = (get_post_meta(intval($product_id), 'chromium_product_sale_price') ? floatval(get_post_meta(intval($product_id),
                            'chromium_product_sale_price',
                            true) * $currencyRate) : '');
                    if ($sale_price) {
                        $product->set_sale_price($sale_price);
                    }
                    $price = ($sale_price ? $sale_price : $regular_price);
                    $product->set_price($price);
                    $product->save();
                }
            }
        }
    }
}


if (!function_exists('chromium_woocommerce_settings_save_general')) {
    function chromium_woocommerce_settings_save_general($array)
    {
        if (function_exists('chromium_update_currency_rate')) {
            chromium_update_currency_rate();
        }
    }

    add_action("woocommerce_settings_save_general", 'chromium_woocommerce_settings_save_general', 10, 1);
}