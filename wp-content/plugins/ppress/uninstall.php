<?php
//if uninstall not called from WordPress exit
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

// Load ProfilePress file
include_once( 'profilepress.php' );

$plugin_general_settings = get_option( 'pp_settings_data' );

$delete = is_multisite() ? 'yes' : $plugin_general_settings['remove_plugin_data'];

if ( $delete == 'yes' ) {

	/** Delete plugin options */
	function pp_delete_multisite_option( $blog_id = '' ) {

		// remove uer moderation "pending" role
		remove_role( 'pending_users' );
		delete_blog_option( $blog_id, 'pp_settings_data' );
		delete_site_option( 'pp_plugin_lite_activated' );
		delete_site_option( 'pp_version' );
		delete_site_option( 'pp_db_ver' );
		delete_site_option( 'pp_db_lite_ver' );
	}

	/** Delete plugin options */
	function pp_delete_single_site_option() {
		delete_option( 'pp_settings_data' );
		delete_option( 'pp_plugin_lite_activated' );
		delete_option( 'pp_version' );
		delete_site_option( 'pp_db_ver' );
		delete_option( 'pp_db_lite_ver' );
	}


	global $wpdb;

	if ( is_multisite() ) {

		$blog_ids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );

		foreach ( $blog_ids as $blog_id ) {
			switch_to_blog( $blog_id );
			pp_delete_multisite_option( $blog_id );
			restore_current_blog();
		}
	} else {
		pp_delete_single_site_option();
	}


	$db_prefix = $wpdb->base_prefix;

	$drop_tables = array();

	$drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}pp_login_builder";
	$drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}pp_password_reset_builder";
	$drop_tables[] = "DROP TABLE IF EXISTS {$db_prefix}pp_registration_builder";

	foreach ( $drop_tables as $tables ) {
		$wpdb->query( $tables );
	}

	flush_rewrite_rules();
}