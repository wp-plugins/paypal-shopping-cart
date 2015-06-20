<?php

/**
 * @class       Paypal_Shopping_Cart_For_WordPress_Admin
 * @version	1.0.0
 * @package	paypal-shopping-cart-for-wordpress
 * @category	Class
 * @author      johnny manziel <phpwebcreators@gmail.com>
 */
class Paypal_Shopping_Cart_For_WordPress_Admin {

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
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->load_dependencies();
    }

    private function load_dependencies() {
        /**
         * The class responsible for defining all actions that occur in the Dashboard
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/paypal-shopping-cart-for-wordpress-admin-display.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/paypal-shopping-cart-for-wordpress-general-setting.php';

        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/paypal-shopping-cart-for-wordpress-html-output.php';
    }

    public function paypal_shopping_cart_button_woocommerce_standard_parameters($paypal_args) {
        if( isset($paypal_args['BUTTONSOURCE']) ) {
            $paypal_args['BUTTONSOURCE'] = 'mbjtechnolabs_SP';
        } else {
            $paypal_args['bn'] = 'mbjtechnolabs_SP';
        }
        return $paypal_args;
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wordpress_Customisation_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wordpress_Customisation_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/paypal-shopping-cart-admin.js', array('jquery'), $this->version, false);
    }

}
