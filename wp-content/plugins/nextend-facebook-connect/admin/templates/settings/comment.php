<?php
defined('ABSPATH') || die();

$isPRO = NextendSocialLoginAdmin::isPro();

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
        <th scope="row"><?php _e('Login button', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="comment_login_button"
                              value="show" <?php if ($settings->get('comment_login_button') == 'show') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Show', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="comment_login_button"
                              value="hide" <?php if ($settings->get('comment_login_button') == 'hide') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Hide', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
            <p class="description"><?php printf(__('You need to turn on the \' %1$s > %2$s > %3$s \' for this feature to work', 'nextend-facebook-connect'), __('Settings'), __('Discussion'), __('Users must be registered and logged in to comment')); ?></p>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Button style', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type="radio" name="comment_button_style"
                           value="default" <?php if ($settings->get('comment_button_style') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/buttons/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="comment_button_style"
                           value="icon" <?php if ($settings->get('comment_button_style') == 'icon') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Icon', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/buttons/icon.png', NSL_ADMIN_PATH) ?>"/>
                </label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Button alignment', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="comment_button_align"
                              value="left" <?php if ($settings->get('comment_button_align') == 'left') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Left', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="comment_button_align"
                              value="center" <?php if ($settings->get('comment_button_align') == 'center') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Center', 'nextend-facebook-connect'); ?></span></label><br>

                <label><input type="radio" name="comment_button_align"
                              value="right" <?php if ($settings->get('comment_button_align') == 'right') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Right', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>
<?php if ($isPRO): ?>
    <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                             value="<?php _e('Save Changes'); ?>"></p>
<?php endif; ?>
