<script type="text/javascript">
    (function ($) {

        window.NSLResetTerms = function () {
            var id = 'terms',
                content =  <?php echo wp_json_encode(__('By clicking Register, you accept our <a href="#privacy_policy_url" target="_blank">Privacy Policy</a>', 'nextend-facebook-connect')); ?>;

            if ($('#wp-' + id + '-wrap').hasClass('html-active')) {
                $('#' + id).val(content);
            } else { // We are in tinyMCE mode
                var activeEditor = tinyMCE.get(id);
                if (activeEditor !== null) {
                    activeEditor.setContent(content);
                }
            }

            return false;
        };

        $(document).ready(function () {
            $('#terms_show').on('change', function () {
                if ($(this).is(':checked')) {
                    $('#nsl-terms').css('display', '');
                } else {
                    $('#nsl-terms').css('display', 'none');
                }
            });
        });
    })(jQuery);
</script>

<table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><?php _e('Terms and conditions', 'nextend-facebook-connect'); ?></th>
        <td>
            <fieldset>
                <label for="terms_show">
                    <input type="hidden" name="terms_show" value="0">
                    <input type="checkbox" name="terms_show" id="terms_show"
                           value="1" <?php if ($settings->get('terms_show') == '1') : ?> checked="checked" <?php endif; ?>>
                    <?php _e('Show', 'nextend-facebook-connect'); ?>
                </label>

                <div id="nsl-terms" <?php if ($settings->get('terms_show') != '1') : ?> style="display:none;" <?php endif; ?>>
                    <?php
                    wp_editor($settings->get('terms'), 'terms', array(
                        'textarea_rows' => 4,
                        'media_buttons' => false
                    ));
                    ?>
                    <p class="description"><a href="#"
                                              onclick="return NSLResetTerms();"><?php _e('Reset to default', 'nextend-facebook-connect'); ?></a>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr>
        <th scope="row"><?php _e('Store', 'nextend-facebook-connect'); ?></th>
        <td>
            <label for="store_name">
                <input type="hidden" name="store_name" value="0">
                <input type="checkbox" name="store_name" id="store_name"
                       value="1" <?php if ($settings->get('store_name') == '1') : ?> checked="checked" <?php endif; ?>>
                <?php _e('First and last name', 'nextend-facebook-connect'); ?>
            </label>
            <p class="description"
               id="tagline-store_name"><?php _e('When not enabled, username will be randomly generated.', 'nextend-facebook-connect'); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td>
            <label for="store_email">
                <input type="hidden" name="store_email" value="0">
                <input type="checkbox" name="store_email" id="store_email"
                       value="1" <?php if ($settings->get('store_email') == '1') : ?> checked="checked" <?php endif; ?>>
                <?php _e('Email', 'nextend-facebook-connect'); ?>
            </label>
            <p class="description"
               id="tagline-store_email"><?php _e('When not enabled, email will be empty.', 'nextend-facebook-connect'); ?></p>
        </td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td>
            <label for="avatar_store">
                <input type="hidden" name="avatar_store" value="0">
                <input type="checkbox" name="avatar_store" id="avatar_store"
                       value="1" <?php if ($settings->get('avatar_store') == '1') : ?> checked="checked" <?php endif; ?>>
                <?php _e('Avatar', 'nextend-facebook-connect'); ?>
            </label>
        </td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td>
            <label for="store_access_token">
                <input type="hidden" name="store_access_token" value="0">
                <input type="checkbox" name="store_access_token" id="store_access_token"
                       value="1" <?php if ($settings->get('store_access_token') == '1') : ?> checked="checked" <?php endif; ?>>
                <?php _e('Access token', 'nextend-facebook-connect'); ?>
            </label>
        </td>
    </tr>
    </tbody>
</table>
<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes'); ?>"></p>