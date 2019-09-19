<?php
  $thb_id = get_the_ID();
  $tags = wp_get_post_tags($thb_id);

	if ($tags) {
	  $tag_ids = array();
		foreach($tags as $individual_tag) { $tag_ids[] = $individual_tag->term_id; }
	  $args = array(
	    'tag__in' => $tag_ids,
	    'post__not_in' => array($thb_id),
	    'posts_per_page' => ot_get_option( 'related_count', '6'),
	    'ignore_sticky_posts' => 1,
	    'no_found_rows' => true,
	  );
	$related_posts = new WP_Query( $args );

	if ($related_posts->have_posts()) : ?>
	<!-- Start Related Posts -->
	<div class="row post">
		<aside class="small-12 columns post-content related-posts">
			<h4><strong><?php esc_html_e( 'You May Also Like', 'thevoux' ); ?></strong></h4>
			<div class="row relatedposts hide-on-print">
			  <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
			    <div class="small-6 medium-4 columns">
			    	<?php
			    		set_query_var( 'thb_class', 'related-post' );
			    		get_template_part( 'inc/templates/loop/mega-menu-style1' );
			    	?>
			    </div>
			  <?php endwhile; ?>
			</div>
		</aside>
	</div>
	<!-- End Related Posts -->
	<?php endif;
	}
	wp_reset_postdata();
