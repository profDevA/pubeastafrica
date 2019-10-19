<?php

add_action( 'init', 'pp_global_shortcode_shortcake' );

function pp_global_shortcode_shortcake() {
	if(is_singular()) {
		return;
	}
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		return;
	}

	shortcode_ui_register_for_shortcode(
		'link-registration',
		array(
			'label'         => 'Registration Link',
			'listItemImage' => 'dashicons-admin-links',
			'attrs'         => array(
				array(
					'label'       => 'Label',
					'attr'        => 'label',
					'type'        => 'text',
					'description' => 'The anchor text for the link',
				),
				array(
					'label'       => 'CSS ID',
					'attr'        => 'id',
					'type'        => 'text',
					'description' => 'CSS id for the HTML registration link.',
				),
				array(
					'label'       => 'CSS class',
					'attr'        => 'class',
					'type'        => 'text',
					'description' => 'CSS class for the HTML registration link.',
				),
				array(
					'label'       => 'Title',
					'attr'        => 'title',
					'type'        => 'text',
					'description' => 'Title attribute for the HTML link',
				)
			)
		)
	);

	shortcode_ui_register_for_shortcode(
		'link-lost-password',
		array(
			'label'         => 'Password Reset Link',
			'listItemImage' => 'dashicons-admin-links',
			'attrs'         => array(
				array(
					'label'       => 'Label',
					'attr'        => 'label',
					'type'        => 'text',
					'description' => 'The anchor text for the link',
				),
				array(
					'label'       => 'CSS ID',
					'attr'        => 'id',
					'type'        => 'text',
					'description' => 'CSS id for the password reset link.',
				),
				array(
					'label'       => 'CSS class',
					'attr'        => 'class',
					'type'        => 'text',
					'description' => 'CSS class for the password reset link.',
				),
				array(
					'label'       => 'Title',
					'attr'        => 'title',
					'type'        => 'text',
					'description' => 'Title attribute for the link',
				)
			)
		)
	);

	shortcode_ui_register_for_shortcode(
		'link-login',
		array(
			'label'         => 'Login Link',
			'listItemImage' => 'dashicons-admin-links',
			'attrs'         => array(
				array(
					'label'       => 'Label',
					'attr'        => 'label',
					'type'        => 'text',
					'description' => 'The anchor text for the link',
				),
				array(
					'label'       => 'CSS ID',
					'attr'        => 'id',
					'type'        => 'text',
					'description' => 'CSS id for the password reset link.',
				),
				array(
					'label'       => 'CSS class',
					'attr'        => 'class',
					'type'        => 'text',
					'description' => 'CSS class for the password reset link.',
				),
				array(
					'label'       => 'Title',
					'attr'        => 'title',
					'type'        => 'text',
					'description' => 'Title attribute for the link',
				)
			)
		)
	);

	shortcode_ui_register_for_shortcode(
		'link-logout',
		array(
			'label'         => 'Logout Link',
			'listItemImage' => 'dashicons-admin-links',
			'attrs'         => array(
				array(
					'label'       => 'Label',
					'attr'        => 'label',
					'type'        => 'text',
					'description' => 'The anchor text for the link',
				),
				array(
					'label'       => 'CSS ID',
					'attr'        => 'id',
					'type'        => 'text',
					'description' => 'CSS id for the password reset link.',
				),
				array(
					'label'       => 'CSS class',
					'attr'        => 'class',
					'type'        => 'text',
					'description' => 'CSS class for the password reset link.',
				),
				array(
					'label'       => 'Title',
					'attr'        => 'title',
					'type'        => 'text',
					'description' => 'Title attribute for the link',
				)
			)
		)
	);
}

