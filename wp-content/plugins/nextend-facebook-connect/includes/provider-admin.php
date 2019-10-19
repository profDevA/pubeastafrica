<?php

class NextendSocialProviderAdmin {

    /** @var string path to global /admin folder */
    public static $globalPath;

    /** @var NextendSocialProvider */
    protected $provider;

    /** @var string path to current providers /admin folder */
    protected $path;

    /**
     * NextendSocialProviderAdmin constructor.
     *
     * @param NextendSocialProvider $provider
     */
    public function __construct($provider) {
        $this->provider = $provider;

        $this->path = $this->provider->getPath() . '/admin';


        add_filter('nsl_update_settings_validate_' . $this->provider->getOptionKey(), array(
            $this,
            'validateSettings'
        ), 10, 2);
    }

    /**
     * @return NextendSocialProvider
     */
    public function getProvider() {
        return $this->provider;
    }

    /**
     * @param string $subview
     * Returns the admin URL for a subview.
     *
     * @return string
     */
    public function getUrl($subview = '') {
        return add_query_arg(array(
            'subview' => $subview
        ), NextendSocialLoginAdmin::getAdminUrl('provider-' . $this->provider->getId()));
    }

    /**
     * @param $newData
     * @param $postedData
     * Returns the validated settings for the buttons.
     *
     * @return mixed
     */
    public function validateSettings($newData, $postedData) {

        $newData = $this->provider->validateSettings($newData, $postedData);

        if (isset($postedData['custom_default_button'])) {
            if (isset($postedData['custom_default_button_enabled']) && $postedData['custom_default_button_enabled'] == '1') {
                $newData['custom_default_button'] = $postedData['custom_default_button'];
            } else {
                if ($postedData['custom_default_button'] != '') {
                    $newData['custom_default_button'] = '';
                }
            }
        }

        if (isset($postedData['custom_icon_button'])) {
            if (isset($postedData['custom_icon_button_enabled']) && $postedData['custom_icon_button_enabled'] == '1') {
                $newData['custom_icon_button'] = $postedData['custom_icon_button'];
            } else {
                if ($postedData['custom_icon_button'] != '') {
                    $newData['custom_icon_button'] = '';
                }
            }
        }

        if (isset($postedData['terms'])) {
            if (isset($postedData['terms_override']) && $postedData['terms_override'] == '1') {
                $newData['terms'] = $postedData['terms'];
            } else {
                $newData['terms'] = '';
            }
        }

        foreach ($postedData AS $key => $value) {

            switch ($key) {
                case 'login_label':
                case 'link_label':
                case 'unlink_label':
                    $newData[$key] = wp_kses_post($value);
                    break;
                case 'user_prefix':
                case 'user_fallback':
                    $newData[$key] = preg_replace("/[^A-Za-z0-9\-_ ]/", '', $value);
                    break;
                case 'settings_saved':
                    $newData[$key] = intval($value) ? 1 : 0;
                    break;
                case 'oauth_redirect_url':
                    $newData[$key] = $value;
                    break;
            }
        }

        return $newData;
    }

    /**
     * Displays a subview if it is set in the URL.
     */
    public function settingsForm() {
        $subview = !empty($_REQUEST['subview']) ? $_REQUEST['subview'] : '';
        $this->displaySubView($subview);
    }

    /**
     * @param $subview
     * Display the requested subview
     */
    protected function displaySubView($subview) {
        if (!$this->provider->adminDisplaySubView($subview)) {
            switch ($subview) {
                case 'settings':
                    $this->render('settings');
                    break;
                case 'buttons':
                    $this->render('buttons');
                    break;
                case 'sync-data':
                    if ($this->provider->hasSyncFields()) {
                        $this->render('sync-data');
                    } else {
                        wp_redirect($this->provider->getAdmin()
                                                   ->getUrl());
                        exit;
                    }
                    break;
                case 'usage':
                    $this->render('usage');
                    break;
                default:
                    $this->render('getting-started');
                    break;
            }
        }
    }

    /**
     * @param      $view
     * @param bool $showMenu
     * Enframe the specified part-view with the complete view(header, menu, footer).
     */
    public function render($view, $showMenu = true) {
        include(self::$globalPath . '/templates/header.php');
        $_view = $view;
        $view  = 'providers';
        include(self::$globalPath . '/templates/menu.php');
        $view = $_view;
        echo '<div class="nsl-admin-content">';
        echo '<h1>' . $this->provider->getLabel() . '</h1>';
        if ($showMenu) {
            include(self::$globalPath . '/templates-provider/menu.php');
        }

        \NSL\Notices::displayNotices();

        if ($view == 'buttons') {
            include(self::$globalPath . '/templates-provider/buttons.php');
        } else if ($view == 'usage') {
            include(self::$globalPath . '/templates-provider/usage.php');
        } else if ($view == 'sync-data') {
            include(self::$globalPath . '/templates-provider/sync-data.php');
        } else {
            include($this->path . '/' . $view . '.php');
        }
        echo '</div>';
        include(self::$globalPath . '/templates/footer.php');
    }

    /**
     * Display the Verify part of the settings subview.
     */
    public function renderSettingsHeader() {

        $provider = $this->provider;

        $state = $provider->getState();
        ?>
        <?php if ($state == 'not-tested') : ?>
            <div class="nsl-box nsl-box-blue">
                <h2 class="title"><?php _e('Your configuration needs to be verified', 'nextend-facebook-connect'); ?></h2>
                <p><?php _e('Before you can start letting your users register with your app it needs to be tested. This test makes sure that no users will have troubles with the login and registration process. <br> If you see error message in the popup check the copied ID and secret or the app itself. Otherwise your settings are fine.', 'nextend-facebook-connect'); ?></p>

                <p id="nsl-test-configuration">
                    <a id="nsl-test-button" href="#"
                       onclick="NSLPopupCenter('<?php echo add_query_arg('test', '1', $provider->getLoginUrl()); ?>', 'test-window', <?php echo $provider->getPopupWidth(); ?>, <?php echo $provider->getPopupHeight(); ?>); return false;"
                       class="button button-primary"><?php _e('Verify Settings', 'nextend-facebook-connect'); ?></a>
                    <span id="nsl-test-please-save"><?php _e('Please save your changes to verify settings.', 'nextend-facebook-connect'); ?></span>
                </p>
            </div>
        <?php endif; ?>


        <?php if ($provider->settings->get('tested') == '1') : ?>
            <div class="nsl-box <?php if ($state == 'enabled'): ?>nsl-box-green<?php else: ?> nsl-box-yellow nsl-box-exclamation-mark<?php endif; ?>">
                <h2 class="title"><?php _e('Works Fine', 'nextend-facebook-connect'); ?> -
                    <?php
                    switch ($state) {
                        case 'disabled':
                            _e('Disabled', 'nextend-facebook-connect');
                            break;
                        case 'enabled':
                            _e('Enabled', 'nextend-facebook-connect');
                            break;
                    }
                    ?></h2>
                <p><?php
                    switch ($state) {
                        case 'disabled':
                            printf(__('This provider is currently disabled, which means that users can’t register or login via their %s account.', 'nextend-facebook-connect'), $provider->getLabel());
                            break;
                        case 'enabled':
                            printf(__('This provider works fine, but you can test it again. If you don’t want to let users register or login with %s anymore you can disable it.', 'nextend-facebook-connect'), $provider->getLabel());
                            echo '</p>';
                            echo '<p>';
                            printf(__('This provider is currently enabled, which means that users can register or login via their %s account.', 'nextend-facebook-connect'), $provider->getLabel());
                            break;
                    }
                    ?></p>

                <p id="nsl-test-configuration">
                    <a id="nsl-test-button" href="#"
                       onclick="NSLPopupCenter('<?php echo add_query_arg('test', '1', $provider->getLoginUrl()); ?>', 'test-window', <?php echo $provider->getPopupWidth(); ?>, <?php echo $provider->getPopupHeight(); ?>); return false"
                       class="button button-secondary"><?php _e('Verify Settings Again', 'nextend-facebook-connect'); ?></a>
                    <span id="nsl-test-please-save"><?php _e('Please save your changes before verifying settings.', 'nextend-facebook-connect'); ?></span>
                    <?php
                    switch ($state) {
                        case 'disabled':
                            ?>
                            <a href="<?php echo wp_nonce_url(add_query_arg('provider', $provider->getId(), NextendSocialLoginAdmin::getAdminUrl('sub-enable')), 'nextend-social-login_enable_' . $provider->getId()); ?>"
                               class="button button-primary">
								<?php _e('Enable', 'nextend-facebook-connect'); ?>
                            </a>
                            <?php
                            break;
                        case 'enabled':
                            ?>
                            <a href="<?php echo wp_nonce_url(add_query_arg('provider', $provider->getId(), NextendSocialLoginAdmin::getAdminUrl('sub-disable')), 'nextend-social-login_disable_' . $provider->getId()); ?>"
                               class="button button-secondary">
								<?php _e('Disable', 'nextend-facebook-connect'); ?>
                            </a>
                            <?php
                            break;
                    }
                    ?>
                </p>
            </div>
        <?php endif; ?>


        <script type="text/javascript">

			jQuery(document).on('ready', function () {
                var $test = jQuery('#nsl-test-configuration');
                if ($test.length) {
                    jQuery(<?php echo wp_json_encode('#' . implode(',#', array_keys($provider->getRequiredFields()))); ?>)
                        .on('keyup.test', function () {
                            jQuery('#nsl-test-button').remove();
                            jQuery('#nsl-test-please-save').css('display', 'inline');
                            jQuery('input').off('keyup.test');
                        });
                }
            });
        </script>
        <?php
    }

    /**
     * Displays the free setting options.
     */
    public function renderOtherSettings() {
        include(self::$globalPath . '/templates-provider/settings-other.php');
    }

    /**
     * Displays the pro setting options.
     */
    public function renderProSettings() {
        include(self::$globalPath . '/templates-provider/settings-pro.php');
    }

    /**
     * Displays message if Oauth Redirect URI has changed.
     */
    public function renderOauthChangedInstruction() {
        echo '<h2>' . $this->provider->getLabel() . '</h2>';

        include($this->path . '/fix-redirect-uri.php');
    }
}

NextendSocialProviderAdmin::$globalPath = NSL_PATH . '/admin';