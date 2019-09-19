<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
	$vars = $wp_query->query_vars;
	$thb_columns = array_key_exists('thb_columns', $vars) ? $vars['thb_columns'] : false;
?>
<div class="small-12 medium-6 <?php echo esc_attr($thb_columns); ?> columns">
<article <?php post_class('post style-masonry style-masonry-3'); ?> itemscope itemtype="http://schema.org/Article">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php do_action('thb_post_icon'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-masonry-2x'); ?></a>
	</figure>
	<?php } ?>
	<?php do_action('thb_post_top', true, true); ?>
	<?php do_action( 'thb_displayTitle', 'h4' ); ?>
	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>
</div>
