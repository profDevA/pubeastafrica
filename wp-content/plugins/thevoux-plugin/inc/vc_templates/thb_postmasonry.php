<?php function thb_postmasonry( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_postmasonry', $atts );
	extract( $atts );

	$source .= '|offset:'.$offset;
	$source_data = VcLoopSettings::parseData( $source );
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$masonry_posts = $query_builder->build();
	$masonry_posts = $masonry_posts[1];

	$rand = mt_rand(10, 99);

 	ob_start();

	if ( $masonry_posts->have_posts() ) { ?>
		<div class="row posts masonry" data-loadmore="#loadmore-<?php echo esc_attr($rand); ?>" data-rand="<?php echo esc_attr($rand); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_ajax' ) ); ?>">
			<?php
				while ( $masonry_posts->have_posts() ) : $masonry_posts->the_post();
				set_query_var( 'thb_columns', $columns );
				get_template_part( 'inc/templates/loop/masonry/masonry-'.$style );
				endwhile; // end of the loop.
			?>
		</div>
		<?php
			wp_localize_script( 'thb-app', 'thb_postajax_'.$rand, array(
				'style'   => $style,
				'count'   => $source_data['size'],
				'loop'    => $source,
				'columns' => $columns,
			) );
		?>
		<?php if ($loadmore) { ?>
			<div class="text-center">
				<a class="masonry_btn btn black small" href="#" id="loadmore-<?php echo esc_attr($rand); ?>"><?php esc_html_e( 'Load More', 'thevoux' ); ?></a>
			</div>
		<?php } ?>
	<?php }

  $out = ob_get_clean();

  wp_reset_query();
  wp_reset_postdata();

  return $out;
}
thb_add_short('thb_postmasonry', 'thb_postmasonry');
