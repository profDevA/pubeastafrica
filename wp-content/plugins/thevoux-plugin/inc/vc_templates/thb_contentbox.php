<?php function thb_contentbox( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_contentbox', $atts );
  extract( $atts );
	$href = vc_build_link( $link );
	// Image
	if ($image) {
		$img_id = preg_replace('/[^\d]/', '', $image);
		$img = wp_get_attachment_image($img_id, 'full', false, array(
			'alt'   => trim(strip_tags( get_post_meta($img_id, '_wp_attachment_image_alt', true) )),
		));
	} else {
		$img = '';	
	}
	
	// Link
	$link_to = '';
	if (!empty($href)) {
		$link_to = $href['url'] ? $href['url'] : '';
	}
	// Content
	$out  = '<div class="contentbox '.$animation.'">';
		$out .= $link ? '<a href="'.esc_url($link_to).'" '. ($href['target'] ? ' target="'.$href['target'].'"' : '') . ($href['title'] ? ' title="'.$href['title'].'"' : '') .'>' : '';
		$out .= '<figure>'.$img.'</figure>';
		$out .= '<div class="content"' . ($content_color ? ' style="color: '.$content_color.'"' : '').'>';
			$out .= '<h6' . ($heading_color ? ' style="color: '.$heading_color.'"' : '').'>'.$heading.'</h6>';
			$out .= $content;
		$out .= '</div>';
		$out .= $link ? '</a>' : '';
	$out .= '</div>';
  return $out;
}
thb_add_short('thb_contentbox', 'thb_contentbox');
