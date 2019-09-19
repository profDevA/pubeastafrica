<?php function thb_postcategory( $atts, $content = null ) {
	$add_title = 'true';
  $atts = vc_map_get_attributes( 'thb_postcategory', $atts );
	extract( $atts );

	switch($style) {
		case 'style5':
			$ppp = 4;
			break;
		case 'style6':
			$ppp = 6;
			break;
		default:
			$ppp = 5;
			break;
	}
	$args = array(
		'cat' => $cat,
		'posts_per_page' => $ppp,
		'ignore_sticky_posts' => 1,
		'no_found_rows' => true
	);
	if ($offset) {
		$args = wp_parse_args(
			array(
				'offset' => $offset,
			)
		, $args );
	}
	$posts = new WP_Query( $args );
 	$i = 0;
 	ob_start();

	if ( $posts->have_posts() ) { ?>
		<div class="row endcolumn catelement-<?php echo esc_attr($style); ?>">
			<?php if ($style !== 'style4' && $add_title == 'true') { ?>
					<div class="small-12 columns">
						<div class="category_title catstyle-<?php echo esc_attr($style. ' '.$title_style); ?>">
							<h2><a href="<?php echo get_category_link($cat); ?>" title="<?php echo get_cat_name( $cat ); ?>"><?php echo get_cat_name( $cat ); ?></a></h2>
						</div>
					</div>
			<?php } ?>
	  		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
	  			<?php if ($style == 'style1' || $style == 'style1-alt') { ?>
	  				<?php if ($style == 'style1-alt') { set_query_var( 'thb_offset_style', 'offset-title' ); } ?>
		  			<?php if ($i == 0) { ?>
		  				<div class="small-12 medium-6 columns">
		  					<?php get_template_part( 'inc/templates/loop/style3' ); ?>
		  				</div>
		  				<div class="small-12 medium-6 columns">
		  			<?php } ?>
			  			<?php if ($i == 1 || $i == 3) { ?>
			  					<div class="row">
			  			<?php } ?>
			  			<?php if ($i > 0) { ?>
			  						<div class="small-12 medium-6 columns">
			  							<?php get_template_part( 'inc/templates/loop/style3-small' ); ?>
			  						</div>
			  			<?php } ?>
			  			<?php if ($i + 1 == $posts->post_count ||$i == 2 || $i == 4) { ?>
			  					</div>
			  			<?php } ?>
		  			<?php if ($i + 1 == $posts->post_count) { ?>
	  					</div>
	  				<?php } ?>
	  			<?php } elseif ($style == 'style2') { ?>
	  				<?php if ($i == 0) { ?>
  						<div class="small-12 medium-6 columns">
  							<?php get_template_part( 'inc/templates/loop/style3' ); ?>
  						</div>
  					<?php } ?>
  					<?php if ($i > 0) { ?>
  						<?php if ($i == 1) { ?>
  							<div class="small-12 medium-6 columns">
  								<ul class="post-category-listing">
  						<?php } ?>
  						<?php if ($i > 0) { ?>
  							<?php set_query_var( 'excerpts', false ); ?>
  							<?php get_template_part( 'inc/templates/loop/listing' ); ?>
  						<?php } ?>
  						<?php if ($i + 1 == $posts->post_count) { ?>
  								</ul>
  							</div>
  						<?php } ?>
  					<?php } ?>
	  			<?php } elseif ($style == 'style3') { ?>

	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
	  						<?php get_template_part( 'inc/templates/loop/style3' ); ?>
	  						<ul class="post-category-listing">
	  				<?php } ?>
	  					<?php if ($i > 0) { ?>
	  						<?php set_query_var( 'thb_nocats', true ); ?>
  							<?php get_template_part( 'inc/templates/loop/listing' ); ?>
	  					<?php } ?>
	  				<?php if ($i + 1 == $posts->post_count) { ?>
	  						</ul>
  						</div>
  					<?php } ?>
	  			<?php } elseif ($style == 'style3-alt') { ?>

	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
	  						<?php get_template_part( 'inc/templates/loop/style3' ); ?>
	  						<ul class="post-category-listing">
	  				<?php } ?>
	  					<?php if ($i > 0) { ?>
	  						<?php set_query_var( 'thb_nocats', true ); ?>
	  						<?php get_template_part( 'inc/templates/loop/listing' ); ?>
	  					<?php } ?>
	  				<?php if ($i + 1 == $posts->post_count) { ?>
	  						</ul>
	  					</div>
	  				<?php } ?>
	  			<?php } elseif ($style == 'style3-nothumbs') { ?>
	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
	  						<?php set_query_var( 'thb_class', 'style3-nothumbs' ); ?>
	  						<?php set_query_var( 'thb_author', true ); ?>
	  						<?php get_template_part( 'inc/templates/loop/style3' ); ?>
	  						<?php set_query_var( 'thb_author', false ); ?>
	  						<ul class="post-category-listing">
	  				<?php } ?>
	  					<?php if ($i > 0) { ?>
	  						<?php set_query_var( 'thb_nocats', true ); ?>
	  						<?php set_query_var( 'thb_noimage', true ); ?>
	  						<?php get_template_part( 'inc/templates/loop/listing' ); ?>
	  						<?php set_query_var( 'thb_noimage', false ); ?>
	  						<?php set_query_var( 'thb_nocats', false ); ?>
	  					<?php } ?>
	  				<?php if ($i + 1 == $posts->post_count) { ?>
	  						</ul>
	  					</div>
	  				<?php } ?>
	  			<?php } elseif ($style == 'style4') { ?>
	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
		  					<div class="category_container">
		  						<div class="inner">
		  							<div class="category_title catstyle-<?php echo esc_attr($style); ?>">
		  								<h2><a href="<?php echo get_category_link($cat); ?>" title="<?php echo get_cat_name( $cat ); ?>"><?php echo get_cat_name( $cat ); ?></a></h2>
		  							</div>
		  							<div class="small-12 medium-3 columns">
		  								<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
  					<?php } ?>
	  					<?php if ($i == 1) { ?>
	  							<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
	  						</div>
	  					<?php } ?>
	  					<?php if ($i == 2) { ?>
	  						<div class="small-12 medium-6 columns">
								<?php set_query_var( 'thb_excerpt', true ); get_template_part( 'inc/templates/loop/style5' ); ?>
							</div>
						<?php } ?>
						<?php if ($i == 3) { ?>
							<div class="small-12 medium-3 columns">
								<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
						<?php } ?>
						<?php if ($i == 4) { ?>
								<?php set_query_var( 'thb_excerpt', false ); get_template_part( 'inc/templates/loop/style5' ); ?>
							</div>
						<?php } ?>
  					<?php if ($i + 1 == $posts->post_count) { ?>

								</div>
							</div>
						</div>
						<?php } ?>
	  			<?php } elseif ($style == 'style5') { ?>
	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 columns">
	  						<?php
	  							set_query_var( 'thb_style', 'featured-style8' );
	  							set_query_var( 'thb_class', 'light-title' );
	  							get_template_part( 'inc/templates/loop/post-slider/post-slider');
	  							set_query_var( 'thb_class', false );
	  							set_query_var( 'thb_style', false );
	  						?>
	  					</div>
	  				<?php } ?>
  					<?php if ($i > 0) { ?>
  						<div class="small-12 medium-4 columns">
  						<?php get_template_part( 'inc/templates/loop/style3-small' ); ?>
  						</div>
  					<?php } ?>
  				<?php } elseif ($style == 'style6') { ?>
  					<?php if ($i == 0) { ?>
  						<div class="small-12 medium-7 columns">
  							<?php get_template_part( 'inc/templates/loop/style3' ); ?>
  						</div>
  					<?php } ?>
  					<?php if ($i > 0) { ?>
  						<?php if ($i == 1) { ?>
  							<div class="small-12 medium-5 columns">
  								<ul class="post-category-listing">
  						<?php } ?>
  						<?php if ($i > 0) { ?>
  							<?php set_query_var( 'excerpts', false ); ?>
  							<?php get_template_part( 'inc/templates/loop/listing-excerpt' ); ?>
  						<?php } ?>
  						<?php if ($i + 1 == $posts->post_count) { ?>
  								</ul>
  							</div>
  						<?php } ?>
  					<?php } ?>
	  			<?php } elseif ($style == 'style7') { ?>

	  				<?php if ($i == 0) { ?>
	  					<div class="small-12 medium-6 columns">
	  						<?php get_template_part( 'inc/templates/loop/style3' ); ?>
	  					</div>
	  				<?php } ?>
	  				<?php if ($i > 0) { ?>
	  					<?php if ($i == 1) { ?>
	  						<div class="small-12 medium-6 columns">
	  							<div class="row">
	  					<?php } ?>
	  					<?php if ($i > 0) { ?>
	  						<div class="small-6 columns">
	  							<?php set_query_var( 'thb_excerpt', false ); ?>
	  							<?php set_query_var( 'thb_image_size', 'thevoux-style1-2x' ); ?>
	  							<?php get_template_part( 'inc/templates/loop/style3-small' ); ?>
	  						</div>
	  					<?php } ?>
	  					<?php if ($i + 1 == $posts->post_count) { ?>
	  							</div>
	  						</div>
	  					<?php } ?>
	  				<?php } ?>
	  			<?php } ?>
	  		<?php $i++; endwhile; // end of the loop. ?>
	  	</div>
	<?php }
   $out = ob_get_clean();

   wp_reset_query();
   wp_reset_postdata();

  return $out;
}
thb_add_short('thb_postcategory', 'thb_postcategory');