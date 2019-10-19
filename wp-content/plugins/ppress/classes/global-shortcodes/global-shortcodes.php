<?php

class ProfilePress_Global_Shortcodes {

	static private $current_user;

	public static function initialize() {
		add_action( 'init', array( __CLASS__, 'get_current_user' ) );
		add_shortcode( 'link-registration', array( __CLASS__, 'link_registration' ) );
		add_shortcode( 'link-lost-password', array( __CLASS__, 'link_lost_password' ) );
		add_shortcode( 'link-login', array( __CLASS__, 'link_login' ) );
		add_shortcode( 'link-logout', array( __CLASS__, 'link_logout' ) );
		add_shortcode( 'pp-login-form', array( __CLASS__, 'login_form_tag' ) );
		add_shortcode( 'pp-registration-form', array( __CLASS__, 'registration_form_tag' ) );
		add_shortcode( 'pp-password-reset-form', array( __CLASS__, 'password_reset_form_tag' ) );
		add_shortcode( 'pp-redirect-non-logged-in-users', array( __CLASS__, 'redirect_non_logged_in_users' ) );
	}

	/** Get the currently logged user */
	public static function get_current_user() {
		$current_user = wp_get_current_user();
		if ( $current_user instanceof WP_User ) {
			self::$current_user = $current_user;
		}
	}

	/**
	 * Login form tag
	 *
	 * @param array $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public static function login_form_tag( $atts, $content ) {
		$login_error = ProfilePress_Login_Auth::credentials_validation();

		$tag = '<form method="post" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '">';
		$tag .= do_shortcode( $content );
		$tag .= '</form>';

		return $login_error . $tag;
	}

	/**
	 * Registration form tag
	 *
	 * @param array $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public static function registration_form_tag( $atts, $content ) {

		$registration_status = ProfilePress_Registration_Auth::validate_registration_form();

		$tag = '<form method="post" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '">';
		$tag .= do_shortcode( $content );
		$tag .= '</form>';

		return $registration_status . $tag;

	}

	/**
	 * Password reset form tag
	 *
	 * @param array $atts
	 * @param string $content
	 *
	 * @return string
	 */
	public static function password_reset_form_tag( $atts, $content ) {

		$password_reset_structure = ProfilePress_Registration_Auth::validate_registration_form();

		$tag = '<form method="post" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '">';
		$tag .= do_shortcode( $content );
		$tag .= '</form>';

		return $password_reset_structure . $tag;

	}


	/**
	 * Normalize unamed shortcode
	 *
	 * @param $atts
	 *
	 * @return mixed
	 */
	public static function normalize_attributes( $atts ) {
		if ( is_array( $atts ) ) {
			foreach ( $atts as $key => $value ) {
				if ( is_int( $key ) ) {
					$atts[ $value ] = true;
					unset( $atts[ $key ] );
				}
			}

			return $atts;
		}
	}

	/** registration url */
	public static function link_registration( $atts ) {

		$atts = self::normalize_attributes( $atts );

		if ( ( ! empty( $atts['raw'] ) && ( $atts['raw'] == true ) ) ) {
			return wp_registration_url();
		}

		$atts = shortcode_atts(
			array(
				'class' => '',
				'id'    => '',
				'title' => '',
				'label' => 'Sign Up',
				'raw'   => ''
			),
			$atts
		);

		$class = 'class="' . $atts['class'] . '"';
		$id    = 'id="' . $atts['id'] . '"';
		$label = $atts['label'];
		$title = 'title="' . $atts['title'] . '"';


		$html = '<a href="' . wp_registration_url() . "\" {$title} {$class} {$id}>$label</a>";

		return $html;
	}

	/** Lost password url */
	public static function link_lost_password( $atts ) {

		$atts = self::normalize_attributes( $atts );


		if ( ( ! empty( $atts['raw'] ) && ( $atts['raw'] == true ) ) ) {
			return wp_lostpassword_url();
		}

		$atts = shortcode_atts(
			array(
				'class' => '',
				'id'    => '',
				'title' => '',
				'label' => 'Reset Password',
				'raw'   => ''
			),
			$atts
		);

		$class = 'class="' . $atts['class'] . '"';
		$id    = 'id="' . $atts['id'] . '"';
		$label = $atts['label'];
		$title = 'title="' . $atts['title'] . '"';

		$html = '<a href="' . wp_lostpassword_url() . "\" {$title} {$class} {$id}>$label</a>";

		return $html;
	}


	/** Login url */
	public static function link_login( $atts ) {

		$atts = self::normalize_attributes( $atts );

		if ( ( ! empty( $atts['raw'] ) && ( $atts['raw'] == true ) ) ) {
			return wp_login_url();
		}

		$atts = shortcode_atts(
			array(
				'class' => '',
				'id'    => '',
				'title' => '',
				'label' => 'Login',
				'raw'   => ''
			),
			$atts
		);

		$class = 'class="' . $atts['class'] . '"';
		$id    = 'id="' . $atts['id'] . '"';
		$label = $atts['label'];
		$title = 'title="' . $atts['title'] . '"';

		$html = '<a href="' . wp_login_url() . '" ' . "$title $class $id" . '>' . $label . '</a>';

		return $html;
	}

	/** Logout URL */
	public static function link_logout( $atts ) {
		if ( ! is_user_logged_in() ) {
			return;
		}

		$atts = self::normalize_attributes( $atts );

		if ( ( ! empty( $atts['raw'] ) && ( $atts['raw'] == true ) ) ) {
			return wp_logout_url();
		}

		$atts = shortcode_atts(
			array(
				'class' => '',
				'id'    => '',
				'title' => '',
				'label' => '',
				'raw'   => ''
			),
			$atts
		);

		$class = 'class="' . $atts['class'] . '"';
		$id    = 'id="' . $atts['id'] . '"';
		$label = $atts['label'];
		$title = 'title="' . $atts['title'] . '"';

		$html = '<a href="' . wp_logout_url() . '" ' . "$title $class $id" . '>' . $label . '</a>';

		return $html;

	}


	/**
	 * Redirect non logged users to login page.
	 *
	 * @param array $atts
	 */
	public static function redirect_non_logged_in_users( $atts ) {
		if ( is_user_logged_in() ) {
			return;
		}

		$atts = shortcode_atts(
			array(
				'url' => ''
			),
			$atts
		);

		$url = empty( $atts['url'] ) ? pp_login_redirect() : $atts['url'];

		wp_redirect( $url );
		exit;
	}

}

ProfilePress_Global_Shortcodes::initialize();