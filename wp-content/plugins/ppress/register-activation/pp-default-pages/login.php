<?php
namespace pp_default_pages;

/**
 * Create a login page powered by ProfilePress
 *
 * @package pp_default_pages
 */
class Login {

	/** insert the page to db */
	public static function instance() {
		// Create post object
		$post_args = array(
			'post_title'    => 'Log In',
			'post_content'  => '[profilepress-login id="1"]',
			'post_status'   => 'publish',
			'post_type' => 'page'
		);

		// Insert the post into the database
		$insert = wp_insert_post( $post_args, true );

		if($insert && !is_wp_error($insert)) {
			return $insert;
		}
		else {
			return null;
		}
	}
}