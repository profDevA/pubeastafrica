<?php

class NextendSocialUserData {

    /** @var array */
    private $userData;

    /** @var NextendSocialUser */
    private $socialUser;

    /** @var NextendSocialProvider */
    private $provider;

    /** @var WP_Error */
    private $errors;

    private $isCustomRegisterFlow = false;

    /**
     * NextendSocialUserData constructor.
     *
     * @param $userData
     * @param $socialUser
     * @param $provider
     *
     * @throws NSLContinuePageRenderException
     */
    public function __construct($userData, $socialUser, $provider) {

        $this->userData   = $userData;
        $this->socialUser = $socialUser;
        $this->provider   = $provider;

        $askExtraData = apply_filters('nsl_registration_require_extra_input', false, $this->userData);

        if ($askExtraData) {
            $registerFlowPage = NextendSocialLogin::getRegisterFlowPage();
            if ($registerFlowPage !== false) {
                if (!is_page($registerFlowPage)) {
                    wp_redirect(add_query_arg(array(
                        'loginSocial' => $this->provider->getId()
                    ), get_permalink($registerFlowPage)));
                    exit;
                }
                $this->isCustomRegisterFlow = true;

            } else if (NextendSocialLogin::$WPLoginCurrentView == 'login' && get_option('users_can_register')) {
                wp_redirect(add_query_arg(array(
                    'loginSocial' => $this->provider->getId()
                ), NextendSocialLogin::getRegisterUrl()));
                exit;
            }

            $this->errors = new WP_Error();

            $this->userData = apply_filters('nsl_registration_validate_extra_input', $this->userData, $this->errors);

            /**
             * It is not a submit or there is an error
             */
            if (!$this->isPost() || $this->errors->get_error_code() != '') {
                $this->displayForm();
            }
        }

        $this->errors   = new WP_Error();
        $this->userData = apply_filters('nsl_registration_user_data', $this->userData, $this->provider, $this->errors);

        if ($this->errors->get_error_code() != '') {
            if ($this->errors->get_error_message() != '') {
                \NSL\Notices::addError($this->errors->get_error_message());
            }

            wp_redirect( site_url( 'wp-login.php' ) );
            exit();
        }
    }

    public function toArray() {
        return $this->userData;
    }

    public function isPost() {
        return isset($_POST['submit']);
    }

    /**
     * @throws NSLContinuePageRenderException
     */
    public function displayForm() {
        NextendSocialLogin::removeLoginFormAssets();

        if ($this->isCustomRegisterFlow) {
            add_shortcode('nextend_social_login_register_flow', array(
                $this,
                'customRegisterFlowShortcode'
            ));
            throw new NSLContinuePageRenderException('CUSTOM_REGISTER_FLOW');
        } else {

            if (!function_exists('login_header')) {

                if (NextendSocialLogin::$WPLoginCurrentView == 'register-bp') {

                    if (class_exists('NextendSocialLoginPRO', false)) {
                        remove_action('bp_before_account_details_fields', 'NextendSocialLoginPRO::bp_register_form');
                        remove_action('bp_before_register_page', 'NextendSocialLoginPRO::bp_register_form');
                        remove_action('bp_after_register_page', 'NextendSocialLoginPRO::bp_register_form');
                    }

                    add_action('bp_before_register_page', array(
                        $this,
                        'bp_before_register_page'
                    ));

                    add_action('bp_after_register_page', array(
                        $this,
                        'bp_after_register_page'
                    ));

                    throw new NSLContinuePageRenderException('BuddyPress');
                } else if (defined('THEME_MY_LOGIN_PATH')) {
                    add_shortcode('theme-my-login', array(
                        $this,
                        'render_registration_form_tml'
                    ));

                    throw new NSLContinuePageRenderException('THEME_MY_LOGIN');
                }

                require_once(dirname(__FILE__) . '/compat-wp-login.php');
            }

            login_header(__('Registration Form'), '<p class="message register">' . __('Register For This Site!') . '</p>', $this->errors);

            echo $this->render_registration_form();

            login_footer('user_login');
            exit;
        }
    }

    public function customRegisterFlowShortcode() {
        $errors = $this->errors;
        if (is_wp_error($errors)) {
            $html = array();
            if ($errors->get_error_messages()) {
                foreach ($errors->get_error_messages() as $error) {
                    $html[] = '<div class="error">' . $error . '</div>';
                }
            }
            if (!empty($html)) {
                echo '<style>.nsl-messages .error{background-color: #e2401c;border-left: .6180469716em solid rgba(0,0,0,.15);padding: 1em 1.618em;margin-bottom: 2.617924em;color:#fff;}</style>';
                echo '<div class="nsl-messages">' . implode('', $html) . '</div>';
            }
        }
        $this->errors = array();

        return $this->render_registration_form();
    }

    public function render_registration_form() {
        if ($this->isCustomRegisterFlow) {
            $postUrl = add_query_arg(array(
                'loginSocial' => $this->provider->getId()
            ), get_permalink(NextendSocialLogin::getRegisterFlowPage()));
        } else if (strpos(NextendSocialLogin::$WPLoginCurrentView, 'register') === 0) {
            $postUrl = add_query_arg(array(
                'loginSocial' => $this->provider->getId()
            ), NextendSocialLogin::getRegisterUrl());
        } else {
            $postUrl = add_query_arg('loginSocial', $this->provider->getId(), NextendSocialLogin::getLoginUrl('login_post'));
        }
        ob_start();
        ?>
        <form name="registerform" id="registerform" action="<?php echo esc_url($postUrl); ?>" method="post">
            <input type="hidden" name="submit" value="1"/>

            <?php do_action('nsl_registration_form_start', $this->userData); ?>

            <?php do_action('nsl_registration_form_end', $this->userData); ?>

            <br class="clear"/>
            <p class="submit"><input type="submit" name="wp-submit" id="wp-submit"
                                     class="button button-primary button-large" value="<?php esc_attr_e('Register'); ?>"/></p>
        </form>
        <?php
        return ob_get_clean();
    }

    public function render_registration_form_tml() {
        ob_start();
        ?>
        <div class="tml tml-register" id="theme-my-login">
            <?php
            $registerMessage = Theme_My_Login_Template::get_action_template_message('register');
            if (!empty($registerMessage)) {
                $before_message = '<p class="message">';
                $after_message  = '</p>';
                echo $before_message . $registerMessage . $after_message;
            }

            $wp_error = $this->errors;
            if (is_wp_error($wp_error)) {
                if ($wp_error->get_error_code()) {
                    $errors   = '';
                    $messages = '';
                    foreach ($wp_error->get_error_codes() as $code) {
                        $severity = $wp_error->get_error_data($code);
                        foreach ($wp_error->get_error_messages($code) as $error) {
                            if ('message' == $severity) {
                                $messages .= '    ' . $error . "<br />\n";
                            } else {
                                $errors .= '    ' . $error . "<br />\n";
                            }
                        }
                    }
                    if (!empty($errors)) {
                        echo '<p class="error">' . apply_filters('login_errors', $errors) . "</p>\n";
                    }
                    if (!empty($messages)) {
                        echo '<p class="message">' . apply_filters('login_messages', $messages) . "</p>\n";
                    }
                }
            }
            $this->errors = array();


            echo $this->render_registration_form();
            ?>
        </div>
        <?php
        return ob_get_clean();
    }

    public function bp_before_register_page() {
        ob_start();
    }

    public function bp_after_register_page() {
        ob_end_clean();

        $wp_error = $this->errors;
        if (is_wp_error($wp_error)) {
            if ($wp_error->get_error_code()) {
                $errors   = '';
                $messages = '';
                foreach ($wp_error->get_error_codes() as $code) {
                    $severity = $wp_error->get_error_data($code);
                    foreach ($wp_error->get_error_messages($code) as $error) {
                        if ('message' == $severity) {
                            $messages .= '    ' . $error . "<br />\n";
                        } else {
                            $errors .= '    ' . $error . "<br />\n";
                        }
                    }
                }
                $html = '';
                if (!empty($errors)) {
                    $html .= '<div class="error">' . apply_filters('login_errors', $errors) . "</div>\n";
                }
                if (!empty($messages)) {
                    $html .= '<div class="message">' . apply_filters('login_messages', $messages) . "</div>\n";
                }

                if (!empty($html)) {
                    ?>
                    <div id="signup_form" class="standard-form">
                        <div>
                            <?php echo $html; ?>
                        </div>
                    </div>
                    <?php
                }
            }
        }
        $this->errors = array();

        echo $this->render_registration_form();
    }
}