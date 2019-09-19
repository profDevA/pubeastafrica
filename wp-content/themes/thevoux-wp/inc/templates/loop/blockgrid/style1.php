<?php
	$classes[] = 'post';
	$classes[] = 'post-blockgrid-style1';
	$classes[] = 'light-title';
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class( $classes ); ?>>
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('thevoux-style1-2x'); ?>
		</a>
		<div class="featured-title">
			<?php do_action('thb_post_top', true, false); ?>
			<?php do_action( 'thb_displayTitle', 'h3' ); ?>
			<?php get_template_part( 'inc/templates/postbits/post-links-style2' ); ?>
		</div>
	</figure>
	<?php do_action('thb_PostMeta'); ?>
</article>