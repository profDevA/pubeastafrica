<?php
/**
 * Theme name: Fzbuk
 * Builder type: Registration form
 */
namespace registrations\fzbuk_theme;

/**
 * Class Fzbuk_Registrations
 * @package registrations\fzbuk_theme
 */
class Fzbuk_Registrations {

	public static function instance() {
		global $wpdb;

		$wpdb->insert(
			REGISTRATION_TABLE,
			array(
				'title'                => 'Fzbuk Registration Theme',
				'structure'            => self::structure(),
				'css'                  => self::css(),
				'success_registration' => '<div class="profilepress-reg-status">Registration Successful.</div>',
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
  text-align: center;
  width: 360px;
  margin: 10px auto;
  padding: 10px;
}

.fzbuk-login-form-wrap {
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
  margin: 10px auto;
  padding: 50px 30px 0 30px;
  text-align: center;
}

.fzbuk-login-form-wrap:before {
  display: block;
  content: "";
  width: 58px;
  height: 19px;
  top: 10px;
  left: 10px;
  position: absolute;
}
.fzbuk-login-form-wrap > h1 {
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
  color: #fff !important;
  text-decoration: none;
  font-weight: 400;
}

.fzbuk-login-form input[type="text"], .fzbuk-login-form input[type="password"], .fzbuk-login-form input[type="email"] {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
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
  margin: 0 !important;
}

input.fzbuk-input-middle {
  border-bottom: medium none !important;
  border-radius: unset !important;
  box-shadow: unset !important;
  border-top: medium none !important;
  width: 100% !important;
  padding: 12px 20px !important;
  color: #afafaf !important;
  font-weight: 400 !important;
  font-family: "Lato", sans-serif;
  cursor: text !important;
}


.fzbuk-login-form input[type="email"], .fzbuk-login-form input[type="text"]  {
  border-bottom: none;
  border-radius: 4px 4px 0 0;
  padding-bottom: 13px;
  box-shadow: 0 -1px 0 #E0E0E0 inset, 0 1px 2px rgba(0, 0, 0, 0.23) inset;
}
.fzbuk-login-form input[type="password"] {
  border-top: 1px solid #eee;
  border-radius: 0 0 4px 4px;
  box-shadow: 0 -1px 2px rgba(0, 0, 0, 0.23) inset, 0 1px 2px rgba(255, 255, 255, 0.1);
}
.fzbuk-login-form input[type="submit"] {
  font-family: "Lato", sans-serif;
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
	<h1>Sign Up</h1>

	<div class="fzbuk-login-form">
		<label>
			[reg-username placeholder="Username"]
		</label>

		<label>
			[reg-email placeholder="Email Address" class="fzbuk-input-middle"]
		</label>

		<label>
			[reg-password placeholder="Password"]
		</label>

		[reg-submit value="Register"]

	</div>
	<h5>Have an Account? [link-login label="Login"]</h5>
</div>

STRUCTURE;
	}
}