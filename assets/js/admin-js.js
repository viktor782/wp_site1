jQuery(document).ready(function ($) {
    function update_product_price(wrap) {
        if (jQuery('.currencyOptions').length) {
            jQuery('#_regular_price, #_sale_price, .variable_pricing .wc_input_price').attr('readonly', true);
            var product_type = (wrap.hasClass('currencyOptions-simple') ? 'simple' : 'variable'),
                product_id = wrap.find('.chromium_product_id').val(),
                product_position = wrap.find('.chromium_product_position').val(),
                currency = wrap.find('.chromium_product_currency').val(),
                custom_price = wrap.find('.chromium_product_price').val(),
                custom_sale_price = wrap.find('.chromium_product_sale_price').val(),
                chromium_currency_info = JSON.parse(wrap.find('.chromium_currency_info').val()),
                currency_rate = chromium_currency_info[currency]['ask'],
                price = (custom_price ? parseFloat(custom_price * currency_rate.replace(',', '.')) : ''),
                sale_price = (custom_sale_price ? parseFloat(custom_sale_price.replace(',', '.') * currency_rate) : ''),
                price_el = (product_type === 'simple' ? jQuery('#_regular_price') : jQuery('#variable_regular_price_' + product_position + '')),
                sale_price_el = (product_type === 'simple' ? jQuery('#_sale_price') : jQuery('#variable_sale_price' + product_position + '')),
                custom_sale_price_el = (product_type === 'simple' ? wrap.find('#chromium_product_sale_price') : wrap.find('#chromium_product_sale_price[' + product_position + ']'));


            console.log(sale_price);
            if (sale_price >= price) {
                custom_sale_price_el.parents('.form-field').append('<div class="wc_error_tip chromiumError">' + salePriceNoticeText + '</div>');
                sale_price = '';
                // console.log(sale_price);
                // console.log(price);
                console.log('>');
            } else {
                console.log('<');
                custom_sale_price_el.parents('.form-field').find('.wc_error_tip').remove();
            }

            // console.log(product_type);
            // console.log(price_el);
            if (price) {
                price = price.toFixed(price_decimals);
            }
            if (sale_price) {
                sale_price = sale_price.toFixed(price_decimals);
            }

            if (sale_price === 0) {
                sale_price = '';
                sale_price_el.val(sale_price).attr('value', sale_price);
            }

            price_el.val(price).attr('value', price);
            sale_price_el.val(price).attr('value', sale_price);
        }
    }

    var currencyWrap = jQuery('.currencyOptions');
    if (currencyWrap.length > 0) {
        update_product_price(currencyWrap);
    }


    jQuery(document).on('change paste keyup', '.chromium_product_input', function () {
        var wrap = jQuery(this).parents('.currencyOptions');
        if (wrap.length > 0) {
            update_product_price(wrap);
        }
    });

    // jQuery('#chromium_product_sale_price').on("change paste keyup", function () {
    //     var price = parseFloat(jQuery('#chromium_product_price').val()),
    //         salePrice = parseFloat(jQuery(this).val());
    //
    //     if (salePrice >= price) {
    //         jQuery(this).parents('.chromium_product_sale_price_field').append('<div class="wc_error_tip chromiumError">' + salePriceNoticeText + '</div>');
    //         jQuery(this).val('');
    //     } else {
    //         jQuery(this).parents('.chromium_product_sale_price_field').find('.wc_error_tip').remove();
    //     }
    //
    // });


});