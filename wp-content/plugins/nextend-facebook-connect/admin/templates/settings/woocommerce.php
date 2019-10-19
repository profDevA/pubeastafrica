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
        <th scope="row"><?php _e('Button style', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type="radio" name="woocoommerce_form_button_style"
                           value="default" <?php if ($settings->get('woocoommerce_form_button_style') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/buttons/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocoommerce_form_button_style"
                           value="icon" <?php if ($settings->get('woocoommerce_form_button_style') == 'icon') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Icon', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/buttons/icon.png', NSL_ADMIN_PATH) ?>"/>
                </label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Login form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="woocommerce_login"
                              value="" <?php if ($settings->get('woocommerce_login') == '') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('No Connect button in login form', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="woocommerce_login"
                              value="before" <?php if ($settings->get('woocommerce_login') == 'before') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button on', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        woocommerce_login_form_start</code></label><br>
                <label><input type="radio" name="woocommerce_login"
                              value="after" <?php if ($settings->get('woocommerce_login') == 'after') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button on', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        woocommerce_login_form_end</code></label><br>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Login layout', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type="radio" name="woocommerce_login_form_layout"
                           value="default" <?php if ($settings->get('woocommerce_login_form_layout') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_login_form_layout"
                           value="below" <?php if ($settings->get('woocommerce_login_form_layout') == 'below') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_login_form_layout"
                           value="below-separator" <?php if ($settings->get('woocommerce_login_form_layout') == 'below-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below with separator', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below-separator.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_login_form_layout"
                           value="above" <?php if ($settings->get('woocommerce_login_form_layout') == 'above') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Above', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/above.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_login_form_layout"
                           value="above-separator" <?php if ($settings->get('woocommerce_login_form_layout') == 'above-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Above with separator', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/above-separator.png', NSL_ADMIN_PATH) ?>"/>
                </label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Register form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="woocommerce_register"
                              value="" <?php if ($settings->get('woocommerce_register') == '') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('No Connect button in register form', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="woocommerce_register"
                              value="before" <?php if ($settings->get('woocommerce_register') == 'before') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button on', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        woocommerce_register_form_start</code></label><br>
                <label><input type="radio" name="woocommerce_register"
                              value="after" <?php if ($settings->get('woocommerce_register') == 'after') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button on', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        woocommerce_register_form_end</code></label><br>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Register layout', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type="radio" name="woocommerce_register_form_layout"
                           value="default" <?php if ($settings->get('woocommerce_register_form_layout') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_register_form_layout"
                           value="below" <?php if ($settings->get('woocommerce_register_form_layout') == 'below') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_register_form_layout"
                           value="below-separator" <?php if ($settings->get('woocommerce_register_form_layout') == 'below-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below with separator', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below-separator.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_register_form_layout"
                           value="above" <?php if ($settings->get('woocommerce_register_form_layout') == 'above') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Above', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/above.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_register_form_layout"
                           value="above-separator" <?php if ($settings->get('woocommerce_register_form_layout') == 'above-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Above with separator', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/above-separator.png', NSL_ADMIN_PATH) ?>"/>
                </label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Billing form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="woocommerce_billing"
                              value="" <?php if ($settings->get('woocommerce_billing') == '') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('No Connect button in billing form', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="woocommerce_billing"
                              value="before" <?php if ($settings->get('woocommerce_billing') == 'before') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button on', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        woocommerce_before_checkout_billing_form</code></label><br>
                <label><input type="radio" name="woocommerce_billing"
                              value="after" <?php if ($settings->get('woocommerce_billing') == 'after') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Connect button on', 'nextend-facebook-connect'); ?></span></label>
                <code><?php _e('Action:'); ?>
                    woocommerce_after_checkout_billing_form</code><br>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Billing layout', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label>
                    <input type="radio" name="woocommerce_billing_form_layout"
                           value="default" <?php if ($settings->get('woocommerce_billing_form_layout') == 'default') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Default', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/default.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_billing_form_layout"
                           value="below" <?php if ($settings->get('woocommerce_billing_form_layout') == 'below') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_billing_form_layout"
                           value="below-separator" <?php if ($settings->get('woocommerce_billing_form_layout') == 'below-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Below with separator', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/below-separator.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_billing_form_layout"
                           value="above" <?php if ($settings->get('woocommerce_billing_form_layout') == 'above') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Above', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/above.png', NSL_ADMIN_PATH) ?>"/>
                </label>
                <label>
                    <input type="radio" name="woocommerce_billing_form_layout"
                           value="above-separator" <?php if ($settings->get('woocommerce_billing_form_layout') == 'above-separator') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Above with separator', 'nextend-facebook-connect'); ?></span><br/>
                    <img src="<?php echo plugins_url('images/layouts/above-separator.png', NSL_ADMIN_PATH) ?>"/>
                </label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Account details', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="woocommerce_account_details"
                              value="" <?php if ($settings->get('woocommerce_account_details') == '') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('No Connect buttons in account details form', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="woocommerce_account_details"
                              value="before" <?php if ($settings->get('woocommerce_account_details') == 'before') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Link buttons on', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        woocommerce_edit_account_form_start</code></label><br>
                <label><input type="radio" name="woocommerce_account_details"
                              value="after" <?php if ($settings->get('woocommerce_account_details') == 'after') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Link buttons on', 'nextend-facebook-connect'); ?></span>
                    <code><?php _e('Action:'); ?>
                        woocommerce_edit_account_form_end</code></label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Button alignment', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="woocoommerce_form_button_align"
                              value="left" <?php if ($settings->get('woocoommerce_form_button_align') == 'left') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Left', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="woocoommerce_form_button_align"
                              value="center" <?php if ($settings->get('woocoommerce_form_button_align') == 'center') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
                    <span><?php _e('Center', 'nextend-facebook-connect'); ?></span></label><br>

                <label><input type="radio" name="woocoommerce_form_button_align"
                              value="right" <?php if ($settings->get('woocoommerce_form_button_align') == 'right') : ?> checked="checked" <?php endif; ?><?php echo $attr; ?>>
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
