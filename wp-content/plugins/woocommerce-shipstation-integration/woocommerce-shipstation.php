<?php
/**
 * Plugin Name: WooCommerce - ShipStation Integration
 * Plugin URI: https://woocommerce.com/products/shipstation-integration/
 * Version: 4.1.29
 * Description: Adds ShipStation label printing support to WooCommerce. Requires server DomDocument support.
 * Author: WooCommerce
 * Author URI: https://woocommerce.com/
 * Text Domain: woocommerce-shipstation
 * Domain Path: /languages
 * Tested up to: 5.0
 * WC tested up to: 3.7
 * WC requires at least: 2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WooCommerce fallback notice.
 *
 * @since 4.1.26
 * @return string
 */
function woocommerce_shipstation_missing_wc_notice() {
	/* translators: %s WC download URL link. */
	echo '<div class="error"><p><strong>' . sprintf( esc_html__( 'Shipstation requires WooCommerce to be installed and active. You can download %s here.', 'woocommerce-shipstation' ), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>' ) . '</strong></p></div>';
}

/**
 * Include shipstation class.
 *
 * @since 1.0.0
 */
function woocommerce_shipstation_init() {
	load_plugin_textdomain( 'woocommerce-shipstation', false, basename( dirname( __FILE__ ) ) . '/languages' );

	if ( ! class_exists( 'WooCommerce' ) ) {
		add_action( 'admin_notices', 'woocommerce_shipstation_missing_wc_notice' );
		return;
	}

	define( 'WC_SHIPSTATION_VERSION', '4.1.29' );
	define( 'WC_SHIPSTATION_FILE', __FILE__ );

	if ( ! defined( 'WC_SHIPSTATION_EXPORT_LIMIT' ) ) {
		define( 'WC_SHIPSTATION_EXPORT_LIMIT', 100 );
	}


	include_once( 'includes/class-wc-shipstation-integration.php' );
	include_once( 'includes/class-wc-shipstation-privacy.php' );
}

add_action( 'plugins_loaded', 'woocommerce_shipstation_init' );

/**
 * Define integration.
 *
 * @since 1.0.0
 *
 * @param  array $integrations Integrations.
 * @return array Integrations.
 */
function woocommerce_shipstation_load_integration( $integrations ) {
	$integrations[] = 'WC_ShipStation_Integration';

	return $integrations;
}

add_filter( 'woocommerce_integrations', 'woocommerce_shipstation_load_integration' );

/**
 * Listen for API requests.
 *
 * @since 1.0.0
 */
function woocommerce_shipstation_api() {
	include_once( 'includes/class-wc-shipstation-api.php' );
}

add_action( 'woocommerce_api_wc_shipstation', 'woocommerce_shipstation_api' );

/**
 * Added ShipStation custom plugin action links.
 *
 * @since 4.1.17
 * @version 4.1.17
 *
 * @param array $links Links.
 *
 * @return array Links.
 */
function woocommerce_shipstation_api_plugin_action_links( $links ) {
	$setting_link = admin_url( 'admin.php?page=wc-settings&tab=integration&section=shipstation' );
	$plugin_links = array(
		'<a href="' . $setting_link . '">' . __( 'Settings', 'woocommerce-shipstation' ) . '</a>',
		'<a href="https://woocommerce.com/my-account/tickets">' . __( 'Support', 'woocommerce-shipstation' ) . '</a>',
		'<a href="https://docs.woocommerce.com/document/shipstation-for-woocommerce/">' . __( 'Docs', 'woocommerce-shipstation' ) . '</a>',
	);

	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'woocommerce_shipstation_api_plugin_action_links' );
