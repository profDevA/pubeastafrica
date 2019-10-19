<?php
require_once CLASSES . '/class.password-reset.php';

require_once VIEWS . '/password-reset-builder/password-reset-builder-settings-page.php';

require_once VIEWS . '/password-reset-builder/password-reset-builder-shortcode-parser.php';


class PP_Parent_Password_Reset_Shortcode_Parser extends ProfilePress_Password_Reset
{
    /** Constructor */
    public function __construct()
    {
        add_shortcode('profilepress-password-reset', array($this, 'profilepress_password_reset_parser'));
    }

    /**
     * Parse the password reset shortcode
     *
     * @param $atts
     *
     * @return string
     */
    public function profilepress_password_reset_parser($atts)
    {
        // get password reset builder id
        $id = absint($atts['id']);

        // do password reset handler function.
        ProfilePress_Password_Reset::do_password_reset();

        $password_reset_status = ProfilePress_Password_Reset::validate_password_reset_form($id);
        $password_reset_status .= ProfilePress_Password_Reset::do_password_reset_status();
        $password_reset_status = apply_filters('pp_password_reset_notice', $password_reset_status);

        $attribution_start = '<!-- This Password reset form is built and powered by ProfilePress WordPress plugin - https://profilepress.net -->' . "\r\n";
        $attribution_end = "\r\n" . '<!-- / ProfilePress WordPress plugin. -->' . "\r\n";

        $password_reset_css = self::get_password_reset_css($id);

        // call the password reset structure/design
        return apply_filters('pp_password_reset_form', $attribution_start . $password_reset_css . $password_reset_status . $this->get_password_reset_structure($id) . $attribution_end, $id);

    }


    /**
     * Get the password reset structure from the database
     *
     * @param int $id
     *
     * @return string
     */
    function get_password_reset_structure($id)
    {
        if ('GET' == $_SERVER['REQUEST_METHOD'] && isset($_REQUEST['key']) && isset($_REQUEST['login'])) {
            $structure = $this->get_password_reset_handler_structure($id);
        } else {
            $structure = PROFILEPRESS_sql::get_a_builder_structure('password_reset', $id);
        }

        $form_tag = '<form method="post">';

        return $form_tag . do_shortcode($structure) . '</form>';
    }


    /**
     * Return password reset handler form or redirect to password reset page when key is invalid.
     *
     * @param int $id
     *
     * @return null|string
     */
    public function get_password_reset_handler_structure($id)
    {

        // Verify key / login combo
        $user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
        if (!$user || is_wp_error($user)) {
            if ($user && $user->get_error_code() === 'expired_key') {
                wp_redirect(pp_password_reset_url() . '?error=expiredkey');
            } else {
                wp_redirect(pp_password_reset_url() . '?error=invalidkey');
            }
            exit;
        } else {
            $handler_structure = PROFILEPRESS_sql::get_password_reset_handler_structure($id);
            $handler_structure .= '<input type="hidden" name="reset_key" value="' . esc_attr($_REQUEST['key']) . '">';
            $handler_structure .= '<input type="hidden" name="reset_login" value="' . esc_attr($_REQUEST['login']) . '">';
        }

        return $handler_structure;
    }


    /**
     * Get the CSS stylesheet for the ID password reset
     *
     * @return mixed
     */
    public static function get_password_reset_css($password_reset_builder_id)
    {
        // if no id is set return
        if (!isset($password_reset_builder_id)) {
            return;
        }

        $password_reset_css = PROFILEPRESS_sql::get_a_builder_css('password_reset', $password_reset_builder_id);

        return "<style type=\"text/css\">\r\n $password_reset_css \r\n</style>";
    }


    /** Singleton poop */
    public static function get_instance()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self;
        }

        return $instance;
    }

}


PP_Parent_Password_Reset_Shortcode_Parser::get_instance();