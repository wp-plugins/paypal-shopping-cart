<?php

/**
 *
 * @wordpress-plugin
 * Plugin Name:       PayPal Shopping Cart
 * Plugin URI:        http://webs-spider.com/
 * Description:       PayPal Shopping Cart is a powerful, eCommerce plugin. No Coding Required. Official PayPal Partner.
 * Version:           1.0.0
 * Author:            johnwickjigo
 * Author URI:        http://www.mbjtechnolabs.com
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       paypal-shopping-cart
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!defined('PDW_PLUGIN_URL'))
    define('PDW_PLUGIN_URL', plugin_dir_url(__FILE__));

if (!defined('PDW_PLUGIN_DIR'))
    define('PDW_PLUGIN_DIR', dirname(__FILE__));

/**
 * define plugin basename
 */
if (!defined('PDW_PLUGIN_BASENAME')) {
    define('PDW_PLUGIN_BASENAME', plugin_basename(__FILE__));
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-paypal-shopping-cart-for-wordpress-activator.php
 */
function activate_paypal_shopping_cart_for_wordPress() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-paypal-shopping-cart-for-wordpress-activator.php';
    Paypal_Shopping_Cart_For_WordPress_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-paypal-shopping-cart-for-wordpress-deactivator.php
 */
function deactivate_paypal_shopping_cart_for_wordPress() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-paypal-shopping-cart-for-wordpress-deactivator.php';
    Paypal_Shopping_Cart_For_WordPress_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_paypal_shopping_cart_for_wordPress');
register_deactivation_hook(__FILE__, 'deactivate_paypal_shopping_cart_for_wordPress');

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-paypal-shopping-cart-for-wordpress.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_paypal_shopping_cart_for_wordPress() {

    $plugin = new Paypal_Shopping_Cart_For_WordPress();
    $plugin->run();
}

run_paypal_shopping_cart_for_wordPress();
