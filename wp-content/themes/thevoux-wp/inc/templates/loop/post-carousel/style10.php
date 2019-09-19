<article <?php post_class('post post-carousel-style10'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2'); ?></a>
	</figure>
	<?php do_action( 'thb_displayTitle', 'h6'); ?>
	<?php do_action('thb_PostMeta'); ?>
</article>