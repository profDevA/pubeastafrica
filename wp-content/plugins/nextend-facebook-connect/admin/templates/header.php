<?php
defined('ABSPATH') || die();
?>
<div id="nsl-admin">
    <div class="nsl-admin-header">
        <h1>
            <a href="<?php echo NextendSocialLoginAdmin::getAdminUrl(); ?>">
                <img src="<?php echo plugins_url('images/nsl-logo.png', NSL_ADMIN_PATH) ?>" width="64" height="64"
                     alt="Nextend Social Login"/>
                Nextend Social Login</a>
        </h1>

        <a href="<?php echo NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/nextend-social-login-docs/documentation/', 'header-menu-docs'); ?>"
           class="nsl-admin-header-nav" target="_blank"><?php _e('Docs', 'nextend-facebook-connect'); ?></a>

        <a href="<?php echo NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/contact-us/nextend-social-login-support/', 'header-menu-support'); ?>"
           class="nsl-admin-header-nav" target="_blank"><?php _e('Support', 'nextend-facebook-connect'); ?></a>

        <a href="<?php echo NextendSocialLoginAdmin::getAdminUrl('debug'); ?>"
           class="nsl-admin-header-nav"><?php _e('Debug', 'nextend-facebook-connect'); ?></a>

        <a href="<?php echo NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/social-login/', 'header-menu-pro-addon'); ?>"
           class="nsl-admin-header-nav" target="_blank"><?php _e('Pro Addon', 'nextend-facebook-connect'); ?></a>
    </div>