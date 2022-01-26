<?php
/*
 * Plugin Name: WP Amazon Shop Modificado AAWP
 * Version: 2.0.8
 * Plugin URI: http://www.amadercode.com/wp-amazon-shop-drop-shipping-affiliation
 * Description: Plugin WP Amazon Shop modificado para tener el diseño del AAWP.
 * Author: Patxi Juaristi
 * Author URI: https://juaristech.com
 * Requires at least: 4.0
 * Tested up to: 5.3
 * Stable tag: 2.0.8
 * Text Domain: wp-amazon-shop
 * Domain Path: /lang/
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) exit;
define( 'ACL_WPAS_VERSION', '2.0.8' );
define( 'ACL_WPAS_REQUIRED_PHP_VERSION', '5.3.0' );
define( 'ACL_WPAS_WP_VERSION', '4.0' );
define( 'ACL_WPAS_PRODUCT_PERMIT', 20);
if ( ! defined( 'ACL_WPAS_PLUGIN_FILE' ) ) {
    define( 'ACL_WPAS_PLUGIN_FILE', __FILE__ );
}
define('ACL_WPAS_IMG_PATH', plugin_dir_url(__FILE__).'assets/images/');

// Load plugin basic class files
require_once( 'includes/wp-amazon-shop-plugin.php' );
require_once( 'includes/wp-amazon-shop-settings.php');
require_once( 'includes/wp-amazon-shop-admin-api.php');
// Load Amazon sdk libraries
require_once( 'includes/wp-amazon-shop-install.php');
require_once( 'includes/lib/html/simple_html_dom.php');
//Load Plugin Operation class files
require_once( 'includes/wp-amazon-shop-handler.php');
require_once( 'includes/wp-amazon-shop-functions.php');

/**
 * Returns the main instance of WordPress_Plugin_Template to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WordPress_Plugin_Template
 */
function acl_amazon_product_template () {
	$instance = ACL_Amazon_Product_Plugin::instance( __FILE__, ACL_WPAS_VERSION );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = ACL_Amazon_Product_Settings::instance( $instance );
	}
	return $instance;
}

add_action('plugins_loaded', 'acl_amazon_product_template');
//Activation Hook
register_activation_hook( __FILE__, array('ACL_Amazon_Shop_Install','pre_installation_required_check') );
//Redirect to setting page.
if(!function_exists('acl_wpas_settings_redirect')){
    function acl_wpas_settings_redirect( $plugin ) {
        if( $plugin == plugin_basename( __FILE__ )) {
            wp_redirect( admin_url('admin.php?page=wp-amazon-shop'));
            exit();
        }
    }
    add_action( 'activated_plugin', 'acl_wpas_settings_redirect' );
}
