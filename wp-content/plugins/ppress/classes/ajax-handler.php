<?php

//builder preview Ajax handler
add_action( 'wp_ajax_pp-builder-preview', 'pp_builder_preview_handler' );

function pp_builder_preview_handler() {

	// iframe preview url content
	if ( isset( $_GET['action'] ) && $_GET['action'] == 'pp-builder-preview' ) {
		include VIEWS . '/live-preview/builder-preview.php';
	}
	// if ajax post request is received return the parsed shortcode
	elseif ( isset( $_POST['builder_structure'] ) && ! empty( $_POST['builder_structure'] ) ) {
		echo do_shortcode( stripslashes( $_POST['builder_structure'] ) );
	}

	// IMPORTANT: don't forget to "exit"
	exit;

}