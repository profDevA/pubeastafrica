<div class="nsl-admin-content">
    <h1 class="title"><?php _e('Fix Oauth Redirect URIs', 'nextend-facebook-connect'); ?></h1>
    <?php
    /** @var NextendSocialProvider[] $wrongOauthProviders */
    $wrongOauthProviders = array();
    foreach (NextendSocialLogin::$enabledProviders AS $provider) {
        if (!$provider->checkOauthRedirectUrl()) {
            $wrongOauthProviders[] = $provider;
        }
    }

    if (count($wrongOauthProviders) === 0) {
        echo '<div class="updated"><p>' . __('Every Oauth Redirect URI seems fine', 'nextend-facebook-connect') . '</p></div>';

        foreach (NextendSocialLogin::$enabledProviders AS $provider) {
            $provider->getAdmin()
                     ->renderOauthChangedInstruction();
        }
    } else {
        ?>
        <p><?php printf(__('%s detected that your login url changed. You must update the Oauth redirect URIs in the related social applications.', 'nextend-facebook-connect'), '<b>Nextend Social Login</b>'); ?></p>

        <?php
        foreach ($wrongOauthProviders AS $provider) {
            $provider->getAdmin()
                     ->renderOauthChangedInstruction();
        }
        ?>


        <a href="<?php echo wp_nonce_url(NextendSocialLoginAdmin::getAdminUrl('update_oauth_redirect_url'), 'nextend-social-login_update_oauth_redirect_url'); ?>" class="button button-primary">
            <?php _e('Got it', 'nextend-facebook-connect'); ?>
        </a>

    <?php } ?>
</div>