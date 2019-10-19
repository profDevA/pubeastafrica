<?php
add_action( 'init', 'pp_passreset_shortcode_shortcake' );

function pp_passreset_shortcode_shortcake() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		return;
	}

	shortcode_ui_register_for_shortcode(
		'user-login',
		array(
			'label'         => 'Password Reset Form: Username / Email field',
			'listItemImage' => 'dashicons-admin-users',
			'attrs'         => array(
				array(
					'label'       => 'CSS class',
					'attr'        => 'class',
					'type'        => 'text',
					'description' => 'CSS class for the field.',
				),
				array(
					'label'       => 'CSS ID',
					'attr'        => 'id',
					'type'        => 'text',
					'description' => 'CSS id for the field.',
				),
				array(
					'label'       => 'Title',
					'attr'        => 'title',
					'type'        => 'text',
					'description' => 'Title attribute for the input field.',
				),
				array(
					'label'       => 'Placeholder',
					'attr'        => 'placeholder',
					'type'        => 'text',
					'description' => 'Placeholder attribute for the input field.'
				),
				array(
					'label'       => 'Value',
					'attr'        => 'value',
					'type'        => 'text',
					'description' => 'Value attribute (default field text).'
				),
			),
		)
	);

shortcode_ui_register_for_shortcode(
		'reset-submit',
		array(
			'label'         => 'Password Reset Form: Submit Button',
			'listItemImage' => 'dashicons-cart',
			'attrs'         => array(
				array(
					'label'       => 'CSS class',
					'attr'        => 'class',
					'type'        => 'text',
					'description' => 'CSS class for the field.',
				),
				array(
					'label'       => 'CSS ID',
					'attr'        => 'id',
					'type'        => 'text',
					'description' => 'CSS id for the field.',
				),
				array(
					'label'       => 'Title',
					'attr'        => 'title',
					'type'        => 'text',
					'description' => 'Title attribute for the input field.',
				),
				array(
					'label'       => 'Value',
					'attr'        => 'value',
					'type'        => 'text',
					'description' => 'Submit button text.'
				),
			),
		)
	);
}