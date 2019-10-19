<?php

require CLASSES . '/class-tgm-plugin.php';

add_action('tgmpa_register', 'pp_require_plugins');

function pp_require_plugins()
{
    if (apply_filters('pp_disable_tgmpa_notice', false)) return;

    $plugins = array(
        // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name' => 'Shortcake (Shortcode UI)', // The plugin name.
            'slug' => 'shortcode-ui', // The plugin slug (typically the folder name).
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'force_activation' => false
        )
    );

    $config = array(

        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu' => 'pp-required-plugins', // Menu slug.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'tgmpa'),
            'menu_title' => __('Install Plugins', 'tgmpa'),
            'installing' => __('Installing Plugin: %s', 'tgmpa'), // %s = plugin name.
            'oops' => __('Something went wrong with the plugin API.', 'tgmpa'),
            'notice_can_install_required' => _n_noop('ProfilePress requires the following plugin: %1$s.', 'ProfilePress requires the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop('ProfilePress recommends the following plugin: %1$s.', 'ProfilePress recommends the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with ProfilePress: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with ProfilePress: %1$s.'), // %1$s = plugin name(s).

        )
    );

    tgmpa($plugins, $config);

}