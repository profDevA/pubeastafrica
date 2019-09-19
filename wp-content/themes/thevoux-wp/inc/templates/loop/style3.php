<?php
	$vars = $wp_query->query_vars;
	$thb_offset_style = array_key_exists('thb_offset_style', $vars) ? $vars['thb_offset_style'] : '';
	$thb_class = array_key_exists('thb_class', $vars) ? $vars['thb_class'] : false;
	$thb_author = array_key_exists('thb_author', $vars) ? $vars['thb_author'] : false;
	$thb_excerpt = array_key_exists('thb_excerpt', $vars) ? $vars['thb_excerpt'] : true;
	add_filter( 'excerpt_length', 'thb_short_excerpt_length' );

	$classes[] = 'post style3';
	$classes[] = $thb_offset_style;
	$classes[] = $thb_class;
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class( $classes ); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php do_action('thb_post_icon'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style3'); ?></a>
	</figure>
	<?php } ?>
	<div class="offset-title-container">
		<?php do_action('thb_post_top', false, true); ?>
		<?php do_action( 'thb_displayTitle', 'h3' ); ?>
		<?php if ($thb_author) { ?>
		<?php do_action('thb_post_author'); ?>
		<?php } ?>
		<?php if ($thb_excerpt) { ?>
		<div class="post-content">
			<?php the_excerpt(); ?>
		</div>
		<?php } ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>