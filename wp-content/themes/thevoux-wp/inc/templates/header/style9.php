<?php
	$thb_id = get_the_ID();
	$header_boxed = ot_get_option( 'header_boxed', 'off');
	$header_menu_color = ot_get_option( 'header_menu_color', 'light');

	$header_transparent = get_post_meta($thb_id, 'header_transparent', true);
	$header_transparent_color = get_post_meta($thb_id, 'header_transparent_color', true);
	$logo = ot_get_option( 'logo', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo.png');

	$classes[] = 'header style9';
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
				<div class="style9-left-side">
					<div class="toggle-holder">
						<?php do_action( 'thb_mobile_toggle'); ?>
					</div>
				</div>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
				</a>
				<div class="social-holder <?php echo esc_attr($social_style = ot_get_option( 'header_socialstyle', 'style1')); ?>">
					<?php do_action( 'thb_secondary_area', true); ?>
				</div>
			</div>
		</div>
	</div>
</header>
<?php if ($header_boxed === 'on') { ?>
	</div>
</div>
<?php } ?>
</div>
<!-- End Header -->
