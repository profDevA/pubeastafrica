<?php

class PP_ShortcakeUI {

	static $instance;

	public static function initialize() {
		$pp_builder_pages = array(
			REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG,
			LOGIN_BUILDER_SETTINGS_PAGE_SLUG,
			PASSWORD_RESET_BUILDER_SETTINGS_PAGE_SLUG,
		);


		if ( isset( $_GET['page'] ) && in_array( $_GET['page'], $pp_builder_pages ) ) {
            // remove shortcake "Add Post Element" button.
            if (class_exists('Shortcode_UI')) {
                remove_action('media_buttons', array(Shortcode_UI::get_instance(), 'action_media_buttons'));
            }
			add_action( 'media_buttons', array( __CLASS__, 'shortcake_button' ), 15 );
			add_action( 'wp_enqueue_media', array( __CLASS__, 'shortcaka_button_js' ) );
		}
	}

	/**
	 * Callback function
	 */
	public static function shortcake_button() {
		if ( is_plugin_active( 'shortcode-ui/shortcode-ui.php' ) ) {
			?>
			<a href="#" class="button pp-insert-shortcake">
				<img src="<?php echo ASSETS_URL; ?>/images/buttoncon.png" alt="" style="margin: 0 2px; padding: 0; height: 100%; width: auto; vertical-align: top;"/> ProfilePress Shortcodes
			</a>
			<?php
		}
	}

	/**
	 * Shortcake JS button
	 */
	public static function shortcaka_button_js() {
		wp_enqueue_script( 'media_button', ASSETS_URL . '/js/shortcakeui.js', array( 'jquery' ), '1.0', true );
	}
}

add_action('admin_init', array('PP_ShortcakeUI', 'initialize' ));
