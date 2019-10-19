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
        <th scope="row"><?php _e('Register form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="buddypress_register_button"
                              value="" <?php if ($settings->get('buddypress_register_button') == '') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('No Connect button', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="buddypress_register_button"
                              value="bp_before_register_page" <?php if ($settings->get('buddypress_register_button') == 'bp_before_register_page') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button before register', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        bp_before_register_page</code></label><br>
                <label><input type="radio" name="buddypress_register_button"
                              value="bp_before_account_details_fields" <?php if ($settings->get('buddypress_register_button') == 'bp_before_account_details_fields') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button before account details', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        bp_before_account_details_fields</code></label><br>
                <label><input type="radio" name="buddypress_register_button"
                              value="bp_after_register_page" <?php if ($settings->get('buddypress_register_button') == 'bp_after_register_page') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button after register', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        bp_after_register_page</code></label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Register button style', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type="radio" name="buddypress_register_button_style"
                           value="default" <?php if ($settings->get('buddypress_register_button_style') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/buttons/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="buddypress_register_button_style"
                           value="icon" <?php if ($settings->get('buddypress_register_button_style') == 'icon') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Icon', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/buttons/icon.png', NSL_ADMIN_PATH) ?>"/>
                </label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Sidebar Login form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="buddypress_sidebar_login"
                              value="" <?php if ($settings->get('buddypress_sidebar_login') == '') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Hide login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="buddypress_sidebar_login"
                              value="show" <?php if ($settings->get('buddypress_sidebar_login') == 'show') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Show login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                <p class="description" id="tagline-buddypress_sidebar_login"><?php _e('Some themes that use BuddyPress, display the social buttons twice in the same login form. This option can disable the one for: <b>bp_sidebar_login_form action</b>.  ', 'nextend-facebook-connect'); ?></p>
            </fieldset>
        </td>

    </tr>

    <tr>
        <th scope="row"><?php _e('Login form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="buddypress_login"
                              value="" <?php if ($settings->get('buddypress_login') == '') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Hide login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="buddypress_login"
                              value="show" <?php if ($settings->get('buddypress_login') == 'show') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Show login buttons', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Login button style', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type="radio" name="buddypress_login_button_style"
                           value="default" <?php if ($settings->get('buddypress_login_button_style') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/buttons/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="buddypress_login_button_style"
                           value="icon" <?php if ($settings->get('buddypress_login_button_style') == 'icon') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
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
                    <input type="radio" name="buddypress_login_form_layout"
                           value="default" <?php if ($settings->get('buddypress_login_form_layout') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="buddypress_login_form_layout"
                           value="below" <?php if ($settings->get('buddypress_login_form_layout') == 'below') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="buddypress_login_form_layout"
                           value="below-separator" <?php if ($settings->get('buddypress_login_form_layout') == 'below-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below with separator', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below-separator.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="buddypress_login_form_layout"
                           value="above" <?php if ($settings->get('buddypress_login_form_layout') == 'above') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Above', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/above.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="buddypress_login_form_layout"
                           value="above-separator" <?php if ($settings->get('buddypress_login_form_layout') == 'above-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
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
                <label><input type="radio" name="buddypress_register_button_align"
                              value="left" <?php if ($settings->get('buddypress_register_button_align') == 'left') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Left', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="buddypress_register_button_align"
                              value="center" <?php if ($settings->get('buddypress_register_button_align') == 'center') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Center', 'nextend-facebook-connect'); ?></span></label><br>

                <label><input type="radio" name="buddypress_register_button_align"
                              value="right" <?php if ($settings->get('buddypress_register_button_align') == 'right') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
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
