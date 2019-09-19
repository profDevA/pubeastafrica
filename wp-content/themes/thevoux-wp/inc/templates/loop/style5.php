<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<?php
	$vars = $wp_query->query_vars;
	$thb_excerpt = array_key_exists('thb_excerpt', $vars) ? $vars['thb_excerpt'] : false;
	$extend = $thb_excerpt ? ' extend' : '';
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style5' . $extend); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style2'); ?></a>
	</figure>
	<?php } ?>
	<?php do_action('thb_post_top', false, true); ?>
	<?php do_action( 'thb_displayTitle', 'h4'); ?>
	<?php if ($thb_excerpt) { ?>
	<div class="post-content">
		<?php the_excerpt(); ?>
	</div>
	<?php } ?>
	<?php do_action('thb_PostMeta'); ?>
</article>