<article <?php post_class('post featured-style-carousel'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
	</figure>
	<?php do_action( 'thb_displayTitle', 'h6'); ?>
	<?php do_action('thb_PostMeta'); ?>
</article>