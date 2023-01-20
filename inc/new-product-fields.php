<?php

if (!function_exists('chromium_add_currency_fields_to_simple_product')) {
    add_action('woocommerce_product_options_general_product_data', 'chromium_add_currency_fields_to_simple_product');
    function chromium_add_currency_fields_to_simple_product()
    {
        $default_lang = '';
        $post_lang = '';
        $currency = get_woocommerce_currency();
        $post_id = get_the_ID();
        if (function_exists('pll_default_language')) {
            $default_lang = pll_default_language();
        }
        if (function_exists('pll_get_post_language')) {
            $post_lang = pll_get_post_language($post_id);
        }

        $WC_Product_Data_Store_CPT = new WC_Product_Data_Store_CPT();
        if ($WC_Product_Data_Store_CPT->get_product_type(get_the_ID()) != 'simple' || $post_lang != $default_lang || $currency != 'UAH') {
            return;
        }

        echo "<div id='currency-options' class='currencyOptions currencyOptions-simple'>";

        $currencyInfo = get_option('chromium_currency_info');

        $decimals = wc_get_price_decimals();
        woocommerce_wp_select(array(
            'id'       => 'chromium_product_currency',
            'class'    => 'chromium_product_currency chromium_product_input',
            'value'    => get_post_meta($post_id, 'chromium_product_currency', true),
            'label'    => __('Select currency', 'chromium'),
            'options'  => array(
                'USD' => __('USD - ' . round($currencyInfo['USD']['ask'], 2) . '', 'chromium'),
                'EUR' => __('EUR - ' . round($currencyInfo['EUR']['ask'], 2) . '', 'chromium'),
            ),
            'desc_tip' => 'true',
//            'description' => __('Define whether or not the entire product is taxable, or just the cost of shipping it.', 'woocommerce'),
        ));

        woocommerce_wp_text_input(array(
            'id'                => 'chromium_product_price',
            'class'             => 'chromium_product_price chromium_product_input',
            'label'             => __('Price', 'chromium'),
            'desc_tip'          => 'true',
//            'description'       => __('Enter the number of days the gift card is valid for.', 'woocommerce'),
            'type'              => 'number',
            'custom_attributes' => array(
                'min'  => '1',
                'step' => 'any',
//                'required' => 'required'
            ),
        ));

        woocommerce_wp_text_input(array(
            'id'                => 'chromium_product_sale_price',
            'class'             => 'chromium_product_sale_price chromium_product_input',
            'label'             => __('Sale price', 'chromium'),
            'desc_tip'          => 'true',
//            'description'       => __('Enter the number of days the gift card is valid for.', 'woocommerce'),
            'type'              => 'number',
            'custom_attributes' => array(
                'min'  => '1',
                'step' => 'any'
            ),
        ));

        woocommerce_wp_hidden_input(array(
            'id'    => 'chromium_product_id',
            'value' => $post_id
        ));

        woocommerce_wp_hidden_input(array(
            'id'    => 'chromium_currency_info',
            'class' => 'chromium_currency_info',
            'value' => json_encode(get_option('chromium_currency_info'))
        ));

        echo '</div>';
    }
}

if (!function_exists('chromium_save_simple_product_currency_fields')) {
    function chromium_save_simple_product_currency_fields($post_id)
    {
        if (get_post_type($post_id) != 'product') {
            return;
        }

        if (isset($_POST['chromium_product_price']) && !empty($_POST['chromium_product_price'])) {
            update_post_meta($post_id, 'chromium_product_price', abs($_POST['chromium_product_price']));
        }

        if (isset($_POST['chromium_product_sale_price']) && !empty($_POST['chromium_product_sale_price'])) {
            update_post_meta($post_id, 'chromium_product_sale_price', abs($_POST['chromium_product_sale_price']));
        } else {
            delete_post_meta($post_id, 'chromium_product_sale_price');
        }
        if (isset($_POST['chromium_product_currency']) && !empty($_POST['chromium_product_currency'])) {
            update_post_meta($post_id, 'chromium_product_currency', $_POST['chromium_product_currency']);
        }
    }

    add_action('woocommerce_process_product_meta_simple', 'chromium_save_simple_product_currency_fields');
    add_action('woocommerce_process_product_meta_variable', 'chromium_save_simple_product_currency_fields');
}


if (!function_exists('chromium_add_currency_fields_to_variations')) {
    add_action('woocommerce_variation_options_pricing', 'chromium_add_currency_fields_to_variations', 10, 3);
    function chromium_add_currency_fields_to_variations($loop, $variation_data, $variation)
    {

        $default_lang = '';
        $post_lang = '';
        $currency = get_woocommerce_currency();
        $post_id = get_the_ID();
        if (function_exists('pll_default_language')) {
            $default_lang = pll_default_language();
        }
        if (function_exists('pll_get_post_language')) {
            $post_lang = pll_get_post_language($post_id);
        }

        $WC_Product_Data_Store_CPT = new WC_Product_Data_Store_CPT();
        if ($WC_Product_Data_Store_CPT->get_product_type(get_the_ID()) != 'variable' || $post_lang != $default_lang || $currency != 'UAH') {
            return;
        }

        $price = (get_post_meta($variation->ID, 'chromium_product_price') ? get_post_meta($variation->ID, 'chromium_product_price', true) : '');
        $sale_price = (get_post_meta($variation->ID, 'chromium_product_sale_price') ? get_post_meta($variation->ID, 'chromium_product_sale_price', true) : '');

        if ($sale_price == 0) { $sale_price = '';}

        echo "<div id='currency-options-$loop' class='currencyOptions currencyOptions-variable'>";
        $currencyInfo = get_option('chromium_currency_info');
        woocommerce_wp_select(array(
            'id'       => 'chromium_product_currency[' . $loop . ']',
            'class'    => 'chromium_product_currency chromium_product_input',
            'value'    => get_post_meta($variation->ID, 'chromium_product_currency', true),
            'label'    => __('Select currency', 'chromium'),
            'options'  => array(
                'USD' => __('USD - ' . round($currencyInfo['USD']['ask'], 2) . '', 'chromium'),
                'EUR' => __('EUR - ' . round($currencyInfo['EUR']['ask'], 2) . '', 'chromium'),
            ),
            'desc_tip' => 'true'
        ));

        woocommerce_wp_text_input(array(
            'id'                => 'chromium_product_price[' . $loop . ']',
            'class'             => 'qwe-' . $loop . ' chromium_product_price chromium_product_input',
            'value'             => $price,
            'label'             => __('Price', 'chromium'),
            'desc_tip'          => 'true',
            'type'              => 'number',
            'custom_attributes' => array(
                'min'  => '1',
                'step' => 'any',
                'required' => 'required'
            ),
        ));

        woocommerce_wp_text_input(array(
            'id'                => 'chromium_product_sale_price[' . $loop . ']',
            'class'             => 'chromium_product_sale_price chromium_product_input',
            'value'             => $sale_price,
            'label'             => __('Sale price', 'chromium'),
            'desc_tip'          => 'true',
            'type'              => 'number',
            'custom_attributes' => array(
                'min'  => '1',
                'step' => 'any'
            ),
        ));

        woocommerce_wp_hidden_input(array(
            'id'    => 'chromium_product_position[' . $loop . ']',
            'class' => 'chromium_product_position',
            'value' => $loop
        ));

        woocommerce_wp_hidden_input(array(
            'id'    => 'chromium_currency_info[' . $loop . ']',
            'class' => 'chromium_currency_info',
            'value' => json_encode(get_option('chromium_currency_info'))
        ));
        echo "</div>";

    }
}

if (!function_exists('chromium_save_variable_product_currency_fields')) {
    add_action('woocommerce_save_product_variation', 'chromium_save_variable_product_currency_fields', 10, 2);
    function chromium_save_variable_product_currency_fields($variation_id, $i)
    {
        if (isset($_POST['chromium_product_currency'][$i])) {
            update_post_meta($variation_id, 'chromium_product_currency', esc_attr($_POST['chromium_product_currency'][$i]));
        }
        if (isset($_POST['chromium_product_price'][$i]) && !empty(isset($_POST['chromium_product_price'][$i]))) {
            update_post_meta($variation_id, 'chromium_product_price', abs($_POST['chromium_product_price'][$i]));
        }
        if (isset($_POST['chromium_product_sale_price'][$i]) && !empty(isset($_POST['chromium_product_sale_price'][$i]))) {
            update_post_meta($variation_id, 'chromium_product_sale_price', abs($_POST['chromium_product_sale_price'][$i]));
        } else {
            delete_post_meta($variation_id, 'chromium_product_sale_price');
        }
    }
}

if (!function_exists('chromium_return_custom_price')) {
    function chromium_return_custom_price($price, $product)
    {
        global $post, $blog_id;
        $product = wc_get_product($product);
        if ($product->is_type('variable')) {
            $price = wc_price($product->get_variation_price('min'));
        }
        return $price;
    }

    add_filter('woocommerce_product_get_price', 'chromium_return_custom_price', 10, 2);
}

if (!function_exists('chromium_add_admin_body_class')) {
    function chromium_add_admin_body_class($classes)
    {
        return "$classes chromium_custom_price";
    }

    $currency = get_woocommerce_currency();
    if ($currency === 'UAH') {
        add_filter('admin_body_class', 'chromium_add_admin_body_class');
    }
}
