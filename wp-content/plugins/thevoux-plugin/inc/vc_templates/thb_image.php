<?php function thb_image( $atts, $content = null ) {
	$atts = vc_map_get_attributes( 'thb_image', $atts );
	extract( $atts );

	$img_id = preg_replace('/[^\d]/', '', $image);
	
	$full = $full_width == 'true' ? 'full' : '';
	$img_size = $img_size == '' ? 'full' : $img_size;
	$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size, 'class' => 'thb_image ' . $animation . ' ' . $alignment . ' '. $full . ' ' . $retina ) );
	if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" />';
  
  $link_to = $c_lightbox = $a_title = $a_target = '';
  if ($lightbox == true) {
      $link_to = wp_get_attachment_image_src( $img_id, 'large');
      $link_to = $link_to[0];
      $c_lightbox = ' rel="magnific"';
  } else {
  		$img_link = ( $img_link == '||' ) ? '' : $img_link;
  		$link = vc_build_link( $img_link );
  		
      $link_to = $link['url'];
      $a_title = $link['title'];
      $a_target = $link['target'];	
  }
  
  if (!empty($link_to)) {
  	$out = '<a class="image_link"'.$c_lightbox.' href="'.$link_to.'"'. ' target="'.sanitize_text_field( $a_target ).'" title="'.$a_title.'">'.$img['thumbnail'].'</a>';
  } else {
  	$out = $img['thumbnail'];
  }
  

  return $out;
}
thb_add_short('thb_image', 'thb_image');
