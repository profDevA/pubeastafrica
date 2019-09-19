<?php
	$thb_id = get_the_ID();
	$embed = get_post_meta($thb_id, 'post_video', TRUE);
	$vars = $wp_query->query_vars;
	$active = array_key_exists('active', $vars) ? $vars['active'] : false;
?>
<a href="#" class="post video_play vertical text-center <?php echo esc_attr($active); ?>" data-video-url="<?php echo esc_attr($embed); ?>" data-post-id="<?php the_ID(); ?>">
	<?php if ( has_post_thumbnail() ) { ?>
	<figure class="post-gallery">
			<?php the_post_thumbnail('thevoux-style1'); ?>
	</figure>
	<?php } ?>
	<header class="post-title entry-header">
		<?php the_title('<h6>', '</h6>'); ?>
	</header>
</a>