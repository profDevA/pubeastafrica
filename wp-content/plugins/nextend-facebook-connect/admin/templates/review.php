<?php

$state = NextendSocialLogin::$settings->get('review_state');

if ((0 < $state && $state < 5) || $state == 6) {
    // Rated 1, 2, 3, 4 OR 6
    return;
}
?>

<?php if ($state == -1): ?>
    <div class="nsl-box-review nsl-box-review-step-1" data-stars="0">
    <div class="nsl-box-review-bigstar"></div>
    <div class="nsl-box-review-label" data-star="0"><?php _e('Rate your experience!', 'nextend-facebook-connect'); ?></div>
    <div class="nsl-box-review-label" data-star="1"><?php _e('Hated it', 'nextend-facebook-connect'); ?></div>
    <div class="nsl-box-review-label" data-star="2"><?php _e('Disliked it', 'nextend-facebook-connect'); ?></div>
    <div class="nsl-box-review-label" data-star="3"><?php _e('It was ok', 'nextend-facebook-connect'); ?></div>
    <div class="nsl-box-review-label" data-star="4"><?php _e('Liked it', 'nextend-facebook-connect'); ?></div>
    <div class="nsl-box-review-label" data-star="5"><?php _e('Loved it', 'nextend-facebook-connect'); ?></div>
    <div class="nsl-box-review-stars-container">
        <div class="nsl-box-review-star" data-star="1" data-href="<?php echo esc_attr(NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/contact-us/suggestion/', 'dashboard-review-1')); ?>"></div>
        <div class="nsl-box-review-star" data-star="2" data-href="<?php echo esc_attr(NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/contact-us/suggestion/', 'dashboard-review-2')); ?>"></div>
        <div class="nsl-box-review-star" data-star="3" data-href="<?php echo esc_attr(NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/contact-us/satisfaction-feedback/', 'dashboard-review-3')); ?>"></div>
        <div class="nsl-box-review-star" data-star="4" data-href="<?php echo esc_attr(NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/contact-us/satisfaction-feedback/', 'dashboard-review-4')); ?>"></div>
        <div class="nsl-box-review-star" data-star="5"></div>
    </div>
</div>
<?php endif; ?>

<div class="nsl-box-review nsl-box-review-star-5" <?php if ($state != 5): ?>style="display:none;"<?php endif; ?>>
    <h3><?php _e('Please Leave a Review', 'nextend-facebook-connect'); ?></h3>
    <div class="nsl-box-review-star-5-description"><?php _e('If you are happy with <b>Nextend Social Login</b> and can take a minute please leave us a review. It will be a tremendous help for us!', 'nextend-facebook-connect'); ?></div>
    <div class="nsl-box-review-star-5-primary">
        <a href="<?php echo esc_attr(NextendSocialLoginAdmin::trackUrl('https://nextendweb.com/redirect/nsl-review.html', 'dashboard-review-5')); ?>" target="_blank" class="button button-primary"><?php _e('Ok, you deserve it', 'nextend-facebook-connect'); ?></a>
    </div>

    <div class="nsl-box-review-star-5-close"></div>
</div>
<script>
	(function ($) {
        $(document).ready(function () {
            var $box = $('.nsl-box-review-step-1'),
                $box5 = $('.nsl-box-review-star-5'),
                updateReviewState = function (state) {
                    $.post(ajaxurl, {
                        'action': 'nsl_save_review_state',
                        'review_state': state,
                        '_ajax_nonce': <?php echo wp_json_encode(wp_create_nonce('nsl_save_review_state')); ?>
                    });
                };
            $box.find('.nsl-box-review-star').on({
                mouseenter: function () {
                    $box.attr('data-stars', $(this).data('star'));
                },
                click: function (e) {
                    e.preventDefault();

                    var star = parseInt($(this).data('star'));
                    if (star < 5) {
                        var win = window.open($(this).data('href'), '_blank');

                        $box.remove();

                        updateReviewState(star);

                        win.focus();
                    } else {
                        updateReviewState(5);
                        $box.remove();
                        $box5.css('display', '');
                    }
                }
            });
            $box.find('.nsl-box-review-stars-container').on({
                mouseleave: function () {
                    $box.attr('data-stars', 0);
                }
            });

            $box5.find('a, .nsl-box-review-star-5-close').on('click', function () {
                $box5.remove();
                updateReviewState(6);
            });
        });
    })(jQuery);
</script>