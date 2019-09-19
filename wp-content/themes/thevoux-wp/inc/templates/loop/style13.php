<?php
	add_filter( 'excerpt_length', 'thb_widget_excerpt_length' );

	$vars = $wp_query->query_vars;
	$thb_i = array_key_exists('thb_i', $vars) ? $vars['thb_i'] : '';
	$classes[] = 'post style13';
	$classes[] = 'center-category';

	$class_first = ($thb_i % 2 == 0) ? 'medium-order-2' : '';
	$class_second = ($thb_i % 2 == 0) ? 'medium-order-1' : '';
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class( $classes ); ?>>
	<div class="row no-padding">
		<div class="small-12 medium-7 small-order-1 columns <?php echo esc_attr($class_first); ?>">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<?php do_action('thb_post_icon'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2-2x'); ?></a>
			</figure>
			<?php } ?>
		</div>
		<div class="small-12 medium-5 small-order-2 columns content-side <?php echo esc_attr($class_second); ?>">
			<div class="style13-content">
				<div>
					<?php do_action('thb_post_top', true, true); ?>
					<?php do_action( 'thb_displayTitle', 'h2' ); ?>
					<div class="post-content small">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<?php get_template_part( 'inc/templates/postbits/post-links-style2' ); ?>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>
