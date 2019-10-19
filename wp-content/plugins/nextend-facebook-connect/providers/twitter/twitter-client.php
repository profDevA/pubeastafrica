<?php
require_once NSL_PATH . '/includes/auth.php';

class NextendSocialProviderTwitterClient extends NextendSocialAuth {

    const VERSION = '1.0';

    const SIGNATURE_METHOD = 'HMAC-SHA1';

    private $endpoint = 'https://api.twitter.com/';

    protected $consumer_key = '';

    protected $consumer_secret = '';

    protected $redirect_uri = '';

    public function __construct($providerID, $consumer_key, $consumer_secret) {
        parent::__construct($providerID);

        $this->consumer_key    = $consumer_key;
        $this->consumer_secret = $consumer_secret;
    }

    public function getTestUrl() {
        return $this->endpoint;
    }

    /**
     * @param string $redirect_uri
     */
    public function setRedirectUri($redirect_uri) {
        $this->redirect_uri = $redirect_uri;
    }


    public function deleteLoginPersistentData() {
        \NSL\Persistent\Persistent::delete($this->providerID . '_request_token');
    }

    /**
     * @return string
     * @throws Exception
     */
    public function createAuthUrl() {

        $response = $this->oauthRequest($this->endpoint . 'oauth/request_token', 'POST', array(), array(
            'oauth_callback' => $this->redirect_uri
        ));

        $oauthTokenData = $this->extract_params($response);

        \NSL\Persistent\Persistent::set($this->providerID . '_request_token', maybe_serialize($oauthTokenData));

        return $this->endpoint . 'oauth/authenticate?oauth_token=' . $oauthTokenData['oauth_token'] /*. '&force_login=1'*/
            ;
    }

    /**
     * @throws Exception
     */
    public function checkError() {
        if (isset($_GET['denied'])) {
            throw new Exception('Authentication cancelled');
        }
    }

    public function hasAuthenticateData() {
        return isset($_REQUEST['oauth_token']) && isset($_REQUEST['oauth_verifier']);
    }

    /**
     * @return false|string
     * @throws Exception
     */
    public function authenticate() {
        $requestToken = maybe_unserialize(\NSL\Persistent\Persistent::get($this->providerID . '_request_token'));

        $response = $this->oauthRequest($this->endpoint . 'oauth/access_token', 'POST', array(), array(
            'oauth_verifier' => $_GET['oauth_verifier']
        ), array(
            'token'  => $requestToken['oauth_token'],
            'secret' => $requestToken['oauth_token_secret']
        ));

        $accessTokenData = $this->extract_params($response);

        $access_token_data = wp_json_encode(array(
            'oauth_token'        => $accessTokenData['oauth_token'],
            'oauth_token_secret' => $accessTokenData['oauth_token_secret'],
            'user_id'            => $accessTokenData['user_id'],
            'screen_name'        => $accessTokenData['screen_name']
        ));

        $this->setAccessTokenData($access_token_data);

        return $access_token_data;
    }

    /**
     * @param       $path
     * @param array $data
     *
     * @return array|mixed|object
     * @throws Exception
     */
    public function get($path, $data = array(), $endpoint = false) {

        if (!$endpoint) {
            $endpoint = $this->endpoint;
        }

        $response = $this->oauthRequest($endpoint . '1.1/' . $path . '.json', 'GET', $data + array(
                'user_id' => $this->access_token_data['user_id']
            ), array(), array(
            'token'  => $this->access_token_data['oauth_token'],
            'secret' => $this->access_token_data['oauth_token_secret']
        ));

        return json_decode($response, true);
    }

    /**
     * @param        $url
     * @param        $method
     * @param  array $_requestData
     * @param  array $_oauthData
     * @param array  $context
     *
     * @return string
     * @throws Exception
     */
    private function oauthRequest($url, $method, $_requestData = array(), $_oauthData = array(), $context = array()) {

        $method = strtoupper($method);

        uksort($_requestData, 'strcmp');

        $headers = array();

        $headers['Authorization'] = $this->getAuthorizationHeader($url, $method, $_requestData, $_oauthData, $context);

        $http_args = array(
            'timeout'    => 15,
            'user-agent' => 'WordPress',
            'headers'    => $headers,
            'body'       => $_requestData
        );

        if ($method == 'POST') {
            $request = wp_remote_post($url, $http_args);
        } else {
            $request = wp_remote_get($url, $http_args);
        }

        if (is_wp_error($request)) {

            throw new Exception($request->get_error_message());
        } else if (wp_remote_retrieve_response_code($request) !== 200) {

            $this->errorFromResponse(json_decode(wp_remote_retrieve_body($request), true));

            throw new Exception(sprintf(__('Unexpected response: %s', 'nextend-facebook-connect'), wp_remote_retrieve_body($request)));
        }

        return wp_remote_retrieve_body($request);
    }

    private function getAuthorizationHeader($url, $method, $_requestData = array(), $_oauthData = array(), $context = array()) {

        $oauthParams = $this->getOauth1Params($context);

        foreach ($_oauthData as $k => $v) {
            $oauthParams[$this->safe_encode($k)] = $this->safe_encode($v);
        }

        $params = array_merge($oauthParams, $_requestData);

        unset($params['oauth_signature']);

        uksort($params, 'strcmp');

        $prepared_pairs_with_oauth = array();
        foreach ($params as $k => $v) {
            $prepared_pairs_with_oauth[] = "{$k}={$v}";
        }

        $paramsForSignature = implode('&', $this->safe_encode(array(
            $method,
            $url,
            implode('&', $prepared_pairs_with_oauth)
        )));

        $left        = $this->safe_encode($this->consumer_secret);
        $right       = $this->safe_encode($this->secret($context));
        $signing_key = $left . '&' . $right;

        $oauthParams['oauth_signature'] = $this->safe_encode(base64_encode(hash_hmac('sha1', $paramsForSignature, $signing_key, true)));

        uksort($oauthParams, 'strcmp');

        $encoded_quoted_pairs = array();
        foreach ($oauthParams as $k => $v) {
            $encoded_quoted_pairs[] = "{$k}=\"{$v}\"";
        }

        return 'OAuth ' . implode(', ', $encoded_quoted_pairs);
    }

    /**
     * @param $response
     *
     * @throws Exception
     */
    private function errorFromResponse($response) {
        if (isset($response['errors']) && is_array($response['errors'])) {
            throw new Exception($response['errors'][0]['message']);
        }
    }

    private function safe_encode($data) {
        if (is_array($data)) {
            return array_map(array(
                $this,
                'safe_encode'
            ), $data);
        } else if (is_scalar($data)) {
            return str_ireplace(array(
                '+',
                '%7E'
            ), array(
                ' ',
                '~'
            ), rawurlencode($data));
        } else {
            return '';
        }
    }

    private function safe_decode($data) {
        if (is_array($data)) {
            return array_map(array(
                $this,
                'safe_decode'
            ), $data);
        } else if (is_scalar($data)) {
            return rawurldecode($data);
        } else {
            return '';
        }
    }

    private function extract_params($body) {
        $kvs     = explode('&', $body);
        $decoded = array();
        foreach ($kvs as $kv) {
            $kv              = explode('=', $kv, 2);
            $kv[0]           = $this->safe_decode($kv[0]);
            $kv[1]           = $this->safe_decode($kv[1]);
            $decoded[$kv[0]] = $kv[1];
        }

        return $decoded;
    }

    private function nonce($length = 12, $include_time = true) {
        $prefix = $include_time ? microtime() : '';

        return md5(substr($prefix . uniqid(), 0, $length));
    }

    private function timestamp() {
        $time = time();

        return (string)$time;
    }

    private function getOauth1Params($data) {

        $defaults = array(
            'oauth_nonce'            => $this->nonce(),
            'oauth_timestamp'        => $this->timestamp(),
            'oauth_version'          => self::VERSION,
            'oauth_consumer_key'     => $this->consumer_key,
            'oauth_signature_method' => self::SIGNATURE_METHOD,
        );

        // include the user token if it exists

        if ($oauth_token = $this->token($data)) {
            $defaults['oauth_token'] = $oauth_token;
        }

        $encoded = array();
        foreach ($defaults as $k => $v) {
            $encoded[$this->safe_encode($k)] = $this->safe_encode($v);
        }

        return $encoded;
    }

    private function token($context) {
        if (isset($context['token']) && !empty($context['token'])) {
            return $context['token'];
        } else if (isset($context['user_token'])) {
            return $context['user_token'];
        }

        return '';
    }

    private function secret($context) {

        if (isset($context['secret']) && !empty($context['secret'])) {
            return $context['secret'];
        } else if (isset($context['user_secret'])) {
            return $context['user_secret'];
        }

        return '';
    }

}