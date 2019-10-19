<?php

/**
 * Parser for the child-shortcode of login form
 */
class Login_Builder_Shortcode_Parser {

	/**
	 * define all login builder sub shortcode.
	 */
	function __construct() {
		add_shortcode( 'login-username', array( $this, 'login_username' ) );

		add_shortcode( 'login-password', array( $this, 'login_password' ) );

		add_shortcode( 'login-remember', array( $this, 'login_remember' ) );

		add_shortcode( 'login-submit', array( $this, 'login_submit' ) );


	}


	/**
	 * parse the [login-username] shortcode
	 *
	 * @param array $atts
	 *
	 * @return string
	 */
	function login_username( $atts ) {
		$atts = shortcode_atts(
			array(
				'class' => '',
				'id' => '',
				'value' => '',
				'title' => '',
				'placeholder' => ''
			),
			$atts
		);

		$field_title = $atts['title'];

		$class       = 'class="' . $atts['class'] . '"';
		$placeholder = 'placeholder="' . $atts['placeholder'] . '"';
		 $id   = !empty($atts['id']) ? 'id="' . $atts['id'] . '"' : null;
		$value       = !empty( $atts['value'] ) ? 'value="' . $atts['value'] . '"' : 'value="' . esc_attr( @$_POST['login_username'] ) . '"';

		$title = isset( $field_title ) ? "title=\"$field_title\"" : null;


		$html = <<<HTML
<input name="login_username" type="text" {$value} {$title} $class $placeholder $id required="required" />
HTML;
		return $html;
	}

	/**
	 * @param array $atts
	 *
	 * parse the [login-password] shortcode
	 *
	 * @return string
	 */
	function login_password( $atts ) {
		$atts = shortcode_atts(
			array(
				'class' => '',
				'id' => '',
				'value' => '',
				'title' => '',
				'placeholder' => ''
			),
			$atts
		);

		$class       = 'class="' . $atts['class'] . '"';
		$placeholder = 'placeholder="' . $atts['placeholder'] . '"';
		 $id   = !empty($atts['id']) ? 'id="' . $atts['id'] . '"' : null;
		$value       = !empty( $atts['value'] ) ? 'value="' . $atts['value'] . '"' : 'value="' . esc_attr( @$_POST['login_password'] ) . '"';

		$field_title = $atts['title'];
		$title       = isset( $field_title ) ? "title=\"$field_title\"" : '';

		$html = "<input name='login_password' type='password' $title $value $class $placeholder $id required='required' />";

		return $html;
	}

	/** Remember me checkbox */
	function login_remember( $atts ) {
		$atts = shortcode_atts(
			array(
				'class' => '',
				'id' => '',
				'title' => ''
			),
			$atts
		);

		$class = 'class="' . $atts['class'] . '"';
		$id    = 'id="' . $atts['id'] . '"';

		$field_title = $atts['title'];
		$title       = isset( $field_title ) ? "title=\"$field_title\"" : '';

		$html = "<input name='login_remember' value='true' type='checkbox' $title $class $id checked='checked' />";

		return $html;
	}


	/** Login submit button */
	function login_submit( $atts ) {
		$atts = shortcode_atts(
			array(
				'class' => '',
				'id' => '',
				'value' => 'Log In',
				'title' => '',
				'name' => 'login_submit'
			),
			$atts
		);

		$name    = 'name="' . $atts['name'] . '"';
		$class = 'class="' . $atts['class'] . '"';
		$id    = 'id="' . $atts['id'] . '"';
		$value = !empty( $atts['value'] ) ? 'value="' . $atts['value'] . '"' : 'value="Log In"';

		$field_title = $atts['title'];
		$title       = isset( $field_title ) ? "title=\"$field_title\"" : '';

		$html = "<input type='submit' $name $title $class $id $value />";

		return $html;
	}


	/** singleton poop */
	static function get_instance() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self;
		}

		return $instance;
	}
}

Login_Builder_Shortcode_Parser::get_instance();
