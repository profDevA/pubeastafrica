<?php

namespace NSL;

class GDPR {

    public function __construct() {
        add_action('admin_init', array(
            $this,
            'add_privacy_policy_content'
        ));

        add_filter('wp_privacy_personal_data_exporters', array(
            $this,
            'register_exporter'
        ), -1);

        /*
        add_filter('wp_privacy_personal_data_erasers', array(
            $this,
            'register_eraser'
        ));
        */
    }

    public function add_privacy_policy_content() {
        if (!function_exists('wp_add_privacy_policy_content')) {
            return;
        }

        $content = '';
        $content .= '<h2>' . __('What personal data we collect and why we collect it') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . sprintf(__('%1$s collects data when a visitor register, login or link the account with with any of the enabled social provider. It collects the following data: email address, name, social provider identifier and access token. Also it can collect profile picture and more fields with the Pro Addon\'s sync data feature.'), 'Nextend Social Login') . '</p>';

        $content .= '<h2>' . __('Who we share your data with') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . sprintf(__('%1$s stores the personal data on your site and does not share it with anyone except the access token which used for the authenticated communication with the social providers.'), 'Nextend Social Login') . '</p>';

        $content .= '<h2>' . __('Does the plugin share personal data with third parties') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . sprintf(__('%1$s use the access token what the social provider gave to communicate with the providers to verify account and securely access personal data.'), 'Nextend Social Login') . '</p>';

        $content .= '<h2>' . __('How long we retain your data') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . sprintf(__('%1$s removes the collected personal data when the user deleted from WordPress.'), 'Nextend Social Login') . '</p>';

        $content .= '<h2>' . __('Does the plugin use personal data collected by others?') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . sprintf(__('%1$s use the personal data collected by the social providers to create account on your site when the visitor authorize it.'), 'Nextend Social Login') . '</p>';

        $content .= '<h2>' . __('Does the plugin store things in the browser?') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . sprintf(__('Yes, %1$s must create a cookie for visitors who use the social login authorization flow. This cookie required for every provider to secure the communication and to redirect the user back to the last location.'), 'Nextend Social Login') . '</p>';

        $content .= '<h2>' . __('Does the plugin collect telemetry data, directly or indirectly?') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . __('No') . '</p>';

        $content .= '<h2>' . __('Does the plugin enqueue JavaScript, tracking pixels or embed iframes from a third party?') . '</h2>';
        $content .= '<p class="privacy-policy-tutorial">' . __('No') . '</p>';


        wp_add_privacy_policy_content('Nextend Social Login', wp_kses_post($content));
    }


    public function register_exporter($exporters) {
        $exporters['nextend-facebook-connect'] = array(
            'exporter_friendly_name' => 'Nextend Social Login',
            'callback'               => array(
                $this,
                'exporter'
            ),
        );

        return $exporters;
    }

    public function exporter($email_address, $page = 1) {
        $email_address = trim($email_address);

        $data_to_export = array();

        $user = get_user_by('email', $email_address);

        if (!$user) {
            return array(
                'data' => array(),
                'done' => true,
            );
        }

        $user_data_to_export = array();

        foreach (\NextendSocialLogin::$allowedProviders AS $provider) {
            $user_data_to_export = array_merge($user_data_to_export, $provider->exportPersonalData($user->ID));
        }


        if (!empty($user_data_to_export)) {
            $data_to_export[] = array(
                'group_id'    => 'user',
                'group_label' => __('User'),
                'item_id'     => "user-{$user->ID}",
                'data'        => $user_data_to_export,
            );
        }


        return array(
            'data' => $data_to_export,
            'done' => true,
        );
    }

    public function register_eraser($erasers) {
        $erasers['nextend-facebook-connect'] = array(
            'exporter_friendly_name' => 'Nextend Social Login',
            'callback'               => array(
                $this,
                'eraser'
            ),
        );

        return $erasers;
    }

    public function eraser($email_address, $page = 1) {
        return array(
            'items_removed'  => false,
            'items_retained' => false,
            'messages'       => array(),
            'done'           => true,
        );
    }
}


new GDPR();