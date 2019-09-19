<?php
	$thb_id = get_the_ID();
	$vars = $wp_query->query_vars;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-single-2x';
	$featured_image_credit = get_post_meta($thb_id, 'standard-featured-credit', true);
?>
<?php if ( has_post_thumbnail() ) { ?>
	<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), $thb_image_size); ?>
	<figure class="post-detail-gallery">
		<?php the_post_thumbnail($thb_image_size); ?>
		<?php if ($featured_image_credit) { ?>
			<figcaption class="featured_image_credit"><?php echo esc_attr($featured_image_credit); ?></figcaption>
		<?php } ?>
	</figure>
<?php } else { ?>
	<p class="text-center"><strong><?php esc_html_e('Please select a featured image for your post', 'thevoux' ); ?></strong></p>
<?php } ?>