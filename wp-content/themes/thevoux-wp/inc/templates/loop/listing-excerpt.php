<?php
	add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
?>
<li itemscope itemtype="http://schema.org/Article" <?php post_class('post listing with-excerpt'); ?>>
	<a class="figure" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail('thumbnail'); ?>
	</a>
	<div class="listing_content">
		<?php do_action( 'thb_displayTitle', 'h5'); ?>
		<?php the_excerpt(); ?>
		<?php do_action('thb_PostMeta'); ?>
	</div>
</li>