<?php

/** @todo refactor this class to be modular and easy to @see moderation-notification.php */
class ProfilePress_Registration_Auth
{

    static protected $registration_form_status;

    // recaptcha db settings
    static protected $recaptcha_db_settings;

    /**
     * Called to validate registration form field
     * @return string
     */
    public static function validate_registration_form($id = null, $redirect = null)
    {
        // if registration form have been submitted process it

        // filter to change registration submit button name to avoid validation for forms on same page
        $submit_name = apply_filters('pp_registration_submit_name', 'reg_submit', $id);
        if (isset($_POST[$submit_name])) {
            $register_the_user = ProfilePress_Registration_Auth::register_new_user($_POST, $id, $_FILES, $redirect);
        }

        // display form generated messages
        if ( ! empty($register_the_user)) {
            $registration_errors = html_entity_decode($register_the_user);
        } else {
            $registration_errors = '';
        }

        return $registration_errors;
    }


    /**
     * Register new users
     *
     * @param $post array $_POST data
     * @param $form_id int Registration builder ID
     *
     * @return string
     */
    public static function register_new_user($post, $form_id, $files = '', $redirect = '')
    {

        // create an array of acceptable userdata for use by wp_insert_user
        $valid_userdata = array(
            'reg_username',
            'reg_password',
            'reg_email',
            'reg_website',
            'reg_nickname',
            'reg_display_name',
            'reg_first_name',
            'reg_last_name',
            'reg_bio'
        );

        // get the data for userdata
        $segregated_userdata = array();

        // loop over the $_POST data and create an array of the wp_insert_user userdata
        foreach ($post as $key => $value) {
            if ($key == 'reg_submit') {
                continue;
            }

            if (in_array($key, $valid_userdata)) {
                $segregated_userdata[$key] = esc_attr($value);
            }
        }


        // get convert the form post data to userdata for use by wp_insert_users
        $username     = isset($segregated_userdata['reg_username']) ? $segregated_userdata['reg_username'] : '';
        $password     = isset($segregated_userdata['reg_password']) ? $segregated_userdata['reg_password'] : '';
        $email        = isset($segregated_userdata['reg_email']) ? $segregated_userdata['reg_email'] : '';
        $website      = isset($segregated_userdata['reg_website']) ? $segregated_userdata['reg_website'] : '';
        $nickname     = isset($segregated_userdata['reg_nickname']) ? $segregated_userdata['reg_nickname'] : '';
        $display_name = isset($segregated_userdata['reg_display_name']) ? $segregated_userdata['reg_display_name'] : '';
        $first_name   = isset($segregated_userdata['reg_first_name']) ? $segregated_userdata['reg_first_name'] : '';
        $last_name    = isset($segregated_userdata['reg_last_name']) ? $segregated_userdata['reg_last_name'] : '';
        $bio          = isset($segregated_userdata['reg_bio']) ? $segregated_userdata['reg_bio'] : '';


        // real uer data
        $real_userdata = array(
            'user_login'   => $username,
            'user_pass'    => $password,
            'user_email'   => $email,
            'user_url'     => $website,
            'nickname'     => $nickname,
            'display_name' => $display_name,
            'first_name'   => $first_name,
            'last_name'    => $last_name,
            'description'  => $bio
        );

        // filter for the css class of the error message
        $reg_status_css_class = apply_filters('pp_registration_error_css_class', 'profilepress-reg-status', $form_id);


        /* start filter Hook */
        $reg_errors = new WP_Error();

        if ( ! validate_username($post['reg_username'])) {
            $reg_errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid because it uses illegal characters. Please enter a valid username.', 'profilepress'));
        }

        if ( ! is_email($real_userdata['user_email'])) {
            $reg_errors->add('invalid_email', __('Email address is not valid', 'ppress'));
        }

        // --------START ---------   validation for required fields ----------------------//
        // loop through required fields and throw error if any is empty
        if (is_array($_POST['required-fields']) && ! empty($_POST['required-fields'])) {
            foreach ($_POST['required-fields'] as $key => $value) {
                if (empty($_POST[$key])) {
                    $reg_errors->add('required_field_empty', sprintf(__('%s field is required', 'ppress'), $value));
                    // stop looping if a required field is found empty.
                    break;
                }
            }
        }
        // --------END ---------   validation for required fields ----------------------//

        // call validate reg from function
        $reg_form_errors = apply_filters('pp_registration_validation', $reg_errors, $form_id);

        if (is_wp_error($reg_form_errors) && $reg_form_errors->get_error_code() != '') {
            return '<div class="' . $reg_status_css_class . '">' . $reg_form_errors->get_error_message() . '</div>';
        }

        /* End Filter Hook */

        //merge real data(for use by wp_insert_user()) and custom profile fields data
        $user_data = $real_userdata;

        /* Start Action Hook */
        do_action('pp_before_registration', $form_id, $user_data);
        /* End Action Hook */

        // proceed to registration using wp_insert_user method which return the new user id
        $register_user = wp_insert_user($real_userdata);

        $new_user_notification = apply_filters('pp_new_user_notification', 'enable');

        if (is_int($register_user) && 'enable' == $new_user_notification) {
            wp_new_user_notification($register_user, null, 'admin');
        }

        // register custom profile field
        if ( ! is_wp_error($register_user)) {

            /* Start Action Hook */
            do_action('pp_after_registration', $form_id, $user_data, $register_user);
            /* End Action Hook */

            // get the "registration successful message" for the registration page
            $message_on_successful_registration = PROFILEPRESS_sql::get_db_success_registration($form_id);


            return ! empty($message_on_successful_registration) ? $message_on_successful_registration : '<div class="profilepress-reg-status">Registration successful</div>';

        } else {
            return '<div class="' . $reg_status_css_class . '">' . $register_user->get_error_message() . '</div>';
        }

    }
}