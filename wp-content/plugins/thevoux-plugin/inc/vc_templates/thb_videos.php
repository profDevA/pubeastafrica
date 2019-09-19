<?php function thb_videos( $atts, $content = null ) {
	$style = 'style1';
  $atts = vc_map_get_attributes( 'thb_videos', $atts );
  extract( $atts );
	$args = array(
		'post_type'=>'post',
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
		'tax_query' => array(
	    array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => array(
          'post-format-video',
        ),
        'operator' => 'IN',
	    ),
		),
	);

	if ($offset) {
		$args = wp_parse_args(
			array(
				'offset' => $offset,
			)
		, $args );
	}
	if ($source == 'most-recent') {
		$args = wp_parse_args(
			array(
				'posts_per_page' => $item_count
			)
		, $args );
	} elseif ($source == 'by-category') {
	 	if (!empty($cat)) {
	 		$cats = explode(',',$cat);
	 		$args = wp_parse_args(
	 			array(
	 				'posts_per_page' => $item_count,
	 				'category__in' => $cats
	 			)
	 		, $args );
	 	}
	} elseif ($source == 'by-id') {
		$post_id_array = explode(',', $post_ids);

		$args = wp_parse_args(
			array(
				'post__in' => $post_id_array,
				'posts_per_page' => 99,
				'orderby' => 'post__in'
			)
		, $args );
	} elseif ($source == 'by-tag') {
		$post_tag_array = explode(',', $tag_slugs);

		$args = wp_parse_args(
			array(
				'posts_per_page' => $item_count,
				'tag_slug__in' => $post_tag_array
			)
		, $args );
	} elseif ($source == 'by-share') {
		$args = wp_parse_args(
			array(
				'posts_per_page' => $item_count,
				'meta_key' => 'thb_pssc_counts',
				'orderby' => 'meta_value_num'
			)
		, $args );
	} elseif ($source == 'by-author') {
		$post_author_array = explode(',', $author_ids);

		$args = wp_parse_args(
			array(
				'posts_per_page' => $item_count,
				'author__in' => $post_author_array
			)
		, $args );
	}
	$video_posts = new WP_Query( $args );
	global $wp_embed;

 	ob_start();
	if ( $video_posts->have_posts() ) { ?>
	<?php if ($style == 'style1') { ?>
		<div class="category_container style2">
			<div class="inner">
	<?php } ?>
				<?php if ($add_title === 'true') { ?>
					<div class="category_title <?php echo esc_attr($title_style); ?>">
						<h2><?php echo esc_html( $title ); ?></h2>
					</div>
				<?php } ?>
				<div class="video_playlist <?php echo esc_attr($style); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_video_playlist' ) ); ?>">
					<div class="row">

							<?php $i = 1; while ( $video_posts->have_posts() ) : $video_posts->the_post(); ?>
								<?php if ($style == 'style1') { ?>
									<?php if ($i == 1) { ?>
										<div class="small-12 large-8 columns video-side">
											<?php
												$video_url = get_post_meta(get_the_ID() , 'post_video', TRUE);
												if ($video_url !=='' && wp_oembed_get($video_url) ) {
													echo '<div class="flex-video widescreen">'.wp_oembed_get($video_url).'</div>';
												} else {
													echo wp_video_shortcode(array(
														"src" => $video_url
													));
												}
											?>
										</div>
										<div class="small-12 large-4 columns thb-play-list-holder">
											<div class="custom_scroll dark-scroll">
									<?php } ?>
										<?php
											$active = $i == 1 ? 'video-active' : false;
											set_query_var( 'active', $active);
											get_template_part( 'inc/templates/loop/playlist' );
										?>
									<?php if ($i == $video_posts->post_count) { ?>
											</div>
										</div>
									<?php } ?>
								<?php } elseif ($style == 'style2') { ?>
									<?php if ($i == 1) { ?>
										<div class="small-12 columns video-side">
											<?php
												$video_url = get_post_meta(get_the_ID() , 'post_video', TRUE);
												if ($video_url !=='' && wp_oembed_get($video_url) ) {
													echo '<div class="flex-video widescreen">'.wp_oembed_get($video_url).'</div>';
												} else {
													echo wp_video_shortcode(array(
														"src" => $video_url
													));
												}
											?>
										</div>
										<aside class="gap" style="height: 30px;"></aside>
										<div class="small-12 columns">
											<?php
												$count = $video_posts->post_count;
												$columns = $count > 4 ? 6 : max($count, 4);
											?>
											<div class="slick row" data-pagination="false" data-navigation="true" data-columns="<?php echo esc_attr($columns); ?>" data-autoplay="false" data-disablepadding="true">
												<?php } ?>
													<div class="columns">
													<?php
														$active = $i == 1 ? 'video-active' : false;
														set_query_var( 'active', $active);
														get_template_part( 'inc/templates/loop/playlist-vertical' );
													?>
													</div>
												<?php if ($i == $video_posts->post_count) { ?>
											</div>
										</div>
									<?php } ?>
								<?php } ?>
							<?php $i++; endwhile; // end of the loop. ?>
					</div>
				</div>
	<?php if ($style == 'style1') { ?>
			</div>
		</div>
	<?php } ?>
	<?php }

   $out = ob_get_clean();
   wp_reset_query();
   wp_reset_postdata();

  return $out;
}
thb_add_short('thb_videos', 'thb_videos');
