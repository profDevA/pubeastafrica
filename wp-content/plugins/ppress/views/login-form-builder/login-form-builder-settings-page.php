<?php

require_once 'login-builder-wp-list-table.php';

/**
 * Login Form Builder
 */
class Login_Form_Builder {

	private $login_builder_errors;

	private $plugin_menu_item;

	function __construct() {
		add_action( 'admin_menu', array( $this, 'register_settings_page' ) );
		add_filter( 'set-screen-option', array( $this, 'save_screen_option' ), 10, 3 );
		add_action( 'admin_print_scripts', array( $this, 'js_confirm_delete_login_form' ) );

		add_action( 'admin_init', array( $this, 'install_starter_themes' ) );
	}

	function register_settings_page() {

		$login_builder_hook = add_submenu_page(
			'pp-config',
			'Login Form - ProfilePress',
			'Login Form',
			'manage_options',
			'pp-login',
			array( $this, 'login_builder_page' ) );

		add_action( "load-$login_builder_hook", array( $this, 'add_options' ) );

		//help tab
		add_action( "load-$login_builder_hook", array( $this, 'help_tab' ) );

		$this->plugin_menu_item = $login_builder_hook;
	}

	/** Help tab */
	public function help_tab() {
		$screen = get_current_screen();
		if ( $screen->id != $this->plugin_menu_item ) {
			return;
		}
		$screen->add_help_tab( array(
			'id'      => 'help_tab_login-form',
			'title'   => 'Login shortcodes',
			'content' => require( PROFILEPRESS_ROOT . '/help-tab/login.php' )
		) );
		$screen->add_help_tab( array(
			'id'      => 'help_tab_global',
			'title'   => 'Global shortcodes',
			'content' => require( PROFILEPRESS_ROOT . '/help-tab/global.php' )
		) );
	}


	function login_builder_page() {
	    pp_cleanup_tinymce();

		// if we are in edit state, display the table
		if ( isset( $_GET['action'] ) && $_GET['action'] == 'edit' ) {

			// save login edit. note: method called before the static edit page
			// so generated error will display at the top of page
			$this->save_add_edit_login_builder( 'edit', absint( $_GET['login'] ) );

			$this->login_builder_edit_page();
		}
		elseif ( isset( $_GET['login-builder'] ) && $_GET['login-builder'] == 'new' ) {

			$this->save_add_edit_login_builder( 'add' );

			self::login_builder_add_page();
		} // if we are not in edit state, display the table
		else {
			self::login_builder_index_page();
		}
	}

	static function login_builder_index_page() {
		?>
		<div class="wrap">
			<h2>
		<?php _e('Login Form Builder', 'ppress');?>
		<a class="add-new-h2" href="<?php echo esc_url_raw( add_query_arg( 'login-builder', 'new' ) ); ?>"><?php _e( 'Add New', 'ppress' ); ?></a>
	</h2>

			<?php
			// include settings tab
			require_once VIEWS . '/include.settings-page-tab.php';?>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<!-- main content -->
					<div id="post-body-content">

						<div class="meta-box-sortables ui-sortable">
							<?php
							global $login_list_table;
							$login_list_table->prepare_items();
							?>

							<form method="post">
								<input type="hidden" name="page" value="ttest_list_table">
								<?php
								$login_list_table->display(); ?>
							</form>
						</div>
						<br>
						<a title="<?php _e( 'Click to install starter login themes', 'ppress' ); ?>" class="button-primary" href="<?php echo wp_nonce_url( admin_url( 'admin.php?page=' . LOGIN_BUILDER_SETTINGS_PAGE_SLUG . '&install-starter-theme=login' ), 'install_starter_theme' ); ?>">
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

	static function login_builder_add_page() {
		?>
		<div class="wrap">
		<h2><?php _e('Login Form Builder', 'ppress');?></h2>
		<?php
		require_once 'include.add-login-builder.php';
	}

function login_builder_edit_page() {
	?>
	<div class="wrap">
	<h2>
		<?php _e('Login Form Builder', 'ppress');?>
		<a class="add-new-h2" href="<?php echo esc_url_raw( add_query_arg( 'login-builder', 'new' ) ); ?>"><?php _e( 'Add New', 'ppress' ); ?></a>
	</h2>

	<?php if ( isset( $this->login_builder_errors ) ) : ?>
		<div id="message" class="error notice is-dismissible"><p><strong><?php echo $this->login_builder_errors; ?>. </strong></p></div>
	<?php endif; ?>

	<?php if ( @$_GET['login-added'] ) : ?>
		<div id="message" class="updated notice is-dismissible"><p><strong>New Login Added. </strong></p></div>
	<?php endif; ?>

	<?php
	if ( @$_GET['login-edited'] ) {
		echo '<div id="message" class="updated notice is-dismissible"><p><strong>Login Edited. </strong></p></div>';
	}
	require_once 'include.edit-login-builder.php';
}

	/**
	 * Save edit_login_builder
	 *
	 * Add a new builder to the DB and also update builder
	 *
	 * @param $operation string add/edit
	 * @param $id int builder id
	 */
	public function save_add_edit_login_builder( $operation, $id = '' ) {
		if ( current_user_can( 'administrator' ) && (isset( $_POST['add_login'] ) || isset( $_POST['edit_login'] ) )) {
			$title       = esc_attr( $_POST['lfb_title'] );
			$structure   = stripslashes( $_POST['lfb_structure'] );
			$css         = stripslashes( $_POST['lfb_css'] );


			// catch and save form generated errors in property @login_builder_errors
			if ( empty( $_POST['lfb_title'] ) ) {
				$this->login_builder_errors = 'Title is empty';
			}
			elseif ( empty( $_POST['lfb_structure'] ) ) {
				$this->login_builder_errors = 'Login Design is missing';
			}

			if ( isset( $this->login_builder_errors ) ) {
				return;
			}


			if ( isset( $_POST['edit_login'] ) && check_admin_referer( 'edit_login_builder', '_wpnonce' ) && $operation == 'edit' ) {

				// update login in db
				PROFILEPRESS_sql::sql_update_login_builder( $id, $title, $structure, $css, date( 'Y-m-d' ) );

				wp_redirect( add_query_arg( 'login-edited', 'true' ) );
				exit;
			}
			elseif ( isset( $_POST['add_login'] ) && check_admin_referer( 'add_login_builder', '_wpnonce' ) && $operation == 'add' ) {
				// insert the login to db
				$added_login_id = PROFILEPRESS_sql::sql_insert_login_builder( $title, $structure, $css, date( 'Y-m-d' ) );


				wp_redirect(
					sprintf(
						'?page=%s&action=%s&login=%s&_wpnonce=%s&login-added=true',
						LOGIN_BUILDER_SETTINGS_PAGE_SLUG, 'edit',
						absint( $added_login_id ),
						wp_create_nonce( 'pp_edit_login' )
					)
				);
				exit;
			}
		}
	}


	/** Instantiate the wp_list_table class */
	function add_options() {
		global $login_list_table;
		$option = 'per_page';
		$args   = array(
			'label'   => 'Login forms',
			'default' => 10,
			'option'  => 'login_builder_per_page'
		);
		add_screen_option( $option, $args );

		$login_list_table = new Login_Builder_List_Table;

	}

	// save the screen option values
	function save_screen_option( $status, $option, $value ) {
		return $value;
	}

	/**
	 * Install login form starter themes.
	 */
	public function install_starter_themes() {
		if ( isset( $_GET['install-starter-theme'] ) && $_GET['install-starter-theme'] == 'login' ) {
			if ( current_user_can( 'administrator' ) && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'install_starter_theme' ) ) {
				logins\Logins_Base::instance();
				// remove_query_arg is made to prevent recursive install of starter themes.
				wp_redirect( remove_query_arg( 'install-starter-theme', add_query_arg( 'starter-theme-install', 'success' ) ) );
				exit;
			}
		}
	}

	/** Singleton Poop */
	static function get_instance() {
		static $instance;
		if ( ! isset( $instance ) ) {
			$instance = new Login_Form_Builder;
		}

		return $instance;
	}

	/** Add an alert before a login builder is deleted */
	public function js_confirm_delete_login_form() {
		?>
		<script type="text/javascript">
			function pp_del_login(page, action, login, _wpnonce) {
				if (confirm("Are you sure you want to delete this?")) {
					window.location.href = '?page=' + page + '&action=' + action + '&login=' + login + '&_wpnonce=' + _wpnonce;
				}
			}
		</script>
	<?php
	}
}

Login_Form_Builder::get_instance();