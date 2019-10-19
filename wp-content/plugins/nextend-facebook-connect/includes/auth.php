<?php

abstract class NextendSocialAuth {

    protected $providerID;

    protected $access_token_data;

    public function __construct($providerID) {
        $this->providerID = $providerID;
    }

    public function checkError() {

    }

    /**
     * @param string $access_token_data
     */
    public function setAccessTokenData($access_token_data) {
        $this->access_token_data = json_decode($access_token_data, true);
    }

    public abstract function createAuthUrl();

    public abstract function authenticate();

    public abstract function get($path, $data = array(), $endpoint = false);

    /**
     * @return bool
     */
    public abstract function hasAuthenticateData();

    /**
     * @return string
     */
    public abstract function getTestUrl();
}