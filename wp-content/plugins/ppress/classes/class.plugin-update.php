<?php

namespace ProfilePress\Plugin_Update;

/**
 * Class PP_Update
 * @package ProfilePress\Plugin_Update
 */
class PP_Update {
	public static $instance;

	const DB_VER = 3;

	/** init */
	public function init_options() {
		// was previously pp_db_var for the upgrade but the same value was use by the premium plugin thus the change
		$value = !(get_site_option( 'pp_db_ver' )) ? 0 :  get_site_option( 'pp_db_ver' );

		add_site_option( 'pp_db_lite_ver', $value );
	}

	/** Should update run? */
	public function maybe_update() {
		$this->init_options();

		if ( get_site_option( 'pp_db_lite_ver' ) >= self::DB_VER ) {
			return;
		}

		// update plugin
		$this->update();
	}

	public function update() {

		// no PHP timeout for running updates
		set_time_limit( 0 );

		// this is the current database schema version number
		$current_db_ver = get_site_option( 'pp_db_lite_ver' );

		// this is the target version that we need to reach
		$target_db_ver = self::DB_VER;

		// run update routines one by one until the current version number
		// reaches the target version number
		while ( $current_db_ver < $target_db_ver ) {
			// increment the current db_ver by one
			$current_db_ver ++;

			// each db version will require a separate update function
			$update_method = "pp_update_routine_{$current_db_ver}";

			if ( method_exists( $this, $update_method ) ) {
				call_user_func( array( $this, $update_method ) );
			}

			// update the option in the database, so that this process can always
			// pick up where it left off
			update_site_option( 'pp_db_lite_ver', $current_db_ver );
		}
	}

	/**
	 * Added jakhu forms to ProfilePress lite
	 */
	public function pp_update_routine_1() {

		global $wpdb;

		// jakhu login
		$login_structure = <<<STRUCTURE
<div class="jakhu-login-form">

	<div class="jakhu-header">
		<h1>Sign In</h1>
		<span>Fill out the form below to login.</span>
	</div>


	<div class="jakhu-content">
		[login-username placeholder="Username" class="jakhu-input jakhu-username"]

		[login-password placeholder="Password" class="jakhu-input jakhu-password"]
	</div>

	<div class="jakhu-footer">
		[login-submit value="Sign In" class="jakhu-button"]

		[link-registration class="jakhu-login" label="Sign Up"]

		<br/>

		<div style="float: right; text-decoration: underline;">
			[link-lost-password class="jakhu-password-reset" label="Forgot Password?"]
		</div>
	</div>
</div>
STRUCTURE;

		$login_css = <<<CSS
@import url(http://fonts.googleapis.com/css?family=Bree+Serif);

/* css class for the login generated errors */
.profilepress-login-status {
    width: 300px;
	position: static;
	margin: 10px auto;
	padding: 6px;
	background: #f3f3f3;
	border: 1px solid #fff;
	border-radius: 5px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.profilepress-login-status a {
  color: #ea9629 !important;
}


.jakhu-login-form .jakhu-header span::selection {
	color: #fff;
	background: #f676b2; /* Safari */
}

.jakhu-login-form .jakhu-header span::-moz-selection {
	color: #fff;
	background: #f676b2; /* Firefox */
}

.jakhu-login-form {
	width: 300px;
	position: static;
	margin: auto;
	background: #f3f3f3;
	border: 1px solid #fff;
	border-radius: 5px;

	box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.jakhu-login-form .jakhu-header {
	padding: 40px 30px 30px 30px;
}

.jakhu-login-form .jakhu-header h1 {
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 28px;
	line-height:34px;
	color: #414848;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
	margin-bottom: 10px;
}

.jakhu-login-form .jakhu-header span {
	font-size: 13px;
	line-height: 16px;
	color: #678889;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight:300;
}

.jakhu-login-form .jakhu-content {
	padding: 0 30px 25px 30px;
}

/* Input field */
.jakhu-login-form .jakhu-content .jakhu-input {
	width: 240px;
	padding: 15px 25px;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight: 400;
	font-size: 14px;
	color: #9d9e9e;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
	background: #fff;
	border: 1px solid #fff;
	border-radius: 5px;
	box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
}

.jakhu-login-form .jakhu-content .jakhu-password{
	margin-top: 25px;
}

.jakhu-login-form .jakhu-content .jakhu-input:hover {
	background: #dfe9ec;
	color: #414848;
}

.jakhu-login-form .jakhu-content .jakhu-input:focus {
	background: #dfe9ec;
	color: #414848;

	box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
	-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
	-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
}

.jakhu-login-form .jakhu-footer {
	padding: 25px 30px 40px 30px;
	overflow: auto;

	background: #d4dedf;
	border-top: 1px solid #fff;

	box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-moz-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-webkit-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
}

/* Login button */
.jakhu-login-form .jakhu-footer .jakhu-button {
	float:right;
	padding: 11px 25px;
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 18px;
	color: #fff;
	text-shadow: 0 1px 0 rgba(0,0,0,0.25);
	background: #56c2e1;
	border: 1px solid #46b3d3;
	border-radius: 5px;
	cursor: pointer;

	box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
	-moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
	-webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
}

.jakhu-login-form .jakhu-footer .jakhu-button:hover {
	background: #3f9db8;
	border: 1px solid rgba(256,256,256,0.75);
	box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
}

.jakhu-login-form .jakhu-footer .jakhu-button:focus {
	bottom: -1px;
	background: #56c2e1;
	box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
	-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
	-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
}

/* Registration link */
.jakhu-login-form .jakhu-footer .jakhu-login {
	display: block;
	float: right;
	padding: 10px;
	margin-right: 20px;
	text-decoration: none;
	background: none;
	border: none;
	cursor: pointer;
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 20px;
	color: #414848;
	text-shadow: 0 1px 0 rgba(256,256,256,0.5);
}

/* password reset link */
.jakhu-login-form .jakhu-footer .jakhu-password-reset {
	display: block;
	text-align:center
	padding: 10px;
	text-decoration: none;
	background: none;
	border: none;
	cursor: pointer;
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 18px;
	color: #414848;
	margin-top: 40px;
	text-shadow: 0 1px 0 rgba(256,256,256,0.5);
}


.jakhu-login a {
 text-decoration: none;
}

.jakhu-login-form .jakhu-footer .jakhu-login:hover {
	color: #3f9db8;
}

.jakhu-login-form .jakhu-footer .jakhu-login:focus {
	position: relative;
	bottom: -1px;
}

.jakhu-content input {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
CSS;

		$wpdb->insert(
			LOGIN_TABLE,
			array(
				'title'     => 'Jakhu Login Theme',
				'structure' => $login_structure,
				'css'       => $login_css,
				'date'      => date( 'Y-m-d' )
			),
			array(
				'%s',
				'%s',
				'%s',
				'%s'
			)
		);


		// registration form

		$reg_structure = <<<STRUCTURE
<div class="jakhu-login-form">

	<div class="jakhu-header">
		<h1>Sign Up</h1><span>Fill out the form to create an account.</span>
	</div>

	<div class="jakhu-content">
		[reg-username placeholder="Username" class="jakhu-input jakhu-username"]

		[reg-email placeholder="Email" class="jakhu-input jakhu-email"]

		[reg-password placeholder="Password" class="jakhu-input jakhu-password"]

		[reg-first-name class="jakhu-input jakhu-first-name" placeholder="First Name" required]

		[reg-last-name class="jakhu-input jakhu-last-name" placeholder="Last Name" required]

	</div>
	<div class="jakhu-footer">
		[reg-submit value="Register" class="jakhu-button"]

		[link-login class="jakhu-login" label="Login"]
	</div>

</div>

STRUCTURE;

		$reg_css = <<<CSS
@import url(http://fonts.googleapis.com/css?family=Bree+Serif);

/* css class for the registration form generated errors */
.profilepress-reg-status {
    width: 350px;
	position: static;
	z-index:5;
	margin: 10px 0;
	padding: 6px;
	background: #f3f3f3;
	border: 1px solid #fff;
	border-radius: 5px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.jakhu-login-form .jakhu-header span::selection {
	color: #fff;
	background: #f676b2; /* Safari */
}

.jakhu-login-form .jakhu-header span::-moz-selection {
	color: #fff;
	background: #f676b2; /* Firefox */
}

.jakhu-login-form {
	width: 350px;
	position: static;
	z-index:5;

	background: #f3f3f3;
	border: 1px solid #fff;
	border-radius: 5px;

	box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.jakhu-login-form .jakhu-header {
	padding: 40px 30px 30px 30px;
}

.jakhu-login-form .jakhu-header h1 {
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 28px;
	line-height:34px;
	color: #414848;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
	margin-bottom: 10px;
}

.jakhu-login-form .jakhu-header span {
	font-size: 13px;
	line-height: 16px;
	color: #678889;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight:300;
}

.jakhu-login-form .jakhu-content {
	padding: 0 30px 25px 30px;
}

/* Input field */
.jakhu-login-form .jakhu-content .jakhu-input {
	width: 240px;
	padding: 15px 25px;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight: 400;
	font-size: 14px;
	color: #9d9e9e;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);

	background: #fff;
	border: 1px solid #fff;
	border-radius: 5px;

	box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
}

/* Second and Third input fourth fifth field */
.jakhu-login-form .jakhu-content .jakhu-password, .jakhu-login-form .jakhu-content .jakhu-email, .jakhu-login-form .jakhu-content .jakhu-pass-icon, .jakhu-login-form .jakhu-content .jakhu-first-name, .jakhu-login-form .jakhu-content .jakhu-last-name {
	margin-top: 25px;
}

.jakhu-login-form .jakhu-content .jakhu-input:hover {
	background: #dfe9ec;
	color: #414848;
}

.jakhu-login-form .jakhu-content .jakhu-input:focus {
	background: #dfe9ec;
	color: #414848;

	box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
	-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
	-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
}


/* Animation */
.jakhu-input, .jakhu-user-icon, .jakhu-email-icon, .jakhu-pass-icon, .jakhu-button, .jakhu-login {
	transition: all 0.5s;
	-moz-transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-o-transition: all 0.5s;
	-ms-transition: all 0.5s;
}

.jakhu-login-form .jakhu-footer {
	padding: 25px 30px 40px 30px;
	overflow: auto;

	background: #d4dedf;
	border-top: 1px solid #fff;

	box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-moz-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-webkit-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
}

/* Register button */
.jakhu-login-form .jakhu-footer .jakhu-button {
	float:right;
	padding: 11px 25px;

	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 18px;
	color: #fff;
	text-shadow: 0 1px 0 rgba(0,0,0,0.25);

	background: #56c2e1;
	border: 1px solid #46b3d3;
	border-radius: 5px;
	cursor: pointer;

	box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
	-moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
	-webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
}

.jakhu-login-form .jakhu-footer .jakhu-button:hover {
	background: #3f9db8;
	border: 1px solid rgba(256,256,256,0.75);

	box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
}

.jakhu-login-form .jakhu-footer .jakhu-button:focus {
	bottom: -1px;
	background: #56c2e1;
	box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
	-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
	-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
}

/* Login link */
.jakhu-login-form .jakhu-footer .jakhu-login {
	display: block;
	float: right;
	padding: 10px;
	margin-right: 20px;
	text-decoration: none;
	background: none;
	border: none;
	cursor: pointer;
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 20px;
	color: #414848;
	text-shadow: 0 1px 0 rgba(256,256,256,0.5);
}

.jakhu-login a {
 text-decoration: none;
}

.jakhu-login-form .jakhu-footer .jakhu-login:hover {
	color: #3f9db8;
}

.jakhu-login-form .jakhu-footer .jakhu-login:focus {
	position: relative;
	bottom: -1px;
}

.jakhu-content input {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

CSS;

		$wpdb->insert(
			REGISTRATION_TABLE,
			array(
				'title'                => 'Jakhu Registration Theme',
				'structure'            => $reg_structure,
				'css'                  => $reg_css,
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


		// password reset

		$p_structure = <<<STRUCTURE
<div class="jakhu-login-form">

	<div class="jakhu-header">
		<h1>Forgot Password?</h1>
		<span>Please enter your username or email address.
You will receive a link to create a new password via email.</span>
	</div>

	<div class="jakhu-content">

		[user-login id="login" placeholder="Username or E-mail" class="jakhu-input jakhu-username"]
	</div>

	<div class="jakhu-footer">
		[reset-submit value="Reset Password" class="jakhu-button"]

		<br/><br/>

		<div style="float: right; text-decoration: underline;">
			[link-login class="jakhu-login" label="Back to Login?"]
		</div>
	</div>

</div>

STRUCTURE;

		$p_css = <<<CSS
@import url(http://fonts.googleapis.com/css?family=Bree+Serif);

/* css class for the password reset form generated errors */
.profilepress-reset-status {
    width: 300px;
	position: static;
	z-index:5;
	margin: 10px 0;
	padding: 6px;
	background: #f3f3f3;
	border: 1px solid #fff;
	border-radius: 5px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
}


.jakhu-login-form .jakhu-header span::selection {
	color: #fff;
	background: #f676b2; /* Safari */
}

.jakhu-login-form .jakhu-header span::-moz-selection {
	color: #fff;
	background: #f676b2; /* Firefox */
}

.jakhu-login-form {
	width: 300px;
	position: static;
	z-index:5;

	background: #f3f3f3;
	border: 1px solid #fff;
	border-radius: 5px;

	box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.jakhu-login-form .jakhu-header {
	padding: 40px 30px 30px 30px;
}

.jakhu-login-form .jakhu-header h1 {
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 28px;
	line-height:34px;
	color: #414848;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
	margin-bottom: 10px;
}

.jakhu-login-form .jakhu-header span {
	font-size: 13px;
	line-height: 16px;
	color: #678889;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight:300;
}

.jakhu-login-form .jakhu-content {
	padding: 0 30px 25px 30px;
}

/* Input field */
.jakhu-login-form .jakhu-content .jakhu-input {
	width: 240px;
	padding: 15px 25px;
	font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
	font-weight: 400;
	font-size: 14px;
	color: #9d9e9e;
	text-shadow: 1px 1px 0 rgba(256,256,256,1.0);

	background: #fff;
	border: 1px solid #fff;
	border-radius: 5px;

	box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.50);
}

/* Second and Third input fourth fifth field */
.jakhu-login-form .jakhu-content .jakhu-password{
	margin-top: 25px;
}

.jakhu-login-form .jakhu-content .jakhu-input:hover {
	background: #dfe9ec;
	color: #414848;
}

.jakhu-login-form .jakhu-content .jakhu-input:focus {
	background: #dfe9ec;
	color: #414848;

	box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
	-moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
	-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.25);
}

/* Animation */
.jakhu-input, .jakhu-user-icon, .jakhu-email-icon, .jakhu-pass-icon, .jakhu-button, .jakhu-login {
	transition: all 0.5s;
	-moz-transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-o-transition: all 0.5s;
	-ms-transition: all 0.5s;
}

.jakhu-login-form .jakhu-footer {
	padding: 25px 30px 40px 30px;
	overflow: auto;
	background: #d4dedf;
	border-top: 1px solid #fff;
	box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-moz-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
	-webkit-box-shadow: inset 0 1px 0 rgba(0,0,0,0.15);
}

/* Login button */
.jakhu-login-form .jakhu-footer .jakhu-button {
	float:right;
	padding: 11px 25px;
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 18px;
	color: #fff;
	text-shadow: 0 1px 0 rgba(0,0,0,0.25);
	background: #56c2e1;
	border: 1px solid #46b3d3;
	border-radius: 5px;
	cursor: pointer;
	box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
	-moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
	-webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
}

.jakhu-login-form .jakhu-footer .jakhu-button:hover {
	background: #3f9db8;
	border: 1px solid rgba(256,256,256,0.75);
	box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
}

.jakhu-login-form .jakhu-footer .jakhu-button:focus {
	bottom: -1px;
	background: #56c2e1;
	box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
	-moz-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
	-webkit-box-shadow: inset 0 1px 6px rgba(256,256,256,0.75);
}

/* Registration link */
.jakhu-login-form .jakhu-footer .jakhu-login {
	display: block;
	float: right;
	padding: 10px;
	margin-right: 20px;
	text-decoration: none;
	background: none;
	border: none;
	cursor: pointer;
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 20px;
	color: #414848;
	text-shadow: 0 1px 0 rgba(256,256,256,0.5);
}

/* Back to login link */
.jakhu-login-form .jakhu-footer .jakhu-back-login {
	display: block;
	text-align:center
	padding: 10px;
	text-decoration: none;
	background: none;
	border: none;
	cursor: pointer;
	font-family: 'Bree Serif', serif;
	font-weight: 300;
	font-size: 18px;
	color: #414848;
	margin-top: 20px;
	text-shadow: 0 1px 0 rgba(256,256,256,0.5);
}


.jakhu-login a {
 text-decoration: none;
}

.jakhu-login-form .jakhu-footer .jakhu-login:hover {
	color: #3f9db8;
}

.jakhu-login-form .jakhu-footer .jakhu-login:focus {
	position: relative;
	bottom: -1px;
}

.jakhu-content input {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
CSS;
		$wpdb->insert(
			PASSWORD_RESET_TABLE,
			array(
				'title'                  => 'Jakhu Password Reset',
				'structure'              => $p_structure,
				'css'                    => $p_css,
				'success_password_reset' => '<div class="profilepress-reset-status">Check your email for further instructions.</div>',
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

	public function pp_update_routine_2() {
		delete_site_option('pp_plugin_activated');
		delete_site_option('pp_db_ver');
	}

	/**
	 * increase custom field option size
	 */
	public function pp_update_routine_3() {
		global $wpdb;

		$table = PASSWORD_RESET_TABLE;
		$form  = <<<FORM
<div class="pp-reset-password-form">
	<h3>Enter your new password below.</h3>
	<label for="password1">New password<span class="req">*</span></label>
	[enter-password id="password1" required autocomplete="off"]

	<label for="password2">Re-enter new password<span class="req">*</span></label>
	[re-enter-password id="password2" required autocomplete="off"]

	[password-reset-submit class="pp-reset-button pp-reset-button-block" value="Save"]
</div>
FORM;

		$wpdb->query( "ALTER TABLE $table ADD handler_structure LONGTEXT NOT NULL AFTER structure" );
		$wpdb->query( "UPDATE $table SET handler_structure = '$form' WHERE id > 0" );

	}

	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}