<?php function thb_instagram_block( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_instagram_block', $atts );
	extract( $atts );

	$out ='';
	ob_start();

	$el_class[] = 'row instagram-row thb-instagram-block no-padding';
	$element_id = uniqid('thb-instagram-block-');

  $username = $username === '' ? ot_get_option( 'instagram_username') : $username;

  if ( ! $username ) {
	   esc_html_e( 'Please check your Instagram username.', 'thevoux' );
	}

	$instagram = thb_getInstagramPhotos(8, $username, $access_token);

	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $el_class)); ?>">
		<?php if (array_key_exists('error', $instagram)) { echo esc_html($instagram['error']); } ?>

		<?php if (array_key_exists('data', $instagram)) { $i = 0; foreach ($instagram['data'] as $item) { ?>
			<div class="small-6 medium-3 large-2 columns">
				<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
				<?php if ($link == 'true') { ?>
					<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
				<?php } ?>
				<span><?php get_template_part('assets/svg/like.svg'); ?><em><?php echo thb_numberAbbreviation($item['likes']); ?></em> <?php get_template_part('assets/svg/comment.svg'); ?><em><?php echo thb_numberAbbreviation($item['comments']); ?></em></span>
				</figure>
			</div>
			<?php if ( 1 === $i ) { ?>
				<div class="small-12 medium-6 large-4 thb-username-column thb-light-column columns">
					<span><i class="fa fa-instagram"></i> <?php echo esc_html($username); ?></span>
					<p><?php
						if (isset($instagram['user_data']['biography'])) {
							echo esc_html($instagram['user_data']['biography']);
						}
					?></p>
					<?php if (isset($instagram['user_data']['external_url'])) { ?>
							<a href="<?php echo esc_url($instagram['user_data']['external_url']); ?>" target="_blank"><?php echo esc_html($instagram['user_data']['external_url']); ?></a>
					<?php } ?>
				</div>
			<?php } ?>
			<?php if ( 5 === $i ) { ?>
				<div class="small-6 medium-3 large-2 thb-follower-column thb-light-column columns">
					<p><?php echo thb_numberAbbreviation(($instagram['user_data']['followed_by'])); ?></p>
					<span><?php esc_html_e( 'Followers', 'thevoux' ); ?></span>
				</div>
				<div class="small-6 medium-3 large-2 thb-following-column thb-light-column columns">
					<p><?php echo thb_numberAbbreviation(($instagram['user_data']['follow'])); ?></p>
					<span><?php esc_html_e( 'Following', 'thevoux' ); ?></span>
				</div>
			<?php } ?>
		<?php $i++; } } ?>
		<style>
			<?php if ($thb_color) { ?>
			#<?php echo esc_attr($element_id); ?> .thb-username-column {
				background: <?php echo esc_attr($thb_color); ?>;
			}
			<?php } ?>
			<?php if ($thb_color2) { ?>
			#<?php echo esc_attr($element_id); ?> .thb-follower-column {
				background: <?php echo esc_attr($thb_color2); ?>;
			}
			<?php } ?>
			<?php if ($thb_color3) { ?>
			#<?php echo esc_attr($element_id); ?> .thb-following-column {
				background: <?php echo esc_attr($thb_color3); ?>;
			}
			<?php } ?>
		</style>
	</div>
	<?php

	$out = ob_get_clean();

	return $out;
}
thb_add_short( 'thb_instagram_block', 'thb_instagram_block');