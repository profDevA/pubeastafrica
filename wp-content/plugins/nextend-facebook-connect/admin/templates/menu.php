<?php
/** @var $view string */
?>
<div class="nsl-admin-nav-bar">
    <a href="<?php echo NextendSocialLoginAdmin::getAdminUrl(); ?>"
       class="nsl-admin-nav-tab<?php if ($view === 'providers'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Providers', 'nextend-facebook-connect'); ?></a>
    <a href="<?php echo NextendSocialLoginAdmin::getAdminUrl('global-settings'); ?>"
       class="nsl-admin-nav-tab<?php if ($view === 'global-settings'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Global Settings', 'nextend-facebook-connect'); ?></a>

    <?php if ($view === 'pro-addon' || NextendSocialLogin::hasLicense() || defined('NSL_PRO_PATH')): ?>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminUrl('pro-addon'); ?>"
           class="nsl-admin-nav-tab<?php if ($view === 'pro-addon'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Pro Addon', 'nextend-facebook-connect'); ?></a>
    <?php endif; ?>
</div>