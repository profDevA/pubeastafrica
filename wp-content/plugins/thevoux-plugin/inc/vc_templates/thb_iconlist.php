<?php function thb_iconlist( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_iconlist', $atts );
	extract( $atts );
	if($icon) { $sicon = ' <i class="'.$icon.'" '. ($color ? ' style="color:'.$color.'"' : '') .'></i>'; } else { $sicon = ''; }
	
	$list_items = explode(",", $content);
	$out = '<ul class="iconlist '.$animation.'">';
	foreach($list_items as $list_item) {
		$out .= '<li>'.$sicon. $list_item.'</li>';
	}
	
	$out .= '</ul>';
	
	return $out;
}
thb_add_short('thb_iconlist', 'thb_iconlist');
