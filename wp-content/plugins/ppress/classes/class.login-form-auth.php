<?php

/**
 * Authorise login and redirect to the appropriate page
 *
 * currently used only by the tabbed widget.
 */
class ProfilePress_Login_Auth
{
    /**
     * Called to validate login credentials or o
     * @return string
     */
    public static function credentials_validation($id = null, $redirect = null)
    {
        // filter for the css class of the error message
        $login_status_css_class = apply_filters('pp_login_error_css_class', 'profilepress-login-status', $id);

        // catch all social login errors caught by the glaobal func below.
        /** @see connectors.php */
        global $pp_login_wp_errors;

        // initialise variable
        $login_error = '';

        if (isset($pp_login_wp_errors) && is_wp_error($pp_login_wp_errors)) {
            $login_error = '<div class="' . $login_status_css_class . '">';
            $login_error .= $pp_login_wp_errors->get_error_message();
            $login_error .= '</div>';
        }

        // filter to change login submit button name to avoid validation for forms on same page
        $submit_name = apply_filters('pp_login_submit_name', 'login_submit', $id);
        // if login form have been submitted process it
        if (isset($_POST[$submit_name])) {
            // get login form data
            $username = trim($_POST['login_username']);
            $password = $_POST['login_password'];
            $remember_login = sanitize_text_field($_POST['login_remember']);

            // $id is being included for filtering the redirection location after login
            $login_status = ProfilePress_Login_Auth::login_auth($username, $password, $remember_login, $id, $redirect);

            if (isset($login_status) && is_wp_error($login_status)) {
                $login_error = '<div class="' . $login_status_css_class . '">';
                $login_error .= $login_status->get_error_message();
                $login_error .= '</div>';
            } else {
                $login_error = '';
            }
        }

        return $login_error;
    }

    /**
     * Authenticate login
     *
     * @param string $username
     * @param string $password
     * @param bool $remember_login
     * @param string $login_form_id
     * @param string $redirect
     *
     * @return string/void
     */
    static function login_auth($username, $password, $remember_login = 'true', $login_form_id = '', $redirect)
    {
        do_action('pp_before_login_validation', $username, $password, $login_form_id);

        /* start filter Hook */

        $login_errors = new WP_Error();

        // call validate reg from function
        $login_form_errors = apply_filters('pp_login_validation', $login_errors, $login_form_id);

        if (is_wp_error($login_form_errors) && $login_form_errors->get_error_code() != '') {

            return $login_form_errors;
        }

        /* End Filter Hook */

        $creds = array();
        $creds['user_login'] = $username;
        $creds['user_password'] = $password;

        if ($remember_login == 'true') {
            $creds['remember'] = true;
        }

        $secure_cookie = '';
        // If the user wants ssl but the session is not ssl, force a secure cookie.
        if (!force_ssl_admin()) {
            if ($user = get_user_by('login', $username)) {
                if (get_user_option('use_ssl', $user->ID)) {
                    $secure_cookie = true;
                    force_ssl_admin(true);
                }
            }
        }

        if (defined('FORCE_SSL_ADMIN') && FORCE_SSL_ADMIN === true) {
            $secure_cookie = true;
        }

        $user = wp_signon($creds, $secure_cookie);

        $user = apply_filters('pp_login_errors', $user, $username);

        if (is_wp_error($user) && ($user->get_error_code())) {
            return $user;
        } elseif (!is_wp_error($user)) {

            do_action('pp_before_login_redirect', $username, $password, $login_form_id);

            // culled from wp-login.php file.
            if (!empty($redirect)) {
                // Redirect to https if user wants ssl
                if ($secure_cookie && false !== strpos($redirect, 'wp-admin'))
                    $redirect = preg_replace('|^http://|', 'https://', $redirect);
            } else {
                $redirect = pp_login_redirect();
            }

            $login_redirect = $redirect;

            /** Setup a custom location of the builder */
            $login_redirection = apply_filters('pp_login_redirect', $login_redirect, $login_form_id);

            wp_redirect($login_redirection);
            exit;
        }
    }

}
