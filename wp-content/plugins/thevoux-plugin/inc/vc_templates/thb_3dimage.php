<?php function thb_threedimage( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_threedimage', $atts );
	extract( $atts );
	$img_id = preg_replace('/[^\d]/', '', $image);
	$full = $full_width == 'true' ? 'full' : '';
	$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'full', 'class' => $alignment ) );
	$img_org = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'full', 'class' => 'visually-hidden' ) );
	$img_src = wp_get_attachment_image_src($img_id, 'full');
	if ( $img == NULL ) $img['thumbnail'] = '<img src="http://placekitten.com/g/400/300" />';
  

	$img_link = ( $img_link == '||' ) ? '' : $img_link;
	$link = vc_build_link( $img_link );
	
  $link_to = $link['url'];
  $a_title = $link['title'];
  $a_target = $link['target'] ? $link['target'] : '_self';	
  
  ob_start();
  ?>
  <a href="<?php echo esc_url($link_to); ?>" target="<?php echo esc_attr( $a_target ); ?>" title="<?php echo esc_attr($a_title); ?>" class="thb_3dimg-container <?php echo esc_attr($full); ?>">
  	<?php echo $img_org["thumbnail"]; ?>
  	<div class="thb_3dimg">
	  	<div class="atvImg-layer"><?php echo $img["thumbnail"]; ?></div>
	    <div class="atvImg-layer"><div class="image_bg"><div class="image_link"></div></div></div>
	    <div class="atvImg-layer">
	    	<span class="title"><h3><?php echo esc_html($a_title); ?></h3></span>
	    	<span class="arrow"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	     	 width="69.002px" height="41.752px" viewBox="0 0 69.002 41.752" enable-background="new 0 0 69.002 41.752" xml:space="preserve">
	     <polygon fill-rule="evenodd" clip-rule="evenodd" points="69.002,20.846 47.351,0 43.475,3.732 58.359,18.064 0,18.064 0,23.439 
	     			58.619,23.439 43.475,38.021 47.351,41.752 69.002,20.906 68.971,20.876"/>
	     </svg></span>
	   </div>
  	</div>
  </a>
  <?php
	$out = ob_get_clean();
	
  return $out;
}
thb_add_short('thb_threedimage', 'thb_threedimage');
