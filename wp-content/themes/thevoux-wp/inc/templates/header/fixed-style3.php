<?php
	$logo = ot_get_option( 'logo_fixed') ? ot_get_option( 'logo_fixed') : ot_get_option( 'logo', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo.png');
	$fixed_header_shadow = ot_get_option( 'fixed_header_shadow');

	$header_class[] = 'header fixed style4 fixed-style3';
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
					<div class="logo">
						<?php if (!is_single()) { ?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
							<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
						</a>
						<?php } else { ?><h6 id="page-title"><?php the_title(); ?></h6><?php } ?>
					</div>
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
