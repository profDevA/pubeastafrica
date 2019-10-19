<?php
/**
 * @package   ProfilePress_WordPress_Plugin
 * @author    ProfilePress Team <me@w3guy.com>
 * @license   GPL-2.0+
 * @link      https://profilepress.net
 * @copyright 2017 Proper Fraction Limited <me@w3guy.com>
 * @wordpress-plugin
 *
 * Plugin Name: ProfilePress Lite
 * Plugin URI: https://profilepress.net
 * Description: Ultimate Custom Registration, Login, Profile and User Account Management WordPress Plugin.
 * Version: 1.5.13
 * Author: ProfilePress Team
 * Author URI: https://profilepress.net
 * Text Domain: ppress
 * Domain Path: /languages/
 *
 */

defined( 'ABSPATH' ) or die( "No script kiddies please!" );

define( 'PROFILEPRESS_SYSTEM_FILE_PATH', __FILE__ );
define( 'PROFILEPRESS_ROOT', plugin_dir_path( __FILE__ ) );
define( 'PROFILEPRESS_ROOT_URL', plugin_dir_url( __FILE__ ) );

define( 'CSS', PROFILEPRESS_ROOT . 'css' );
define( 'PASSWORD_RESET', PROFILEPRESS_ROOT . 'password-reset' );
define( 'VIEWS', PROFILEPRESS_ROOT . 'views' );
define( 'CLASSES', PROFILEPRESS_ROOT . 'classes' );
define( 'THEMES_FOLDER', PROFILEPRESS_ROOT . 'theme' );
define( 'REGISTER_ACTIVATION', PROFILEPRESS_ROOT . 'register-activation' );

define( 'TEMPLATES_URL', PROFILEPRESS_ROOT_URL . 'theme' );
define( 'ASSETS_URL', PROFILEPRESS_ROOT_URL . 'assets' );
define( 'VIEWS_URL', PROFILEPRESS_ROOT_URL . 'views' );

define( 'LOGIN_BUILDER_SETTINGS_PAGE_SLUG', 'pp-login' );
define( 'REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG', 'pp-registration' );
define( 'PASSWORD_RESET_BUILDER_SETTINGS_PAGE_SLUG', 'pp-password-reset' );

add_action( 'plugins_loaded', 'pp_plugin_load_textdomain' );
function pp_plugin_load_textdomain() {
	load_plugin_textdomain( 'ppress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

require_once CLASSES . '/class.load-files.php';
require_once PROFILEPRESS_ROOT . '/register-activation/base.php';

register_activation_hook( __FILE__, array( 'ProfilePress_Plugin_On_Activate', 'instance' ) );
register_deactivation_hook( __FILE__, 'pp_flush_rewrites_deactivate' );


// update DB when new new blog is created in multi site.
add_action( 'wpmu_new_blog', 'pp_activation_on_new_mu_blog', 10, 2 );
/** register activation ish when a new multi-site blog is created */
function pp_activation_on_new_mu_blog( $blog_id, $user_id ) {
	if ( is_plugin_active_for_network( 'profilepress/profilepress.php' ) ) {
		switch_to_blog( $blog_id );
		ProfilePress_Plugin_On_Activate::plugin_settings_activation();
		restore_current_blog();
	}
}

/** Flush rewrite rule on plugin deactivation */
function pp_flush_rewrites_deactivate() {
	flush_rewrite_rules();
}

// load plugin files
ProfilePress_Dir::load_files();

// call plugin update
add_action( 'plugins_loaded', 'pp_update_plugin', 10 );
function pp_update_plugin() {
	if ( ! is_admin() ) {
		return;
	}
	$instance = ProfilePress\Plugin_Update\PP_Update::get_instance();
	$instance->maybe_update();
}