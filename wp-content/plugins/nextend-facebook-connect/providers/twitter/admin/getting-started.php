<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();
?>

<div class="nsl-admin-sub-content">
    <h2 class="title"><?php _e('Getting Started', 'nextend-facebook-connect'); ?></h2>

    <p style="max-width:55em;"><?php printf(__('To allow your visitors to log in with their %1$s account, first you must create a %1$s App. The following guide will help you through the %1$s App creation process. After you have created your %1$s App, head over to "Settings" and configure the given "%2$s" and "%3$s" according to your %1$s App.', 'nextend-facebook-connect'), "Twitter", "Consumer Key", "Consumer Secret"); ?></p>

    <h2 class="title"><?php printf(_x('Create %s', 'App creation', 'nextend-facebook-connect'), 'Twitter App'); ?></h2>

    <ol>
        <li><?php printf(__('Navigate to %s', 'nextend-facebook-connect'), '<a href="https://developer.twitter.com/en/apps/create" target="_blank">https://developer.twitter.com/en/apps/create</a>'); ?></li>
        <li><?php printf(__('Log in with your %s credentials if you are not logged in yet', 'nextend-facebook-connect'), 'Twitter'); ?></li>
        <li><?php _e('If you don\'t have a developer account yet, please apply one by filling all the required details! This is required for the next steps!', 'nextend-facebook-connect'); ?></li>
        <li><?php printf(__('Once your developer account is complete, navigate back to %s if you aren\'t already there!', 'nextend-facebook-connect'), '<a href="https://developer.twitter.com/en/apps/create" target="_blank">https://developer.twitter.com/en/apps/create</a>'); ?>
        <li><?php printf(__('Fill the App name, Application description fields. Then enter your site\'s URL to the Website URL field: <b>%s</b>', 'nextend-facebook-connect'), site_url()); ?></li>
        <li><?php _e('Tick the checkbox next to Enable Sign in with Twitter!', 'nextend-facebook-connect'); ?></li>
        <li><?php printf(__('Add the following URL to the "Callback URLs" field: <b>%s</b>', 'nextend-facebook-connect'), $provider->getRedirectUriForApp()); ?></li>
        <li><?php _e('Fill the “Terms of Service URL", "Privacy policy URL" and "Tell us how this app will be used” fields!', 'nextend-facebook-connect'); ?></li>
        <li><?php _e('Click the Create button.', 'nextend-facebook-connect'); ?></li>
        <li><?php _e('Read the Developer Terms and click the Create button again!', 'nextend-facebook-connect'); ?></li>
        <li><?php _e('Select the Permissions tab and click Edit.', 'nextend-facebook-connect'); ?></li>
        <li><?php _e('Tick the Request email address from users under the Additional permissions section and click Save.', 'nextend-facebook-connect'); ?></li>
        <li><?php _e('Go to the Keys and tokens tab and find the API key and API secret key', 'nextend-facebook-connect'); ?></li>
    </ol>

    <a href="<?php echo $this->getUrl('settings'); ?>"
       class="button button-primary"><?php printf(__('I am done setting up my %s', 'nextend-facebook-connect'), 'Twitter App'); ?></a>

    <br>
    <div class="nsl-admin-embed-youtube">
        <div></div>
        <iframe src="https://www.youtube.com/embed/5m4kD11Ai2w?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
</div>