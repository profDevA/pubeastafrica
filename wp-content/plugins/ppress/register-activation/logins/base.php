<?php
namespace logins;

require_once 'flatui-theme/flatui.php';
require_once 'fzbuk-theme/fzbuk.php';


class Logins_Base {

	public static function instance() {
		flatui_theme\FlatUI_Login::instance();
		fzbuk_theme\Fzbuk_Login::instance();
	}
}