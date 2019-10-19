<?php

class NextendSocialProviderGoogle extends NextendSocialProvider {

    /** @var NextendSocialProviderGoogleClient */
    protected $client;

    protected $color = '#4285f4';

    protected $colorUniform = '#dc4e41';

    protected $svg = '<svg xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><path fill="#4285F4" fill-rule="nonzero" d="M20.64 12.2045c0-.6381-.0573-1.2518-.1636-1.8409H12v3.4814h4.8436c-.2086 1.125-.8427 2.0782-1.7959 2.7164v2.2581h2.9087c1.7018-1.5668 2.6836-3.874 2.6836-6.615z"/><path fill="#34A853" fill-rule="nonzero" d="M12 21c2.43 0 4.4673-.806 5.9564-2.1805l-2.9087-2.2581c-.8059.54-1.8368.859-3.0477.859-2.344 0-4.3282-1.5831-5.036-3.7104H3.9574v2.3318C5.4382 18.9832 8.4818 21 12 21z"/><path fill="#FBBC05" fill-rule="nonzero" d="M6.964 13.71c-.18-.54-.2822-1.1168-.2822-1.71s.1023-1.17.2823-1.71V7.9582H3.9573A8.9965 8.9965 0 0 0 3 12c0 1.4523.3477 2.8268.9573 4.0418L6.964 13.71z"/><path fill="#EA4335" fill-rule="nonzero" d="M12 6.5795c1.3214 0 2.5077.4541 3.4405 1.346l2.5813-2.5814C16.4632 3.8918 14.426 3 12 3 8.4818 3 5.4382 5.0168 3.9573 7.9582L6.964 10.29C7.6718 8.1627 9.6559 6.5795 12 6.5795z"/><path d="M3 3h18v18H3z"/></g></svg>';

    protected $svgUniform = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" fill-rule="evenodd" d="M11.988,14.28 L11.988,9.816 L23.22,9.816 C23.388,10.572 23.52,11.28 23.52,12.276 C23.52,19.128 18.924,24 12,24 C5.376,24 -9.47390314e-15,18.624 -9.47390314e-15,12 C-9.47390314e-15,5.376 5.376,0 12,0 C15.24,0 17.952,1.188 20.028,3.132 L16.62,6.444 C15.756,5.628 14.244,4.668 12,4.668 C8.028,4.668 4.788,7.968 4.788,12.012 C4.788,16.056 8.028,19.356 12,19.356 C16.596,19.356 18.288,16.176 18.6,14.292 L11.988,14.292 L11.988,14.28 Z"/></svg>';

    const requiredApi1 = 'Google People API';

    protected $sync_fields = array(
        'gender'        => array(
            'label' => 'Gender',
            'node'  => 'me',
        ),
        'link'          => array(
            'label' => 'Profile link',
            'node'  => 'me',
        ),
        'locale'        => array(
            'label' => 'Locale',
            'node'  => 'me',
        ),
        'biographies'   => array(
            'label'       => 'Biographies',
            'node'        => 'people',
            'description' => self::requiredApi1,
        ),
        'birthdays'     => array(
            'label'       => 'Birthdays',
            'node'        => 'people',
            'scope'       => 'https://www.googleapis.com/auth/user.birthday.read',
            'description' => self::requiredApi1,
        ),
        'occupations'   => array(
            'label'       => 'Occupations',
            'node'        => 'people',
            'description' => self::requiredApi1,
        ),
        'organizations' => array(
            'label'       => 'Organizations',
            'node'        => 'people',
            'description' => self::requiredApi1,
        ),
        'residences'    => array(
            'label'       => 'Residences',
            'node'        => 'people',
            'description' => self::requiredApi1,
        ),
        'taglines'      => array(
            'label'       => 'Taglines',
            'node'        => 'people',
            'description' => self::requiredApi1,
        ),
        'ageRanges'     => array(
            'label'       => 'Age ranges',
            'node'        => 'people',
            'description' => self::requiredApi1,
        ),
        'addresses'     => array(
            'label'       => 'Addresses',
            'node'        => 'people',
            'scope'       => 'https://www.googleapis.com/auth/user.addresses.read',
            'description' => self::requiredApi1,
        ),
        'phoneNumbers'  => array(
            'label'       => 'Phone Numbers',
            'node'        => 'people',
            'scope'       => 'https://www.googleapis.com/auth/user.phonenumbers.read',
            'description' => self::requiredApi1,
        )
    );

    public function __construct() {
        $this->id    = 'google';
        $this->label = 'Google';

        $this->path = dirname(__FILE__);

        $this->requiredFields = array(
            'client_id'     => 'Client ID',
            'client_secret' => 'Client Secret'
        );

        parent::__construct(array(
            'client_id'     => '',
            'client_secret' => '',
            'skin'          => 'uniform',
            'login_label'   => 'Continue with <b>Google</b>',
            'link_label'    => 'Link account with <b>Google</b>',
            'unlink_label'  => 'Unlink account from <b>Google</b>'
        ));
    }

    protected function forTranslation() {
        __('Continue with <b>Google</b>', 'nextend-facebook-connect');
        __('Link account with <b>Google</b>', 'nextend-facebook-connect');
        __('Unlink account from <b>Google</b>', 'nextend-facebook-connect');
    }

    public function getRawDefaultButton() {
        $skin = $this->settings->get('skin');
        switch ($skin) {
            case 'dark':
                $color = $this->color;
                $svg   = $this->svg;
                break;
            case 'light':
                $color = '#fff';
                $svg   = $this->svg;
                break;
            default:
                $color = $this->colorUniform;
                $svg   = $this->svgUniform;
        }

        return '<span class="nsl-button nsl-button-default nsl-button-' . $this->id . '" data-skin="' . $skin . '" style="background-color:' . $color . ';"><span class="nsl-button-svg-container">' . $svg . '</span><span class="nsl-button-label-container">{{label}}</span></span>';
    }

    public function getRawIconButton() {
        return '<span class="nsl-button nsl-button-icon nsl-button-' . $this->id . '" style="background-color:' . $this->colorUniform . ';"><span class="nsl-button-svg-container">' . $this->svgUniform . '</span></span>';
    }

    public function validateSettings($newData, $postedData) {
        $newData = parent::validateSettings($newData, $postedData);

        foreach ($postedData AS $key => $value) {

            switch ($key) {
                case 'tested':
                    if ($postedData[$key] == '1' && (!isset($newData['tested']) || $newData['tested'] != '0')) {
                        $newData['tested'] = 1;
                    } else {
                        $newData['tested'] = 0;
                    }
                    break;
                case 'skin':
                    $newData[$key] = trim(sanitize_text_field($value));
                    break;
                case 'client_id':
                case 'client_secret':
                    $newData[$key] = trim(sanitize_text_field($value));
                    if ($this->settings->get($key) !== $newData[$key]) {
                        $newData['tested'] = 0;
                    }

                    if (empty($newData[$key])) {
                        \NSL\Notices::addError(sprintf(__('The %1$s entered did not appear to be a valid. Please enter a valid %2$s.', 'nextend-facebook-connect'), $this->requiredFields[$key], $this->requiredFields[$key]));
                    }
                    break;
            }
        }

        return $newData;
    }

    public function getClient() {
        if ($this->client === null) {

            require_once dirname(__FILE__) . '/google-client.php';

            $this->client = new NextendSocialProviderGoogleClient($this->id);

            $this->client->setClientId($this->settings->get('client_id'));
            $this->client->setClientSecret($this->settings->get('client_secret'));
            $this->client->setRedirectUri($this->getRedirectUri());
            $this->client->setPrompt('select_account');
        }

        return $this->client;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function getCurrentUserInfo() {
        $fields          = array(
            'id',
            'name',
            'email',
            'family_name',
            'given_name',
            'picture',
        );
        $extra_me_fields = apply_filters('nsl_google_sync_node_fields', array(), 'me');

        return $this->getClient()
                    ->get('userinfo?fields=' . implode(',', array_merge($fields, $extra_me_fields)));
    }

    public function getMe() {
        return $this->authUserData;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getMyPeople() {
        $extra_people_fields = apply_filters('nsl_google_sync_node_fields', array(), 'people');

        if (!empty($extra_people_fields)) {
            return $this->getClient()
                        ->get('people/me?personFields=' . implode(',', $extra_people_fields), array(), 'https://people.googleapis.com/v1/');
        }

        return $extra_people_fields;
    }

    /**
     * @param $key
     *
     * @return string
     */
    public function getAuthUserData($key) {

        switch ($key) {
            case 'id':
                return $this->authUserData['id'];
            case 'email':
                return $this->authUserData['email'];
            case 'name':
                return $this->authUserData['name'];
            case 'first_name':
                return $this->authUserData['given_name'];
            case 'last_name':
                return $this->authUserData['family_name'];
            case 'picture':
                return $this->authUserData['picture'];
        }

        return parent::getAuthUserData($key);
    }

    public function syncProfile($user_id, $provider, $access_token) {
        if ($this->needUpdateAvatar($user_id)) {
            $this->updateAvatar($user_id, $this->getAuthUserData('picture'));
        }

        $this->storeAccessToken($user_id, $access_token);
    }

    public function deleteLoginPersistentData() {
        parent::deleteLoginPersistentData();

        if ($this->client !== null) {
            $this->client->deleteLoginPersistentData();
        }
    }

    public function getAvatar($user_id) {

        if (!$this->isUserConnected($user_id)) {
            return false;
        }

        $picture = $this->getUserData($user_id, 'profile_picture');
        if (!$picture || $picture == '') {
            return false;
        }

        return $picture;
    }

    public function getSyncDataFieldDescription($fieldName) {
        if (isset($this->sync_fields[$fieldName]['description'])) {
            return sprintf(__('Required API: %1$s', 'nextend-facebook-connect'), $this->sync_fields[$fieldName]['description']);
        }

        return parent::getSyncDataFieldDescription($fieldName);
    }
}

NextendSocialLogin::addProvider(new NextendSocialProviderGoogle);