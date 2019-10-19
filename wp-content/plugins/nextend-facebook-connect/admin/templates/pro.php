<?php

$state = NextendSocialLoginAdmin::getProState();

function nsl_get_pro_no_license() {
    ?>
    <div class="nsl-box nsl-box-yellow nsl-box-yellow-bg nsl-box-padlock">
        <h2 class="title"><?php _e('Get Pro Addon to unlock more features', 'nextend-facebook-connect'); ?></h2>
        <p><?php printf(__('The features below are available in %s Pro Addon. Get it today and tweak the awesome settings.', 'nextend-facebook-connect'), "Nextend Social Login"); ?></p>
        <p><?php _e('If you already have a license, you can Authorize your Pro Addon. Otherwise you can purchase it using the button below.', 'nextend-facebook-connect'); ?></p>
        <p>
            <a href="<?php echo NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/social-login/', 'buy-pro-addon-button'); ?>"
               target="_blank"
               class="button button-primary"><?php _e('Buy Pro Addon', 'nextend-facebook-connect'); ?></a>
            <a href="<?php echo NextendSocialLoginAdmin::getAdminUrl('pro-addon'); ?>"
               class="button button-secondary"><?php _e('Authorize Pro Addon', 'nextend-facebook-connect'); ?></a>
        </p>
    </div>
    <?php
}

function nsl_get_pro_installed() {
    ?>
    <div class="nsl-box nsl-box-blue">
        <h2 class="title"><?php _e('Pro Addon is not activated', 'nextend-facebook-connect'); ?></h2>
        <p><?php _e('To be able to use the Pro features, you need to install and activate the Nextend Social Connect Pro Addon.', 'nextend-facebook-connect'); ?></p>
        <p>
            <a href="<?php echo wp_nonce_url(add_query_arg(array(
                'action'        => 'activate',
                'plugin'        => urlencode('nextend-social-login-pro/nextend-social-login-pro.php'),
                'plugin_status' => 'all'
            ), admin_url('plugins.php')), 'activate-plugin_' . 'nextend-social-login-pro/nextend-social-login-pro.php'); ?>"
               target="_blank" onclick="setTimeout(function(){window.location.reload(true)}, 2000)"
               class="button button-primary"><?php _e('Activate Pro Addon', 'nextend-facebook-connect'); ?></a>
        </p>
    </div>
    <?php
}

function nsl_get_pro_not_installed() {
    ?>
    <div class="nsl-box nsl-box-blue">
        <h2 class="title"><?php _e('Pro Addon is not installed', 'nextend-facebook-connect'); ?></h2>
        <p><?php _e('To be able to use the Pro features, you need to install and activate the Nextend Social Connect Pro Addon.', 'nextend-facebook-connect'); ?></p>
        <p>
            <a href="<?php echo NextendSocialLoginAdmin::getAdminUrl('pro-addon'); ?>"
               class="button button-primary"><?php _e('Install Pro Addon', 'nextend-facebook-connect'); ?></a>
        </p>
    </div>
    <?php
}

switch ($state) {
    case 'no-capability':
        break;
    case 'not-installed':
        nsl_get_pro_not_installed();
        break;
    case 'installed':
        nsl_get_pro_installed();
        break;
    default:
        nsl_get_pro_no_license();
        break;
}