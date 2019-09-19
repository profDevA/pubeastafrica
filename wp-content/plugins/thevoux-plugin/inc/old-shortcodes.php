<?php
/* Small Title Shortcodes */
function small_title($atts, $content = null ) {
    extract(shortcode_atts(array(
    	'title'      => 'Title'
    ), $atts));

	$out = '<div class="category_title catstyle-style1 small"><h5>' .esc_attr($title). '</h5></div>';

  return $out;
}
thb_add_short('small_title', 'small_title');

/* Medium Title Shortcodes */
function medium_title($atts, $content = null ) {
    extract(shortcode_atts(array(
    	'title'      => 'Title'
    ), $atts));

	$out = '<div class="mediumtitle">' .esc_attr($title). '</div>';

  return $out;
}
thb_add_short('medium_title', 'medium_title');

/* Large Title Shortcodes */
function large_title($atts, $content = null ) {
    extract(shortcode_atts(array(
    	'title'      => 'Title'
    ), $atts));

	$out = '<div class="category_title catstyle-style1"><h2>' .esc_attr($title). '</h2></div>';

  return $out;
}
thb_add_short('large_title', 'large_title');

/* Extra Large Title Shortcodes */
function extra_large_title($atts, $content = null ) {
    extract(shortcode_atts(array(
    	'title'      => 'Title'
    ), $atts));

	$out = '<div class="extralargetitle">' .esc_attr($title). '</div>';

  return $out;
}
thb_add_short('extra_large_title', 'extra_large_title');

/* Inline Label Shortcodes */
function tags($atts, $content = null ) {
    extract(shortcode_atts(array(
    	'color'      => 'gray'
    ), $atts));

	$out = '<span class="highlight '.$color.'">' .esc_attr($content). '</span>';

    return $out;
}
thb_add_short('tags', 'tags');

/* Blockquote */
function blockquotes( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'pull'      => '',
       	'author'    => ''
    ), $atts));
	$authorhtml = '';
	if ($author) {
		$authorhtml = '<cite>'. $author. '</cite>';
	}
	$out = '<blockquote class="'.$pull.'"><p>' .$content. $authorhtml. '</p></blockquote>';
    return $out;
}
thb_add_short('blockquote', 'blockquotes');

/* Icons */
function icons( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'type'      => '',
       	'url'				=> '',
       	'box'				=> '',
       	'size'			=> 'icon-1x'
    ), $atts));

		$out = '<i class="fa '.$type.'"></i>';

  	if ($box) {

  		$class = '';

  		switch ($type) {
  			case 'fa-facebook':
  				$class = 'facebook';
  				break;
  			case 'fa-twitter':
	  			$class = 'twitter';
	  			break;
	  		case 'fa-pinterest':
	  			$class = 'pinterest';
	  			break;
	  		case 'fa-linkedin':
	  			$class = 'linkedin';
	  			break;
	  		case 'fa-instagram':
	  			$class = 'instagram';
	  			break;
	  		case 'fa-youtube':
	  			$class = 'youtube';
	  			break;
  		}
  		if ($type == 'fa-facebook' || $type == 'fa-twitter' || $type == 'fa-google-plus' || $type == 'fa-pinterest' || $type == 'fa-linkedin') {
  			$class = substr($type, 3);
  		}
  		$out = '<a href="'.$url.'" class="boxed-icon fill '.$class.' '. $size.'">'.$out.'</a>';
  	}	else {
  		$out = '<span class="inline-icon '. $size.' no-link"><i class="fa '.$type.' '. $size.'"></i></span>';
  	}

  	return $out;
}
thb_add_short('icon', 'icons');

/* Dropcap */
function dropcap( $atts, $content = null ) {

		$out = '<span class="dropcap">'.$content.'</span>';

  	return $out;
}
thb_add_short('dropcap', 'dropcap');