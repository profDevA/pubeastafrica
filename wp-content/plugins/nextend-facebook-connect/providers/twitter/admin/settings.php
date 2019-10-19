<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();

$settings = $provider->settings;
?>

<div class="nsl-admin-sub-content">
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
            <tr>
                <th scope="row"><label
                            for="consumer_key"><?php _e('API Key', 'nextend-facebook-connect'); ?></label>
                            - <em>(<?php _e('Required', 'nextend-facebook-connect'); ?>)</em></label></th>
                <td>
                    <input name="consumer_key" type="text" id="consumer_key"
                           value="<?php echo esc_attr($settings->get('consumer_key')); ?>" class="regular-text">
                    <p class="description"
                       id="tagline-consumer_key"><?php printf(__('If you are not sure what is your %1$s, please head over to <a href="%2$s">Getting Started</a>', 'nextend-facebook-connect'), 'API secret key', $this->getUrl()); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><label
                            for="consumer_secret"><?php _e('API secret key', 'nextend-facebook-connect'); ?></label>
                </th>
                <td><input name="consumer_secret" type="text" id="consumer_secret"
                           value="<?php echo esc_attr($settings->get('consumer_secret')); ?>" class="regular-text"
                           style="width:40em;">
                </td>
            </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                                 value="<?php _e('Save Changes'); ?>"></p>

        <?php
        $this->renderOtherSettings();
        ?>

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><?php _e('Profile image size', 'nextend-facebook-connect'); ?></th>
                    <td>
                        <fieldset>
                            <label><input type="radio" name="profile_image_size"
                                          value="mini" <?php if ($settings->get('profile_image_size') == 'mini') : ?> checked="checked" <?php endif; ?>>
                                <span>24x24</span></label><br>
                            <label><input type="radio" name="profile_image_size"
                                          value="normal" <?php if ($settings->get('profile_image_size') == 'normal') : ?> checked="checked" <?php endif; ?>>
                                <span>48x48</span></label><br>
                            <label><input type="radio" name="profile_image_size"
                                          value="bigger" <?php if ($settings->get('profile_image_size') == 'bigger') : ?> checked="checked" <?php endif; ?>>
                                <span>73x73</span></label><br>
                            <label><input type="radio" name="profile_image_size"
                                          value="original" <?php if ($settings->get('profile_image_size') == 'original') : ?> checked="checked" <?php endif; ?>>
                                    <span><?php _e('Original', 'nextend-facebook-connect'); ?></span></label><br>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php
        $this->renderProSettings();
        ?>
    </form>
</div>
