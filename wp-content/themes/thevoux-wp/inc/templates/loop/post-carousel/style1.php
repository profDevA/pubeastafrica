<?php
	$vars = $wp_query->query_vars;
	$thb_style = array_key_exists('thb_style', $vars) ? $vars['thb_style'] : 'featured-style4';
	$thb_image_size = array_key_exists('thb_image_size', $vars) ? $vars['thb_image_size'] : 'thevoux-style1-2x';
?>
<article <?php post_class('post cover-image light-title '. $thb_style); ?> itemscope itemtype="http://schema.org/Article">
	<div class="thb-placeholder">
		<?php the_post_thumbnail($thb_image_size); ?>
	</div>
	<div class="featured-title">
		<?php do_action('thb_post_top', true, false); ?>
		<?php do_action( 'thb_displayTitle', 'h3' ); ?>
		<div class="post-content small">
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more"><?php esc_html_e('Read More &rarr;', 'thevoux' ); ?></a>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>