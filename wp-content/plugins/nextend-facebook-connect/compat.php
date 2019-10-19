<?php


class NextendSocialLoginCompatibility {

    public function __construct() {
        add_action('after_setup_theme', array(
            $this,
            'after_setup_theme'
        ), 11);
    }

    public function after_setup_theme() {
        global $pagenow;

        /** Compatibility fix for Socialize theme @SEE https://themeforest.net/item/socialize-multipurpose-buddypress-theme/12897637 */
        if (function_exists('ghostpool_login_redirect')) {
            if ('wp-login.php' === $pagenow && !empty($_GET['loginSocial'])) {
                /** If the action not removed, then the wp-login.php always redirected to {siteurl}/#login/ and it break social login */
                remove_action('init', 'ghostpool_login_redirect');
            }
        }
    }
}

new NextendSocialLoginCompatibility();
