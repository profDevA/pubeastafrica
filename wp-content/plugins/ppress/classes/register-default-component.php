<?php

/**
 * Default css and
 */

function pp_public_css()
{
    if (!apply_filters('pp_disable_flatui_bootstrap', false)) {
        wp_register_style('pp-bootstrap', ASSETS_URL . '/css/flat-ui/bs/css/bs.css');
        wp_enqueue_style('pp-flat-ui', ASSETS_URL . '/css/flat-ui/css/flat-ui.css', array('pp-bootstrap'));
    }

    wp_enqueue_style('ppcore', ASSETS_URL . '/css/ppcore.css');
}


function pp_admin_css()
{
    // only load in profilepress settings pages.
    if (!is_pp_admin_page()) return;

    wp_enqueue_style('pp-codemirror', ASSETS_URL . '/codemirror/codemirror.css');
    wp_enqueue_style('pp-admin', ASSETS_URL . '/css/admin-style.css');
}


function pp_public_js()
{
}

function pp_admin_js()
{
    wp_enqueue_script('jquery');

    // only load in profilepress settings pages.
    if (!is_pp_admin_page()) return;

    wp_enqueue_script('pp-admin-scripts', ASSETS_URL . '/js/admin.js', array('jquery'));
    wp_enqueue_script('pp-codemirror', ASSETS_URL . '/codemirror/codemirror.js');
    wp_enqueue_script('pp-codemirror-css', ASSETS_URL . '/codemirror/css.js');
}


add_action('wp_enqueue_scripts', 'pp_public_css');
add_action('admin_enqueue_scripts', 'pp_admin_css');
add_action('wp_enqueue_scripts', 'pp_public_js');
add_action('admin_enqueue_scripts', 'pp_admin_js');
