<article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-slider featured-style12 light-title'); ?>>
	<div class="featured-title row max_width">
		<div class="small-12 medium-offset-2 medium-8 large-offset-0 large-7 columns">
			<?php do_action('thb_post_top', true, false); ?>
			<?php do_action( 'thb_displayTitle', 'h1' ); ?>
			<?php do_action('thb_post_author'); ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="btn transparent-white small"><?php esc_html_e('READ MORE', 'thevoux' ); ?></a>
		</div>
	</div>
	<div class="parallax_bg"
				data-center-bottom="transform: translate3d(0px, -5%, 0px);"
				data-center-top="transform: translate3d(0px, 5%, 0px);"><?php the_post_thumbnail('full'); ?></div>
	<?php do_action('thb_PostMeta'); ?>
</article>