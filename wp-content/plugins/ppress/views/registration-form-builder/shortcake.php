<?php

add_action( 'init', 'pp_registration_shortcode_shortcake' );

function pp_registration_shortcode_shortcake() {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		return;
	}

	shortcode_ui_register_for_shortcode(
		'reg-username',
		array(
			'label'         => 'Registration form: Username field',
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
		'reg-password',
		array(
			'label'         => 'Registration form: Password field',
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
		'reg-email',
		array(
			'label'         => 'Registration form: Email field',
			'listItemImage' => 'dashicons-email',
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
		'reg-website',
		array(
			'label'         => 'Registration form: Website field',
			'listItemImage' => 'dashicons-admin-links',
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
		'reg-nickname',
		array(
			'label'         => 'Registration form: Nickname field',
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
		'reg-display-name',
		array(
			'label'         => 'Registration form: Display name field',
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
		'reg-first-name',
		array(
			'label'         => 'Registration form: First name field',
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
		'reg-last-name',
		array(
			'label'         => 'Registration form: Last name field',
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
		'reg-bio',
		array(
			'label'         => 'Registration form: Biography field',
			'listItemImage' => 'dashicons-info',
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
		'reg-submit',
		array(
			'label'         => 'Registration form: Submit Button',
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