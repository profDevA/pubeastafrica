<?php function thb_postslider( $atts, $content = null ) {
	$source = '';
	$autoplay = false;
  $atts = vc_map_get_attributes( 'thb_postslider', $atts );
  extract( $atts );

  $source .= '|offset:'.$offset;
 	$source_data = VcLoopSettings::parseData( $source );
 	$query_builder = new ThbLoopQueryBuilder( $source_data );
 	$posts = $query_builder->build();
 	$posts = $posts[1];

 	$rand = mt_rand(10, 99);

 	$pagi = ($pagination == 'true' ? 'true' : 'false');
 	$nav = ($navigation == 'true' ? 'true' : 'false');

 	ob_start();
 	$classes[] = 'slick';
 	$classes[] = $style;
 	$classes[] = ($style == 'featured-style3' || $style == 'featured-style9') ? 'dark-pagination' : '';
 	$classes[] = $style == 'featured-style10' ? 'fly-nav' : false;
 	$classes[] = $style == 'featured-style13' ? 'bottom-left-nav' : false;
 	$classes[] = $style == 'featured-style14' ? 'equal-height bottom-right-nav' : false;
 	$classes[] = $style == 'featured-style8' ? 'equal-height' : false;
 	$classes[] = in_array($style, array('featured-style9', 'featured-style9 offset')) ? 'center-arrows' : false;

 	if ( $posts->have_posts() ) { ?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-columns="1" data-pagination="<?php echo esc_attr($pagi); ?>" data-navigation="<?php echo esc_attr($nav); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>">
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
		<div>
			<?php
				if ($style === 'featured-style14') {
					get_template_part( 'inc/templates/loop/post-slider/post-slider-full-right');
				} elseif ($style === 'featured-style13') {
					get_template_part( 'inc/templates/loop/post-slider/post-slider-full-left');
				} elseif ($style === 'featured-style11') {
					get_template_part( 'inc/templates/loop/post-slider/post-slider-full');
				} elseif ($style === 'featured-style12') {
					get_template_part( 'inc/templates/loop/post-slider/post-slider-left');
				} else {
					$style_old = $style;
					$class = '';
					$class = in_array($style_old, array('featured-style10', 'featured-style8')) ? $class . ' light-title' : $class;
					$class = in_array($style_old, array('featured-style1','featured-style3','featured-style5','featured-style8', 'featured-style9', 'featured-style9 offset')) ? $class . ' center-category' : $class;
					set_query_var( 'thb_style', $style );
					set_query_var( 'thb_class', $class );
					if (in_array($style_old, array('featured-style10')) ) {
						set_query_var( 'thb_image_size', 'thevoux-style1-2x' );
					} elseif (in_array($style_old, array('featured-style3', 'featured-style5')) ) {
					  set_query_var( 'thb_image_size', 'thevoux-style9-2x' );
					}
					get_template_part( 'inc/templates/loop/post-slider/post-slider');
				}
			?>
		</div>
		<?php endwhile; ?>
	</div>
	<?php }
	set_query_var( 'thb_style', false );
	set_query_var( 'thb_class', false );
	$out = ob_get_clean();

	wp_reset_query();
	wp_reset_postdata();
  return $out;
}
thb_add_short('thb_postslider', 'thb_postslider');