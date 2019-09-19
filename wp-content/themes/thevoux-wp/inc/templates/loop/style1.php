<?php
	$vars = $wp_query->query_vars;
	$thb_class = array_key_exists('thb_class', $vars) ? $vars['thb_class'] : false;
	$thb_author = array_key_exists('thb_author', $vars) ? $vars['thb_author'] : false;
	$thb_noexcerpt = array_key_exists('thb_noexcerpt', $vars) ? $vars['thb_noexcerpt'] : false;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-style1-2x';
	$thb_sharestyle = array_key_exists('thb_sharestyle', $vars) ? $vars['thb_sharestyle'] : 'post-links';
	remove_filter( 'excerpt_length', 'thb_short_excerpt_length' );
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );


	$classes[] = 'post style1';
	$classes[] = $thb_class;
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class( $classes ); ?>>
	<div class="row align-middle">
		<div class="small-12 medium-5 large-6 columns">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<?php do_action('thb_post_icon'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail($thb_image_size); ?></a>
			</figure>
			<?php } ?>
		</div>
		<div class="small-12 medium-7 large-6 columns">
			<div class="thb-post-style1-content">
				<?php do_action( 'thb_post_top', true, true); ?>
				<?php do_action( 'thb_displayTitle', 'h3' ); ?>
				<?php if ($thb_author) { ?>
				<?php do_action('thb_post_author'); ?>
				<?php } ?>
				<div class="post-content small">
					<?php if (!$thb_noexcerpt) { the_excerpt(); } ?>
					<?php get_template_part( 'inc/templates/postbits/'.$thb_sharestyle ); ?>
				</div>
			</div>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>
