<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<?php do_action('woocommerce_before_customer_login_form'); ?>
<div id="customer_login" class="full-height-content">
	<div class="row">
			<div class="small-12 small-centered medium-6 large-4 xlarge-3 columns">
					<?php wc_print_notices();  ?>
					<div class="login-container">
						<p class="text-center"><?php esc_html_e( "I'm an existing customer and would like to login." ,'thevoux' ); ?></p>
						<form method="post" class="woocommerce-form woocommerce-form-login login text-center">

								<input type="text" class="input-text full" name="username" id="username" placeholder="<?php esc_html_e( 'Username or email address', 'thevoux' ); ?>"/>

								<input class="input-text full" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password', 'thevoux' ); ?>"/>
							<div class="row">
								<div class="small-6 columns">
									<div class="remember">
										<input name="rememberme" type="checkbox" id="rememberme" value="forever" class="custom_check"/> <label for="rememberme" class="checkbox custom_label"><?php esc_html_e( 'Remember me','thevoux' ); ?></label>
									</div>
								</div>
								<div class="small-6 columns">
									<a class="lost_password" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
								</div>
							</div>

							<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
							<button type="submit" class="woocommerce-Button button black small" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
						</form>
						<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
						<div class="text-center">
							<p><strong><?php esc_html_e( "I'm a new customer and would like to register." ,'thevoux' ); ?></strong></p>
							<a href="#" class="btn small" id="create-account"><?php esc_html_e( 'Create a New Account','thevoux' ); ?></a>
						</div>
						<?php endif; ?>
					</div>
					<?php if (get_option('woocommerce_enable_myaccount_registration')=='yes') : ?>
					<div class="register-container">
						<p class="text-center"><?php esc_html_e( "I'm a new customer and would like to register." ,'thevoux' ); ?></p>
						<form method="post" class="woocommerce-form woocommerce-form-register register text-center" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
							<?php do_action( 'woocommerce_register_form_start' ); ?>
							<?php if (get_option('woocommerce_registration_generate_username')=='no') : ?>
									<input type="text" class="input-text full" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" placeholder="<?php esc_html_e( 'Username', 'thevoux' ); ?>" />

							<?php endif; ?>
								<input type="email" class="input-text full" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" placeholder="<?php esc_html_e( 'Email address', 'thevoux' ); ?>" />
							<?php if (get_option('woocommerce_registration_generate_password')=='no') : ?>
								<input type="password" class="input-text full" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" placeholder="<?php esc_html_e( 'Password', 'thevoux' ); ?>" />
							<?php endif; ?>

							<?php do_action( 'woocommerce_register_form' ); ?>
							<?php do_action( 'register_form' ); ?>

							<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
							<button type="submit" class="woocommerce-Button button black small" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_register_form_end' ); ?>
						</form>
						<div class="text-center">
							<p><strong><?php esc_html_e( "I'm an existing customer and would like to login." ,'thevoux' ); ?></strong></p>
							<a href="#" class="btn small" id="login-account"><?php esc_html_e( 'Login to Existing Account','thevoux' ); ?></a>
						</div>
					</div>
					<?php endif; ?>
				<?php do_action('woocommerce_after_customer_login_form'); ?>
			</div>
	</div>
</div>
