<?php
namespace password_reset;

require_once 'flatui-theme/flatui.php';
require_once 'fzbuk-theme/fzbuk.php';


class Password_Reset_Base {

	public static function instance() {
		flatui_theme\Flatui_Password_Reset::instance();
		fzbuk_theme\Fzbuk_Password_Reset::instance();
	}
}