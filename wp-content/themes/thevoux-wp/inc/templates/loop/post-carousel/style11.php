<article <?php post_class('post post-carousel-style11'); ?> itemscope itemtype="http://schema.org/Article">
	<figure class="post-gallery">
		<?php do_action('thb_categories', 'style2'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style1-2x'); ?></a>
	</figure>
	<div class="style11-content">
		<?php do_action( 'thb_displayTitle', 'h5'); ?>
		<?php do_action('thb_post_author'); ?>
		<?php do_action('thb_PostMeta'); ?>
	</div>
</article>