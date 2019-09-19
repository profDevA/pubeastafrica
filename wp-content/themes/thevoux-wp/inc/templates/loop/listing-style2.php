<?php
	$image_id = get_post_thumbnail_id();
	$image_link = wp_get_attachment_image_src($image_id,'thevoux-widget-2x');

	$figure_classes[] = 'figure';
?>
<li itemscope itemtype="http://schema.org/Article" <?php post_class('post listing listing-style2'); ?>>
	<figure class="bg-figure" style="background-image: url(<?php echo esc_attr($image_link[0]); ?>)"></figure>
	<div class="listing_content">
		<?php do_action( 'thb_displayTitle', 'h6'); ?>
		<?php do_action('thb_PostMeta'); ?>
	</div>
	<?php get_template_part( 'inc/templates/postbits/post-just-shares' ); ?>
</li>
