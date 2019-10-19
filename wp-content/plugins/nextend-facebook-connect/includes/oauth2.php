<?php

require_once NSL_PATH . '/includes/auth.php';


abstract class NextendSocialOauth2 extends NextendSocialAuth {

    const CSRF_LENGTH = 32;

    protected $state = false;

    protected $client_id;
    protected $client_secret;
    protected $redirect_uri;

    protected $endpointAuthorization;
    protected $endpointAccessToken;
    protected $endpointRestAPI;

    protected $defaultRestParams = array();

    protected $scopes = array();

    public function checkError() {
        if (isset($_GET['error']) && isset($_GET['error_description'])) {
            if ($this->validateState()) {
                throw new Exception($_GET['error'] . ': ' . htmlspecialchars_decode($_GET['error_description']));
            }
        }
    }

    public function getTestUrl() {
        return $this->endpointAccessToken;
    }

    public function hasAuthenticateData() {
        return isset($_REQUEST['code']);
    }

    /**
     * @param string $client_id
     */
    public function setClientId($client_id) {
        $this->client_id = $client_id;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret($client_secret) {
        $this->client_secret = $client_secret;
    }

    /**
     * @param string $redirect_uri
     */
    public function setRedirectUri($redirect_uri) {
        $this->redirect_uri = $redirect_uri;
    }

    public function getEndpointAuthorization() {
        return $this->endpointAuthorization;
    }

    /*
     * Adds response_type, client_id, redirect_uri and state as query parameter in the Authorization Url.
     * client_id can be found in the App when you create one
     * redirect_uri is the url you wish to be redirected after you entered you login credentials
     * state is a randomly generated string
     */
    public function createAuthUrl() {

        $args = array(
            'response_type' => 'code',
            'client_id'     => urlencode($this->client_id),
            'redirect_uri'  => urlencode($this->redirect_uri),
            'state'         => urlencode($this->getState())
        );

        $scopes = apply_filters('nsl_' . $this->providerID . '_scopes', $this->scopes);
        if (count($scopes)) {
            $args['scope'] = urlencode($this->formatScopes($scopes));
        }

        return add_query_arg($args, $this->getEndpointAuthorization());
    }

    /**
     * @param $scopes
     * Connects an array of scopes with whitespace.
     *
     * @return string
     */
    protected function formatScopes($scopes) {
        return implode(' ', array_unique($scopes));
    }

    /**
     * @return bool|false|string
     * If the code that was sent by the selected provider and the state is valid,
     * we can make a request for an accessToken with wp_remote_post().
     * The result contains HTTP headers and content.
     *
     * Returns the accessToken with which we can make certain requests for their user profile data.
     * @throws Exception
     */
    public function authenticate() {

        if (isset($_GET['code'])) {
            if (!$this->validateState()) {
                throw  new Exception('Unable to validate CSRF state');
            }

            $http_args = array(
                'timeout'    => 15,
                'user-agent' => 'WordPress',
                'body'       => array(
                    'grant_type'    => 'authorization_code',
                    'code'          => $_GET['code'],
                    'redirect_uri'  => $this->redirect_uri,
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->client_secret
                )
            );

            $request = wp_remote_post($this->endpointAccessToken, $this->extendAllHttpArgs($http_args));

            if (is_wp_error($request)) {

                throw new Exception($request->get_error_message());
            } else if (wp_remote_retrieve_response_code($request) !== 200) {

                $this->errorFromResponse(json_decode(wp_remote_retrieve_body($request), true));
            }

            $accessTokenData = json_decode(wp_remote_retrieve_body($request), true);

            if (!is_array($accessTokenData)) {
                throw new Exception(sprintf(__('Unexpected response: %s', 'nextend-facebook-connect'), wp_remote_retrieve_body($request)));
            }

            $accessTokenData['created'] = time();

            $this->access_token_data = $accessTokenData;

            return wp_json_encode($accessTokenData);
        }

        return false;
    }

    /**
     * @param $response
     *
     * @throws Exception
     */
    protected function errorFromResponse($response) {
        if (isset($response['error'])) {
            throw new Exception($response['error'] . ': ' . $response['error_description']);
        }
    }

    public function deleteLoginPersistentData() {
        \NSL\Persistent\Persistent::delete($this->providerID . '_state');
    }

    /**
     * If the stored state is the same as the state we have received from the remote Provider, it is valid.
     *
     * @return bool
     */
    protected function validateState() {
        $this->state = \NSL\Persistent\Persistent::get($this->providerID . '_state');
        if ($this->state === false) {
            return false;
        }

        if (empty($_GET['state'])) {
            return false;
        }

        if ($_GET['state'] == $this->state) {
            return true;
        }

        return false;
    }

    /**
     * Returns the stored state for the current provider.
     *
     * @return bool|mixed|null|string
     */
    protected function getState() {
        $this->state = \NSL\Persistent\Persistent::get($this->providerID . '_state');
        if ($this->state === null) {
            $this->state = $this->generateRandomState();

            \NSL\Persistent\Persistent::set($this->providerID . '_state', $this->state);
        }

        return $this->state;
    }

    /**
     * Generates a random string, which will be needed for the remote provider.
     * It will be stored for a time.
     *
     * @return bool|string
     */
    protected function generateRandomState() {

        if (function_exists('random_bytes')) {
            return $this->bytesToString(random_bytes(self::CSRF_LENGTH));
        }

        if (function_exists('mcrypt_create_iv')) {
            /** @noinspection PhpDeprecationInspection */
            $binaryString = mcrypt_create_iv(self::CSRF_LENGTH, MCRYPT_DEV_URANDOM);

            if ($binaryString !== false) {
                return $this->bytesToString($binaryString);
            }
        }

        if (function_exists('openssl_random_pseudo_bytes')) {
            $wasCryptographicallyStrong = false;

            $binaryString = openssl_random_pseudo_bytes(self::CSRF_LENGTH, $wasCryptographicallyStrong);

            if ($binaryString !== false && $wasCryptographicallyStrong === true) {
                return $this->bytesToString($binaryString);
            }
        }

        return $this->randomStr(self::CSRF_LENGTH);
    }

    private function bytesToString($binaryString) {
        return substr(bin2hex($binaryString), 0, self::CSRF_LENGTH);
    }

    private function randomStr($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $str = '';
        $max = strlen($keyspace) - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return $str;
    }

    /**
     * @param       $path
     * @param array $data
     * @param       $endpoint
     *
     * @return array
     * @throws Exception
     */
    public function get($path, $data = array(), $endpoint = false) {

        $http_args = array(
            'timeout'    => 15,
            'user-agent' => 'WordPress',
            'body'       => array_merge($this->defaultRestParams, $data)
        );
        if (!$endpoint) {
            $endpoint = $this->endpointRestAPI;
        }
        $request = wp_remote_get($endpoint . $path, $this->extendHttpArgs($this->extendAllHttpArgs($http_args)));

        if (is_wp_error($request)) {

            throw new Exception($request->get_error_message());
        } else if (wp_remote_retrieve_response_code($request) !== 200) {

            $this->errorFromResponse(json_decode(wp_remote_retrieve_body($request), true));
        }

        $result = json_decode(wp_remote_retrieve_body($request), true);

        if (!is_array($result)) {
            throw new Exception(sprintf(__('Unexpected response: %s', 'nextend-facebook-connect'), wp_remote_retrieve_body($request)));
        }

        return $result;
    }

    /**
     * @param $http_args
     * Puts additional data into the http header.
     * Used for getting access to the resources with a bearer token.
     *
     * @return mixed
     */
    protected function extendHttpArgs($http_args) {
        $http_args['headers'] = array(
            'Authorization' => 'Bearer ' . $this->access_token_data['access_token']
        );

        return $http_args;
    }

    protected function extendAllHttpArgs($http_args) {

        return $http_args;
    }
}