<?php
function thb_bgoutput($array, $setting = false) {
	if(!empty($array)) {
		if (array_key_exists('background-color', $array) || $setting == 'background-color') {
			echo "background-color: " . $array['background-color'] . " !important;\n";
		}
		if (array_key_exists('background-image', $array) || $setting == 'background-image') {
		  if (!empty($array['background-image'])) {
			  echo "background-image: url(" . $array['background-image'] . ") !important;\n";
			}
		}
		if (array_key_exists('background-repeat', $array) || $setting == 'background-repeat') {
		  if (!empty($array['background-repeat'])) {
			  echo "background-repeat: " . $array['background-repeat'] . " !important;\n";
			}
		}
		if (array_key_exists('background-attachment', $array) || $setting == 'background-attachment') {
		  if (!empty($array['background-attachment'])) {
			  echo "background-attachment: " . $array['background-attachment'] . " !important;\n";
			}
		}
		if (array_key_exists('background-position', $array) || $setting == 'background-position') {
		  if (!empty($array['background-position'])) {
			  echo "background-position: " . $array['background-position'] . " !important;\n";
			}
		}
		if (array_key_exists('background-size', $array) || $setting == 'background-size') {
		  if (!empty($array['background-size'])) {
			  echo "background-size: " . $array['background-size'] . " !important;\n";
			}
		}
	}
}

function thb_paddingoutput($array) {
	if(!empty($array)) {
		$unit = array_key_exists('unit',$array) ? $array['unit'] : 'px';

		if (array_key_exists('top', $array)) {
			echo "padding-top: " . $array['top'] . $unit.";\n";
		}
		if (array_key_exists('right', $array)) {
			echo "padding-right: " . $array['right'] . $unit.";\n";
		}
		if (array_key_exists('bottom', $array)) {
			echo "padding-bottom: " . $array['bottom'] . $unit.";\n";
		}
		if (array_key_exists('left', $array)) {
			echo "padding-left: " . $array['left'] . $unit.";\n";
		}
	}
}

function thb_borderoutput($array) {
	if(!empty($array)) {
		$return = '';
		$unit = array_key_exists('unit',$array) ? $array['unit'] : 'px';
		$style = array_key_exists('style',$array) ? $array['style'] : 'solid';
		if (!empty($array['width'])) {
			$return = $array['width'];
		}
		if ($unit) {
			$return .= $unit;
		}
		if ($style) {
			$return .= ' '.$style;
		}
		if (!empty($array['color'])) {
			$return .= ' '.$array['color'];
		}
		echo ''.$return;
	}
}

function thb_linkcoloroutput($array, $start = '', $important = false) {
	if ( !empty( $array ) ) {
    $important_text = isset($important) ? ' !important' : '';
		if (array_key_exists('link', $array) && !empty($array['link'])) {
			echo "".$start." a { color: " . $array['link'] . $important_text."; }\n";
		}
		if (array_key_exists('hover', $array) && !empty($array['hover'])) {
			echo "".$start." a:hover { color: " . $array['hover'] . $important_text."; }\n";
		}
		if (array_key_exists('active', $array) && !empty($array['active'])) {
			echo "".$start." a:active { color: " . $array['active'] . $important_text."; }\n";
		}
		if (array_key_exists('visited', $array) && !empty($array['visited'])) {
			echo "".$start." a:visited { color: " . $array['visited'] . $important_text."; }\n";
		}
		if (array_key_exists('focus', $array) && !empty($array['focus'])) {
			echo "".$start." a:focus { color: " . $array['focus'] . $important_text."; }\n";
		}
	}
}

$thb_fontlist = array();

function thb_google_webfont() {
	global $thb_fontlist;
	$options = array(
		array(
				'option' => "body_type",
				'default' => "Lora"
		),
		array(
				'option' => "title_type",
				'default' => "Playfair Display"
		),
		array(
				'option' => "button_type",
				'default' => "Lora"
		),
		array(
				'option' => "em_font",
				'default' => ""
		),
		array(
				'option' => "menu_type",
				'default' => "Lora"
		),
		array(
				'option' => "submenu_type",
				'default' => "Lora"
		),
		array(
				'option' => "subheader_menu_type",
				'default' => "Lora"
		),
		array(
				'option' => "widget_title_type",
				'default' => "Lora"
		),
		array(
				'option' => "mobile_menu_type",
				'default' => "Lora"
		),
		array(
				'option' => "mobile_submenu_type",
				'default' => "Lora"
		),
		array(
				'option' => "post_meta_type",
				'default' => "Lora"
		),
		array(
				'option' => "social_bar_type",
				'default' => "Lora"
		),
		array(
				'option' => "footer_menu_type",
				'default' => "Lora"
		),
		array(
				'option' => "h1_type",
				'default' => ""
		),
		array(
				'option' => "h2_type",
				'default' => ""
		),
		array(
				'option' => "h3_type",
				'default' => ""
		),
		array(
				'option' => "h4_type",
				'default' => ""
		),
		array(
				'option' => "h5_type",
				'default' => ""
		),
		array(
				'option' => "h6_type",
				'default' => ""
		)
	);
	$import = '';

	$subsets = 'latin';
	$subset = ot_get_option( 'font_subsets');

	if ( 'latin-ext' == $subset ) {
		$subsets .= ',latin-ext';
	} elseif ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	$google_fonts = get_theme_mod( 'ot_google_fonts', array() );
	$google_fonts_families = wp_list_pluck( $google_fonts, 'family' );

	foreach($options as $option) {
		$array = ot_get_option($option['option']);
		if (!empty($array['font-family'])) {
			if (!in_array($array['font-family'], $thb_fontlist)) {
				if (in_array($array['font-family'], $google_fonts_families)) {
					$family_slug = mb_strtolower(str_replace(' ', '', $array['font-family']));
					$font_weights = implode (",", $google_fonts[$family_slug]['variants']);
					$font_weights = str_replace('regular', '400', $font_weights);
					$font_weights = str_replace(',italic', ',400i', $font_weights);
					$font_weights = str_replace('italic', 'i', $font_weights);
					$font_family = str_replace(' ', '+', $array['font-family']);
					$font = $font_family.':'.$font_weights;
					array_push($thb_fontlist, $font);
				}
			}
		} elseif ($option['default']) {
			if (!in_array($option['default'], $thb_fontlist)) {
				if (in_array($option['default'], $google_fonts_families)) {
					$family_slug = mb_strtolower(str_replace(' ', '', $option['default']));
					$font_weights = implode (",", $google_fonts[$family_slug]['variants']);
					$font_weights = str_replace('regular', '400', $font_weights);
					$font_weights = str_replace(',italic', ',400i', $font_weights);
					$font_weights = str_replace('italic', 'i', $font_weights);
					$font_family = str_replace(' ', '+', $option['default']);
					$font = $font_family.':'.$font_weights;
					array_push($thb_fontlist, $font);
				}
			}
		}
	}

	$font_list = array_unique($thb_fontlist);

	if ($font_list) {
		$cssfont = implode('|', $font_list);
		$query_args = array(
			'family' => $cssfont,
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "https://fonts.googleapis.com/css" );
		return $font_url;
	}
}

function thb_typeoutput($array, $important = false, $default = false) {
	global $thb_fontlist;

	if(!empty($array)) {

		if (!empty($array['font-family'])) {
			echo "font-family: " . $array['font-family'] . ", 'BlinkMacSystemFont', -apple-system, 'Roboto', 'Lucida Sans';\n";
		} elseif ($default) {
			echo "font-family: " . $default . ";\n";
		}
		if (!empty($array['font-color'])) {
			echo "color: " . $array['font-color'] . ";\n";
		}
		if (!empty($array['font-style'])) {
			echo "font-style: " . $array['font-style'] . ";\n";
		}
		if (!empty($array['font-variant'])) {
			echo "font-variant: " . $array['font-variant'] . ";\n";
		}
		if (!empty($array['font-weight'])) {
			echo "font-weight: " . $array['font-weight'] . ";\n";
		}
		if (!empty($array['font-size'])) {

			if ($important) {
				echo "font-size: " . $array['font-size'] . " !important;\n";
			} else {
				echo "font-size: " . $array['font-size'] . ";\n";
			}
		}
		if (!empty($array['text-decoration'])) {
				echo "text-decoration: " . $array['text-decoration'] . " !important;\n";
		}
		if (!empty($array['text-transform'])) {
				echo "text-transform: " . $array['text-transform'] . " !important;\n";
		}
		if (!empty($array['line-height'])) {
				echo "line-height: " . $array['line-height'] . " !important;\n";
		}
		if (!empty($array['letter-spacing'])) {
				echo "letter-spacing: " . $array['letter-spacing'] . " !important;\n";
		}
	}
	if(empty($array) && !empty($default)) {
		echo "font-family: '" . $default . "';\n";
	}
}

function thb_spacingoutput($array, $std = false, $type = 'padding') {
	if(!empty($array)) {
		$unit = array_key_exists('unit', $array) ? $array['unit'] : 'px';
		if (array_key_exists('top', $array)) {
			$top = array_key_exists('top', $array) ? $array['top'] : false;
			echo esc_attr($type.'-top:'.$top.$unit.';');
		}
		if (array_key_exists('right', $array)) {
			$right = array_key_exists('right', $array) ? $array['right'] : false;
			echo esc_attr($type.'-right:'.$right.$unit.';');
		}
		if (array_key_exists('bottom', $array)) {
			$bottom = array_key_exists('bottom', $array) ? $array['bottom'] : false;
			echo esc_attr($type.'-bottom:'.$bottom.$unit.';');
		}
		if (array_key_exists('left', $array)) {
			$left = array_key_exists('left', $array) ? $array['left'] : false;
			echo esc_attr($type.'-left:'.$left.$unit.';');
		}
	}

}

function thb_measurementoutput($array) {
	if (!empty($array)) {
		echo (''.$array[0] . $array[1]);
	}
}

function thb_hex2rgb($hex) {

   $hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {

      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));

   } else {

      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));

   }

   $rgb = array($r, $g, $b);

   return implode(",", $rgb); // returns the rgb values separated by commas

}
function thb_adjustColorLightenDarken($color_code,$percentage_adjuster = 0) {
    $percentage_adjuster = round($percentage_adjuster/100,2);
    if(is_array($color_code)) {
        $r = $color_code["r"] - (round($color_code["r"])*$percentage_adjuster);
        $g = $color_code["g"] - (round($color_code["g"])*$percentage_adjuster);
        $b = $color_code["b"] - (round($color_code["b"])*$percentage_adjuster);

        return array("r"=> round(max(0,min(255,$r))),
            "g"=> round(max(0,min(255,$g))),
            "b"=> round(max(0,min(255,$b))));
    }
    elseif(preg_match("/#/",$color_code)) {
        $hex = str_replace("#","",$color_code);
        $r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
        $g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
        $b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
        $r = round($r - ($r*$percentage_adjuster));
        $g = round($g - ($g*$percentage_adjuster));
        $b = round($b - ($b*$percentage_adjuster));

        return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
            .str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);

    }
}

/* Category Color Echo */
function thb_catcoloroutput( $array ) {
	if( ! empty( $array ) ) {
		foreach ( $array as $cat => $color ) {
			$cat = get_category( $cat );
			if ( $cat && $color ) {
				echo ".post .thb-post-top .post-meta.style1 a.cat-".$cat->slug." { color: ". $color ."; }\n";
				echo ".post .thb-post-top .post-meta.style2 a.cat-".$cat->slug." { background-color: ". $color ."; }\n";
				echo ".post.post-carousel-style11 .post-meta.style2 a.cat-".$cat->slug." { background-color: ". $color ."; }\n";
				echo ".post .post-content .category_title.catstyle-style".$cat->term_id." h2 a:hover { color: ". $color ."; }\n";
			}
		}
	}
}
