<?php
	$thb_id = get_the_ID();
	$header_boxed = ot_get_option( 'header_boxed', 'off');
	$header_menu_color = ot_get_option( 'header_menu_color', 'light');

	$header_transparent = get_post_meta($thb_id, 'header_transparent', true);
	$header_transparent_color = get_post_meta($thb_id, 'header_transparent_color', true);
	$logo = ot_get_option( 'logo', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo.png');

	$classes[] = 'header style3';
	$classes[] = $header_boxed === 'on' ? 'boxed' : '';

	$transparent_classes[] = 'header_holder';
	$transparent_classes[] = $header_transparent;
	$transparent_classes[] = $header_transparent_color;

	if ($header_transparent === 'on' && $header_transparent_color === 'light-transparent-header') {
		$logo = ot_get_option( 'logo_light', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo_light.png');
	}
	$header_video = ot_get_option( 'header_video');
	if ($header_video) {
		$header_bg = ot_get_option( 'header_bg');
		$header_bg_img = isset($header_bg['background-image']) ? $header_bg['background-image'] : false;
	}
?>

<!-- Start Header -->
<div class="<?php echo esc_attr(implode(' ', $transparent_classes)); ?>">
<?php if ($header_boxed === 'on') { ?>
<div class="row">
	<div class="small-12 columns">
<?php } ?>
<header class="<?php echo esc_attr(implode(' ', $classes)); ?>">
	<div class="header_top cf">
		<?php if ($header_video) { ?>
			<div class="thb-header-video" data-vide-bg="mp4: <?php echo esc_url($header_video); ?><?php if ($header_bg_img) { ?>, poster: <?php echo esc_attr($header_bg_img); ?><?php } ?>" data-vide-options="posterType: 'auto', autoplay: true, loop: true, muted: true, position: 50% 50%, resizing: true">
				<div class="thb-header-video-overlay"></div>
			</div>
		<?php } ?>
		<div class="row full-width-row">
			<div class="small-12 columns logo">
				<div class="toggle-holder">
					<?php do_action( 'thb_mobile_toggle'); ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
						<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
					</a>
				</div>
				<?php do_action('thb_adv_headerstyle3'); ?>
				<div class="social-holder hide-for-large <?php echo esc_attr($social_style = ot_get_option( 'header_socialstyle', 'style1')); ?>">
					<?php do_action( 'thb_social_header' ); ?>
					<?php do_action( 'thb_quick_search' ); ?>
					<?php do_action( 'thb_quick_cart' ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php if (ot_get_option( 'full_menu', 'on') !== 'off') { ?>
		<?php if (!thb_is_mobile()) { ?>
			<div class="nav_holder show-for-large <?php echo esc_attr($header_menu_color); ?>">
				<div class="row full-width-row">
					<div class="small-12 columns">
						<nav class="full-menu-container">
							<?php get_template_part( 'inc/templates/header/full-menu' ); ?>
						</nav>
						<div class="social-holder <?php echo esc_attr($social_style = ot_get_option( 'header_socialstyle', 'style1')); ?>">
							<?php do_action( 'thb_secondary_area', false); ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</header>
<?php if ($header_boxed === 'on') { ?>
	</div>
</div>
<?php } ?>
</div>
<!-- End Header -->
