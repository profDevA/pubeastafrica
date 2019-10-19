<?php
defined('ABSPATH') || die();
/** @var $this NextendSocialProviderAdmin */

$provider = $this->getProvider();

$settings = $provider->settings;
?>

<hr/>
<h2><?php _e('Other settings', 'nextend-facebook-connect'); ?></h2>
<table class="form-table">
    <tbody>
    <tr>
        <th scope="row"><label
                    for="user_prefix"><?php _e('Username prefix on register', 'nextend-facebook-connect'); ?></label></th>
        <td><input name="user_prefix" type="text" id="user_prefix"
                   value="<?php echo esc_attr($settings->get('user_prefix')); ?>" class="regular-text"></td>
    </tr>
    <tr>
        <th scope="row"><label
                    for="user_fallback"><?php _e('Fallback username prefix on register', 'nextend-facebook-connect'); ?></label></th>
        <td><input name="user_fallback" type="text" id="user_fallback"
                   value="<?php echo esc_attr($settings->get('user_fallback')); ?>" class="regular-text">
            <p class="description" id="tagline-user_fallback"><?php _e('Used when username is invalid or not stored', 'nextend-facebook-connect'); ?></p></td>
    </tr>
    <?php if (NextendSocialLogin::$settings->get('terms_show') == 1): ?>
        <tr>
            <th scope="row"><?php _e('Terms and conditions', 'nextend-facebook-connect'); ?></th>
            <td>
                <?php
                $terms              = $settings->get('terms');
                $hasOverriddenTerms = !empty($terms);
                ?>
                <fieldset>
                    <label for="terms_override">
                        <input type="hidden" name="terms_override" value="0">
                        <input type="checkbox" name="terms_override" id="terms_override"
                               value="1" <?php if ($hasOverriddenTerms) : ?> checked="checked" <?php endif; ?>>
                        <?php printf(__('Override global "%1$s"', 'nextend-facebook-connect'), __('Terms and conditions', 'nextend-facebook-connect')); ?>
                    </label>

                    <div id="nsl-terms" <?php if (!$hasOverriddenTerms) : ?> style="display:none;" <?php endif; ?>>
                        <?php
                        wp_editor($terms, 'terms', array(
                            'textarea_rows' => 4,
                            'media_buttons' => false
                        ));
                        ?>
                    </div>
                </fieldset>
                <script type="text/javascript">
                    (function ($) {

                        $(document).ready(function () {
                            $('#terms_override').on('change', function () {
                                if ($(this).is(':checked')) {
                                    $('#nsl-terms').css('display', '');
                                } else {
                                    $('#nsl-terms').css('display', 'none');
                                }
                            });
                        });
                    })(jQuery);
                </script>
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>