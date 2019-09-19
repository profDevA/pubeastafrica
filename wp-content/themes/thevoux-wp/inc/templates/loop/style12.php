<?php
	add_filter( 'excerpt_length', 'thb_long_excerpt_length' );
	$vars = $wp_query->query_vars;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-style1-2x';
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style12 center-category'); ?>>

	<header class="post-title entry-header">
		<?php do_action('thb_post_top', true, false); ?>
		<h1 itemprop="headline"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		<?php get_template_part( 'inc/templates/postbits/post-shares-comments' ); ?>
	</header>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php do_action('thb_post_icon'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($thb_image_size); ?></a>
	</figure>
	<?php } ?>
	<div class="post-content small">
		<?php the_excerpt(); ?>
		<p class="text-center">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more-link"><?php esc_html_e('Read More', 'thevoux' ); ?></a>
		</p>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>
