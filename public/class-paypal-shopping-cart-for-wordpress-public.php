<?php

/**
 * @class       paypal_shopping_cart_for_wordPress_Public
 * @version	1.0.0
 * @package	paypal-shopping-cart-for-wordpress
 * @category	Class
 * @author      johnny manziel <phpwebcreators@gmail.com>
 */
class paypal_shopping_cart_for_wordPress_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->paypal_shopping_cart_for_wordPress_add_shortcode();
        add_filter('widget_text', 'do_shortcode');
    }

    public function paypal_shopping_cart_for_wordPress_add_shortcode() {
        add_shortcode('paypal_shopping_cart', array($this, 'paypal_shopping_cart_for_wordPress_button_generator'));
        add_shortcode('paypal_view_cart', array($this, 'paypal_shopping_cart_for_wordPress_view_cart'));
    }

    public function paypal_shopping_cart_for_wordPress_view_cart() {
        $paypal_shopping_cart_for_wordPress_cart_opens = get_option('paypal_shopping_cart_for_wordPress_cart_opens');
        $paypal_shopping_cart_for_wordPress_view_custom_button = get_option('paypal_shopping_cart_for_wordPress_view_custom_button');
        $paypal_shopping_cart_for_wordPress_view_button_image = get_option('paypal_shopping_cart_for_wordPress_view_button_image');
        $paypal_shopping_cart_for_wordPress_PayPal_sandbox = get_option('paypal_shopping_cart_for_wordPress_PayPal_sandbox');
        $paypal_shopping_cart_for_wordPress_bussiness_email = get_option('paypal_shopping_cart_for_wordPress_bussiness_email');
        if (isset($paypal_shopping_cart_for_wordPress_PayPal_sandbox) && $paypal_shopping_cart_for_wordPress_PayPal_sandbox == 'yes') {
            $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        }

        if (isset($paypal_shopping_cart_for_wordPress_view_button_image) && !empty($paypal_shopping_cart_for_wordPress_view_button_image)) {
            switch ($paypal_shopping_cart_for_wordPress_view_button_image) {
                case 'button1':
                    $button_url = 'https://www.paypalobjects.com/en_US/i/btn/view_cart.gif';
                    break;
                case 'button2':
                    $button_url = 'https://www.paypalobjects.com/en_GB/i/btn/view_cart.gif';
                    break;
                case 'button3':
                    $button_url = get_option('paypal_shopping_cart_for_wordPress_view_custom_button');
                    break;
            }
        } elseif (isset($paypal_shopping_cart_for_wordPress_view_custom_button) && !empty($paypal_shopping_cart_for_wordPress_view_custom_button)) {
            $button_url = $paypal_shopping_cart_for_wordPress_view_custom_button;
        } else {
            $button_url = 'https://www.paypalobjects.com/en_GB/i/btn/view_cart.gif';
        }
        
         if( isset($paypal_shopping_cart_for_wordPress_cart_opens) && !empty($paypal_shopping_cart_for_wordPress_cart_opens) ) {
             switch ($paypal_shopping_cart_for_wordPress_cart_opens) {
                case '':
                    $open = '';
                    break;
                case '_blank':
                    $open = '_blank';
                    break;
            }
        } else {
            $open = '';
        }

        ob_start();

        $output = '';
        $output = '<div class="page-sidebar widget">';

        $output .= '<form action="' . esc_url($paypal_url) . '" method="post" target="'. $open. '">';
        $output .= '<input type="hidden" name="business" value="' . esc_attr($paypal_shopping_cart_for_wordPress_bussiness_email) . '">';

        $output .= '<input type="hidden" name="bn" value="mbjtechnolabs_SP">';
        $output .= '<input type="hidden" name="display" value="1">';
        $output .= '<input type="hidden" name="cmd" value="_cart">';
        $output .= '<input type="image" name="submit" border="0" src="' . esc_url($button_url) . '" alt="PayPal - The safer, easier way to pay online">';
        $output .= '</form></div>';

        return $output;
        return ob_get_clean();
    }

    public function paypal_shopping_cart_for_wordPress_button_generator($atts) {

        extract(shortcode_atts(array(
            'item_name' => 'TEST',
            'amount' => 1,
            'discount_amount' => 0,
            'shipping' => 0,
            'handling' => 0,
                        ), $atts));

        $paypal_shopping_cart_for_wordPress_cart_opens = get_option('paypal_shopping_cart_for_wordPress_cart_opens');
        $paypal_shopping_cart_for_wordPress_custom_button = get_option('paypal_shopping_cart_for_wordPress_custom_button');
        $paypal_shopping_cart_for_wordPress_button_image = get_option('paypal_shopping_cart_for_wordPress_button_image');
        $paypal_shopping_cart_for_wordPress_notify_url = site_url('?paypal_shopping_cart_for_wordPress&action=ipn_handler');
        $paypal_shopping_cart_for_wordPress_return_page = get_option('paypal_shopping_cart_for_wordPress_return_page');
        $paypal_shopping_cart_for_wordPress_currency = get_option('paypal_shopping_cart_for_wordPress_currency');
        $paypal_shopping_cart_for_wordPress_bussiness_email = get_option('paypal_shopping_cart_for_wordPress_bussiness_email');
        $paypal_shopping_cart_for_wordPress_PayPal_sandbox = get_option('paypal_shopping_cart_for_wordPress_PayPal_sandbox');

        if (isset($paypal_shopping_cart_for_wordPress_button_image) && !empty($paypal_shopping_cart_for_wordPress_button_image)) {
            switch ($paypal_shopping_cart_for_wordPress_button_image) {
                case 'button1':
                    $button_url = 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_addtocart_96x21.png';
                    break;
                case 'button2':
                    $button_url = 'https://www.paypalobjects.com/webstatic/en_US/btn/btn_addtocart_120x26.png';
                    break;
                case 'button3':
                    $button_url = get_option('paypal_shopping_cart_for_wordPress_custom_button');
                    break;
            }
        } elseif (isset($paypal_shopping_cart_for_wordPress_custom_button) && !empty($paypal_shopping_cart_for_wordPress_custom_button)) {
            $button_url = $paypal_shopping_cart_for_wordPress_custom_button;
        } else {
            $button_url = 'https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif';
        }
        
        
        if( isset($paypal_shopping_cart_for_wordPress_cart_opens) && !empty($paypal_shopping_cart_for_wordPress_cart_opens) ) {
             switch ($paypal_shopping_cart_for_wordPress_cart_opens) {
                case '':
                    $open = '';
                    break;
                case '_blank':
                    $open = '_blank';
                    break;
            }
        } else {
            $open = '';
        }

        if (isset($paypal_shopping_cart_for_wordPress_PayPal_sandbox) && $paypal_shopping_cart_for_wordPress_PayPal_sandbox == 'yes') {
            $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        } else {
            $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
        }

        ob_start();

        $output = '';
        $output = '<div class="page-sidebar widget">';

        $output .= '<form action="' . esc_url($paypal_url) . '" method="post" target="'. $open. '">';

        $output .= '<input type="hidden" name="business" value="' . esc_attr($paypal_shopping_cart_for_wordPress_bussiness_email) . '">';

        $output .= '<input type="hidden" name="bn" value="mbjtechnolabs_SP">';

        $output .= '<input type="hidden" name="cmd" value="_cart">';

        foreach ($atts as $key => $value) {
            $output .= "<input type='hidden' name=$value value=$value>";
        }

        if (isset($item_name) && !empty($item_name)) {
            $output .= '<input type="hidden" name="item_name" value="' . esc_attr($item_name) . '">';
        }

        if (isset($amount) && !empty($amount)) {
            $output .= '<input type="hidden" name="amount" value="' . esc_attr($amount) . '">';
        }

        if (isset($discount_amount) && !empty($discount_amount)) {
            $output .= '<input type="hidden" name="discount_amount" value="' . esc_attr($discount_amount) . '">';
        }

        if (isset($shipping) && !empty($shipping)) {
            $output .= '<input type="hidden" name="shipping" value="' . esc_attr($shipping) . '">';
        }

        if (isset($handling) && !empty($handling)) {
            $output .= '<input type="hidden" name="handling" value="' . esc_attr($handling) . '">';
        }

        $output .= '<input type="hidden" name="add" value="1">';

        if (isset($paypal_shopping_cart_for_wordPress_currency) && !empty($paypal_shopping_cart_for_wordPress_currency)) {
            $output .= '<input type="hidden" name="currency_code" value="' . esc_attr($paypal_shopping_cart_for_wordPress_currency) . '">';
        }

        if (isset($paypal_shopping_cart_for_wordPress_notify_url) && !empty($paypal_shopping_cart_for_wordPress_notify_url)) {
            $output .= '<input type="hidden" name="notify_url" value="' . esc_url($paypal_shopping_cart_for_wordPress_notify_url) . '">';
        }

        if (isset($paypal_shopping_cart_for_wordPress_return_page) && !empty($paypal_shopping_cart_for_wordPress_return_page)) {
            $paypal_shopping_cart_for_wordPress_return_page = get_permalink($paypal_shopping_cart_for_wordPress_return_page);
            $output .= '<input type="hidden" name="return" value="' . esc_url($paypal_shopping_cart_for_wordPress_return_page) . '">';
        }

        $output .= '<input type="image" name="submit" border="0" src="' . esc_url($button_url) . '" alt="PayPal - The safer, easier way to pay online">';
        $output .= '</form></div>';

        return $output;
        return ob_get_clean();
    }

}

