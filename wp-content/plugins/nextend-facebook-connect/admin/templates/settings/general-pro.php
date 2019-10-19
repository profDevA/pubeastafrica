<?php
defined('ABSPATH') || die();

$isPRO = NextendSocialLoginAdmin::isPro();
if (!$isPRO):
    ?>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes'); ?>"></p>

    <hr/>
    <h1><?php _e('PRO settings', 'nextend-facebook-connect'); ?></h1>
<?php
endif;

$attr = '';
if (!$isPRO) {
    $attr = ' disabled ';
}

$settings = NextendSocialLogin::$settings;

NextendSocialLoginAdmin::showProBox();
?>

    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e('Target window', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="target"
                              value="prefer-popup" <?php if ($settings->get('target') == 'prefer-popup') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Prefer popup', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="target"
                              value="prefer-new-tab" <?php if ($settings->get('target') == 'prefer-new-tab') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Prefer new tab', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="target"
                              value="prefer-same-window" <?php if ($settings->get('target') == 'prefer-same-window') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Prefer same window', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Registration notification sent to', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="registration_notification_notify"
                              value="0" <?php if ($settings->get('registration_notification_notify') == '0') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('WordPress default', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="registration_notification_notify"
                              value="nobody" <?php if ($settings->get('registration_notification_notify') == 'nobody') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Nobody', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="registration_notification_notify"
                              value="user" <?php if ($settings->get('registration_notification_notify') == 'user') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('User', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="registration_notification_notify"
                              value="admin" <?php if ($settings->get('registration_notification_notify') == 'admin') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Admin', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="registration_notification_notify"
                              value="both" <?php if ($settings->get('registration_notification_notify') == 'both') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('User and Admin', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Unlink', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type='hidden' name='allow_unlink' value='0'>
                    <input type="checkbox" name="allow_unlink" value="1" <?php if ($settings->get('allow_unlink') != '0') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Allow Social account unlink', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Disable Admin bar for roles', 'nextend-facebook-connect'); ?></th>

        <td>
            <?php
            $wp_roles = new WP_Roles();
            $roles    = $wp_roles->get_names();

            $adminbar_disabled_roles = $settings->get('admin_bar_roles');
            foreach ($roles AS $roleKey => $label):
                ?>
                <fieldset><label for="admin_bar_roles_<?php echo esc_attr($roleKey); ?>">
                        <input name="admin_bar_roles[]" type="checkbox"
                               id="admin_bar_roles_<?php echo esc_attr($roleKey); ?>"
                               value="<?php echo esc_attr($roleKey); ?>" <?php if (in_array($roleKey, $adminbar_disabled_roles)) : ?> checked="checked" <?php endif ?> <?php echo $attr; ?> />
                        <?php echo $label; ?></label>
                </fieldset>
            <?php endforeach; ?>
        <input type="hidden" name="admin_bar_roles[]" value=""/>
        </td>

        <td>
            <fieldset>
                <input type='hidden' name='admin_bar_roles[]' value='0'>
            </fieldset>
        </td>
    </tr>

    </tbody>
</table>
<?php if ($isPRO): ?>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                             value="<?php _e('Save Changes'); ?>"></p>
<?php endif; ?>