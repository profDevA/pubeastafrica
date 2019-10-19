<?php
/**
 * Theme name: FlatUI by Designmodo
 * Builder type: Registration form
 */
namespace registrations\flatui_theme;

/**
 * Class FlatUI_Registrations
 * @package registrations\flatui_theme
 */
class FlatUI_Registrations {

	public static function instance() {
		global $wpdb;

		$wpdb->insert(
			REGISTRATION_TABLE,
			array(
				'title'                => 'FlatUI Registration Theme',
				'structure'            => self::structure(),
				'css'                  => self::css(),
				'success_registration' => '<div class="profilepress-reg-status">Registration Successful</div>',
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

	/** Login CSS */
	public static function css() {
		return <<<CSS
/* css class for the registration form generated errors */

.profilepress-reg-status {
  border-radius: 6px;
  font-size: 17px;
  line-height: 1.471;
  padding: 10px 19px;
  background-color: #e74c3c;
  color: #ffffff;
  font-weight: normal;
  transition: border 0.25s linear 0s, color 0.25s linear 0s, background-color 0.25s linear 0s;
  display: block;
  text-align: center;
  vertical-align: middle;
  margin: 5px 0;
}

.profilepress-reg-status a {
  color: #fff;
  font-weight: bold;
}

.profilepress-reg-label {
  padding: 1px 8px 2px 3px;
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
    <div class="form-group">[reg-username id="reg-username" placeholder="Username" class="form-control login-field"]
        <label class="login-field-icon fui-user" for="reg-username"></label></div>
    <div class="form-group">[reg-password id="reg-password" placeholder="Password" class="form-control login-field"]
        <label class="login-field-icon fui-lock" for="reg-password"></label></div>
    <div class="form-group">[reg-email id="reg-email" placeholder="Email" class="form-control login-field"]
        <label class="login-field-icon fui-mail" for="reg-email"></label></div>
    <div class="form-group">[reg-website class="form-control login-field" placeholder="Website" id="reg-website" required]
        <label class="login-field-icon fui-chat" for="reg-website"></label></div>
    <div class="form-group">[reg-nickname class="form-control login-field" placeholder="Nickname" id="id-nickname"]
        <label class="login-field-icon fui-user" for="id-nickname"></label></div>
    <div class="form-group">[reg-first-name class="form-control login-field" id="reg-firstname" placeholder="First Name"]
        <label class="login-field-icon fui-user" for="reg-firstname"></label></div>
    <div class="form-group">[reg-last-name class="form-control login-field" id="reg-lastname" placeholder="Last Name" required]
        <label class="login-field-icon fui-user" for="reg-lastname"></label></div>
    <div class="form-group">[reg-submit value="Register" class="btn btn-primary btn-lg btn-block" id="submit-button"]</div>
    <div class="form-group" style="text-align:center">Have an account? [link-login label="Login"]</div>
</div>

STRUCTURE;
	}
}