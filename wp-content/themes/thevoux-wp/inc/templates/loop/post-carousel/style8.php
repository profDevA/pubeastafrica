<?php
	$vars = $wp_query->query_vars;
	$thb_style = array_key_exists('thb_style', $vars) ? $vars['thb_style'] : 'featured-style4';
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-style1-2x';
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,$thb_image_size);
?>
<article <?php post_class('post center-category '. $thb_style); ?> itemscope itemtype="http://schema.org/Article">
	<div class="thb-placeholder">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail($thb_image_size); ?>
		</a>
	</div>
	<div class="featured-title">
		<?php do_action( 'thb_post_top', true, false); ?>
		<?php do_action( 'thb_displayTitle', 'h3' ); ?>
		<?php do_action( 'thb_post_author'); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>