<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();
?>
<div class="nsl-admin-sub-content">

    <h4><?php _e('Shortcode', 'nextend-facebook-connect'); ?></h4>

    <p>
        <b><?php _e('Important!', 'nextend-facebook-connect'); ?></b>
        &nbsp;<?php _e('The shortcodes are only rendered for users who haven\'t logged in yet!', 'nextend-facebook-connect'); ?>
        &nbsp;<a href="https://nextendweb.com/nextend-social-login-docs/theme-developer/#shortcode"><?php _e('See the full list of shortcode parameters.','nextend-facebook-connect'); ?></a>
    </p>

    <?php
    $shortcodes = array(
        '[nextend_social_login]',
        '[nextend_social_login provider="' . $provider->getId() . '"]',
        '[nextend_social_login provider="' . $provider->getId() . '" style="icon"]',
        '[nextend_social_login provider="' . $provider->getId() . '" style="icon" redirect="https://nextendweb.com/"]',
        '[nextend_social_login trackerdata="source"]'
    );
    ?>

    <textarea readonly cols="160" rows="6" class="nextend-html-editor-readonly"
              aria-describedby="editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4"><?php echo implode("\n\n", $shortcodes); ?></textarea>


    <h4><?php _e('Simple link', 'nextend-facebook-connect'); ?></h4>

    <?php
    $html = '<a href="' . $provider->getLoginUrl() . '" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="' . esc_attr($provider->getId()) . '" data-popupwidth="' . $provider->getPopupWidth() . '" data-popupheight="' . $provider->getPopupHeight() . '">' . "\n\t" . __('Click here to login or register', 'nextend-facebook-connect') . "\n" . '</a>';
    ?>
    <textarea readonly cols="160" rows="6" class="nextend-html-editor-readonly"
              aria-describedby="editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4"><?php echo esc_textarea($html); ?></textarea>

    <h4><?php _e('Image button', 'nextend-facebook-connect'); ?></h4>

    <?php
    $html = '<a href="' . $provider->getLoginUrl() . '" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="' . esc_attr($provider->getId()) . '" data-popupwidth="' . $provider->getPopupWidth() . '" data-popupheight="' . $provider->getPopupHeight() . '">' . "\n\t" . '<img src="' . __('Image url', 'nextend-facebook-connect') . '" alt="" />' . "\n" . '</a>';
    ?>
    <textarea readonly cols="160" rows="6" class="nextend-html-editor-readonly"
              aria-describedby="editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4"><?php echo esc_textarea($html); ?></textarea>

</div>
