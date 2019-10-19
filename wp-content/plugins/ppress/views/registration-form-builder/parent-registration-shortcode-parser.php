<?php

require_once VIEWS . '/registration-form-builder/registration-form-builder-settings-page.php';

require_once VIEWS . '/registration-form-builder/registration-builder-shortcode-parser.php';

// include the registration form auth
require_once CLASSES . '/class-registration-form-auth.php';


class PP_Parent_Registration_Shortcode_Parser {

	function __construct() {

		add_shortcode( 'profilepress-registration', array( __CLASS__, 'profilepress_registration_parser' ) );
	}

	public static function profilepress_registration_parser( $atts ) {

		$atts = shortcode_atts(
			array(
				'id' => '',
				'redirect' => ''
			),
			$atts
		);

		// get registration builder id
		$id = absint( $atts['id'] );
		$redirect = esc_url_raw($atts['redirect']);

		$registration_status = ProfilePress_Registration_Auth::validate_registration_form($id, $redirect);
		$registration_status = apply_filters('pp_registration_status', $registration_status, $id, $redirect);

		$attribution = '<!-- Custom "Edit Profile Page" built with the ProfilePress WordPress plugin - https://profilepress.net -->' . "\r\n";

		$css = self::get_registration_css( $id );

		// call the registration structure/design
		return $attribution . $css . $registration_status . self::get_registration_structure( $id );

	}


	/**
	 * Get the registration structure from the database
	 *
	 * @param int $id
	 *
	 * @return string
	 */
	public static function get_registration_structure( $id ) {
		if ( ! get_option( 'users_can_register' ) ) {
			return apply_filters( 'pp_registration_disabled_text', __( 'Registration is disabled in this site.', 'ppress' ) );
		}
		else {
			$registration_structure = PROFILEPRESS_sql::get_a_builder_structure( 'registration', $id );

			$form_tag = '<form method="post" enctype="multipart/form-data">';

			return $form_tag . do_shortcode( $registration_structure ) . '</form>';
		}
	}


	/**
	 * Get the CSS stylesheet for the ID registration
	 *
	 * @return mixed
	 */

	public static function get_registration_css( $registration_builder_id ) {

		// if no id is set return
		if ( ! isset( $registration_builder_id ) ) {
			return;
		}

		$registration_css = PROFILEPRESS_sql::get_a_builder_css( 'registration', $registration_builder_id );

		return "<style type=\"text/css\">\r\n $registration_css \r\n</style>";
	}


	/** Singleton poop */
	static function get_instance() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self;
		}

		return $instance;
	}
}

PP_Parent_Registration_Shortcode_Parser::get_instance();