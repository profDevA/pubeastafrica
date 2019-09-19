<?php function thb_hotspots( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_hotspots', $atts );
	extract( $atts );

	$img_id = preg_replace('/[^\d]/', '', $image);

	$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'full'  ) );
	if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" />';

  $spots = json_decode(urldecode($thb_hotspot_data));


  ob_start();


  ?>
  <div class="thb-hotspot-container <?php echo esc_attr($thb_tooltip_function); ?>">
    <?php echo $img['thumbnail']; ?>
    <?php foreach ($spots as $key=>$spot) { ?>
      <?php
				unset($hotspot_classes);
	      $hotspot_classes[] = "thb-hotspot";
	      $hotspot_classes[] = $thb_pin_color;
	      $hotspot_classes[] = $spot->Position;
	      $hotspot_classes[] = $animation;
      ?>
      <div class="<?php echo esc_attr(implode(' ', $hotspot_classes)); ?>" style="left:<?php echo esc_attr($spot->x); ?>%; top:<?php echo esc_attr($spot->y); ?>%">
        <div class="thb-hotspot-content <?php echo esc_attr($thb_pulsate); ?>"><?php echo esc_attr($key + 1); ?></div>
        <div class="thb-hotspot-tooltip">
          <div class="thb-hotspot-tooltip-inner <?php if ($spot->Product && thb_wc_supported() ) { ?>thb-product-popup<?php }?>">
            <?php if ($spot->Product && thb_wc_supported() ) { ?>
              <?php
              $args = array(
        				'post_type' => 'product',
        				'post_status' => 'publish',
        				'ignore_sticky_posts'   => 1,
        				'p' => $spot->Product
        			);
              $product_loop = new WP_Query( $args );
              $product = wc_get_product($spot->Product);
              ?>
              <?php while ( $product_loop->have_posts() ) : $product_loop->the_post(); ?>
  							<?php wc_get_template_part( 'content', 'product-hotspots' ); ?>
  					  <?php endwhile; wp_reset_postdata(); ?>
              <?php if (!$product_loop->found_posts) { ?><p><?php esc_html_e('Product Not Found', 'thevoux' ); ?></p><?php } ?>
            <?php } else { ?>
              <?php if ($spot->Title) { ?><h6><?php echo wp_kses_post($spot->Title); ?></h6><?php } ?>
              <?php if ($spot->Message) { ?><p><?php echo wp_kses_post($spot->Message); ?></p><?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <?php
  $out = ob_get_clean();

	return $out;
}
thb_add_short('thb_hotspots', 'thb_hotspots');
