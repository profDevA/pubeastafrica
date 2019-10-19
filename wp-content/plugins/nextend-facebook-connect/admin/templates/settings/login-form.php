<?php
defined('ABSPATH') || die();

$settings = NextendSocialLogin::$settings;
?>
    <table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e('Login Form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="show_login_form"
                              value="show" <?php if ($settings->get('show_login_form') == 'show') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Show login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="show_login_form"
                              value="hide" <?php if ($settings->get('show_login_form') == 'hide') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Hide login buttons', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Registration Form', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="show_registration_form"
                              value="show" <?php if ($settings->get('show_registration_form') == 'show') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Show login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="show_registration_form"
                              value="hide" <?php if ($settings->get('show_registration_form') == 'hide') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Hide login buttons', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row">
            <?php _e('Embedded login form', 'nextend-facebook-connect'); ?>
            <br>
            <code>wp_login_form</code>
        </th>
        <td>
            <fieldset>
                <label><input type="radio" name="show_embedded_login_form"
                              value="show" <?php if ($settings->get('show_embedded_login_form') == 'show') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Show login buttons', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="show_embedded_login_form"
                              value="hide" <?php if ($settings->get('show_embedded_login_form') == 'hide') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Hide login buttons', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Button alignment', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="login_form_button_align"
                              value="left" <?php if ($settings->get('login_form_button_align') == 'left') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Left', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="login_form_button_align"
                              value="center" <?php if ($settings->get('login_form_button_align') == 'center') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Center', 'nextend-facebook-connect'); ?></span></label><br>

                <label><input type="radio" name="login_form_button_align"
                              value="right" <?php if ($settings->get('login_form_button_align') == 'right') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Right', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>
    </tbody>
</table>

<?php
include dirname(__FILE__) . '/login-form-pro.php';
?>