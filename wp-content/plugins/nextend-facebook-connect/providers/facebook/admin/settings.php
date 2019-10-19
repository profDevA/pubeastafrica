<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();

$settings = $provider->settings;
?>

<div class="nsl-admin-sub-content">
    <?php if (substr($provider->getLoginUrl(), 0, 8) !== 'https://'): ?>
        <div class="error">
            <p><?php printf(__('%1$s allows HTTPS OAuth Redirects only. You must move your site to HTTPS in order to allow login with %1$s.', 'nextend-facebook-connect'), 'Facebook'); ?></p>
            <p><a href="https://nextendweb.com/nextend-social-login-docs/facebook-api-changes/#enforce-https" target="_blank"><?php _e('How to get SSL for my WordPress site?', 'nextend-facebook-connect'); ?></a></p>
        </div>
    <?php endif; ?>
    <?php
    $this->renderSettingsHeader();
    ?>

    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" novalidate="novalidate">

		<?php wp_nonce_field('nextend-social-login'); ?>
        <input type="hidden" name="action" value="nextend-social-login"/>
        <input type="hidden" name="view" value="provider-<?php echo $provider->getId(); ?>"/>
        <input type="hidden" name="subview" value="settings"/>
        <input type="hidden" name="settings_saved" value="1"/>
        <input type="hidden" name="tested" id="tested" value="<?php echo esc_attr($settings->get('tested')); ?>"/>
        <table class="form-table">
            <tbody>
			<?php if (!defined('NEXTEND_FB_APP_ID')): ?>
                <tr>
                    <th scope="row"><label for="appid"><?php _e('App ID', 'nextend-facebook-connect'); ?>
                            - <em>(<?php _e('Required', 'nextend-facebook-connect'); ?>)</em></label></th>
                    <td>
                        <input name="appid" type="text" id="appid"
                               value="<?php echo esc_attr($settings->get('appid')); ?>" class="regular-text">
                        <p class="description"
                           id="tagline-appid"><?php printf(__('If you are not sure what is your %1$s, please head over to <a href="%2$s">Getting Started</a>', 'nextend-facebook-connect'), 'App ID', $this->getUrl()); ?></p>
                    </td>
                </tr>
            <?php endif; ?>
            <?php if (!defined('NEXTEND_FB_APP_SECRET')): ?>
                <tr>
                    <th scope="row"><label for="secret"><?php _e('App Secret', 'nextend-facebook-connect'); ?>
                            - <em>(<?php _e('Required', 'nextend-facebook-connect'); ?>)</em></label>
                    </th>
                    <td><input name="secret" type="text" id="secret"
                               value="<?php echo esc_attr($settings->get('secret')); ?>" class="regular-text"></td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                                 value="<?php _e('Save Changes'); ?>"></p>

        <?php
        $this->renderOtherSettings();

        $this->renderProSettings();
        ?>
    </form>
</div>