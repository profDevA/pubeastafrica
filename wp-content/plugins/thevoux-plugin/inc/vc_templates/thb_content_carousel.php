<?php function thb_content_carousel( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_content_carousel', $atts );
  extract( $atts );

 	$rand = rand(0,1000);
 	$i = 0;
 	$classes[] = 'row';
 	$classes[] = 'thb-content-carousel thb-carousel';
 	$classes[] = $thb_margins;
 	$classes[] = $thb_overflow;
 	$classes[] = $extra_class;
  $classes[] = $thb_navigation == 'true' ? 'center-arrows' : false;

 	ob_start();

	?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="content-carousel-<?php echo esc_attr($rand); ?>" data-columns="<?php echo esc_attr($thb_columns); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>" data-pagination="<?php echo esc_attr($thb_pagination); ?>" data-infinite="false" data-navigation="<?php echo esc_attr($thb_navigation); ?>">
			<?php echo do_shortcode($content); ?>
		</div>

	<?php

	$out = ob_get_clean();

	wp_reset_query();
	wp_reset_postdata();

  return $out;
}
thb_add_short('thb_content_carousel', 'thb_content_carousel');