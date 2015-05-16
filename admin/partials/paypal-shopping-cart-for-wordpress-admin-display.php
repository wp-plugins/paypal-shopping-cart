<?php

/**
 * @class       Paypal_Shopping_Cart_For_WordPress_Admin_Display
 * @version	1.0.0
 * @package	paypal-shopping-cart-for-wordpress
 * @category	Class
 * @author      johnny manziel <phpwebcreators@gmail.com>
 */
class Paypal_Shopping_Cart_For_WordPress_Admin_Display {

    /**
     * Hook in methods
     * @since    1.0.0
     * @access   static
     */
    public static function init() {
        add_action('admin_menu', array(__CLASS__, 'add_settings_menu'));
    }

    /**
     * add_settings_menu helper function used for add menu for pluging setting
     * @since    1.0.0
     * @access   public
     */
    public static function add_settings_menu() {

        add_options_page('PayPal Shopping Cart For WordPress Options', 'PayPal Shopping Cart', 'manage_options', 'paypal-shopping-cart-for-wordpress', array(__CLASS__, 'paypal_shopping_cart_for_wordPress_options'));
    }

    /**
     * paypal_ipn_for_wordpress_options helper will trigger hook and handle all the settings section 
     * @since    1.0.0
     * @access   public
     */
    public static function paypal_shopping_cart_for_wordPress_options() {
        $setting_tabs = apply_filters('paypal_shopping_cart_for_wordPress_options_setting_tab', array('general' => 'General', 'email' => 'Send Email', 'mailchimp' => 'MailChimp', 'help' => 'Help'));
        $current_tab = (isset($_GET['tab'])) ? $_GET['tab'] : 'general';
        ?>
        <h2 class="nav-tab-wrapper">
            <?php
            foreach ($setting_tabs as $name => $label)
                echo '<a href="' . admin_url('admin.php?page=paypal-shopping-cart-for-wordpress&tab=' . $name) . '" class="nav-tab ' . ( $current_tab == $name ? 'nav-tab-active' : '' ) . '">' . $label . '</a>';
            ?>
        </h2>
        <?php
        foreach ($setting_tabs as $setting_tabkey => $setting_tabvalue) {
            switch ($setting_tabkey) {
                case $current_tab:
                    do_action('paypal_shopping_cart_for_wordPress_' . $setting_tabkey . '_setting_save_field');
                    do_action('paypal_shopping_cart_for_wordPress_' . $setting_tabkey . '_setting');
                    break;
            }
        }
    }

}

Paypal_Shopping_Cart_For_WordPress_Admin_Display::init();
