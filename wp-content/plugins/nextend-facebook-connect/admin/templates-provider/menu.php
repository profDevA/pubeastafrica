<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */
/** @var $view string */

$proBadge = '';
if (!NextendSocialLoginAdmin::isPro()) {
    $proBadge = '<span class="nsl-pro-badge">Pro</span>';
}
?>
<div class="nsl-admin-sub-nav-bar">
    <a href="<?php echo $this->getUrl(); ?>"
       class="nsl-admin-nav-tab<?php if ($view === 'getting-started'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Getting Started', 'nextend-facebook-connect'); ?></a>
    <a href="<?php echo $this->getUrl('settings'); ?>"
       class="nsl-admin-nav-tab<?php if ($view === 'settings'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Settings', 'nextend-facebook-connect'); ?></a>
    <a href="<?php echo $this->getUrl('buttons'); ?>"
       class="nsl-admin-nav-tab<?php if ($view === 'buttons'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Buttons', 'nextend-facebook-connect'); ?></a>

    <?php if ($this->provider->hasSyncFields()): ?>
        <a href="<?php echo $this->getUrl('sync-data'); ?>"
           class="nsl-admin-nav-tab<?php if ($view === 'sync-data'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Sync data', 'nextend-facebook-connect'); ?><?php echo $proBadge; ?></a>
    <?php endif; ?>
    <a href="<?php echo $this->getUrl('usage'); ?>"
       class="nsl-admin-nav-tab<?php if ($view === 'usage'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Usage', 'nextend-facebook-connect'); ?></a>
</div>