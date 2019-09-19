<?php function thb_postgrid( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_postgrid', $atts );
  extract( $atts );
  global $wp_query;
  $paged = 1;
  if ( $pagination ) {
    if ( get_query_var('paged') ) {
    	$paged = get_query_var('paged');
    } elseif ( get_query_var('page') ) {
    	$paged = get_query_var('page');
    }
  }
	$source .= '|paged:'.$paged;
	$source .= '|offset:'.$offset;
	$source_data = VcLoopSettings::parseData( $source );
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$thb_posts = $query_builder->build();
	$thb_posts = $thb_posts[1];

	$temp_query = $wp_query;
	$wp_query = $thb_posts;
 	ob_start();

  $rand = mt_rand(10, 99);

 	$classes[] = 'posts';
 	$classes[] = 'post-grid-'.$style;
 	$classes[] = $style.'-posts';
 	$classes[] = $pagination == "true" ? 'ajaxify-pagination' : false;
  $classes[] = in_array($pagination, array('style2', 'style3')) ? 'pagination-'.$pagination : false;
  $classes[] = in_array($style, array('style1', 'style4', 'style11')) ? 'row columns-'.$columns : false;
  $classes[] = in_array($style, array('style2','style2-alt', 'style5', 'style7')) ? 'border' : false;
  $classes[] = $style == 'style3' ? 'border-vertical row no-padding full-width-row': false;
  $classes[] = in_array($style, array('style8', 'style10', 'style13')) ? 'row' : false;

  $post_count = $thb_posts->post_count;

	if ( $thb_posts->have_posts() ) { ?>
		<?php if ($add_title === 'true') { ?>
			<div class="category_title <?php echo esc_attr($title_style); ?>">
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
		<?php } ?>
    <div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" data-loadmore="#loadmore-<?php echo esc_attr( $rand ); ?>" data-rand="<?php echo esc_attr($rand); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_posts_ajax' ) ); ?>">
    <?php $i = 1; while ( $thb_posts->have_posts() ) : $thb_posts->the_post(); ?>
      <?php thb_DisplayPostGrid($style, $columns, $disable_excerpts, $disable_postmeta, $featured_index, $i, $post_count); ?>
    <?php $i++; endwhile; // end of the loop. ?>
    <?php
      if ( $pagination === 'true') {
        the_posts_pagination(array(
          'prev_text' => '<span>' . esc_html__( '&larr;', 'thevoux' ) . '</span>',
          'next_text' => '<span>' . esc_html__( '&rarr;', 'thevoux' ) . '</span>',
          'mid_size'  => 2,
        ));
      } elseif ( $pagination === 'style2' || $pagination === 'style3' ) {
     		wp_localize_script( 'thb-app', 'thb_postajax_'.$rand, array(
          'style'          => $style,
          'loop'           => $source,
          'count'          => $source_data['size'],
          'columns'        => $columns,
          'featured_index' => $featured_index,
        ) );
     	}
    ?>
    <?php if ( $pagination === 'style2' ) { ?>
      <div class="text-center masonry_loader">
        <a class="masonry_btn thb-text-button" id="loadmore-<?php echo esc_attr($rand); ?>"><?php esc_html_e( 'Load More', 'thevoux' ); ?></a>
      </div>
    <?php } ?>
    </div>
	<?php }
	set_query_var( 'thb_style', false );
	set_query_var( 'thb_image_size', false );
	set_query_var( 'thb_class', false );

	$out = ob_get_clean();
	$wp_query = $temp_query;
	wp_reset_query();
	wp_reset_postdata();

  return $out;
}
thb_add_short('thb_postgrid', 'thb_postgrid');
