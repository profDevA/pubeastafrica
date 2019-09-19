<?php function thb_gap( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_gap', $atts );
  extract( $atts );
	
	$out = '';
  $out .= '<aside class="gap cf" style="height:'.esc_attr($height).'px;"></aside>';
  return $out;
}
thb_add_short('thb_gap', 'thb_gap');
