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
            <th scope="row"><?php _e('Login Form', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label><input type="radio" name="userpro_show_login_form"
                                  value="show" <?php if ($settings->get('userpro_show_login_form') == 'show') : ?> checked="checked" <?php endif; ?> <?php echo $attr; ?>>
                        <span><?php _e('Show login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="userpro_show_login_form"
                                  value="hide" <?php if ($settings->get('userpro_show_login_form') == 'hide') : ?> checked="checked" <?php endif; ?> <?php echo $attr; ?>>
                        <span><?php _e('Hide login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Register Form', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label><input type="radio" name="userpro_show_register_form"
                                  value="show" <?php if ($settings->get('userpro_show_register_form') == 'show') : ?> checked="checked" <?php endif; ?> <?php echo $attr; ?>>
                        <span><?php _e('Show login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="userpro_show_register_form"
                                  value="hide" <?php if ($settings->get('userpro_show_register_form') == 'hide') : ?> checked="checked" <?php endif; ?> <?php echo $attr; ?>>
                        <span><?php _e('Hide login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                </fieldset>
            </td>
        </tr>

        <tr>
            <th scope="row"><?php _e('Login form button style', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label>
                        <input type="radio" name="userpro_login_form_button_style"
                               value="default" <?php if ($settings->get('userpro_login_form_button_style') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/buttons/default.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_login_form_button_style"
                               value="icon" <?php if ($settings->get('userpro_login_form_button_style') == 'icon') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Icon', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/buttons/icon.png', NSL_ADMIN_PATH) ?>"/>
                    </label><br>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Login layout', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label>
                        <input type="radio" name="userpro_login_form_layout"
                               value="below" <?php if ($settings->get('userpro_login_form_layout') == 'below') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Below', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/below.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_login_form_layout"
                               value="below-separator" <?php if ($settings->get('userpro_login_form_layout') == 'below-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Below with separator', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/below-separator.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_login_form_layout"
                               value="above" <?php if ($settings->get('userpro_login_form_layout') == 'above') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Above', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/above.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_login_form_layout"
                               value="above-separator" <?php if ($settings->get('userpro_login_form_layout') == 'above-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Above with separator', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/above-separator.png', NSL_ADMIN_PATH) ?>"/>
                    </label><br>
                </fieldset>
            </td>
        </tr>

        <tr>
            <th scope="row"><?php _e('Register form button style', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label>
                        <input type="radio" name="userpro_register_form_button_style"
                               value="default" <?php if ($settings->get('userpro_register_form_button_style') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/buttons/default.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_register_form_button_style"
                               value="icon" <?php if ($settings->get('userpro_register_form_button_style') == 'icon') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Icon', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/buttons/icon.png', NSL_ADMIN_PATH) ?>"/>
                    </label><br>
                </fieldset>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e('Register layout', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label>
                        <input type="radio" name="userpro_register_form_layout"
                               value="below" <?php if ($settings->get('userpro_register_form_layout') == 'below') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Below', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/below.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_register_form_layout"
                               value="below-separator" <?php if ($settings->get('userpro_register_form_layout') == 'below-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Below with separator', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/below-separator.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_register_form_layout"
                               value="above" <?php if ($settings->get('userpro_register_form_layout') == 'above') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Above', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/above.png', NSL_ADMIN_PATH) ?>"/>
                    </label>
                    <label>
                        <input type="radio" name="userpro_register_form_layout"
                               value="above-separator" <?php if ($settings->get('userpro_register_form_layout') == 'above-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Above with separator', 'nextend-facebook-connect'); ?></span><br/>
                        <img src="<?php echo plugins_url('images/layouts/above-separator.png', NSL_ADMIN_PATH) ?>"/>
                    </label><br>
                </fieldset>
            </td>
        </tr>

        <tr>
            <th scope="row"><?php _e('Button alignment', 'nextend-facebook-connect'); ?></th>
            <td>
                <fieldset>
                    <label><input type="radio" name="userpro_form_button_align"
                                  value="left" <?php if ($settings->get('userpro_form_button_align') == 'left') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Left', 'nextend-facebook-connect'); ?></span></label><br>
                    <label><input type="radio" name="userpro_form_button_align"
                                  value="center" <?php if ($settings->get('userpro_form_button_align') == 'center') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                        <span><?php _e('Center', 'nextend-facebook-connect'); ?></span></label><br>

                    <label><input type="radio" name="userpro_form_button_align"
                                  value="right" <?php if ($settings->get('userpro_form_button_align') == 'right') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
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
