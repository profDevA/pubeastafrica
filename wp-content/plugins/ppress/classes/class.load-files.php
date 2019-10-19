<?php

class ProfilePress_Dir {

	public static function load_files() {
		require CLASSES . '/class.plugin-update.php';
		require CLASSES . '/global-functions.php';
		require CLASSES . '/tgm-dependencies.php';
		require CLASSES . '/load-shortcake.php';
		require CLASSES . '/action-links.php';
		require CLASSES . '/mo-admin-notice.php';

		require PROFILEPRESS_ROOT . 'help-tab/change-help-tab-text.php';

		require CLASSES . '/profilepress-sql.php';
		require CLASSES . '/class.alter-default-links.php';
		require CLASSES . '/register-default-component.php';

		require CLASSES . '/ajax-handler.php';
		require CLASSES . '/class.login-form-auth.php';
		require CLASSES . '/admin-notices.php';

		require CLASSES . '/global-shortcodes/global-shortcodes.php';

		require VIEWS . '/admin-footer.php';
		require VIEWS . '/general-settings.php';
		require VIEWS . '/login-form-builder/parent-login-shortcode-parser.php';
		require VIEWS . '/registration-form-builder/parent-registration-shortcode-parser.php';
		require VIEWS . '/password-reset-builder/parent-password-reset-shortcode-parser.php';
	}
}