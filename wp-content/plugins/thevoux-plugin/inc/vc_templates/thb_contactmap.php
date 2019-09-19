<?php function thb_contactmap( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_contactmap', $atts );
	extract( $atts );
	
	$thb_api_key = ot_get_option( 'map_api_key');
	$map_style = rawurldecode( thb_decode( strip_tags( $map_style ) ) );
	$map_controls = explode( ',', $map_controls );
	$height = is_numeric( $height ) && $height > 50 ? $height : 50;
	
	ob_start(); ?>
	<div class="contact_map <?php if ( $thb_api_key === '' ) { ?>disabled<?php } ?>" style="height:<?php echo esc_attr($height); ?>vh" data-map-style="<?php echo esc_attr($map_style); ?>" data-map-zoom="<?php echo esc_attr($zoom); ?>" data-map-type="<?php echo esc_attr($map_type); ?>" data-pan-control="<?php echo esc_attr(in_array( 'panControl', $map_controls )); ?>" data-zoom-control="<?php echo esc_attr(in_array( 'zoomControl', $map_controls )); ?>" data-maptype-control="<?php echo esc_attr(in_array( 'mapTypeControl', $map_controls )); ?>" data-scale-control="<?php echo esc_attr(in_array( 'scaleControl', $map_controls )); ?>" data-streetview-control="<?php echo esc_attr(in_array( 'streetViewControl', $map_controls )); ?>">
		<?php if ( $thb_api_key !== '' ) { ?>
			<?php echo wpb_js_remove_wpautop($content, false); ?>
		<?php } else { ?>
			<?php esc_html_e('Please fill out Google Maps Api key inside Theme Options', 'thevoux' ); ?>
		<?php } ?>
	</div>
	<?php 
	$out = ob_get_clean();
	return $out;
}
thb_add_short('thb_contactmap', 'thb_contactmap');