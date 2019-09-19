<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-slider featured-style14 light-title'); ?>>
	<div class="row no-padding">
		<div class="small-12 medium-8 columns image-side">
			<div class="post-gallery">
				<?php the_post_thumbnail('thevoux-single-3x'); ?>
			</div>
		</div>
		<div class="small-12 medium-4 columns content-side">
			<div class="featured-title">
				<?php do_action('thb_post_top', true, true); ?>
				<?php do_action( 'thb_displayTitle', 'h1' ); ?>
				<?php do_action('thb_post_author'); ?>
			</div>
		</div>
	<?php do_action('thb_PostMeta'); ?>
</article>