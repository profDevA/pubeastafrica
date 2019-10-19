<?php
/**
 * Notice when user registration is disabled.
 */
function pp_registration_disabled_notice() {
	if ( ! is_super_admin( get_current_user_id() ) ) {
		return;
	}
	if ( get_option( 'users_can_register' ) ) {
		return;
	}

	$url = is_multisite() ? network_admin_url( 'settings.php' ) : admin_url( 'options-general.php' );

	?>
	<div id="message" class="updated notice is-dismissible">
		<p>
			<?php printf( __( 'User registration currently disabled. To enable, Go to <a href="%1$s">Settings -> General</a>, and under Membership, check "Anyone can register"', 'ppress' ), $url ); ?>. </p>
	</div>
	<?php
}

add_action( 'admin_notices', 'pp_registration_disabled_notice' );

add_filter( 'removable_query_args', 'pp_removable_query_args' );

function pp_removable_query_args( $args ) {
	$args[] = 'password-reset-edited';
	$args[] = 'password-reset-added';
	$args[] = 'registration-added';
	$args[] = 'registration-edited';
	$args[] = 'login-added';
	$args[] = 'login-edited';
	$args[] = 'settings-update';
	$args[] = 'edit-profile-edited';
	$args[] = 'edit-profile-added';
	$args[] = 'user-profile-added';
	$args[] = 'user-profile-edited';
	$args[] = 'field-edited';
	$args[] = 'field-added';
	$args[] = 'melange-edited';
	$args[] = 'melange-added';
	$args[] = 'new-contact-info';
	$args[] = 'contact-info';

	return $args;
}