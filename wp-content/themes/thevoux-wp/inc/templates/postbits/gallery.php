<?php
	$thb_id = get_the_ID();
	$vars = $wp_query->query_vars;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-single-2x';

	$post_gallery_photos = get_post_meta($thb_id, 'post-gallery-photos', true);
	if ($post_gallery_photos) {
		$post_gallery_photos_arr = explode(',', $post_gallery_photos);
		$count = count($post_gallery_photos_arr);
	}
	$featured_image_credit = get_post_meta($thb_id, 'standard-featured-credit', true);
?>
<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-detail-gallery">
		<?php $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), $thb_image_size); ?>
		<?php the_post_thumbnail($thb_image_size); ?>
		<?php if ($post_gallery_photos) { ?>
		<a href="#post-gallery-<?php the_ID(); ?>" class="gallery-link">
			<?php get_template_part( 'assets/svg/gallery.svg'); ?>
			<div>
				<span class="thb-view-gallery"><?php esc_html_e('View Gallery', 'thevoux' ); ?></span>
				<span class="thb-count-gallery"><?php echo esc_attr($count); ?> <?php esc_html_e('Photos', 'thevoux' ); ?></span>
			</div>
		</a>
		<?php } else { ?>
		<a href="#" class="gallery-link empty"><div class="rel"><?php esc_html_e('Please Add Photos <br> to your Gallery', 'thevoux' ); ?></div></a>
		<?php } ?>
		<?php if ($featured_image_credit) { ?>
			<figcaption class="featured_image_credit"><?php echo esc_attr($featured_image_credit); ?></figcaption>
		<?php } ?>
	</figure>
<?php } else { ?>
	<p class="text-center"><strong><?php esc_html_e('Please select a featured image for your post', 'thevoux' ); ?></strong></p>
<?php } ?>
<?php get_template_part( 'inc/templates/postbits/post-gallery-lightbox' ); ?>
