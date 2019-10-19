<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();
?>
<div class="nsl-admin-sub-content">

    <?php if (substr($provider->getLoginUrl(), 0, 8) !== 'https://'): ?>
        <div class="error">
            <p><?php printf(__('%1$s allows HTTPS OAuth Redirects only. You must move your site to HTTPS in order to allow login with %1$s.', 'nextend-facebook-connect'), 'Facebook'); ?></p>
            <p><a href="https://nextendweb.com/nextend-social-login-docs/facebook-api-changes/#enforce-https" target="_blank"><?php _e('How to get SSL for my WordPress site?', 'nextend-facebook-connect'); ?></a></p>
        </div>
    <?php else: ?>
        <h2 class="title"><?php _e('Getting Started', 'nextend-facebook-connect'); ?></h2>

        <p style="max-width:55em;"><?php printf(__('To allow your visitors to log in with their %1$s account, first you must create a %1$s App. The following guide will help you through the %1$s App creation process. After you have created your %1$s App, head over to "Settings" and configure the given "%2$s" and "%3$s" according to your %1$s App.', 'nextend-facebook-connect'), "Facebook", "App ID", "App secret"); ?></p>

        <h2 class="title"><?php printf(_x('Create %s', 'App creation', 'nextend-facebook-connect'), 'Facebook App'); ?></h2>

        <ol>
            <li><?php printf(__('Navigate to %s', 'nextend-facebook-connect'), '<a href="https://developers.facebook.com/apps/" target="_blank">https://developers.facebook.com/apps/</a>'); ?></li>
            <li><?php printf(__('Log in with your %s credentials if you are not logged in', 'nextend-facebook-connect'), 'Facebook'); ?></li>
            <li><?php _e('Click on the "Add a New App" button', 'nextend-facebook-connect'); ?></li>
            <li><?php printf(__('Fill "Display Name" and "Contact Email". The specified "Display Name" will appear on your %s!', 'nextend-facebook-connect'),'<a href="https://developers.facebook.com/docs/facebook-login/permissions/overview/" target="_blank">Consent Screen</a>'); ?></li>
            <li><?php _e('Click on blue "Create App ID" button', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('Select "Integrate Facebook Login" at the Select a Scenario page, then click Confirm.', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('Enter your domain name to the App Domains', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('Fill up the "Privacy Policy URL". Provide a publicly available and easily accessible privacy policy that explains what data you are collecting and how you will use that data.', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('Click on "Save Changes"', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('In the left sidebar under the Products section, click on "Facebook Login" and select Settings', 'nextend-facebook-connect'); ?></li>
            <li><?php printf(__('Add the following URL to the "Valid OAuth redirect URIs" field: <b>%s</b>', 'nextend-facebook-connect'), $provider->getLoginUrl()); ?></li>
            <li><?php _e('Click on "Save Changes"', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('In the top of the left sidebar, click on "Settings" and select "Basic"', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('Here you can see your "APP ID" and you can see your "App secret" if you click on the "Show" button. These will be needed in plugin\'s settings.', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('Your application is currently private ( Status: In Development ), which means that only you can log in with it. In the top bar click on the "OFF" switcher and select a category for your App.', 'nextend-facebook-connect'); ?></li>
            <li><?php _e('By clicking "Confirm", the Status of your App will go Live.', 'nextend-facebook-connect'); ?></li>
        </ol>

        <a href="<?php echo $this->getUrl('settings'); ?>"
           class="button button-primary"><?php printf(__('I am done setting up my %s', 'nextend-facebook-connect'), 'Facebook App'); ?></a>

        <br>
        <div class="nsl-admin-embed-youtube">
            <div></div>
            <iframe src="https://www.youtube.com/embed/7iiIe8RLIAM?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>
    <?php endif; ?>
</div>