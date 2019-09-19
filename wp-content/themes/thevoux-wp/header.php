<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php
		$header_style       = ot_get_option( 'header_style', 'style1' );
		$header_fixed_style = ot_get_option( 'header_fixed_style', 'style1' );

		/*
		 * Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'thb_borders' ); ?>
<div id="wrapper" class="thb-page-transition-<?php echo esc_attr( ot_get_option( 'page_transition', 'on' ) ); ?>">
	<?php get_template_part( 'inc/templates/header/mobile_menu' ); ?>

	<!-- Start Content Container -->
	<div id="content-container">
		<!-- Start Content Click Capture -->
		<div class="click-capture"></div>
		<!-- End Content Click Capture -->
		<?php do_action( 'thb_page_content', ot_get_option( 'header_top_content' ) ); ?>
		<?php do_action( 'thb_adv_before_header' ); ?>
		<?php get_template_part( 'inc/templates/header/fixed-' . $header_fixed_style ); ?>
		<?php get_template_part( 'inc/templates/header/' . $header_style ); ?>
		<div role="main" class="cf">
