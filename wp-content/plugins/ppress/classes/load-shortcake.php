<?php
require CLASSES . '/shortcake-tinymce-button.php';

$pp_builder_pages = array(
	REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG,
	LOGIN_BUILDER_SETTINGS_PAGE_SLUG,
	PASSWORD_RESET_BUILDER_SETTINGS_PAGE_SLUG
);


if ( isset( $_GET['page'] ) && in_array( $_GET['page'], $pp_builder_pages ) ) {
	require CLASSES . '/global-shortcodes/shortcake.php';
}

if ( isset( $_GET['page'] ) && $_GET['page'] == REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG ) {
	require VIEWS . '/registration-form-builder/shortcake.php';
}

if ( isset( $_GET['page'] ) && $_GET['page'] == LOGIN_BUILDER_SETTINGS_PAGE_SLUG ) {
	require VIEWS . '/login-form-builder/shortcake.php';
}

if ( isset( $_GET['page'] ) && $_GET['page'] == PASSWORD_RESET_BUILDER_SETTINGS_PAGE_SLUG ) {
	require VIEWS . '/password-reset-builder/shortcake.php';
}