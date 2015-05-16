jQuery(function($) {
    'use strict';

    if (jQuery('input[name=paypal_shopping_cart_for_wordPress_button_image][value =button3]').is(':checked')) {
        jQuery('input[name=paypal_shopping_cart_for_wordPress_custom_button]').parent().parent().show();
    } else {
        jQuery('input[name=paypal_shopping_cart_for_wordPress_custom_button]').parent().parent().hide();
    }

    jQuery('input[name=paypal_shopping_cart_for_wordPress_button_image]').click(function() {
        if (jQuery('input[name=paypal_shopping_cart_for_wordPress_button_image][value =button3]').is(':checked')) {
            jQuery('input[name=paypal_shopping_cart_for_wordPress_custom_button]').parent().parent().show();
        } else {
            jQuery('input[name=paypal_shopping_cart_for_wordPress_custom_button]').parent().parent().hide();
        }
    });
    
    
     if (jQuery('input[name=paypal_shopping_cart_for_wordPress_view_button_image][value =button3]').is(':checked')) {
        jQuery('input[name=paypal_shopping_cart_for_wordPress_view_custom_button]').parent().parent().show();
    } else {
        jQuery('input[name=paypal_shopping_cart_for_wordPress_view_custom_button]').parent().parent().hide();
    }

    jQuery('input[name=paypal_shopping_cart_for_wordPress_view_button_image]').click(function() {
        if (jQuery('input[name=paypal_shopping_cart_for_wordPress_view_button_image][value =button3]').is(':checked')) {
            jQuery('input[name=paypal_shopping_cart_for_wordPress_view_custom_button]').parent().parent().show();
        } else {
            jQuery('input[name=paypal_shopping_cart_for_wordPress_view_custom_button]').parent().parent().hide();
        }
    });


});