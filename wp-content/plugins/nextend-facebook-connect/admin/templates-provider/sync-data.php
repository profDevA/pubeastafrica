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

<div class="nsl-admin-sub-content">

<?php
NextendSocialLoginAdmin::showProBox();
?>

    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" novalidate="novalidate">

		<?php wp_nonce_field('nextend-social-login'); ?>
        <input type="hidden" name="action" value="nextend-social-login"/>
        <input type="hidden" name="view" value="provider-<?php echo $provider->getId(); ?>"/>
        <input type="hidden" name="subview" value="sync-data"/>
        <input type="hidden" name="settings_saved" value="1"/>

        <?php
        $sync_warning_message = apply_filters('nsl_' . $provider->getId() . '_sync_warning', false);
        if (!empty($sync_warning_message)): ?>
            <div class="notice notice-warning">
                <p>
                    <?php echo $sync_warning_message; ?>
                </p>
            </div>
        <?php endif; ?>

        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label>Sync fields</label></th>
                <td>
                    <fieldset>
                        <label for="sync_fields_register">
                            <input type="checkbox" id="sync_fields_register"
                                   value="1" checked disabled/>
                            <?php _e('Register', 'nextend-facebook-connect'); ?>
                        </label>
                    </fieldset>
                    <fieldset>
                        <label for="sync_fields_login">
                            <input name="sync_fields[login]" type="hidden" value="0"/>
                            <input name="sync_fields[login]" type="checkbox" id="sync_fields_login"
                                   value="1" <?php if ($settings->get('sync_fields/login')): ?> checked<?php endif; ?> <?php echo $attr; ?>/>
                            <?php _e('Login', 'nextend-facebook-connect'); ?>
                        </label>
                    </fieldset>
                    <fieldset>
                        <label for="sync_fields_link">
                            <input name="sync_fields[link]" type="hidden" value="0"/>
                            <input name="sync_fields[link]" type="checkbox" id="sync_fields_link"
                                   value="1" <?php if ($settings->get('sync_fields/link')): ?> checked<?php endif; ?> <?php echo $attr; ?>/>
                            <?php _e('Link', 'nextend-facebook-connect'); ?>
                        </label>
                    </fieldset>
                </td>
            </tr>
            <?php

            $syncFields = $provider->getSyncFields();
            foreach ($syncFields AS $fieldName => $fieldData):
                ?>
                <tr>
                    <th scope="row"><label for="sync_fields_locale"><?php echo $fieldData['label']; ?></label></th>
                    <td>
                        <fieldset>
                            <label for="sync_fields_<?php echo $fieldName; ?>_enabled">
                                <input name="sync_fields[fields][<?php echo $fieldName; ?>][enabled]" type="hidden" value="0" <?php echo $attr; ?>/>
                                <input name="sync_fields[fields][<?php echo $fieldName; ?>][enabled]" type="checkbox" id="sync_fields_<?php echo $fieldName; ?>_enabled"
                                       value="1" <?php if ($settings->get('sync_fields/fields/' . $fieldName . '/enabled')): ?> checked<?php endif; ?> <?php echo $attr; ?>/>
                                <?php _e('Store in meta key', 'nextend-facebook-connect'); ?>
                            </label>
                            <input name="sync_fields[fields][<?php echo $fieldName; ?>][meta_key]" type="text" id="sync_fields_<?php echo $fieldName; ?>_meta_key"
                                   value="<?php echo esc_attr($settings->get('sync_fields/fields/' . $fieldName . '/meta_key')); ?>" class="regular-text" <?php echo $attr; ?>/>
                        </fieldset>
                        <?php
                        $description = $provider->getSyncDataFieldDescription($fieldName);
                        ?>
                        <?php if (!empty($description)): ?>
                            <p class="description">
                                <?php echo $description; ?>
                            </p>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($isPRO): ?>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes'); ?>">
            </p>
        <?php endif; ?>
    </form>
</div>

<script type="text/javascript">
    (function ($) {

        $(document).ready(function () {
            var $checkboxes = $('input[type="checkbox"]');
            $checkboxes.on('change', function (e) {
                var $checkbox = $(this);
                $checkbox.closest('td').toggleClass('nsl-admin-setting-disabled', !$checkbox.is(':checked'));
            });

            $checkboxes.each(function () {
                var $checkbox = $(this);
                $checkbox.closest('td').toggleClass('nsl-admin-setting-disabled', !$checkbox.is(':checked'));
            });
        });
    })(jQuery);
</script>