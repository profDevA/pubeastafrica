<?php
add_action( 'init', 'pp_login_shortcode_shortcake' );

function pp_login_shortcode_shortcake() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		return;
	}

	shortcode_ui_register_for_shortcode(
		'login-username',
		array(
			'label'         => 'Login form: Username field',
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
		'login-password',
		array(
			'label'         => 'Login form: Password field',
			'listItemImage' => 'dashicons-no-alt',
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
		'login-remember',
		array(
			'label'         => 'Login form: Remember Login Checkbox',
			'listItemImage' => 'dashicons-editor-removeformatting',
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
				)
			),
		)
	);

shortcode_ui_register_for_shortcode(
		'login-submit',
		array(
			'label'         => 'Login form: Submit Button',
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