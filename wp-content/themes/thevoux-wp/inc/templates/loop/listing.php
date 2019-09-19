<?php
	$vars = $wp_query->query_vars;
	$thb_nocats = array_key_exists('thb_nocats', $vars) ? $vars['thb_nocats'] : false;
	$thb_noimage = array_key_exists('thb_noimage', $vars) ? $vars['thb_noimage'] : false;
	$thb_shares = array_key_exists('thb_shares', $vars) ? $vars['thb_shares'] : false;
	$thb_counts = array_key_exists('thb_counts', $vars) ? $vars['thb_counts'] : false;
	$thb_imagesize = array_key_exists('thb_imagesize', $vars) ? $vars['thb_imagesize'] : 'thumbnail';
	$thb_class = array_key_exists('thb_class', $vars) ? $vars['thb_class'] : false;

	$figure_classes[] = 'figure';
	$figure_classes[] = $thb_counts ? 'count-image' : false;
	$figure_classes[] = $thb_class;

?>
<li itemscope itemtype="http://schema.org/Article" <?php post_class('post listing'); ?>>
	<?php if (has_post_thumbnail() && !$thb_noimage) { ?>
	<a class="<?php echo esc_attr(implode(' ', $figure_classes)); ?>" href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
		<?php if($thb_counts) { ?><span class="count"><?php echo esc_attr($thb_counts); ?></span><?php } ?>
		<?php the_post_thumbnail($thb_imagesize); ?>
	</a>
	<?php } ?>
	<div class="listing_content">
		<?php if (!$thb_nocats) { ?>
		<?php do_action('thb_post_top', true, false); ?>
		<?php } ?>
		<?php do_action( 'thb_displayTitle', 'h6'); ?>
		<?php if ($thb_shares) { get_template_part( 'inc/templates/postbits/post-just-shares' ); } ?>
		<?php do_action('thb_PostMeta'); ?>
	</div>
</li>