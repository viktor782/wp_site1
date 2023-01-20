<?php
function custom_mini_cart()
{
    echo '<a href="#" class="dropdown-back" data-toggle="dropdown"> ';
    echo '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="shopping-cart" class="svg-inline--fa fa-shopping-cart fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="#414141" d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"></path></svg>';
    echo '<div class="basket-item-count" style="display: inline;">';
    echo '<span class="cart-items-count count">';
    echo '<a class="footer-cart-contents">' . WC()->cart->get_cart_contents_count() . '</a>';
    echo '</span>';
    echo '</div>';
    echo '</a>';
    echo '<div class="name__suum">';
    _e('summa', 'holod');
    echo ' </div>';
    echo '<p class="suum">';
    echo ' ' . WC()->cart->get_total('total', false) . ' грн</p>';
    echo '<div class="woocommerce">';
    echo '<ul class="dropdown-menu dropdown-menu-mini-cart">';
    echo '<a href="#" class="for_exit"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="#fff" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></a>';
    echo '<li> <div class="widget_shopping_cart_content">';
    woocommerce_mini_cart();
    echo '</div></li></ul></div>';

}


function storefront2_handheld_footer_bar_cart_sum()
{
    ?>
    <p class="suum"> <?php echo wp_kses_data(WC()->cart->get_total('total', false)); ?> грн</p>
    <?php
}

function storefront2_cart_sum_fragment($fragments)
{
    global $woocommerce;

    ob_start();
    storefront2_handheld_footer_bar_cart_sum();
    $fragments['p.suum'] = ob_get_clean();

    return $fragments;
}

function storefront2_handheld_footer_bar_cart_link()
{
    ?>
    <a class="footer-cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>"
       title="<?php esc_attr_e('View your shopping cart', 'storefront'); ?>">
        <span class="count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span>
    </a>
    <?php
}


function storefront2_cart_link_fragment($fragments)
{
    global $woocommerce;

    ob_start();
    storefront2_handheld_footer_bar_cart_link();
    $fragments['a.footer-cart-contents'] = ob_get_clean();

    return $fragments;
}


if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.3', '>=')) {
    add_filter('woocommerce_add_to_cart_fragments', 'storefront2_cart_link_fragment');
    add_filter('woocommerce_add_to_cart_fragments', 'storefront2_cart_sum_fragment');
} else {
    add_filter('add_to_cart_fragments', 'storefront2_cart_link_fragment');
    add_filter('woocommerce_add_to_cart_fragments', 'storefront2_cart_sum_fragment');
}


add_filter('woocommerce_currencies', 'add_my_currency');

function add_my_currency($currencies)
{

    $currencies['UAH'] = __('Українська гривня', 'woocommerce');

    return $currencies;

}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);

function add_my_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'UAH':
            $currency_symbol = 'грн';
            break;
    }
    return $currency_symbol;
}

function holod_add_controll_to_product()
{
    global $product;

   $the_upselss = $product->get_upsell_ids();

    $display_result = '<div class="holod_add_controll_to_product">';

    if (count($the_upselss) > 0){
        $display_result .= '<a href="#" id="to__upsell">' . __('See analog', 'holod') . '</a>';
    }

    $display_result .= '<a href="tel:+300000000" class="to_viber"></a>';

    $display_result .= '<a href="#" class="to_pop" id="get__call">' . __('Order a consultation', 'holod') . '</a>';

    $display_result .= '</div>';
    echo $display_result;

    echo '<div>';
    $id = 153;// Обязательно передавать переменную
    $post = get_post($id);
    $content = $post->post_content;
    echo $content;
    echo '</div>';

}


function cw_woo_attribute()
{
    global $product;
    $attributes = $product->get_attributes();
    if (!$attributes) {
        return;
    }
    $display_result = '<div class="the__att">';
    foreach ($attributes as $attribute) {
        if ($attribute->get_variation()) {
            continue;
        }
        $name = $attribute->get_name();
        if ($attribute->is_taxonomy()) {
            $terms = wp_get_post_terms($product->get_id(), $name, 'all');
            $cwtax = $terms[0]->taxonomy;
            $cw_object_taxonomy = get_taxonomy($cwtax);
            if (isset ($cw_object_taxonomy->labels->singular_name)) {
                $tax_label = $cw_object_taxonomy->labels->singular_name;
            } elseif (isset($cw_object_taxonomy->label)) {
                $tax_label = $cw_object_taxonomy->label;
                if (0 === strpos($tax_label, 'Product ')) {
                    $tax_label = substr($tax_label, 8);
                }
            }
            $display_result .= $tax_label . ': ';
            $tax_terms = array();
            foreach ($terms as $term) {
                $single_term = esc_html($term->name);
                array_push($tax_terms, $single_term);
            }
            $display_result .= implode(', ', $tax_terms) . '<br />';
        } else {
            $display_result .= '<b>' . $name . '</b> : ';
            $display_result .= esc_html(implode(', ', $attribute->get_options())) . '<br />';
        }
    }
    $display_result .= '</div>';
    echo $display_result;
}

add_filter('woocommerce_get_price_html', 'filter_function_name_6609', 10, 2);
function filter_function_name_6609($price, $product)
{
    $regular_price = $product->get_regular_price();
    $sale_price = $product->get_sale_price();
    if ($sale_price) {
        $the__price = '<b>' . wc_price($sale_price) .
            '</b> <del> ' . wc_price($regular_price) . '</del>';
    } else {
        $the__price = '<b>' . wc_price($regular_price) . '</b>';
    }
    //return $the__price;
    return str_replace('ins>', 'b>', $price);
}

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_title', 20);


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_before_main_content', 'woocommerce_template_single_title', 30);


add_action('woocommerce_single_product_summary', 'cw_woo_attribute', 5);


remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 7);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
add_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_excerpt', 5);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

add_action('woocommerce_single_product_summary', 'holod_add_controll_to_product', 40);


function woocommerce_custom_sidebar()
{
    dynamic_sidebar('shop');
}

/**
 * Change the breadcrumb separator
 */
add_filter('woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter');
function wcc_change_breadcrumb_delimiter($defaults)
{
    $defaults['delimiter'] = '&gt;';
    return $defaults;
}


add_filter('woocommerce_pagination_args', 'rocket_woo_pagination');
function rocket_woo_pagination($args)
{
    $args['prev_text'] = '&laquo;';
    $args['next_text'] = '&raquo;';
    return $args;
}


/*
function my_woocommerce_get_price($price, $_product) {
    $kurs = 25; // курс валюты
    $new_price = $price * $kurs;
    return $new_price; // новая цена
}
add_filter('woocommerce_product_get_price', 'my_woocommerce_get_price',100,2);


function my2_woocommerce_get_price($price, $_product) {
    $kurs = 25; // курс валюты
    $new_price = $price * $kurs;
    return $new_price; // новая цена
}
add_filter('woocommerce_product_get_regular_price', 'my2_woocommerce_get_price',100,2); */