<?php
require get_template_directory() .'/inc/admin/plugins/class-tgm-plugin-activation.php';

function thb_register_required_plugins() {
	$data = thb_Theme_Admin()->thb_check_for_update_plugins();
	if (isset($data->plugins)) {
		foreach ($data->plugins as $plugin) {
			switch ($plugin->plugin_name) {
				case 'WPBakery Visual Composer':
				case 'WPBakery Page Builder':
					$slug = 'js_composer';
					break;
				case 'Slider Revolution':
					$slug = 'revslider';
					break;
			}
			$plugins[] = array(
				'name'	        => $plugin->plugin_name,
				'slug'		      => $slug,
				'source'        => $plugin->download_url,
				'version'       => $plugin->version,
				'required'      => true,
				'external_url'  => '',
				'image_url'     => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/'.esc_attr($slug).'.png'
			);
		}
	} else {
		$plugins[] = array(
			'name'				  => 'WPBakery Visual Composer',
			'slug'				  => 'js_composer',
			'source'			  => get_template_directory() . '/inc/plugins/plugins/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip',
			'version'				=> '6.0.2',
			'required'			=> true,
			'image_url'     => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/js_composer.png'
		);
	}
	$plugins[] = array(
		'name'     				    => esc_html__('The Voux - Required Plugin', 'thevoux'),
		'slug'     				    => 'thevoux-plugin',
		'source'					    => get_template_directory() . '/inc/plugins/thevoux-plugin.zip',
		'version'				      => '1.1.4.3',
		'required'				    => true,
		'force_activation'		=> false,
		'force_deactivation'	=> false,
		'image_url'           => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/thevoux.png'
	);
	$plugins[] = array(
		'name'     				    => esc_html__('Sponsored Posts', 'thevoux'),
		'slug'     				    => 'thb-sponsors-plugin',
		'source'					    => get_template_directory() . '/inc/plugins/thb-sponsors-plugin.zip',
		'version'				      => '1.0.0',
		'required'				    => true,
		'force_activation'		=> false,
		'force_deactivation'	=> false,
		'image_url'           => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/thb-sponsors.png'
	);
	$plugins[] = array(
		'name'     				    => 'WooCommerce',
		'slug'     				    => 'woocommerce',
		'required'				    => true,
		'force_activation'		=> false,
		'force_deactivation'  => false,
		'image_url'           => Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/admin/plugins/woo.png'
	);
	$config = array(
		'id'              => 'thb',
		'domain'       		=> 'thevoux',         	    // Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                      // Default absolute path to pre-packaged plugins
		'parent_slug'     => 'themes.php',
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'     => true,                       	// Show admin notices or not
		'is_automatic'    => false,					   	// Automatically activate plugins after installation or not
		'message' 				=> '',					// Message to output right before the plugins table
		'strings'      		=> array(
			'return'       	=> esc_html__( 'Return to Theme Plugins', 'thevoux' )
		)
	);

	tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'thb_register_required_plugins');
