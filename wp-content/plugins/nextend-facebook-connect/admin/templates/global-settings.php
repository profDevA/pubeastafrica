<?php
defined('ABSPATH') || die();

/** @var $view string */

$allowedSubviews = array(
    'general',
    'privacy',
    'login-form',
    'woocommerce',
    'comment',
    'buddypress',
    'memberpress',
    'userpro',
    'ultimate-member'
);

$subview = (!empty($_GET['subview']) && in_array($_GET['subview'], $allowedSubviews)) ? $_GET['subview'] : 'general';

$settings = NextendSocialLogin::$settings;

$proBadge = '';
if (!NextendSocialLoginAdmin::isPro()) {
    $proBadge = '<span class="nsl-pro-badge">Pro</span>';
}
?>
<div class="nsl-admin-content">
    <h1><?php _e('Global Settings', 'nextend-facebook-connect'); ?></h1>
    <div class="nsl-admin-sub-nav-bar">
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('general'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'general'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('General', 'nextend-facebook-connect'); ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('privacy'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'privacy'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Privacy', 'nextend-facebook-connect'); ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('login-form'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'login-form'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Login Form', 'nextend-facebook-connect'); ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('woocommerce'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'woocommerce'): ?> nsl-admin-nav-tab-active<?php endif; ?>">WooCommerce<?php echo $proBadge; ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('comment'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'comment'): ?> nsl-admin-nav-tab-active<?php endif; ?>"><?php _e('Comment', 'nextend-facebook-connect'); ?><?php echo $proBadge; ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('buddypress'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'buddypress'): ?> nsl-admin-nav-tab-active<?php endif; ?>">BuddyPress<?php echo $proBadge; ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('memberpress'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'memberpress'): ?> nsl-admin-nav-tab-active<?php endif; ?>">MemberPress<?php echo $proBadge; ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('userpro'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'userpro'): ?> nsl-admin-nav-tab-active<?php endif; ?>">UserPro<?php echo $proBadge; ?></a>
        <a href="<?php echo NextendSocialLoginAdmin::getAdminSettingsUrl('ultimate-member'); ?>"
           class="nsl-admin-nav-tab<?php if ($subview === 'ultimate-member'): ?> nsl-admin-nav-tab-active<?php endif; ?>">Ultimate Member<?php echo $proBadge; ?></a>
    </div>
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" novalidate="novalidate">

        <?php wp_nonce_field('nextend-social-login'); ?>
        <input type="hidden" name="action" value="nextend-social-login"/>
        <input type="hidden" name="view" value="<?php echo esc_attr($view); ?>"/>
        <input type="hidden" name="subview" value="<?php echo esc_attr($subview); ?>"/>
        <input type="hidden" name="settings_saved" value="1"/>
        <?php
        include(dirname(__FILE__) . '/settings/' . $subview . '.php');
        ?>
    </form>
</div>