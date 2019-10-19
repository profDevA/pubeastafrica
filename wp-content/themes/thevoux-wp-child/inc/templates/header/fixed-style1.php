<?php
	$header_menu_color = ot_get_option( 'header_menu_color', 'light');
	$fixed_header_shadow = ot_get_option( 'fixed_header_shadow');
	$logo = ot_get_option( 'logo_fixed') ? ot_get_option( 'logo_fixed') : ot_get_option( 'logo', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo.png');

	$header_class[] = 'header fixed';
	$header_class[] = $fixed_header_shadow;
?>

<!-- Start Header -->
<header class="<?php echo esc_attr(implode(' ', $header_class)); ?>">
	<div class="header_top cf">
		<div class="row full-width-row align-middle">
			<div class="small-3 medium-2 columns toggle-holder">
				<?php do_action( 'thb_mobile_toggle'); ?>
			</div>
			<div class="small-6 medium-8 columns logo text-center active">
				<?php if (!is_single()) { ?>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
				</a>
				<?php } else { ?><h6 id="page-title"><?php the_title(); ?></h6><?php } ?>
			</div>
			<div class="small-3 medium-2 columns text-right">
				<div class="social-holder <?php echo esc_attr($social_style = ot_get_option( 'header_socialstyle', 'style1')); ?>">
					<?php do_action( 'thb_social_header' ); ?>
					<?php do_action( 'thb_quick_search' ); ?>
					<?php do_action( 'thb_quick_cart' ); ?>
				</div>
			</div>
		</div>
		<?php if(ot_get_option( 'reading_indicator', 'on') !== 'off') { ?>
		<span class="progress"></span>
		<?php } ?>
	</div>
	<?php if (!thb_is_mobile()) { ?>
		<div class="nav_holder show-for-large">

			<nav class="full-menu-container text-center">
				<?php if(has_nav_menu('nav-menu')) { ?>
				  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav submenu-style-' . ot_get_option( 'header_submenu_style', 'style1'), 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
				<?php } ?>
			</nav>
		</div>
	<?php } ?>
</header>
<!-- End Header -->
