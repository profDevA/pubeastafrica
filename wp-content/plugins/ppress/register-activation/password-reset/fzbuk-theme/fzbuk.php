<?php
/**
 * Theme name: Fzbuk
 * Builder type: Password Reset form
 */
namespace password_reset\fzbuk_theme;

/**
 * Class Fzbuk_Password_Reset
 * @package password_reset\fzbuk_theme
 */
class Fzbuk_Password_Reset {

	public static function instance() {
		global $wpdb;

		$wpdb->insert(
			PASSWORD_RESET_TABLE,
			array(
				'title'                  => 'Fzbuk Password Reset',
				'structure'              => self::structure(),
				'css'                    => self::css(),
				'success_password_reset' => '<div class="profilepress-reset-status">Check your e-mail for further instruction.</div>',
				'date'                   => date( 'Y-m-d' )
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
/* css class for the password reset form generated errors */

.profilepress-reset-status {
-webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  color: #fff;
  background: #5170ad;
  background: -moz-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #5170ad), color-stop(100%, #355493));
  background: -webkit-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -o-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -ms-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: radial-gradient(ellipse at center, #5170ad 0%, #355493 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5170ad', endColorstr='#355493',GradientType=1 );
  border: 1px solid #2d416d;
  box-shadow: 0 1px #5670A4 inset, 0 0 10px 5px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  position: relative;
  width: 360px;
  text-align: center;
  margin: 10px auto;
  padding: 10px;
}


.fzbuk-login-form-wrap {

-webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;

  background: #5170ad;
  background: -moz-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #5170ad), color-stop(100%, #355493));
  background: -webkit-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -o-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: -ms-radial-gradient(center, ellipse cover, #5170ad 0%, #355493 100%);
  background: radial-gradient(ellipse at center, #5170ad 0%, #355493 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#5170ad', endColorstr='#355493',GradientType=1 );
  border: 1px solid #2d416d;
  box-shadow: 0 1px #5670A4 inset, 0 0 10px 5px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  position: relative;
  width: 360px;
  height: 300px;
  margin: 10px auto;
  padding: 50px 30px 0 30px;
  text-align: center;
}
.fzbuk-login-form-wrap:before {
  display: block;
  content: '';
  width: 58px;
  height: 19px;
  top: 10px;
  left: 10px;
  position: absolute;
}
.fzbuk-login-form-wrap > h1 {
  font-size: 15px;
  margin: 0 0 50px 0;
  padding: 0;
  font-size: 26px;
  color: #fff;
}
.fzbuk-login-form-wrap > h5 {
  color: #303030;
  margin-top: 20px;
  font-size: 15px;
}
.fzbuk-login-form-wrap > h5 > a {
  font-size: 15px;
  color: #fff;
  text-decoration: none;
  font-weight: 400;
}

.fzbuk-login-form input[type="text"], .fzbuk-login-form input[type="password"], .fzbuk-login-form input[type="email"] {
  width: 100%;
  border: 1px solid #314d89;
  outline: none;
  padding: 12px 20px;
  color: #afafaf;
  font-weight: 400;
  font-family: "Lato", sans-serif;
  cursor: text;
}

.fzbuk-login-form label {
display: block;
}

.fzbuk-login-form input[type="text"]  {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  border-bottom: none;
  border-radius: 4px 4px 0 0;
  padding-bottom: 13px;
  box-shadow: 0 -1px 0 #E0E0E0 inset, 0 1px 2px rgba(0, 0, 0, 0.23) inset;
}

.fzbuk-login-form input[type="submit"] {
  font-family: "Lato", sans-serif;
  font-weight: 400;
  background: #e0e0e0;
  background: -moz-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #e0e0e0), color-stop(100%, #cecece));
  background: -webkit-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: -o-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: -ms-linear-gradient(top, #e0e0e0 0%, #cecece 100%);
  background: linear-gradient(to bottom, #e0e0e0 0%, #cecece 100%);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e0e0e0', endColorstr='#cecece',GradientType=0 );
  display: block;
  margin: 20px auto 0 auto;
  width: 100%;
  border: none;
  border-radius: 3px;
  padding: 8px;
  font-size: 17px;
  color: #636363;
  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.45);
  font-weight: 700;
  box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.17), 0 1px 0 rgba(255, 255, 255, 0.36) inset;
}
.fzbuk-login-form input[type="submit"]:hover {
  background: #DDD;
}
.fzbuk-login-form input[type="submit"]:active {
  padding-top: 9px;
  padding-bottom: 7px;
  background: #C9C9C9;
}
CSS;

	}

	/** Registration structure */
	public static function structure() {
		return <<<STRUCTURE
<div class="fzbuk-login-form-wrap">
	<h1>Forgot Password?</h1>

	<div class="fzbuk-login-form">

		<label>
			[user-login id="login" placeholder="Username or E-mail:"]
		</label>

		[reset-submit value="Reset Password"]

	</div>
	<h5>Back to [link-login label="Login"]</h5>
</div>

STRUCTURE;
	}
}