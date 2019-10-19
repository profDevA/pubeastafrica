<?php

class NextendSocialUpgrader {

    public static function init() {

        add_filter('plugins_api', 'NextendSocialUpgrader::plugins_api', 20, 3); // WooCommerce use priority 20, so better to follow

        add_filter('upgrader_pre_download', 'NextendSocialUpgrader::upgrader_pre_download', 10, 3);

        add_filter('pre_set_site_transient_update_plugins', 'NextendSocialUpgrader::injectUpdate');

    }

    public static function plugins_api($res, $action, $args) {
        if ($action === 'plugin_information' && $args->slug === 'nextend-social-login-pro') {
            try {
                $res = (object)NextendSocialLoginAdmin::apiCall($action, (array)$args);
            } catch (Exception $e) {
                $res = new WP_Error('error', $e->getMessage());
            }
        }

        return $res;
    }

    public static function upgrader_pre_download($reply, $package, $upgrader) {
        $needle = NextendSocialLoginAdmin::getEndpoint();
        if (substr($package, 0, strlen($needle)) == $needle) {
            add_filter('http_response', 'NextendSocialUpgrader::http_response', 10, 3);
        }

        return $reply;
    }

    public static function http_response($response, $r, $url) {

        $needle = NextendSocialLoginAdmin::getEndpoint();
        if (substr($url, 0, strlen($needle)) == $needle && 200 != wp_remote_retrieve_response_code($response) || is_wp_error($response)) {

            if (isset($response['filename']) && file_exists($response['filename'])) {

                $body = @json_decode(@file_get_contents($response['filename']), true);

                if (is_array($body) && isset($body['message'])) {
                    $message = 'Nextend Social Login Pro Addon: ' . $body['message'];

                    if (isset($body['code']) && $body['code'] == 'license_invalid' && NextendSocialLogin::hasLicense()) {
                        NextendSocialLogin::$settings->update(array(
                            'license_key' => ''
                        ));
                        $message.=' - the stored license key has been removed!';
                    }

                    \NSL\Notices::addError($message);

                    return new WP_Error('error', $message);
                }
            }
        }

        return $response;
    }

    public static function injectUpdate($transient) {

        if (!class_exists('NextendSocialLoginPRO', false)) {
            return $transient;
        }

        $filename = "nextend-social-login-pro/nextend-social-login-pro.php";

        if (!isset($transient->response[$filename])) {
            try {
                $item = (object)NextendSocialLoginAdmin::apiCall('plugin_information', array('slug' => 'nextend-social-login-pro'));
            } catch (Exception $e) {
                $item = new WP_Error('error', $e->getMessage());
            }

            if (!is_wp_error($item)) {
                $item->plugin = 'nextend-social-login-pro/nextend-social-login-pro.php';
                if (version_compare(NextendSocialLoginPRO::$version, $item->new_version, '<')) {
                    $transient->response[$filename] = (object)$item;
                    unset($transient->no_update[$filename]);
                } else {
                    $transient->no_update[$filename] = (object)$item;
                    unset($transient->response[$filename]);
                }

            }
        }

        return $transient;
    }
}