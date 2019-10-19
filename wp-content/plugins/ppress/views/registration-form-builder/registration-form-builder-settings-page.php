<?php
ob_start();
require_once 'registration-builder-wp-list-table.php';

/**
 * Registration Form Builder
 */
class Registration_Form_Builder {

	private $registration_builder_errors;

	private $plugin_menu_item;

	function __construct() {
		add_action( 'admin_menu', array( $this, 'register_settings_page' ) );
		add_filter( 'set-screen-option', array( $this, 'save_screen_option' ), 10, 3 );
		add_action( 'admin_print_scripts', array( $this, 'js_confirm_registration_builder' ) );

		add_action( 'admin_init', array( $this, 'install_starter_themes' ) );

	}

	function register_settings_page() {

		$hook = add_submenu_page(
			'pp-config',
			'Registration Form - ProfilePress',
			'Registration Form',
			'manage_options',
			'pp-registration',
			array( $this, 'registration_builder_page' )
		);

		add_action( "load-$hook", array( $this, 'add_options' ) );

		//help tab
		add_action( "load-$hook", array( $this, 'help_tab' ) );

		$this->plugin_menu_item = $hook;
	}

	/** Help tab */
	public function help_tab() {
		$screen = get_current_screen();
		if ( $screen->id != $this->plugin_menu_item ) {
			return;
		}
		$screen->add_help_tab( array(
			'id'      => 'help_tab_login-form',
			'title'   => 'Registration form shortcodes',
			'content' => require( PROFILEPRESS_ROOT . '/help-tab/registration.php' ),
		) );
		$screen->add_help_tab( array(
			'id'      => 'help_tab_global',
			'title'   => 'Global shortcodes',
			'content' => require( PROFILEPRESS_ROOT . '/help-tab/global.php' ),
		) );
	}

	function registration_builder_page() {
	    pp_cleanup_tinymce();
		// if we are in edit state, display the table
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'edit' ) {

			// save registration edit. note: method called before the static edit page
			// so generated error will display at the top of page
			$this->save_add_edit_registration_builder( 'edit', absint( $_GET['registration'] ) );

			$this->registration_builder_edit_page();
		}
		elseif ( isset( $_GET['registration-builder'] ) && $_GET['registration-builder'] == 'new' ) {

			$this->save_add_edit_registration_builder( 'add' );

			$this->registration_builder_add_page();
		} // if we are not in edit state, display the table
		else {
			self::registration_builder_index_page();
		}
	}

	static function registration_builder_index_page() {
		?>
		<div class="wrap">
			<h2>Registration Form Builder
				<a class="add-new-h2" href="<?php echo esc_url( add_query_arg( 'registration-builder', 'new' ) ); ?>">Add New</a>
			</h2>

			<?php

			// include settings tab
			require_once VIEWS . '/include.settings-page-tab.php';?>

			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content">
						<div class="meta-box-sortables ui-sortable">
							<?php
							global $registration_list_table;
							$registration_list_table->prepare_items();
							?>

							<form method="post">
								<input type="hidden" name="page" value="ttest_list_table">
								<?php
								$registration_list_table->display(); ?>
							</form>
						</div>
						<br>
						<a title="<?php _e( 'Click to install starter registration themes', 'ppress' ); ?>" class="button-primary" href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=' . REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG . '&install-starter-theme=registration' ), 'install_starter_theme' ); ?>">
							<?php _e( 'Install Starter Themes', 'ppress' ); ?>
						</a>
					</div>
					<?php include_once VIEWS . '/include.plugin-settings-sidebar.php'; ?>

				</div>
				<br class="clear">
			</div>
		</div>
	<?php
	}

	public function registration_builder_add_page() {
		?>
		<div class="wrap">
		<h2><?php _e('Registration Form Builder', 'ppress'); ?></h2>

		<?php if ( isset( $this->registration_builder_errors ) ) { ?>
			<div id="message" class="error notice is-dismissible"><p><strong><?php echo $this->registration_builder_errors; ?>. </strong>
				</p></div>
		<?php
		}

		require_once 'include.add-registration-builder.php';
	}

	public function registration_builder_edit_page() { ?>
	<div class="wrap">
	<h2>
	<?php _e('Registration Form Builder', 'ppress'); ?>
		<a class="add-new-h2" href="<?php echo esc_url( add_query_arg( 'registration-builder', 'new' ) ); ?>"><?php _e( 'Add New', 'ppress' ); ?></a>
	</h2>

		<?php
		if ( isset( $this->registration_builder_errors ) ) {
			echo '<div id="message" class="error notice is-dismissible"><p><strong>' . $this->registration_builder_errors . '</strong></p></div>';
		}

		if ( @$_GET['registration-edited'] ) {
			echo '<div id="message" class="updated notice is-dismissible"><p><strong>Registration Edited. </strong></p></div>';
		}

		if ( @$_GET['registration-added'] ) {
			echo '<div id="message" class="updated notice is-dismissible"><p><strong>New Registration Added. </strong></p></div>';
		}

		require_once 'include.edit-registration-builder.php';
	}

	/**
	 * @param $operation
	 * @param string $id
	 */
	function save_add_edit_registration_builder( $operation, $id = '' ) {
		if ( current_user_can( 'administrator' ) && (isset( $_POST['add_registration'] ) || isset( $_POST['edit_registration'] ) )) {
			$title                = @esc_attr( $_POST['rfb_title'] );
			$structure            = @stripslashes( $_POST['rfb_structure'] );
			$css                  = @stripslashes( $_POST['rfb_css'] );
			$success_registration = @stripslashes( $_POST['rfb_success_registration'] );


			// catch and save form generated errors in property @registration_builder_errors 
			if ( empty( $_POST['rfb_title'] ) ) {
				$this->registration_builder_errors = 'Title is empty';
			}
			elseif ( empty( $_POST['rfb_structure'] ) ) {
				$this->registration_builder_errors = 'Registration Design is missing';
			}

			if ( isset( $this->registration_builder_errors ) ) {
				return;
			}

			if ( isset( $_POST['edit_registration'] ) && check_admin_referer( 'edit_registration_builder', '_wpnonce' ) && $operation == 'edit' ) {

				PROFILEPRESS_sql::sql_update_registration_builder( $id, $title, $structure, $css, $success_registration, date( 'Y-m-d' ) );

				wp_redirect( add_query_arg( 'registration-edited', 'true' ) );
				exit;
			}

			if ( isset( $_POST['add_registration'] ) && check_admin_referer( 'add_registration_builder', '_wpnonce' ) && $operation == 'add' ) {

				$id = PROFILEPRESS_sql::sql_insert_registration_builder( $title, $structure, $css, $success_registration, date( 'Y-m-d' ) );

				wp_redirect(
					sprintf(
						'?page=%s&action=%s&registration=%s&_wpnonce=%s&registration-added=true',
						REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG, 'edit',
						absint( $id ),
						wp_create_nonce( 'pp_edit_registration' )
					)
				);
				exit;
			}
		}
	}

	function add_options() {
		global $registration_list_table;
		$option = 'per_page';
		$args   = array(
			'label'   => 'Registration forms',
			'default' => 10,
			'option'  => 'registration_builder_per_page',
		);
		add_screen_option( $option, $args );

		$registration_list_table = new Registration_Builder_List_Table;

	}

	// save the screen option values
	function save_screen_option( $status, $option, $value ) {
		return $value;
	}

	/**
	 * Install registration form starter themes.
	 */
	public function install_starter_themes() {
		if ( isset( $_GET['install-starter-theme'] ) && $_GET['install-starter-theme'] == 'registration' ) {
			if ( current_user_can('administrator') && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'install_starter_theme' ) ) {
				registrations\Registrations_Base::instance();
				// remove_query_arg is made to prevent recursive install of starter themes.
				wp_redirect( remove_query_arg( 'install-starter-theme', add_query_arg( 'starter-theme-install', 'success' ) ) );
				exit;
			}
		}
	}

	static function get_instance() {
		static $instance;
		if ( ! isset( $instance ) ) {
			$instance = new Registration_Form_Builder;
		}

		return $instance;
	}

	/** Add an alert before a registration builder is deleted */
	public function js_confirm_registration_builder() {
		?>
		<script type="text/javascript">
			function pp_del_registration(page, action, registration, _wpnonce) {
				if (confirm("Are you sure you want to delete this?")) {
					window.location.href = '?page=' + page + '&action=' + action + '&registration=' + registration + '&_wpnonce=' + _wpnonce;
				}
			}
		</script>
	<?php
	}
}

Registration_Form_Builder::get_instance();