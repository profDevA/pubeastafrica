<?php
require_once NSL_PATH . '/includes/oauth2.php';

class NextendSocialProviderGoogleClient extends NextendSocialOauth2 {

    protected $access_token_data = array(
        'access_token' => '',
        'expires_in'   => -1,
        'created'      => -1
    );

    private $accessType = 'offline';
    private $prompt = 'select_account';

    protected $scopes = array(
        'email',
        'profile'
    );

    protected $endpointAuthorization = 'https://accounts.google.com/o/oauth2/auth';

    protected $endpointAccessToken = 'https://accounts.google.com/o/oauth2/token';

    protected $endpointRestAPI = 'https://www.googleapis.com/oauth2/v1/';

    protected $defaultRestParams = array(
        'alt' => 'json'
    );

    /**
     * @param string $access_token_data
     */
    public function setAccessTokenData($access_token_data) {
        $this->access_token_data = json_decode($access_token_data, true);
    }


    public function createAuthUrl() {
        return add_query_arg(array(
            'access_type'     => urlencode($this->accessType),
            'prompt' => urlencode($this->prompt)
        ), parent::createAuthUrl());
    }

    /**
     * @param string $prompt
     */
    public function setPrompt($prompt) {
        $this->prompt = $prompt;
    }

    /**
     * @param $response
     *
     * @throws Exception
     */
    protected function errorFromResponse($response) {
        if (isset($response['error']['message'])) {
            throw new Exception($response['error']['message']);
        }
    }

}