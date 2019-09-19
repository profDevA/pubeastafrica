<?php
	$logo = ot_get_option( 'logo', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo.png');
	$menu_footer = ot_get_option( 'menu_footer');
	$mobile_menu_color = ot_get_option( 'mobile_menu_color', 'light');
	if ($logo_mobilemenu = ot_get_option( 'logo_mobilemenu')) {
		$logo =	$logo_mobilemenu;
	}
?>
<!-- Start Mobile Menu -->
<nav id="mobile-menu" class="<?php echo esc_attr($mobile_menu_color); ?>">
	<div class="custom_scroll" id="menu-scroll">
		<a href="#" class="close"><?php get_template_part( 'assets/svg/arrows_remove.svg'); ?></a>
		<a href="<?php echo esc_url(home_url('/')); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
			<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
		</a>
		<?php if(has_nav_menu('mobile-menu')) { ?>
		  <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'thb-mobile-menu', 'walker' => new thb_mobileDropdown ) ); ?>
		<?php } ?>
		<?php if (has_nav_menu('secondary-mobile-menu')) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'secondary-mobile-menu', 'depth' => 1, 'container' => false, 'menu_class' => 'thb-mobile-menu-secondary'  ) ); ?>
		<?php } ?>
		<div class="menu-footer">
			<?php echo do_shortcode($menu_footer); ?>
		</div>
	</div>
</nav>
<!-- End Mobile Menu -->