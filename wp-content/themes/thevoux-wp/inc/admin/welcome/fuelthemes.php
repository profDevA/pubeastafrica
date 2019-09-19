<?php
class Thb_Theme_Admin {
	/**
	 *	Main instance
	 */
	private static $_instance;

	/**
	 *	Theme Name
	 */
	public static $thb_theme_name;

	/**
	 *	Theme Version
	 */
	public static $thb_theme_version;

	/**
	 *	Theme Slug
	 */
	public static $thb_theme_slug;

	/**
	 *	Theme Directory
	 */
	public static $thb_theme_directory;

	/**
	 *	Theme Directory URL
	 */
	public static $thb_theme_directory_uri;

	/**
	 *	Product Key
	 */
	public static $thb_product_key;

	/**
	 *	Product Key Expiration
	 */
	public static $thb_product_key_expired;

	/**
	 *	Mobile Check
	 */
	public static $thb_is_mobile;

	/**
	 *	Theme Constructor executed only once per request
	 */
	public function __construct() {
		if ( self::$_instance ) {
			_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
		}
	}

	/**
	 * You cannot clone this class
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	/**
	 * You cannot unserialize instances of this class
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, 'Cheatin&#8217; huh?', '2.0' );
	}

	public static function instance() {
		global $thb_Theme_Admin;
		if ( ! self::$_instance ) {
			self::$_instance = new self();
			$thb_Theme_Admin = self::$_instance;

			// Theme Variables
			$theme = wp_get_theme();
			self::$thb_theme_name = $theme->get( 'Name' );
			self::$thb_theme_version = $theme->parent() ? $theme->parent()->get( 'Version' ) : $theme->get( 'Version' );
			self::$thb_theme_slug = $theme->template;
			self::$thb_theme_directory = get_template_directory() . '/';
			self::$thb_theme_directory_uri = get_template_directory_uri() . '/';

			self::$thb_product_key = get_option("thb_".self::$thb_theme_slug."_key");
			self::$thb_product_key_expired = get_option("thb_".self::$thb_theme_slug."_key_expired");

			// Mobile Detect
			self::$thb_is_mobile = new thb_mobile_detect();

			// After Setup Theme
			add_action( 'after_setup_theme', array( self::$_instance, 'afterSetupTheme' ) );

			// Setup Admin Menus
			if ( is_admin() ) {
				self::$_instance->initAdminPages();
			}
		}

		return self::$_instance;
	}
	/**
	 *	After Theme Setup
	 */
	public function afterSetupTheme() {
		/* WooCommerce Support */
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-lightbox' );

		/* WooCommerce Products per Page */
		add_filter( 'loop_shop_per_page', 'thb_shops_per_page', 20 );

		function thb_shops_per_page($products_per_page) {
			$products_per_page_get = filter_input( INPUT_GET, 'products_per_page', FILTER_VALIDATE_INT );
			$products_per_page = isset($products_per_page_get) ? $products_per_page_get : ot_get_option( 'products_per_page');
			return $products_per_page;
		}

		/* Gutenberg */
		add_theme_support( 'align-wide' );
		add_theme_support( 'align-full' );
		add_theme_support( 'editor-color-palette', array(
        array(
            'name' => esc_html__( 'Accent Color', 'thevoux' ),
            'slug' => 'thb-accent',
            'color' => ot_get_option( 'accent_color', '#ef2673')
        )
    ) );

		/* Text Domain */
		load_theme_textdomain('thevoux', get_stylesheet_directory() . '/inc/languages');

		/* Background Support */
		add_theme_support( 'custom-background', array( 'default-color' => 'ffffff') );

		/* Image Settings */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 180, 180, true );

		$thb_image_sizes = self::$_instance->thb_image_sizes();

		// Register image size
		foreach ( $thb_image_sizes as $image_size ) {
			add_image_size( $image_size['slug'], $image_size['width'], $image_size['height'], $image_size['crop'] );
		}

		/* Post Formats */
		add_theme_support('post-formats', array('image', 'gallery', 'video'));

		/* HTML5 Galleries */
		add_theme_support( 'html5', array( 'gallery', 'caption', 'comment-list' ) );
		add_filter( 'use_default_gallery_style', '__return_false' );

		/* Editor Styling */
		$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lora:300,400,400italic,500,600,700' );
		add_editor_style( array($font_url, 'assets/css/editor-style.css') );

		/* Required Settings */
		if(!isset($content_width)) $content_width = 1170;
		add_theme_support( 'automatic-feed-links' );

		/* Title Support */
		add_theme_support( 'title-tag' );

		/* Register Menus */
		register_nav_menus(
			array(
				'nav-menu' => esc_html__( 'Navigation Menu', 'thevoux' ),
				'mobile-menu' => esc_html__( 'Mobile Menu', 'thevoux' ),
				'secondary-mobile-menu' => esc_html__( 'Secondary Mobile Menu', 'thevoux' )
			)
		);

		$sidebars = ot_get_option( 'sidebars');
		$widget_style = ot_get_option( 'widget_style', 'style1');
		if(!empty($sidebars)) {
			foreach($sidebars as $sidebar) {
				register_sidebar( array(
					'name' => $sidebar['title'],
					'id' => $sidebar['id'],
					'description' => '',
					'before_widget' => '<div id="%1$s" class="widget %2$s '.esc_attr($widget_style).'">',
					'after_widget' => '</div>',
					'before_title' => '<strong><span>',
					'after_title' => '</span></strong>',
				));
			}
		}
	}
	public function thb_image_sizes() {
		$thb_image_sizes = apply_filters('thb_image_sizes_filter', array(
			array(
				'slug'   => 'thevoux-thumbnail',
				'width'  => 90,
				'height' => 90,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-single',
				'width'  => 585,
				'height' => 300,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-vertical',
				'width'  => 300,
				'height' => 400,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-masonry',
				'width'  => 450,
				'height' => 9999,
				'crop'   => false,
			),
			array(
				'slug'   => 'thevoux-style1',
				'width'  => 370,
				'height' => 280,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-style2',
				'width'  => 450,
				'height' => 450,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-style3',
				'width'  => 760,
				'height' => 600,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-style3small',
				'width'  => 370,
				'height' => 200,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-style9',
				'width'  => 340,
				'height' => 200,
				'crop'   => true,
			),
			array(
				'slug'   => 'thevoux-widget',
				'width'  => 340,
				'height' => 150,
				'crop'   => true,
			),
		));

		function thb_calculate_image_orientation( $thb_image_sizes ) {
			if ( ! is_array( $thb_image_sizes ) ) {
				return;
			}
			$new_sizes = array();
			foreach ( $thb_image_sizes as $image_size ) {
				$new_sizes[] = array(
					'slug' 	 => $image_size['slug'].'-small',
					'width'  => absint($image_size['width'] / 2),
					'height' => $image_size['height'] === 9999 ? 9999 : absint($image_size['height'] * 2),
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug' 	 => $image_size['slug'].'-2x',
					'width'  => $image_size['width'] * 2,
					'height' => $image_size['height'] === 9999 ? 9999 : $image_size['height'] * 2,
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug' 	 => $image_size['slug'].'-3x',
					'width'  => $image_size['width'] * 3,
					'height' => $image_size['height'] === 9999 ? 9999: $image_size['height'] * 3,
					'crop'   => $image_size['crop'],
				);
				$new_sizes[] = array(
					'slug' 	 => $image_size['slug'].'-mini',
					'width'  => 20,
					'height' => $image_size['height'] === 9999 ? 9999  : absint(($image_size['height'] * 20) / $image_size['width']),
					'crop'   => $image_size['crop'],
				);
			}
			return $new_sizes;
		}
		$new_sizes = thb_calculate_image_orientation($thb_image_sizes);
		foreach($new_sizes as $new_size) {
			$thb_image_sizes[] = $new_size;
		}
		return $thb_image_sizes;
	}
	public function thbDemos() {
		return array(
		    array(
		        'import_file_name'       => 'The Voux',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/voux/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/voux/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/voux/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/voux_01.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net",
		    ),
		    array(
		        'import_file_name'       => 'The Boheme',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/boheme/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/boheme/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/boheme/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/boheme.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/boheme",
		    ),
		    array(
		        'import_file_name'       => 'Avantgarde',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/avantgarde/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/avantgarde/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/avantgarde/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/avantgarde.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/avantgarde",
		    ),
		    array(
		        'import_file_name'       => 'Madison',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/madison/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/madison/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/madison/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/madison.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/madison",
		    ),
		    array(
		        'import_file_name'       => 'Foodies',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/foodies/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/foodies/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/foodies/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/thefoodies.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/food-demo",
		    ),
		    array(
		        'import_file_name'       => 'Adventure Love',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/adventurelove/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/adventurelove/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/adventurelove/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/adventurelove.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/travel-demo",
		    ),
		    array(
		        'import_file_name'       => 'FashionMe Now',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/fashionme/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/fashionme/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/fashionme/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/fashionmenow.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/fashion-demo",
		    ),
		    array(
		        'import_file_name'       => 'Catherine',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/catherine/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/catherine/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/catherine/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/catherine.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/catherine",
		    ),
		    array(
		        'import_file_name'       => 'Anna',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/anna/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/anna/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/anna/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/anna.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/anna",
		    ),
		    array(
		        'import_file_name'       => 'Bold & Beautiful',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/bold/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/bold/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/bold/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/bold.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/bold-beautiful",
		    ),
		    array(
		        'import_file_name'       => 'Chloe',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/chloe/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/chloe/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/chloe/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/chloe.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/chloe",
		    ),
				array(
		        'import_file_name'       => 'Vicki',
		        'import_file_url'        => "http://themes.fuelthemes.net/theme-demo-files/voux-new/vicki/new-demo-content.xml",
		        'import_widget_file_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/vicki/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/vicki/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/vicki.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/vicki",
		    ),
				array(
		        'import_file_name'         => 'Jaime',
		        'import_file_url'          => "http://themes.fuelthemes.net/theme-demo-files/voux-new/jaime/new-demo-content.xml",
		        'import_widget_file_url'   => "http://themes.fuelthemes.net/theme-demo-files/voux-new/jaime/widget_data.json",
		        'import_theme_options_url' => "http://themes.fuelthemes.net/theme-demo-files/voux-new/jaime/theme-options.txt",
		        'import_image' => self::$thb_theme_directory_uri."assets/img/admin/demos/homepages/jaime.jpg",
		        'import_demo_url' => "https://thevoux.fuelthemes.net/jaime",
		    ),
		);
	}
	/**
	 *	Inintialize Admin Pages
	 */
	public function initAdminPages() {
		global $pagenow;

		// Script and styles
		add_action( 'admin_enqueue_scripts', array( & $this, 'adminPageEnqueue' ) );

		// Menu Pages
		add_action( 'admin_menu', array( & $this, 'adminSetupMenu' ), 1 );

		// Theme Options Redirect
		if ( isset($_GET['page']) ) {
			if ( 'admin.php' == $pagenow && 'thb-theme-options' == $_GET['page'] ) {
				if ( ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
					wp_redirect( admin_url( "themes.php?page=ot-theme-options" ) );
					die();
				}
			}
		}

		// Redirect to Main Page
		add_action( 'after_switch_theme', array( & $this, 'thb_activation_redirect' ) );

		// Ajax Option Update
		add_action("wp_ajax_thb_update_options", array( & $this, 'thb_update_options' ));
		add_action("wp_ajax_nopriv_thb_update_options", array( & $this, 'thb_update_options' ));

		// Admin Notices
		add_action( 'admin_notices', array( & $this, 'thb_admin_notices' ) );

		// Theme Updates
		add_action( 'admin_init', array( & $this, 'thb_theme_update') );

		// Plugin Update Nonce
		add_action( 'register_sidebar', array( & $this, 'thb_theme_admin_init' ) );

	}
	function thb_admin_notices() {
		$remote_ver = get_option("thb_".self::$thb_theme_slug."_remote_ver") ? get_option("thb_".self::$thb_theme_slug."_remote_ver") : self::$thb_theme_version;
		$local_ver = self::$thb_theme_version;

		if(version_compare($local_ver, $remote_ver, '<')) {
			if (
				( !self::$thb_product_key && ( self::$thb_product_key_expired == 0 ) ) ||
				( self::$thb_product_key && ( self::$thb_product_key_expired == 1 ) )
			) {
				echo '<div class="notice is-dismissible error thb_admin_notices">
				<p>There is an update available for the <strong>' . esc_html(self::$thb_theme_name) . '</strong> theme. Go to <a href="' . esc_url(admin_url( 'admin.php?page=thb-product-registration' )) . '">Product Registration</a> to enable theme updates.</p>
				</div>';
			}

			if ( ( self::$thb_product_key && ( self::$thb_product_key_expired == 0 ) ) ) {
				echo '<div class="notice is-dismissible error thb_admin_notices">
				<p>There is an update available for the <strong>' . esc_html(self::$thb_theme_name) . '</strong> theme. <a href="' . esc_url(admin_url()) . 'update-core.php">Update now</a>.</p>
				</div>';
			}
    }
	}
	public function thb_update_options() {
		check_ajax_referer( 'thb_register_ajax', 'security' );
		$key     = filter_input( INPUT_POST, 'key', FILTER_SANITIZE_STRING );
		$expired = filter_input( INPUT_POST, 'expired', FILTER_VALIDATE_BOOLEAN );
		update_option( 'thb_' . self::$thb_theme_slug . '_key', $key) ;
		update_option( 'thb_' . self::$thb_theme_slug . '_key_expired', $expired );
		wp_die();
	}
	public function thb_theme_update() {
		add_filter( 'pre_set_site_transient_update_themes', array( & $this, 'thb_check_for_update' ) );
		add_filter( 'upgrader_pre_download', array( $this, 'thb_upgradeFilter' ), 10, 4 );
	}
	public function thb_check_for_update_plugins() {
		$args = array(
			'timeout' => 30,
			'body' => array(
				"item_ids" => '242431',
				"product_key" => self::$thb_product_key
			)
		);
		$request = wp_remote_get( self::$_instance->thb_dashboard_url('plugin/version'), $args);
		$data = '';
		if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
			$data = json_decode( wp_remote_retrieve_body($request));
		}
		return $data;
	}
	public function thb_check_for_update( $transient ) {
		global $wp_filesystem;
		$args = array(
			'timeout' => 30,
			'body' => array(
				"theme_name" => self::$thb_theme_name,
				"product_key" => self::$thb_product_key
			)
		);

		$request = wp_remote_get( self::$_instance->thb_dashboard_url('version'), $args);

    if (!is_wp_error($request) || wp_remote_retrieve_response_code($request) === 200) {
    	$data = json_decode( wp_remote_retrieve_body($request));
			update_option("thb_".self::$thb_theme_slug."_key_expired", 0);

			if (isset($data->success) && $data->success == false) {
				self::$thb_product_key_expired = 1;
				update_option("thb_".self::$thb_theme_slug."_key_expired", 1);
			} else {
				if(version_compare(self::$thb_theme_version, $data->version, '<')) {
					$transient->response[self::$thb_theme_slug] = array(
						"new_version"	=> 		$data->version,
						"package"		=>	    $data->download_url,
						"url"			=>		'http://fuelthemes.net'
					);

					update_option("thb_".self::$thb_theme_slug."_remote_ver", $data->version);
				}
			}
		}
		return $transient;
	}
	public function thb_upgradeFilter( $reply, $package, $updater ) {

		$cond = ( !self::$thb_product_key || ( self::$thb_product_key_expired == 1 ) );

		if ( isset( $updater->skin->theme_info ) && $updater->skin->theme_info['Name'] == self::$thb_theme_name ) {
			if ( $cond ) {
				return new WP_Error( 'no_credentials', sprintf( __( 'To receive automatic updates, registration is required. Please visit <a href="%1$s" target="_blank">Product Registration</a> to activate your theme.', 'thevoux' ), esc_url(admin_url( 'admin.php?page=thb-product-registration' ) ) ) );
			}
		}

		// VisualComposer
		if ( (isset( $updater->skin->plugin )) && ( $updater->skin->plugin == 'js_composer/js_composer.php') ) {
			if ( $cond ) {
				return new WP_Error( 'no_credentials', sprintf( __( 'To receive automatic updates, registration is required. Please visit <a href="%1$s" target="_blank">Product Registration</a> to activate your theme.', 'thevoux' ), esc_url(admin_url( 'admin.php?page=thb-product-registration' ) ) ) );
			}
		}
		return $reply;
	}
	public function thb_plugins_install( $item ) {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$installed_plugins = get_plugins();

		$item['sanitized_plugin'] = $item['name'];

		// WordPress Repository
		if ( ! $item['version'] ) {
			$item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
		}

		// Install Link
		if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
			$actions = array(
				'install' => sprintf(
					'<a href="%1$s" class="button" title="Install %2$s">Install Now</a>',
					esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),
								'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
								'tgmpa-install' => 'install-plugin',
								'return_url'    => network_admin_url( 'admin.php?page=thb-plugins' )
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-install',
						'tgmpa-nonce'
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		// Activate Link
		elseif ( is_plugin_inactive( $item['file_path'] ) ) {
			$actions = array(
				'activate' => sprintf(
					'<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'               => urlencode( $item['slug'] ),
							'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
							'thb-activate'       => 'activate-plugin',
							'thb-activate-nonce' => wp_create_nonce( 'thb-activate' ),
						),
						admin_url( 'admin.php?page=thb-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}
		// Update Link

		elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
			$actions = array(
				'update' => sprintf(
					'<a href="%1$s" class="button button-update" title="Install %2$s"><span class="dashicons dashicons-update"></span> Update</a>',
					wp_nonce_url(
						add_query_arg(
							array(
								'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'        => urlencode( $item['slug'] ),
								'tgmpa-update'  => 'update-plugin',
								'version'       => urlencode( $item['version'] ),
								'return_url'    => network_admin_url( 'admin.php?page=thb-plugins' )
							),
							TGM_Plugin_Activation::$instance->get_tgmpa_url()
						),
						'tgmpa-update',
						'tgmpa-nonce'
					),
					$item['sanitized_plugin']
				),
			);
		} elseif ( self::$_instance->thb_ispluginactive( $item['file_path'] ) ) {
			$actions = array(
				'deactivate' => sprintf(
					'<a href="%1$s" class="button" title="Deactivate %2$s">Deactivate</a>',
					esc_url( add_query_arg(
						array(
							'plugin'                 => urlencode( $item['slug'] ),
							'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
							// 'plugin_source'          => urlencode( $item['source'] ),
							'thb-deactivate'       => 'deactivate-plugin',
							'thb-deactivate-nonce' => wp_create_nonce( 'thb-deactivate' ),
						),
						admin_url( 'admin.php?page=thb-plugins' )
					) ),
					$item['sanitized_plugin']
				),
			);
		}

		return $actions;
	}
	public function thb_theme_admin_init() {
		$get_name = filter_input( INPUT_GET, 'plugin_name', FILTER_SANITIZE_STRING );

		if ( isset( $_GET['thb-deactivate'] ) && $_GET['thb-deactivate'] == 'deactivate-plugin' ) {

			check_admin_referer( 'thb-deactivate', 'thb-deactivate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {
				if ( $plugin['Name'] == $get_name ) {
						deactivate_plugins( $plugin_name );
				}
			}

		}

		if ( isset( $_GET['thb-activate'] ) && $_GET['thb-activate'] == 'activate-plugin' ) {

			check_admin_referer( 'thb-activate', 'thb-activate-nonce' );

			if ( ! function_exists( 'get_plugins' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$plugins = get_plugins();

			foreach ( $plugins as $plugin_name => $plugin ) {
				if ( $plugin['Name'] == $get_name ) {
					activate_plugin( $plugin_name );
				}
			}

		}

	}
	public function thb_activation_redirect() {
		if ( ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
			$thevoux_installed = 'thevoux_installed';

			if ( false == get_option( $thevoux_installed, false ) ) {
				update_option( $thevoux_installed, true );
				wp_redirect( admin_url( 'admin.php?page=thb-product-registration' ) );
				die();
			}

			delete_option( $thevoux_installed );
		}
	}
	public function adminPageEnqueue($hook_suffix) {
		wp_enqueue_script( 'thb-admin-meta', Thb_Theme_Admin::$thb_theme_directory_uri .'assets/js/admin-meta.min.js', array('jquery'), esc_attr(self::$thb_theme_version));

		wp_enqueue_style( 'thb-admin-css', Thb_Theme_Admin::$thb_theme_directory_uri . "assets/css/admin.css", null, esc_attr(self::$thb_theme_version));
		wp_enqueue_style( 'thb-admin-vs-css', Thb_Theme_Admin::$thb_theme_directory_uri . "assets/css/admin_vc.css", null, esc_attr(self::$thb_theme_version));

		if (class_exists('WPBakeryVisualComposerAbstract')) {
			wp_enqueue_style( 'vc_extra_css', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/css/vc_extra.css' );
			wp_enqueue_script( 'thb-admin-vc', Thb_Theme_Admin::$thb_theme_directory_uri .'assets/js/admin-vc.min.js', array('jquery'), esc_attr(self::$thb_theme_version));
		}
		if ( in_array($hook_suffix, array('term.php', 'edit-tags.php') ) ){
      $screen = get_current_screen();

      if ( is_object( $screen ) && 'thb-sponsors' == $screen->taxonomy ){
        wp_enqueue_media();
      }
    }
	}
	public function adminSetupMenu() {

		// Product Registration
		add_menu_page( Thb_Theme_Admin::$thb_theme_name, Thb_Theme_Admin::$thb_theme_name, 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_Product_Registration' ), Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/fuelthemes-icon.svg', 3 );

		// Product Registration
		add_submenu_page( 'thb-product-registration', 'Registration', 'Registration', 'edit_theme_options', 'thb-product-registration', array( & $this, 'thb_Product_Registration' ) );

		// Main Menu Item
		add_submenu_page( 'thb-product-registration', 'Plugins', 'Plugins', 'edit_theme_options', 'thb-plugins', array( & $this, 'thb_Plugins' ) );

		// Demo Import
		add_submenu_page( 'thb-product-registration', 'Demo Import', 'Demo Import', 'edit_theme_options', 'thb-demo-import', array( & $this, 'thb_Demo_Import' ) );

		// Theme Options
		add_submenu_page( 'thb-product-registration', 'Theme Options', 'Theme Options', 'edit_theme_options', 'thb-theme-options', '__return_false' );

	}
	public function thb_Plugins() {
		get_template_part( 'inc/admin/welcome/pages/plugins' );
	}
	public function thb_Product_Registration() {
		get_template_part( 'inc/admin/welcome/pages/registration' );
	}
	public function thb_Demo_Import() {
		get_template_part( 'inc/admin/welcome/pages/demo-import' );
	}
	public function thb_ispluginactive( $value ) {
		$func = 'is_plugin' . '_active';
	  return $func( $value );
	}
	/**
	 *	Inintialize API
	 */
	public function thb_dashboard_url($type = null) {
		$url = 'https://my.fuelthemes.net';
		switch ( $type ) {
			case 'verify':
				$url .= '/api/verify';
				break;
			case 'verify-by-purchase':
				$url .= '/api/verify-by-purchase';
				break;
			case 'version':
				$url .= '/api/version';
				break;
			case 'plugin/version':
				$url .= '/api/plugin/version';
				break;
			case 'demo':
				$url .= '/api/demo';
				break;
		}
		return $url;
	}
}
// Main instance shortcut
function thb_Theme_Admin() {
	global $thb_Theme_Admin;
	return $thb_Theme_Admin;
}
Thb_Theme_Admin::instance();
