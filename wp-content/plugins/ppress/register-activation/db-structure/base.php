<?php

namespace db_structure;

class PP_Db_Schema {

	public static function instance() {

		self::create_plugin_db_structure();
	}


	/** Create the plugin DB table structure */
	public static function create_plugin_db_structure() {

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$login_builder_table         = LOGIN_TABLE;
		$password_reset_table        = PASSWORD_RESET_TABLE;
		$registration_table          = REGISTRATION_TABLE;


		// applicable for the other builders
		$blog_id_and_date_column = is_multisite() ? 'date text NOT NULL, blog_id MEDIUMINT(9) NOT NULL' : 'date text NOT NULL';

		// custom profile field
		$blog_id_and_options = is_multisite() ? 'options varchar(200) NOT NULL, blog_id MEDIUMINT(9) NOT NULL' : 'options varchar(200) NOT NULL';

		// make builder widget
		$blog_id_and_builder_id = is_multisite() ? 'builder_id mediumint(9) NOT NULL, blog_id MEDIUMINT(9) NOT NULL' : 'builder_id mediumint(9) NOT NULL';


		$tables_to_create[] = "CREATE TABLE IF NOT EXISTS $login_builder_table (
							  id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
							  PRIMARY KEY  (id),
							  title varchar(50) NOT NULL,
							  structure longtext NOT NULL,
							  css longtext NOT NULL,
							  $blog_id_and_date_column
							) $charset_collate;";

		$tables_to_create[] = "CREATE TABLE IF NOT EXISTS $password_reset_table (
							  id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
							  PRIMARY KEY  (id),
							  title varchar(50) NOT NULL,
							  structure longtext NOT NULL,
							  css longtext NOT NULL,
							  success_password_reset text NOT NULL,
							  $blog_id_and_date_column
							) $charset_collate;";

		$tables_to_create[] = "CREATE TABLE IF NOT EXISTS $registration_table (
							  id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
							  PRIMARY KEY  (id),
							  title varchar(50) NOT NULL,
							  structure longtext NOT NULL,
							  css longtext NOT NULL,
							  success_registration text NOT NULL,
							  $blog_id_and_date_column
							) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		foreach ( $tables_to_create as $sql ) {
			dbDelta( $sql );
		}

	}
}