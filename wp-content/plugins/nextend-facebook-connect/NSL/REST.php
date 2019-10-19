<?php

namespace NSL;

class REST {

    public function __construct() {
        \add_action('rest_api_init', array(
            $this,
            'rest_api_init'
        ));
    }

    public function rest_api_init() {
        \register_rest_route('nextend-social-login/v1', '/(?P<provider>\w[\w\s\-]*)/get_user', array(
            'args' => array(
                'provider'     => array(
                    'required'          => true,
                    'validate_callback' => array(
                        $this,
                        'validate_provider'
                    )
                ),
                'access_token' => array(
                    'required' => true,
                ),
            ),
            array(
                'methods'  => 'POST',
                'callback' => array(
                    $this,
                    'get_user'
                )
            ),
        ));

    }

    public function validate_provider($providerID) {
        return \NextendSocialLogin::isProviderEnabled($providerID);
    }

    /**
     * @param \WP_REST_Request $request Full details about the request.
     *
     * @return \WP_Error|\WP_REST_Response
     */
    public function get_user($request) {

        $provider = \NextendSocialLogin::$enabledProviders[$request['provider']];
        try {
            $user = $provider->findUserByAccessToken($request['access_token']);
        } catch (\Exception $e) {
            return new \WP_Error('error', $e->getMessage());
        }

        return $user;
    }
}

new REST();

