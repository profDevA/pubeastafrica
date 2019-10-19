<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            $('#custom_redirect_enabled').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#redirect').css('display', '');
                }
                else {
                    $('#redirect').css('display', 'none');
                }
            });

            $('#custom_redirect_reg_enabled').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#redirect_reg').css('display', '');
                }
                else {
                    $('#redirect_reg').css('display', 'none');
                }
            });

            $('#default_redirect_enabled').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#default_redirect').css('display', '');
                }
                else {
                    $('#default_redirect').css('display', 'none');
                }
            });

            $('#default_redirect_reg_enabled').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#default_redirect_reg').css('display', '');
                }
                else {
                    $('#default_redirect_reg').css('display', 'none');
                }
            });
        });
    })(jQuery);
</script>



<table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e('Debug mode', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="debug"
                              value="0" <?php if ($settings->get('debug') == '0') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Disabled', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="debug"
                              value="1" <?php if ($settings->get('debug') == '1') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Enabled', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Page for register flow', 'nextend-facebook-connect'); ?></th>
        <td>
             <?php wp_dropdown_pages(array(
                 'name'             => 'register-flow-page',
                 'show_option_none' => __('None', "nextend-facebook-connect"),
                 'selected'         => $settings->get('register-flow-page')
             )); ?>
            <p class="description" id="tagline-register-flow-page-1"><?php _e("This setting is used when you request additional data from the users (such as email address) and to display the Terms and conditions.", "nextend-facebook-connect"); ?></p>
            <p class="description" id="tagline-register-flow-page"><?php printf(__('%2$s First create a new page and insert the following shortcode: %1$s then select this page above', 'nextend-facebook-connect'), '<code>[nextend_social_login_register_flow]</code>', '<b>' . __("Usage:", "nextend-facebook-connect") . '</b>'); ?></p>
            <p class="description" id="tagline-register-flow-page"><?php printf(__('%1$s You won\'t be able to reach the selected page unless a social login/registration happens.', 'nextend-facebook-connect'), '<b>' . __("Important:", "nextend-facebook-connect") . '</b>'); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('OAuth redirect uri proxy page', 'nextend-facebook-connect'); ?></th>
        <td>
             <?php wp_dropdown_pages(array(
                 'name'             => 'proxy-page',
                 'show_option_none' => __('None', "nextend-facebook-connect"),
                 'selected'         => $settings->get('proxy-page')
             )); ?>
            <p class="description" id="tagline-proxy-page-1"><?php _e("You can use this setting when wp-login.php page is not available to handle the OAuth flow.", "nextend-facebook-connect") ?></p>
            <p class="description" id="tagline-register-flow-page"><?php printf(__('%1$s First create a new page then select this page above.', 'nextend-facebook-connect'), '<b>' . __("Usage:", "nextend-facebook-connect") . '</b>'); ?></p>
            <p class="description" id="tagline-register-flow-page"><?php printf(__('%1$s You won\'t be able to reach the selected page unless a social login/registration happens.', 'nextend-facebook-connect'), '<b>' . __("Important:", "nextend-facebook-connect") . '</b>'); ?></p>
        </td>
    </tr>

    <tr>
        <th scope="row"><label
                    for="default_redirect"><?php _e('Prevent external redirect overrides', 'nextend-facebook-connect'); ?></label>
        </th>
        <td>
            <label for="redirect_prevent_external">
                <input type="hidden" name="redirect_prevent_external" value="0">
                <input type="checkbox" name="redirect_prevent_external" id="redirect_prevent_external" value="1"<?php if ($settings->get('redirect_prevent_external') == '1') : ?> checked="checked" <?php endif; ?>>
                <?php _e('Disable external redirects', 'nextend-facebook-connect'); ?>
            </label>
        </td>
    </tr>

    <tr>
        <th scope="row"><label
                    for="default_redirect"><?php _e('Default redirect url', 'nextend-facebook-connect'); ?></label>
        </th>
        <td>
            <?php
            $useDefault       = false;
            $default_redirect = $settings->get('default_redirect');
            if (!empty($default_redirect)) {
                $useDefault = true;
            }
            ?>
            <fieldset><label for="default_redirect_enabled">
                    <input name="default_redirect_enabled" type="checkbox" id="default_redirect_enabled"
                           value="1" <?php if ($useDefault): ?> checked<?php endif; ?>>
                    <?php _e('for Login', 'nextend-facebook-connect'); ?></label>
            </fieldset>
            <input name="default_redirect" type="text" id="default_redirect" value="<?php echo esc_attr($default_redirect); ?>"
                   class="regular-text"<?php if (!$useDefault): ?> style="display:none;"<?php endif; ?>>

            <?php
            $useDefault          = false;
            $default_redirectReg = $settings->get('default_redirect_reg');
            if (!empty($default_redirectReg)) {
                $useDefault = true;
            }
            ?>
            <fieldset><label for="default_redirect_reg_enabled">
                    <input name="default_redirect_reg_enabled" type="checkbox" id="default_redirect_reg_enabled"
                           value="1" <?php if ($useDefault): ?> checked<?php endif; ?>>
                    <?php _e('for Register', 'nextend-facebook-connect'); ?></label>
            </fieldset>
            <input name="default_redirect_reg" type="text" id="default_redirect_reg"
                   value="<?php echo esc_attr($default_redirectReg); ?>"
                   class="regular-text"<?php if (!$useDefault): ?> style="display:none;"<?php endif; ?>>
        </td>
    </tr>

    <tr>
        <th scope="row"><label
                    for="redirect"><?php _e('Fixed redirect url', 'nextend-facebook-connect'); ?></label>
        </th>
        <td>
            <?php
            $useCustom = false;
            $redirect  = $settings->get('redirect');
            if (!empty($redirect)) {
                $useCustom = true;
            }
            ?>
            <fieldset><label for="custom_redirect_enabled">
                    <input name="custom_redirect_enabled" type="checkbox" id="custom_redirect_enabled"
                           value="1" <?php if ($useCustom): ?> checked<?php endif; ?>>
                    <?php _e('for Login', 'nextend-facebook-connect'); ?></label>
            </fieldset>
            <input name="redirect" type="text" id="redirect" value="<?php echo esc_attr($redirect); ?>"
                   class="regular-text"<?php if (!$useCustom): ?> style="display:none;"<?php endif; ?>>

            <?php
            $useCustom   = false;
            $redirectReg = $settings->get('redirect_reg');
            if (!empty($redirectReg)) {
                $useCustom = true;
            }
            ?>
            <fieldset><label for="custom_redirect_reg_enabled">
                    <input name="custom_redirect_reg_enabled" type="checkbox" id="custom_redirect_reg_enabled"
                           value="1" <?php if ($useCustom): ?> checked<?php endif; ?>>
                    <?php _e('for Register', 'nextend-facebook-connect'); ?></label>
            </fieldset>
            <input name="redirect_reg" type="text" id="redirect_reg"
                   value="<?php echo esc_attr($redirectReg); ?>"
                   class="regular-text"<?php if (!$useCustom): ?> style="display:none;"<?php endif; ?>>
        </td>
    </tr>

     <tr>
        <th scope="row"><?php _e('Blacklisted redirects', 'nextend-facebook-connect'); ?></th>
         <td>
            <?php
            $blacklistedUrls = $settings->get('blacklisted_urls');
            ?>
             <textarea rows="4" cols="53" name="blacklisted_urls" id="blacklisted_urls"><?php echo esc_textarea($blacklistedUrls); ?></textarea>
             <p class="description"><?php _e('If you want to blacklist redirect url params. One pattern per line.', 'nextend-facebook-connect'); ?></p>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Support login restrictions', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="login_restriction"
                              value="0" <?php if ($settings->get('login_restriction') == '0') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Disabled', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="login_restriction"
                              value="1" <?php if ($settings->get('login_restriction') == '1') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Enabled', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
            <p class="description" id="tagline-login-restriction"><?php printf(__('Please visit to our %1$s to check what plugins are supported!', 'nextend-facebook-connect'), '<a href="https://nextendweb.com/nextend-social-login-docs/login-restriction/" target="_blank">Login Restriction page</a>'); ?></p>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Display avatars in "All media items"', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="avatars_in_all_media"
                              value="0" <?php if ($settings->get('avatars_in_all_media') == '0') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Disabled', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="avatars_in_all_media"
                              value="1" <?php if ($settings->get('avatars_in_all_media') == '1') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Enabled', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
            <p class="description"><?php _e('Enabling this option can speed up loading images in Media Library - Grid view!', 'nextend-facebook-connect'); ?></p>
        </td>
    </tr>

    <tr>
        <th scope="row"><?php _e('Membership', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label><input type="radio" name="allow_register"
                              value="-1" <?php if ($settings->get('allow_register') == '-1') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('WordPress default', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="allow_register"
                              value="0" <?php if ($settings->get('allow_register') == '0') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Disabled', 'nextend-facebook-connect'); ?></span></label><br>
                <label><input type="radio" name="allow_register"
                              value="1" <?php if ($settings->get('allow_register') == '1') : ?> checked="checked" <?php endif; ?>>
                    <span><?php _e('Enabled', 'nextend-facebook-connect'); ?></span></label><br>
            </fieldset>
            <p class="description"><?php _e('Allow registration with Social login.', 'nextend-facebook-connect'); ?></p>
        </td>
    </tr>

    </tbody>
</table>

<?php
include dirname(__FILE__) . '/general-pro.php';
?>