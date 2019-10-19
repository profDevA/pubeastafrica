<?php
/** @var $view string */

defined('ABSPATH') || die();

$settings = NextendSocialLogin::$settings;

$state = NextendSocialLoginAdmin::getProState();

function nsl_license_no_capability($view) {
    ?>
    <div class="nsl-box nsl-box-red nsl-box-error">
        <h2 class="title"><?php _e('Error', 'nextend-facebook-connect'); ?></h2>
        <p><?php _e('You don’t have sufficient permissions to install and activate plugins. Please contact your site’s administrator!', 'nextend-facebook-connect'); ?></p>
    </div>
    <?php
}

function nsl_license_installed($view) {
    ?>
    <div class="nsl-box nsl-box-blue">
        <h2 class="title"><?php _e('Activate Pro Addon', 'nextend-facebook-connect'); ?></h2>
        <p><?php _e('Pro Addon is installed but not activated. To be able to use the Pro features, you need to activate it.', 'nextend-facebook-connect'); ?></p>

        <p>
            <a href="<?php echo wp_nonce_url(add_query_arg(array(
                'action'        => 'activate',
                'plugin'        => urlencode('nextend-social-login-pro/nextend-social-login-pro.php'),
                'plugin_status' => 'all'
            ), admin_url('plugins.php')), 'activate-plugin_' . 'nextend-social-login-pro/nextend-social-login-pro.php'); ?>"
               target="_blank" onclick="setTimeout(function(){window.location.reload(true)}, 2000)"
               class="button button-primary"><?php _e('Activate Pro Addon', 'nextend-facebook-connect'); ?></a>
            <a href="<?php echo wp_nonce_url(add_query_arg(array(
                'action' => 'nextend-social-login',
                'view'   => 'pro-addon-deauthorize'
            ), admin_url('admin-post.php')), 'nextend-social-login'); ?>" class="button button-secondary">
				<?php _e('Deactivate Pro Addon', 'nextend-facebook-connect'); ?>
            </a>
        </p>
    </div>
    <?php
}

function nsl_license_not_installed($view) {
    $plugin_slug = 'nextend-social-login-pro';
    ?>
    <div class="nsl-box nsl-box-blue plugin-card-<?php echo $plugin_slug; ?>">
        <h2 class="title"><?php _e('Pro Addon is not installed', 'nextend-facebook-connect'); ?></h2>

        <p><?php _e('To access the Pro features, you need to install and activate the Pro Addon.', 'nextend-facebook-connect'); ?></p>

        <p class="submit">
            <a class="install-now button button-primary" data-slug="<?php echo $plugin_slug; ?>"
               href="<?php echo esc_url(wp_nonce_url(add_query_arg(array(
                   'action' => 'install-plugin',
                   'plugin' => $plugin_slug,
                   'from'   => 'nextend-facebook-connect',
               ), self_admin_url('update.php')), 'install-plugin_' . $plugin_slug)); ?>"
               aria-label="<?php echo esc_attr(sprintf(__('Install %s now'), 'Nextend Social Login PRO Addon')); ?>"
               data-name="<?php echo esc_attr('Nextend Social Login PRO Addon'); ?>"><?php _e('Install Pro Addon', 'nextend-facebook-connect'); ?></a>
        </p>
    </div>
    <script type="text/javascript">
		(function ($) {
            $(document).on('ready', function () {
                var $button = $('.install-now').on('click.nsl', function (event) {
                    if (typeof wp.updates.installPlugin === 'function') {
                        /** @since WordPress 4.6.0 */

                        event.preventDefault();

                        if ($button.hasClass('updating-message') || $button.hasClass('button-disabled')) {
                            return;
                        }

                        if (wp.updates.shouldRequestFilesystemCredentials && !wp.updates.ajaxLocked) {
                            wp.updates.requestFilesystemCredentials(event);

                            $(document).on('credential-modal-cancel', function () {
                                var $message = $('.install-now.updating-message');

                                $message.removeClass('updating-message').text(wp.updates.l10n.installNow);

                                wp.a11y.speak(wp.updates.l10n.updateCancel, 'polite');
                            });
                        }

                        wp.updates.installPlugin({
                            slug: $button.data('slug'),
                            success: function (response) {
                                if (response.activateUrl) {

                                    $button.addClass('updating-message')
                                        .text( <?php echo wp_json_encode(__('Activating...', 'nextend-facebook-connect'))?> );

                                    window.onNSLProActivate = function () {
                                        window.location.reload(true);
                                    };
                                    $('<iframe onload="onNSLProActivate()" src="' + response.activateUrl +
                                        '" style="visibility:hidden;"></iframe>').appendTo('body');
                                }
                            }
                        }).always(function () {
                            $button.off('.nsl');
                        });
                    }
                });
            });
        })(jQuery);
    </script>
    <?php
}

function nsl_not_compatible($view) {
    $file = 'nextend-social-login-pro/nextend-social-login-pro.php';
    ?>
    <div class="nsl-box nsl-box-blue">
        <h2 class="title"><?php _e('Not compatible!', 'nextend-facebook-connect'); ?></h2>
        <p><?php printf(__('%1$s and %2$s are not compatible. Please update %2$s to version %3$s or newer.', 'nextend-facebook-connect'), "Nextend Social Login", "Nextend Social Login Pro Addon", NextendSocialLogin::$nslPROMinVersion); ?></p>

        <p>
            <a href="<?php echo esc_url(wp_nonce_url(admin_url('update.php?action=upgrade-plugin&plugin=') . $file, 'upgrade-plugin_' . $file)); ?>"
               class="button button-primary"><?php _e('Update Pro Addon', 'nextend-facebook-connect'); ?></a>
        </p>
    </div>
    <?php
}

function nsl_license_activated($view) {
    ?>

    <div class="nsl-box nsl-box-green">
        <h2 class="title"><?php _e('Pro Addon is installed and activated', 'nextend-facebook-connect'); ?></h2>

        <p><?php _e('You installed and activated the Pro Addon. If you don’t want to use it anymore, you can deactivate using the button below.', 'nextend-facebook-connect'); ?></p>

        <p class="submit">
            <a href="<?php echo wp_nonce_url(add_query_arg(array(
                'action' => 'nextend-social-login',
                'view'   => 'pro-addon-deauthorize'
            ), admin_url('admin-post.php')), 'nextend-social-login'); ?>" class="button button-secondary">
				<?php _e('Deactivate Pro Addon', 'nextend-facebook-connect'); ?>
            </a>
        </p>
    </div>
    <?php
}


?>
<div class="nsl-admin-content">
	<?php
    switch ($state) {
        case 'no-capability':
            nsl_license_no_capability($view);
            break;
        case 'installed':
            nsl_license_installed($view);
            break;
        case 'not-installed':
            nsl_license_not_installed($view);
            break;
        case 'no-license':
            NextendSocialLoginAdmin::authorizeBox($view);
            break;
        case 'not-compatible':
            nsl_not_compatible($view);
            break;
        case 'activated':
            nsl_license_activated($view);
            break;
    }
    ?>
</div>