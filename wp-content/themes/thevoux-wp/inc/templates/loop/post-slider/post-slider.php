<?php
	$vars = $wp_query->query_vars;
	$style = array_key_exists('thb_style', $vars) ? $vars['thb_style'] : 'featured-style1';
	$class = array_key_exists('thb_class', $vars) ? $vars['thb_class'] : false;
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-single-2x';
	$classes[] = 'post post-slider';
	$classes[] = $style;
	$classes[] = $class;
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class( $classes ); ?>>
	<figure class="post-gallery">
			<?php the_post_thumbnail($thb_image_size); ?>
	</figure>
	<div class="featured-title">
		<?php do_action('thb_post_top', true, false); ?>
		<?php do_action( 'thb_displayTitle', 'h3' ); ?>
		<?php do_action('thb_post_author'); ?>
		<?php if ($style === 'featured-style10') { get_template_part( 'inc/templates/postbits/post-links-style2' );  } ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>