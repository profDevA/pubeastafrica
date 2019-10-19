<?php

require_once CLASSES . '/class.password-reset.php';

require_once VIEWS . '/login-form-builder/login-form-builder-settings-page.php';

require_once VIEWS . '/login-form-builder/login-builder-shortcode-parser.php';

class PP_Parent_Login_Shortcode_Parser {

	/** login error status     */
	private $login_status;

	/** Constructor */
	public function __construct() {
		add_shortcode( 'profilepress-login', array( $this, 'profilepress_login_parser' ) );
	}

	/** Parse login form */
	public function profilepress_login_parser( $atts ) {

		$atts = shortcode_atts(
			array(
				'id' => '',
				'redirect' => ''
			),
			$atts
		);

		// get login builder id
		$id = absint( $atts['id'] );
		$redirect = esc_url_raw($atts['redirect']);

		$login_error = ProfilePress_Login_Auth::credentials_validation($id, $redirect);
		$login_error = apply_filters('pp_login_error', $login_error);

		$attribution = '<!-- Custom Login form built with the ProfilePress WordPress plugin - https://profilepress.net -->' . "\r\n";

		$css = self::get_login_css( $id );

		return $attribution . $css . $login_error . $this->get_login_structure( $id );
	}


	/**
	 * Build the login structure
	 *
	 * @param int $id login builder ID
	 *
	 * @return string string login structure
	 */
	public function get_login_structure( $id ) {

		$login_structure = PROFILEPRESS_sql::get_a_builder_structure( 'login', $id );

		$form_tag = '<form method="post">';

		self::get_login_css( $id );

		return $form_tag . do_shortcode( $login_structure ) . '</form>';
	}


	/**
	 * Get the CSS stylesheet for the ID login
	 *
	 * @return mixed
	 */

	public static function get_login_css( $login_builder_id ) {

		// if no id is set return
		if ( ! isset( $login_builder_id ) ) {
			return;
		}

		$login_css = PROFILEPRESS_sql::get_a_builder_css( 'login', $login_builder_id );

		// added a break-line to the style tag to keep it in a new line - viewed when viewing site source code
		return "\r\n <style type=\"text/css\">\r\n" . $login_css . "\r\n</style>\r\n
";
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

PP_Parent_Login_Shortcode_Parser::get_instance();