<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style8'); ?>>
	<div class="row">
		<div class="small-12 medium-4 columns">
			<?php if ( has_post_thumbnail() ) { ?>
			<figure class="post-gallery">
				<?php do_action('thb_post_icon'); ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2'); ?></a>
			</figure>
			<?php } ?>
		</div>
		<div class="small-12 medium-8 columns">
			<?php do_action('thb_post_top', true, false); ?>
			<?php do_action( 'thb_displayTitle', 'h5'); ?>
			<div class="post-content small">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>