<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-slider featured-style13 light-title'); ?>>
	<div class="featured-title row max_width">
		<div class="small-12 medium-8 large-6 columns">
			<?php do_action('thb_post_top', true, false); ?>
			<?php do_action( 'thb_displayTitle', 'h1' ); ?>
			<?php do_action('thb_post_author'); ?>
		</div>
	</div>
	<div class="parallax_bg"
				data-center-bottom="transform: translate3d(0px, -5%, 0px);"
				data-center-top="transform: translate3d(0px, 5%, 0px);">
		<?php the_post_thumbnail('full'); ?>
	</div>
	<?php do_action('thb_PostMeta'); ?>
</article>