<?php
// Global namespace
namespace {
	require_once REGISTER_ACTIVATION . '/pp-default-pages/login.php';
	require_once REGISTER_ACTIVATION . '/pp-default-pages/registration.php';
	require_once REGISTER_ACTIVATION . '/pp-default-pages/password-reset.php';
}


namespace general_settings {

	/** Default plugin data for general settings */
	class General_Settings {

		/** Save default plugin settings on activation */
		public static function instance() {


			$general_settings = array();

            $general_settings['set_log_out_url'] = 'default';
			$general_settings['set_login_redirect'] = 'dashboard';

			$general_settings['set_login_url']                           = \pp_default_pages\Login::instance();
			$general_settings['set_registration_url']                    = \pp_default_pages\Registration::instance();
			$general_settings['set_lost_password_url']                   = \pp_default_pages\Password_Reset::instance();

			if ( is_multisite() ) {
				add_blog_option( null, 'pp_settings_data', $general_settings );
			}
			else {
				add_option( 'pp_settings_data', $general_settings );
			}

		}
	}

}