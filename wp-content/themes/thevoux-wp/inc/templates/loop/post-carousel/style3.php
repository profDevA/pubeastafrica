<article <?php post_class('post featured-style5'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style1-2x'); ?></a>
	</figure>
	<?php do_action( 'thb_displayTitle', 'h5'); ?>
	<?php do_action('thb_PostMeta'); ?>
</article>