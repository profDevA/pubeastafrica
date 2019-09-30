<?php
	$header_menu_color = ot_get_option( 'header_menu_color', 'light');
	$fixed_header_shadow = ot_get_option( 'fixed_header_shadow');

	$header_class[] = 'header fixed style4';
	$header_class[] = $fixed_header_shadow;
?>

<!-- Start Header -->
<header class="<?php echo esc_attr(implode(' ', $header_class)); ?>">
	<div class="nav_holder">
		<div class="row full-width-row">
			<div class="small-12 columns">
				<div class="center-column">
					<div class="toggle-holder">
						<?php do_action( 'thb_mobile_toggle', true); ?>
					</div>
					<?php if (!thb_is_mobile()) { ?>
						<nav class="full-menu-container">
							<?php if(has_nav_menu('nav-menu')) { ?>
							  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav submenu-style-' . ot_get_option( 'header_submenu_style', 'style1'), 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
							<?php } ?>
						</nav>
					<?php } ?>
					<div class="social-holder <?php echo esc_attr($social_style = ot_get_option( 'header_socialstyle', 'style1')); ?>">
						<?php do_action( 'thb_social_header' ); ?>
						<?php do_action( 'thb_quick_search' ); ?>
						<?php do_action( 'thb_quick_cart' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if (ot_get_option( 'reading_indicator', 'on') !== 'off') { ?>
		<span class="progress"></span>
	<?php } ?>
</header>
<!-- End Header -->