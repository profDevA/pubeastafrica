<?php
/** List of ProfilePress global helper functions */

/** Plugin DB settings data */
function pp_db_data()
{
    return get_option('pp_settings_data');
}


/** Addons options data */
function pp_addon_options()
{
    $addon_options = get_option('pp_addons_options', array());

    return !empty($addon_options) ? $addon_options : array();
}


/**
 * Return the url to redirect to after login authentication
 *
 * @return bool|string
 */
function pp_login_redirect()
{
    if (!empty($_REQUEST['redirect_to'])) {
        $redirect = $_REQUEST['redirect_to'];
    } else {
        $data = pp_db_data();

        $login_redirect = $data['set_login_redirect'];

        if ($login_redirect == 'dashboard') {
            $redirect = esc_url(network_site_url('/wp-admin'));
        } elseif ('current_page' == $login_redirect) {
            $redirect = pp_get_current_url_raw();
        } elseif (isset($login_redirect) && !empty($login_redirect)) {
            $redirect = get_permalink($login_redirect);
        } else {
            $redirect = esc_url(network_site_url('/wp-admin'));
        }
    }

    return apply_filters('pp_login_redirect', esc_url($redirect));
}

/**
 * Return the url to redirect to after login authentication
 *
 * @return bool|string
 */
function pp_profile_url()
{
    $data = pp_db_data();
    $db_url = $data['set_user_profile_shortcode'];

    if (!empty($db_url)) {
        return get_permalink($db_url);
    } else {
        return admin_url() . 'profile.php';
    }
}


/**
 * Return ProfilePress password reset url.
 *
 * @return string
 */
function pp_password_reset_url()
{
    $data = pp_db_data();
    $db_url = $data['set_lost_password_url'];

    if (!empty($db_url)) {
        return get_permalink($db_url);
    } else {
        return wp_lostpassword_url();
    }
}


/** Get ProfilePress login page URL or WP default login url if it isn't set. */
function pp_login_url()
{
    $data = pp_db_data();
    if (!empty($data['set_login_url'])) {
        $login_url = get_permalink($data['set_login_url']);
    } else {
        $login_url = wp_login_url();
    }

    return $login_url;
}

/** Get ProfilePress login page URL or WP default login url if it isn't set. */
function pp_registration_url()
{
    $data = pp_db_data();
    if (!empty($data['set_registration_url'])) {
        $reg_url = get_permalink($data['set_registration_url']);
    } else {
        $reg_url = wp_registration_url();
    }

    return $reg_url;
}

/**
 * Return the URL of the currently view page.
 *
 * @return string|void
 */
function pp_get_current_url()
{
    global $wp;

    return home_url(add_query_arg(array(), $wp->request));
}


/**
 * Return currently viewed page url without query string.
 *
 * @return string
 */
function pp_get_current_url_raw()
{
    return esc_url($_SERVER['HTTP_HOST'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}

/** @return string blog URL without scheme */
function pp_site_url_without_scheme()
{
    $parsed_url = parse_url(home_url());

    return $parsed_url['host'];
}

/**
 * Append an option to a select dropdown
 *
 * @param string $option option to add
 * @param string $select select dropdown
 *
 * @return string
 */
function pp_append_option_to_select($option, $select)
{
    $regex = "/<select ([^<]*)>/";

    preg_match($regex, $select, $matches);
    $select_attr = $matches[1];

    $a = preg_split($regex, $select);

    $join = '<select ' . $select_attr . '>' . "\r\n";
    $join .= $option . $a[1];

    return $join;
}

/**
 * Blog name or domain name if name doesn't exist
 *
 * @return string
 */
function pp_site_title()
{
    $blog_name = is_multisite() ? get_blog_option(null, 'blogname') : get_option('blogname');

    return !empty($blog_name) ? $blog_name : str_replace(array('http://', 'https://'), '', site_url());
}


/**
 * Check if an admin settings page is ProfilePress'
 * @return bool
 */
function is_pp_admin_page()
{
    $pp_builder_pages = array(
        REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG,
        LOGIN_BUILDER_SETTINGS_PAGE_SLUG,
        PASSWORD_RESET_BUILDER_SETTINGS_PAGE_SLUG,
        'pp-config',
        'pp-install-theme'
    );

    if (isset($_GET['page']) && in_array($_GET['page'], $pp_builder_pages)) {
        return true;
    }
}


/**
 * Return admin email
 *
 * @return string
 */
function pp_admin_email()
{
    return is_multisite() ? get_blog_option(null, 'admin_email') : get_option('admin_email');
}

/** Save all login generated WP_Error be it from normal login form or from social login shebang */
global $pp_login_wp_errors;
/**
 * Error handler for social login.
 *
 * @param string $error_key WP_Error key
 * @param string $error_value WP_Error value
 */
function pp_login_wp_errors($error_key, $error_value)
{
    global $pp_login_wp_errors;
    $pp_login_wp_errors = new WP_Error();
    $pp_login_wp_errors->add($error_key, $error_value);
}


/**
 * Checks whether the given user ID exists.
 *
 * @param string $user_id ID of user
 *
 * @return null|int The user's ID on success, and null on failure.
 */
function pp_user_id_exist($user_id)
{
    if ($user = get_user_by('id', $user_id)) {
        return $user->ID;
    } else {
        return null;
    }
}

/**
 * Get a user's username by their ID
 *
 * @param int $user_id
 *
 * @return bool|string
 */
function pp_get_username_by_id($user_id)
{
    if (empty($user_id)) {
        return false;
    }

    $user = get_user_by('id', $user_id);

    return $user->user_login;
}

/**
 * Is plugin license valid?
 *
 * @return bool
 */
function pp_is_license_valid()
{
    $license = get_option('pp_license_status');
    if ($license == 'valid') {
        return true;
    } else {
        return false;
    }
}

/**
 * Is plugin license invalid?
 * @return bool
 */
function pp_is_license_invalid()
{
    $license = get_option('pp_license_status');
    if ($license == 'invalid') {
        return true;
    } else {
        return false;
    }
}

/**
 * Is license empty?
 *
 * @return bool
 */
function pp_is_license_empty()
{
    $license = get_option('pp_license_key');
    if (false == $license || empty($license)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Was license once active?
 */
function pp_license_once_valid()
{
    $license = get_option('pp_license_once_active');
    if ($license == 'true') {
        return true;
    } else {
        return false;
    }
}


/**
 * Filter form field attributes for unofficial attributes.
 *
 * @param array $atts supplied shortcode attributes
 *
 * @return string
 */
function pp_other_field_atts($atts)
{
    $official_atts = array('name', 'class', 'id', 'value', 'title', 'required', 'placeholder');

    $other_atts = array();

    foreach ($atts as $key => $value) {
        if (!in_array($key, $official_atts)) {
            $other_atts[$key] = $value;
        }
    }


    $other_atts_html = '';
    foreach ($other_atts as $key => $value) {
        $other_atts_html .= "$key=\"$value\" ";
    }

    return $other_atts_html;
}


/**
 * Update option data in WordPress
 *
 * @param string $option
 * @param mixed $value
 *
 * @return bool
 */
function ppp_update_option($option, $value)
{
    $current_blog_id = get_current_blog_id();

    $return = is_multisite() ? update_blog_option($current_blog_id, $option, $value) : update_option($option, $value);

    return $return;
}


/**
 * Add option data in WordPress.
 *
 * @param string $option
 * @param mixed $value
 *
 * @return bool
 */
function ppp_add_option($option, $value)
{
    $current_blog_id = get_current_blog_id();

    $return = is_multisite() ? add_blog_option($current_blog_id, $option, $value) : add_option($option, $value);

    return $return;
}


/**
 * Delete option data in WordPress
 *
 * @param string $option
 *
 * @return bool
 */
function ppp_delete_option($option)
{
    $current_blog_id = get_current_blog_id();

    $return = is_multisite() ? delete_blog_option($current_blog_id, $option) : delete_option($option);

    return $return;
}

/**
 * Get option data in WordPress
 *
 * @param string $option
 *
 * @return mixed|void
 */
function ppp_get_option($option)
{
    $current_blog_id = get_current_blog_id();

    $return = is_multisite() ? get_blog_option($current_blog_id, $option) : get_option($option);

    return $return;
}

/**
 * Create an index.php file to prevent directory browsing.
 *
 * @param string $location folder path to create the file in.
 */
function pp_create_index_file($location)
{
    $content = "You are not allowed here!";
    $fp = fopen($location . "/index.php", "wb");
    fwrite($fp, $content);
    fclose($fp);
}


/**
 * Get front-end do password reset form url.
 *
 * @param string $user_login
 * @param string $key
 *
 * @return string
 */
function pp_get_do_password_reset_url($user_login, $key)
{
    $data = pp_db_data();
    // check to ensure custom password reset page is set
    $db_url = isset($data['set_lost_password_url']) ? $data['set_lost_password_url'] : '';

    if (apply_filters('pp_front_end_do_password_reset', true) && !empty($db_url)) {

        $url = add_query_arg(
            array(
                'key' => $key,
                'login' => rawurlencode($user_login)
            ),
            pp_password_reset_url()
        );

    } else {
        $url = network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
    }

    return $url;
}


/**
 * Get the version number of WordPress.
 *
 * @return string
 */
function pp_get_wordpress_version()
{
    return get_bloginfo('version');
}

function pp_cleanup_tinymce()
{
    add_filter( 'wp_default_editor', function() {
        return 'html';
    });

    echo '<style>.wp-editor-tabs{display:none}</style>';
}