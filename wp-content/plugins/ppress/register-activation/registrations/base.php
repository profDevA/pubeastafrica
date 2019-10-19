<?php
namespace registrations;

// require the various registration theme instances

require_once 'flatui-theme/flatui.php';
require_once 'fzbuk-theme/fzbuk.php';

/** Register all registration themes */
class Registrations_Base {

	public static function instance() {
		// registration builder themes
		flatui_theme\FlatUI_Registrations::instance();
		fzbuk_theme\Fzbuk_Registrations::instance();
	}
}