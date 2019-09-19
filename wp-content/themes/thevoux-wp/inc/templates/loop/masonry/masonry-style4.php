<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
	$vars = $wp_query->query_vars;
	$thb_columns = array_key_exists('thb_columns', $vars) ? $vars['thb_columns'] : false;
?>
<div class="small-12 medium-6 <?php echo esc_attr($thb_columns); ?> columns">
<article <?php post_class('post post-carousel-style11'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<?php do_action('thb_categories', 'style2'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-masonry-2x'); ?></a>
	</figure>
	<div class="style11-content">
		<?php do_action( 'thb_displayTitle', 'h5' ); ?>
		<?php do_action('thb_post_author'); ?>
		<?php do_action('thb_PostMeta'); ?>
	</div>
</article>
</div>