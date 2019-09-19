<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style2'); ?>>
	<div class="row">
		<div class="small-12 medium-5 large-6 columns">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<?php do_action('thb_post_icon'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2-2x'); ?></a>
			</figure>
			<?php } ?>
		</div>
		<div class="small-12 medium-7 large-6 columns">
				<?php do_action('thb_post_top', true, true); ?>
				<?php do_action( 'thb_displayTitle', 'h3' ); ?>
				<?php do_action('thb_post_author'); ?>
				<div class="post-content small">
					<?php get_template_part( 'inc/templates/postbits/post-links' ); ?>
				</div>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>
