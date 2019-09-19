<?php add_filter( 'excerpt_length', 'thb_short_excerpt_length' ); ?>
<?php
	$vars = $wp_query->query_vars;
	$disable_excerpts = array_key_exists('disable_excerpts', $vars) ? $vars['disable_excerpts'] : false;
	$disable_postmeta = array_key_exists('disable_postmeta', $vars) ? $vars['disable_postmeta'] : false;
?>
<article itemscope itemtype="http://schema.org/Article" <?php post_class('post style6'); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
		<?php do_action('thb_post_icon'); ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('thevoux-style1-2x'); ?></a>
	</figure>
	<?php } ?>
	<?php if ($disable_postmeta !== 'true') { ?>
	<?php do_action('thb_post_top', true, true); ?>
	<?php } ?>
	<?php do_action( 'thb_displayTitle', 'h5'); ?>
	<?php if ($disable_excerpts !== 'true') { ?>
	<div class="post-content small">
		<?php the_excerpt(); ?>
	</div>
	<?php } ?>
	<?php do_action('thb_PostMeta'); ?>
</article>