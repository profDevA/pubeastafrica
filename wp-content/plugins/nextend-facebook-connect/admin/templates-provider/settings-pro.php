<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();

$settings = $provider->settings;

$isPRO = apply_filters('nsl-pro', false);

$attr = '';
if (!$isPRO) {
    $attr = ' disabled ';
}
?>

    <hr/>
    <h1><?php _e('PRO settings', 'nextend-facebook-connect'); ?></h1>


<?php
NextendSocialLoginAdmin::showProBox();
?>
    <input type="hidden" name="tested" id="tested" value="<?php echo esc_attr($settings->get('tested')); ?>"/>
    <table class="form-table" <?php if (!$isPRO): ?> style="opacity:0.5;"<?php endif; ?>>
        <tbody>
        <tr>
            <th scope="row"><?php _e('Ask E-mail on registration', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text">
                        <span><?php _e('Ask E-mail on registration', 'nextend-facebook-connect'); ?></span></legend>
                    <label><input type="radio" name="ask_email"
                                  value="never" <?php if ($settings->get('ask_email') == 'never') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Never', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="ask_email"
                                  value="when-empty" <?php if ($settings->get('ask_email') == 'when-empty') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('When email is not provided or empty', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="ask_email"
                                  value="always" <?php if ($settings->get('ask_email') == 'always') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Always', 'nextend-facebook-connect'); ?></span></label><br>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Ask Username on registration', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text">
                        <span><?php _e('Ask Username on registration', 'nextend-facebook-connect'); ?></span></legend>
                    <label><input type="radio" name="ask_user"
                                  value="never" <?php if ($settings->get('ask_user') == 'never') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Never, generate automatically', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="ask_user"
                                  value="when-empty" <?php if ($settings->get('ask_user') == 'when-empty') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('When username is empty or invalid', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="ask_user"
                                  value="always" <?php if ($settings->get('ask_user') == 'always') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Always', 'nextend-facebook-connect'); ?></span></label><br>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Ask Password on registration', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label><input type="radio" name="ask_password"
                                  value="never" <?php if ($settings->get('ask_password') == 'never') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Never', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="ask_password"
                                  value="always" <?php if ($settings->get('ask_password') == 'always') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Always', 'nextend-facebook-connect'); ?></span></label><br>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Automatically connect the existing account upon registration', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <legend class="screen-reader-text">
                        <span><?php _e('Automatically connect the existing account upon registration', 'nextend-facebook-connect'); ?></span>
                    </legend>
                    <label><input type="radio" name="auto_link"
                                  value="disabled" <?php if ($settings->get('auto_link') == 'disabled') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Disabled', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="auto_link"
                                  value="email" <?php if ($settings->get('auto_link') == 'email') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Automatic, based on email address', 'nextend-facebook-connect'); ?></span></label><br>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Disable login for the selected roles', 'nextend-facebook-connect'); ?></th>
            <td>
				<?php
                $wp_roles = new WP_Roles();
                $roles    = $wp_roles->get_names();

                $disable_roles = $settings->get('disabled_roles');
                foreach ($roles AS $roleKey => $label):
                    ?>
                    <fieldset><label for="disabled_roles_<?php echo esc_attr($roleKey); ?>">
                            <input name="disabled_roles[]" type="checkbox"
                                   id="disabled_roles_<?php echo esc_attr($roleKey); ?>"
                                   value="<?php echo esc_attr($roleKey); ?>" <?php if (in_array($roleKey, $disable_roles)) : ?> checked <?php endif ?> <?php echo $attr; ?> />
                            <?php echo $label; ?></label>
                    </fieldset>
                <?php endforeach; ?>
                <input type="hidden" name="disabled_roles[]" value=""/>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Default roles for user who registered with this provider', 'nextend-facebook-connect'); ?></th>
            <td>
				<?php
                $register_roles = $settings->get('register_roles');
                ?>
                <fieldset><label for="register_roles_default">
                        <input name="register_roles[]" type="checkbox" id="register_roles_default"
                               value="default" <?php if (in_array('default', $register_roles)) : ?> checked <?php endif ?> <?php echo $attr; ?> />
                        <?php _e('Default', 'nextend-facebook-connect'); ?></label>
                </fieldset>
                <?php
                foreach ($roles AS $roleKey => $label):
                    ?>
                    <fieldset><label for="register_roles_<?php echo esc_attr($roleKey); ?>">
                            <input name="register_roles[]" type="checkbox"
                                   id="register_roles_<?php echo esc_attr($roleKey); ?>"
                                   value="<?php echo esc_attr($roleKey); ?>" <?php if (in_array($roleKey, $register_roles)) : ?> checked <?php endif ?> <?php echo $attr; ?> />
                            <?php echo $label; ?></label>
                    </fieldset>
                <?php endforeach; ?>
                <input type="hidden" name="register_roles[]" value=""/>
            </td>
        </tr>
        </tbody>
    </table>
<?php if ($isPRO): ?>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                             value="<?php _e('Save Changes'); ?>"></p>
<?php endif; ?>