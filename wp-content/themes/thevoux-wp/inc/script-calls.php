<?php
// De-register Contact Form 7 styles.
add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

// Main Styles.
function thb_main_styles() {
	global $post;
	$i                       = 0;
	$self_hosted_fonts       = ot_get_option( 'self_hosted_fonts' );
	$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
	$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

	// Enqueue.
	wp_enqueue_style( 'thb-fa', esc_url( $thb_theme_directory_uri ) . 'assets/css/font-awesome.min.css', null, '4.7.0' );
	wp_enqueue_style( 'thb-app', esc_url( $thb_theme_directory_uri ) . 'assets/css/app.css', null, esc_attr( $thb_theme_version ) );

	if ( ! defined( 'THB_DEMO_SITE' ) ) {
		wp_enqueue_style( 'thb-style', get_stylesheet_uri(), null, esc_attr( $thb_theme_version ) );
	}
	wp_enqueue_style( 'thb-google-fonts', thb_google_webfont(), null, esc_attr( $thb_theme_version ) );
	wp_add_inline_style( 'thb-app', thb_selection() );

	if ( $self_hosted_fonts ) {
		foreach ( $self_hosted_fonts as $font ) {
			$i++;
			wp_enqueue_style( 'thb-self-hosted-' . $i, $font['font_url'], null, esc_attr( $thb_theme_version ) );
		}
	}

	if ( $post ) {
		if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_styles' ) ) {
			wpcf7_enqueue_styles();
		}
	}
}

add_action( 'wp_enqueue_scripts', 'thb_main_styles' );

// Main Scripts.
function thb_register_js() {
	if ( ! is_admin() ) {
		global $post;
		$thb_combined_libraries  = ot_get_option( 'thb_combined_libraries', 'on' );
		$thb_api_key             = ot_get_option( 'map_api_key' );
		$thb_dependency          = array( 'jquery', 'underscore' );
		$thb_theme_directory_uri = Thb_Theme_Admin::$thb_theme_directory_uri;
		$thb_theme_version       = Thb_Theme_Admin::$thb_theme_version;

		// Register.
		wp_register_script( 'gmapdep', 'https://maps.google.com/maps/api/js?key=' . $thb_api_key, null, esc_attr( $thb_theme_version ), false );
		if ( 'on' === $thb_combined_libraries ) {
			wp_register_script( 'thb-vendor', esc_url( $thb_theme_directory_uri ) . 'assets/js/vendor.min.js', array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			$thb_dependency[] = 'thb-vendor';
		} else {
			$thb_js_libraries = array(
				'TweenMax'                  => '_0TweenMax.min.js',
				'TweenMax-ScrollToPlugin'   => '_2ScrollToPlugin.min.js',
				'animsition'                => 'animsition.js',
				'flickity'                  => 'flickity.pkgd.min.js',
				'imagesloaded'              => 'imagesloaded.pkgd.min.js',
				'jquery-foundation-plugins' => 'jquery.foundation.plugins.js',
				'jquery-history'            => 'jquery.history.js',
				'jquery-hotspot'            => 'jquery.hotspot.js',
				'isotope'                   => 'jquery.isotope.min.js',
				'magnific-popup'            => 'jquery.magnific-popup.min.js',
				'jquery-panr'               => 'jquery.panr.js',
				'sticky-kit'                => 'jquery.sticky-kit.min.js',
				'thb-selection-sharer'      => 'jquery.thbSelectionSharer.js',
				'vide'                      => 'jquery.vide.js',
				'js-cookie'                 => 'js.cookie.js',
				'lazysizes'                 => 'lazysizes.min.js',
				'mobile-detect'             => 'mobile-detect.min.js',
				'odometer'                  => 'odometer.min.js',
				'perfect-scrollbar'         => 'perfect-scrollbar.min.js',
				'plyr-polyfilled'           => 'plyr.polyfilled.min.js',
				'skrollr'                   => 'skrollr.min.js',
				'slick'                     => 'slick.min.js',
				'thb-3dimg'                 => 'thb_3dImg.js',
			);
			foreach ( $thb_js_libraries as $handle => $value ) {
				wp_enqueue_script( $handle, esc_url( $thb_theme_directory_uri ) . 'assets/js/vendor/' . esc_attr( $value ), array( 'jquery' ), esc_attr( $thb_theme_version ), true );
			}
		}
		wp_register_script( 'thb-app', esc_url( $thb_theme_directory_uri ) . 'assets/js/app.min.js', $thb_dependency, esc_attr( $thb_theme_version ), true );

		// Typekit.
		$typekit_id = ot_get_option( 'typekit_id' );
		if ( $typekit_id ) {
			wp_enqueue_script( 'thb-typekit', 'https://use.typekit.net/' . $typekit_id . '.js', null, esc_attr( $thb_theme_version ), false );
			wp_add_inline_script( 'thb-typekit', 'try{Typekit.load({ async: true });}catch(e){}' );
		}

		// Enqueue.
		if ( is_singular() && comments_open() && ( get_option( 'thread_comments' ) === 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( $post ) {
			if ( has_shortcode( $post->post_content, 'thb_contactmap' ) ) {
				wp_enqueue_script( 'gmapdep' );
			}
			if ( has_shortcode( $post->post_content, 'contact-form-7' ) && function_exists( 'wpcf7_enqueue_scripts' ) ) {
				wpcf7_enqueue_scripts();
			}
		}

		wp_enqueue_script( 'thb-app' );
		wp_localize_script(
			'thb-app',
			'themeajax',
			array(
				'themeurl' => get_template_directory_uri(),
				'url'      => admin_url( 'admin-ajax.php' ),
				'l10n'     => array(
					'loading'        => esc_html__( 'Loading ...', 'thevoux' ),
					'nomore'         => esc_html__( 'No More Posts', 'thevoux' ),
					'close'          => esc_html__( 'Close', 'thevoux' ),
					'prev'           => esc_html__( 'Prev', 'thevoux' ),
					'next'           => esc_html__( 'Next', 'thevoux' ),
					'adding_to_cart' => esc_html__( 'Adding to Cart', 'thevoux' ),
					'pinit'          => esc_html__( 'PIN IT', 'thevoux' ),
				),
				'svg'      => array(
					'prev_arrow'  => thb_load_template_part( 'assets/svg/arrow_prev.svg' ),
					'next_arrow'  => thb_load_template_part( 'assets/svg/arrow_next.svg' ),
					'close_arrow' => thb_load_template_part( 'assets/svg/arrows_remove.svg' ),
				),
				'settings' => array(
					'infinite_count'            => ot_get_option( 'infinite_count' ),
					'current_url'               => get_permalink(),
					'newsletter'                => ot_get_option( 'newsletter', 'on' ),
					'newsletter_length'         => ot_get_option( 'newsletter-interval', '1' ),
					'page_transition'           => ot_get_option( 'page_transition', 'on' ),
					'page_transition_style'     => ot_get_option( 'page_transition_style', 'thb-fade' ),
					'page_transition_in_speed'  => ot_get_option( 'page_transition_in_speed', 500 ),
					'page_transition_out_speed' => ot_get_option( 'page_transition_out_speed', 250 ),
					'header_submenu_style'      => ot_get_option( 'header_submenu_style', 'style1' ),
					'thb_custom_video_player'   => ot_get_option( 'thb_custom_video_player', 'on' ),
					'viai_publisher_id'         => ot_get_option( 'viai_publisher_id', '431861828953521' ),
				),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'thb_register_js' );

// WooCommerce.
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
