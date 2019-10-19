<?php
/**
 * Theme name: FlatUi by Designmodo
 * Builder type: Login form
 */
namespace logins\flatui_theme;

/**
 * Class FlatUI_Login
 * @package logins\flatui_theme
 */
class FlatUI_Login {

	public static function instance() {
		global $wpdb;

		$wpdb->insert(
			LOGIN_TABLE,
			array(
				'title' => 'FlatUI Login Theme',
				'structure' => self::structure(),
				'css' => self::css(),
				'date' => date( 'Y-m-d' )
			),
			array(
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
/* css class for the login generated errors */

.profilepress-login-status {

    background-color: #34495e;
    color: #ffffff;
    border: medium none;
    border-radius: 4px;
    font-size: 15px;
    font-weight: normal;
    line-height: 1.4;
    padding: 8px 5px;
    margin:4px 0;
    transition: border 0.25s linear 0s, color 0.25s linear 0s, background-color 0.25s linear 0s;
}

.profilepress-login-status a {
  color: #ea9629 !important;
}

/*
This login form uses the FlatUI css stylesheet that ships with the plugin hence this look.
It's actually very pretty when implemented.
*/
CSS;

	}

	public static function structure() {
		return	<<<STRUCTURE
<div class="login-form">

<div class="form-group">
[login-username placeholder="username" class="form-control login-field" id="login-name"]
<label class="login-field-icon fui-user" for="login-name"></label>
</div>

<div class="form-group">
[login-password placeholder="password" class="form-control login-field" id="login-pass"]
<label class="login-field-icon fui-lock" for="login-pass"></label>
</div>

<div class="form-group">
[login-remember class="flat-checkbox" id="remember-me"]
<label for="remember-me" class="css-label lite-cyan-check">Remember me</label>
</div>

[login-submit value="Sign In" class="btn btn-primary btn-lg btn-block"]


<div class="form-group"><br/>
[link-registration class="reg" label="Register"] | [link-lost-password class="lostp" label="Forgot Password?"]
</div>
</div>

STRUCTURE;
	}
}