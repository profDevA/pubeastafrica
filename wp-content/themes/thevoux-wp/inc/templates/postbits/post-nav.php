<?php

if ( ot_get_option( 'article_prevnext', 'on') === 'off') {
  return;
}

?>
<div class="article-navigation">
	<div class="row">
		<div class="small-12 medium-6 columns">
			<?php
			$prev_post = get_adjacent_post(false, '', true);

			if (!empty($prev_post)) {
				$excerpt = $prev_post->post_content;
				$previd = $prev_post->ID;
				?>

				<a href="<?php echo esc_url(get_permalink($previd)); ?>" class="post-nav-link prev">
					<?php get_template_part( 'assets/svg/arrow_prev.svg'); ?>
					<span><?php echo esc_html__('Previous Article', 'thevoux' ); ?></span>
					<h6><?php echo wp_kses_post($prev_post->post_title); ?></h6>
				</a>
				<?php
			} else {
				?>
				<span><?php echo esc_html__('No Older Articles', 'thevoux' ); ?></span>
				<?php
			}
		?>
		</div>
		<div class="small-12 medium-6 columns">
			<?php
				$next_post = get_adjacent_post(false, '', false);

				if (!empty($next_post)) {
					$excerptnext = $next_post->post_content;
					$nextid = $next_post->ID;
					?>
					<a href="<?php echo esc_url(get_permalink($nextid)); ?>" class="post-nav-link next">
  					<span><?php echo esc_html__('Next Article', 'thevoux' ); ?></span>
  					<h6><?php echo wp_kses_post($next_post->post_title); ?></h6>
  					<?php get_template_part( 'assets/svg/arrow_next.svg'); ?>
					</a>
					<?php
				} else {
				  ?>
					<span><?php echo esc_html__('No Newer Articles', 'thevoux' ); ?></span>
					<?php
				}
			?>
		</div>
	</div>
</div>