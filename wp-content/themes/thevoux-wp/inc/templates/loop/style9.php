<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style1 style9'); ?>>
	<div class="row">
		<div class="small-12 medium-6 large-5 columns small-order-2 medium-order-1">
				<?php do_action('thb_post_top', true, true); ?>
				<?php do_action( 'thb_displayTitle', 'h3' ); ?>
				<div class="post-content small">
					<?php the_excerpt(); ?>
				</div>
				<?php do_action('thb_post_author'); ?>
				<?php get_template_part( 'inc/templates/postbits/post-links' ); ?>
		</div>
		<div class="small-12 medium-6 large-7 columns small-order-1 medium-order-2">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<?php do_action('thb_post_icon'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style9-3x'); ?></a>
			</figure>
			<?php } ?>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>