<?php
/**
 * Theme name: FlatUI by Designmodo
 * Builder type: Password Reset form
 */
namespace password_reset\flatui_theme;

/**
 * Class Flatui_Password_Reset
 * @package password_reset\flatui_theme
 */
class Flatui_Password_Reset {

	public static function instance() {
		global $wpdb;

		$wpdb->insert(
			PASSWORD_RESET_TABLE,
			array(
				'title'                => 'FlatUI Password Reset',
				'structure'            => self::structure(),
				'css'                  => self::css(),
				'success_password_reset' => '<div class="profilepress-reset-status">Check your email for further instructions.</div>',
				'date'                 => date( 'Y-m-d' )
			),
			array(
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			)
		);
	}


	/** CSS stylesheet */
	public static function css() {
		return <<<CSS
/* css class for the password reset form generated errors */

.profilepress-reset-status {

    background-color: #34495e;
    color: #ffffff;
    border: medium none;
    border-radius: 4px;
    font-size: 15px;
    font-weight: normal;
    line-height: 1.4;
    padding: 8px 5px;
    margin: 4px 0;
    transition: border 0.25s linear 0s, color 0.25s linear 0s, background-color 0.25s linear 0s;
}

/*
This form uses the FlatUI css stylesheet that ships with the plugin hence this look.
It's actually very pretty when implemented.
*/
CSS;

	}


	/** Registration structure */
	public static function structure() {
		return <<<STRUCTURE
<div class="login-form">

<p>
Please enter your username or email address.
You will receive a link to create a new password via email.</p>

<div class="form-group">
[user-login id="login" placeholder="Username or E-mail:" class="form-control login-field"]
<label class="login-field-icon fui-user" for="login"></label>
</div>


<p>
[reset-submit value="Reset Password" class="btn btn-primary btn-lg btn-block" id="submit-button"]
</p>

</div>
STRUCTURE;
	}
}