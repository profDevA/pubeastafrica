<?php

if(isset($_GET['page']) && substr($_GET['page'], 0, 3) == 'pp-') {
	add_filter( 'gettext', 'pp_change_help_tab_text', 20, 3 );
}

function pp_change_help_tab_text($translated_text, $text, $domain) {
	if($translated_text == 'Help') {
		$translated_text = 'Shortcode Help Guide';
	}

	return $translated_text;
}