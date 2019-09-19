<div <?php post_class('post listing'); ?>>
	<?php if (has_post_thumbnail()) { ?>
	<a class="figure" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail(); ?>
	</a>
	<?php } ?>
	<div class="listing_content">
		<?php do_action( 'thb_displayTitle', 'h6'); ?>
		<?php do_action('thb_post_top', false, true); ?>
	</div>
</div>