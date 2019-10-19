<?php

class Password_Reset_Builder_Shortcode_Parser {

	/**
	 * define all registration builder sub shortcode.
	 */
	function __construct() {
		add_shortcode( 'user-login', array( $this, 'profilepress_user_login' ) );
		add_shortcode( 'reset-submit', array( $this, 'profilepress_submit_button' ) );

		add_shortcode( 'enter-password', array( $this, 'enter_password' ) );
		add_shortcode( 're-enter-password', array( $this, 're_enter_password' ) );
		add_shortcode( 'password-reset-submit', array( $this, 'password_reset_submit' ) );
	}


	/**
	 * parse the [user-login] shortcode
	 *
	 * @param array $atts
	 *
	 * @return string
	 */
	function profilepress_user_login( $atts ) {

		// grab unofficial attributes
		$other_atts_html = pp_other_field_atts( $atts );

		$atts = shortcode_atts(
			array(
				'class'       => '',
				'id'          => '',
				'value'       => '',
				'title'       => 'Username or Email',
				'placeholder' => 'Username or Email'
			),
			$atts
		);

		$class       = 'class="' . $atts['class'] . '"';
		$placeholder = 'placeholder="' . $atts['placeholder'] . '"';
		 $id   = !empty($atts['id']) ? 'id="' . $atts['id'] . '"' : null;
		$value       = isset( $_POST['user_login'] ) ? 'value="' . esc_attr( $_POST['user_login'] ) . '"' : 'value=""';

		$title = 'title="' . $atts['title'] . '"';

		$html = "<input name=\"user_login\" type='text' $title $value $class $id $placeholder $other_atts_html required='required'/>";

		return $html;
	}

	public function reset_password_form_fields() { ?>
		<p><?php echo apply_filters( 'pp_reset_password_message',
				__( 'Enter a new password below.', 'ppress' ) ); ?></p>

		<p class="form-row form-row-first">
			<label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?>
				<span class="required">*</span></label>
			<input type="password" class="input-text" name="password_1" id="password_1"/>
		</p>		<p class="form-row form-row-last">
			<label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?>
				<span class="required">*</span></label>
			<input type="password" class="input-text" name="password_2" id="password_2"/>
		</p>
	<?php }


	/**
	 * Password reset submit button.
	 *
	 * @param $atts array shortcode param
	 *
	 * @return string HTML submit button
	 */
	function profilepress_submit_button( $atts ) {

		// grab unofficial attributes
		$other_atts_html = pp_other_field_atts( $atts );

		$atts = shortcode_atts(
			array(
				'class' => '',
				'id'    => '',
				'value' => 'Get New Password',
				'title' => '',
				'name'  => 'password_reset_submit'
			),
			$atts
		);

		$name  = 'name="' . $atts['name'] . '"';
		$class = 'class="' . $atts['class'] . '"';
		$value = 'value="' . $atts['value'] . '"';
		$id    = ! empty( $atts['id'] ) ? 'id="' . $atts['id'] . '"' : '';

		$title = 'title="' . $atts['title'] . '"';

		$html = "<input type='submit' $name $title $value $id $class $other_atts_html />";

		return $html;
	}


	/**
	 * parse the [enter-password] shortcode
	 *
	 * @param array $atts
	 *
	 * @return string
	 */
	function enter_password( $atts ) {

		// grab unofficial attributes
		$other_atts_html = pp_other_field_atts( $atts );

		$atts = shortcode_atts(
			array(
				'class'       => '',
				'id'          => '',
				'value'       => '',
				'title'       => '',
				'placeholder' => ''
			),
			$atts
		);

		$class       = 'class="' . $atts['class'] . '"';
		$placeholder = 'placeholder="' . $atts['placeholder'] . '"';
		 $id   = !empty($atts['id']) ? 'id="' . $atts['id'] . '"' : null;
		$value       = isset( $_POST['password1'] ) ? 'value="' . esc_attr( $_POST['password1'] ) . '"' : 'value=""';

		$title = 'title="' . $atts['title'] . '"';

		$html = "<input name=\"password1\" type='password' $title $value $class $id $placeholder $other_atts_html autocomplete='off'>";

		return $html;
	}


	/**
	 * parse the [re-enter-password] shortcode
	 *
	 * @param array $atts
	 *
	 * @return string
	 */
	function re_enter_password( $atts ) {

		// grab unofficial attributes
		$other_atts_html = pp_other_field_atts( $atts );

		$atts = shortcode_atts(
			array(
				'class'       => '',
				'id'          => '',
				'value'       => '',
				'title'       => '',
				'placeholder' => ''
			),
			$atts
		);

		$class       = 'class="' . $atts['class'] . '"';
		$placeholder = 'placeholder="' . $atts['placeholder'] . '"';
		 $id   = !empty($atts['id']) ? 'id="' . $atts['id'] . '"' : null;
		$value       = isset( $_POST['password2'] ) ? 'value="' . esc_attr( $_POST['password2'] ) . '"' : 'value=""';

		$title = 'title="' . $atts['title'] . '"';

		$html = "<input name=\"password2\" type='password' $title $value $class $id $placeholder $other_atts_html autocomplete='off'>";

		return $html;
	}

	/**
	 * Password reset handler submit button.
	 *
	 * @param $atts array shortcode param
	 *
	 * @return string HTML submit button
	 */
	function password_reset_submit( $atts ) {

		// grab unofficial attributes
		$other_atts_html = pp_other_field_atts( $atts );

		$atts = shortcode_atts(
			array(
				'class' => '',
				'id'    => '',
				'value' => 'Get New Password',
				'title' => '',
				'name'  => 'reset_password'
			),
			$atts
		);

		$name  = 'name="' . $atts['name'] . '"';
		$class = 'class="' . $atts['class'] . '"';
		$value = 'value="' . $atts['value'] . '"';
		$id    = ! empty( $atts['id'] ) ? 'id="' . $atts['id'] . '"' : '';

		$title = 'title="' . $atts['title'] . '"';

		$html = "<input type='submit' $name $title $value $id $class $other_atts_html />";

		return $html;
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

Password_Reset_Builder_Shortcode_Parser::get_instance();
