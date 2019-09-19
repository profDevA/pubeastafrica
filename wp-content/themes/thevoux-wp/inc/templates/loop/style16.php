<?php
	$thb_excerpt_length = get_query_var('thb_excerpt_length') ? get_query_var('thb_excerpt_length') : 'thb_supershort_excerpt_length' ;
	$thb_title_size = get_query_var('thb_title_size') ? get_query_var('thb_title_size') : 'h3';
	$thb_image_size = get_query_var('thb_image_size') ? get_query_var('thb_image_size') : 'thevoux-style3';
	add_filter( 'excerpt_length', $thb_excerpt_length );
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style16'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php do_action('thb_post_icon'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($thb_image_size); ?></a>
	</figure>
	<?php } ?>
	<?php do_action( 'thb_displayTitle', $thb_title_size); ?>
	<div class="post-content small">
		<?php the_excerpt(); ?>
		<a href="<?php the_permalink(); ?>" class="btn accent pill-radius very-small"><?php esc_html_e( 'Read More', 'thevoux' ); ?></a>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>
