<?php
function thb_get_archive_layouts() {
	$array = array(
		array(
			'value'   => 'style1',
			'label'   => esc_html__( 'Single Column', 'thevoux' ),
			'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/archives/style01.png'
		),
		array(
			'value'   => 'style2',
			'label'   => esc_html__( 'Single Column', 'thevoux' ),
			'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/archives/style02.png'
		),
		array(
			'value'   => 'style3',
			'label'   => esc_html__( 'Single Column', 'thevoux' ),
			'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/archives/style03.png'
		),
		array(
			'value'   => 'style4',
			'label'   => esc_html__( 'Single Column', 'thevoux' ),
			'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/archives/style04.png'
		),
		array(
			'value'   => 'style5',
			'label'   => esc_html__( 'Single Column', 'thevoux' ),
			'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/archives/style05.png'
		),
		array(
			'value'   => 'style6',
			'label'   => esc_html__( 'Single Column', 'thevoux' ),
			'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/archives/style06.png'
		)
	);

	return $array;
}
function thb_filter_radio_images( $array, $field_id ) {

	if ( in_array($field_id, array('mobile_menu_color', 'header_menu_color', 'header_submenu_color', 'footer_color', 'subfooter_color')) ) {
	  $array = array(
	    array(
	      'value'   => 'light',
	      'label'   => esc_html__( 'Light - White Background', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png'
	    ),
	    array(
	      'value'   => 'dark',
	      'label'   => esc_html__( 'Dark - Black Background', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png'
	    )
	  );
	}
	if ( in_array($field_id, array('header_transparent_color')) ) {
	  $array = array(
	    array(
	      'value'   => 'light-transparent-header',
	      'label'   => esc_html__( 'Light - White Background', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png'
	    ),
	    array(
	      'value'   => 'dark-transparent-header',
	      'label'   => esc_html__( 'Dark - Black Background', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png'
	    )
	  );
	}
	if ( in_array($field_id, array('lightbox_color')) ) {
	  $array = array(
	    array(
	      'value'   => 'lightbox-light',
	      'label'   => esc_html__( 'Light - White Background', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/light.png'
	    ),
	    array(
	      'value'   => 'lightbox-dark',
	      'label'   => esc_html__( 'Dark - Black Background', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/light_dark/dark.png'
	    )
	  );
	}
	if ( in_array($field_id, array('article_style', 'post-style') ) ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/article_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/article_styles/style2.png'
	    ),
	    array(
	      'value'   => 'style3',
	      'label'   => esc_html__( 'Style 3', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/article_styles/style3.png'
	    ),
	    array(
	      'value'   => 'style4',
	      'label'   => esc_html__( 'Style 4', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/article_styles/style4.png'
	    ),
	    array(
	      'value'   => 'style5',
	      'label'   => esc_html__( 'Style 5', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/article_styles/style5.png'
	    )
	  );
	}
	if ( $field_id === 'subfooter_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/subfooter_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/subfooter_styles/style2.png'
	    )
	  );
	}
	if ( $field_id === 'sharing_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/social_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/social_styles/style2.png'
	    )
	  );
	}

	if ( $field_id === 'gallery_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/gallery_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/gallery_styles/style2.png'
	    )
	  );
	}
	if ( $field_id === 'header_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style2.png'
	    ),
	    array(
	      'value'   => 'style3',
	      'label'   => esc_html__( 'Style 3', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style3.png'
	    ),
	    array(
	      'value'   => 'style4',
	      'label'   => esc_html__( 'Style 4', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style4.png'
	    ),
	    array(
	      'value'   => 'style5',
	      'label'   => esc_html__( 'Style 5', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style5.png'
	    ),
	    array(
	      'value'   => 'style6',
	      'label'   => esc_html__( 'Style 6', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style6.png'
	    ),
	    array(
	      'value'   => 'style7',
	      'label'   => esc_html__( 'Style 7', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style7.png'
	    ),
	    array(
	      'value'   => 'style8',
	      'label'   => esc_html__( 'Style 8', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style8.png'
	    ),
	    array(
	      'value'   => 'style9',
	      'label'   => esc_html__( 'Style 9', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_styles/style9.png'
	    )
	  );
	}
	if ( $field_id === 'header_fixed_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_fixed_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_fixed_styles/style2.png'
	    ),
	    array(
	      'value'   => 'style3',
	      'label'   => esc_html__( 'Style 3', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/header_fixed_styles/style3.png'
	    )
	  );
	}
	if ( $field_id === 'header_submenu_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/menu_styles/style1.jpg'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/menu_styles/style2.jpg'
	    ),
	    array(
	      'value'   => 'style3',
	      'label'   => esc_html__( 'Style 3', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/menu_styles/style3.jpg'
	    )
	  );
	}

	if ( $field_id === 'footer_style' ) {
	  $array = array(
	    array(
	      'value'   => 'style1',
	      'label'   => esc_html__( 'Style 1', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/footer_styles/style1.png'
	    ),
	    array(
	      'value'   => 'style2',
	      'label'   => esc_html__( 'Style 2', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/footer_styles/style2.png'
	    ),
	    array(
	      'value'   => 'style3',
	      'label'   => esc_html__( 'Style 3', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/footer_styles/style3.png'
	    ),
	    array(
	      'value'   => 'style4',
	      'label'   => esc_html__( 'Style 4', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/footer_styles/style4.png'
	    ),
	    array(
	      'value'   => 'style5',
	      'label'   => esc_html__( 'Style 5', 'thevoux' ),
	      'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/footer_styles/style5.png'
	    )
	  );
	}

  if ( $field_id === 'widget_style' ) {
    $array = array(
      array(
        'value'   => 'style1',
        'label'   => esc_html__( 'Style 1', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_1.jpg'
      ),
      array(
        'value'   => 'style2',
        'label'   => esc_html__( 'Style 2', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_2.jpg'
      ),
      array(
        'value'   => 'style3',
        'label'   => esc_html__( 'Style 3', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_3.jpg'
      ),
      array(
        'value'   => 'style4',
        'label'   => esc_html__( 'Style 4', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_4.jpg'
      ),
      array(
        'value'   => 'style5',
        'label'   => esc_html__( 'Style 5', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_5.jpg'
      ),
      array(
        'value'   => 'style6',
        'label'   => esc_html__( 'Style 6', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_6.jpg'
      ),
      array(
        'value'   => 'style7',
        'label'   => esc_html__( 'Style 7', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_7.jpg'
      ),
			array(
        'value'   => 'style8',
        'label'   => esc_html__( 'Style 8', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/widget_styles/w_8.jpg'
      ),
    );
  }

  if ( $field_id === 'footer_columns' ) {
    $array = array(
      array(
        'value'   => 'fourcolumns',
        'label'   => esc_html__( 'Four Columns', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/four-columns.png'
      ),
      array(
        'value'   => 'threecolumns',
        'label'   => esc_html__( 'Three Columns', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/three-columns.png'
      ),
      array(
        'value'   => 'twocolumns',
        'label'   => esc_html__( 'Two Columns', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/two-columns.png'
      ),
      array(
        'value'   => 'doubleleft',
        'label'   => esc_html__( 'Double Left Columns', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/doubleleft-columns.png'
      ),
      array(
        'value'   => 'doubleright',
        'label'   => esc_html__( 'Double Right Columns', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/doubleright-columns.png'
      ),
      array(
        'value'   => 'fivecolumns',
        'label'   => esc_html__( 'Five Columns', 'thevoux' ),
        'src'     => Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/admin/columns/five-columns.png'
      )

    );
  }

	if ( in_array($field_id, array('archive_layout', 'category_layout', 'tag_layout', 'search_layout', 'author_layout')) ) {
    $array = thb_get_archive_layouts();
  }

  return $array;

}
add_filter( 'ot_radio_images', 'thb_filter_radio_images', 10, 2 );

function thb_filter_options_name() {
	return __('<a href="http://fuelthemes.net">Fuel Themes</a>', 'thevoux' );
}
add_filter( 'ot_header_version_text', 'thb_filter_options_name', 10, 2 );

function thb_filter_admin_name() {
	return Thb_Theme_Admin::$thb_theme_name.__(' Theme Options', 'thevoux' );
}
add_filter( 'ot_theme_options_page_title', 'thb_filter_admin_name', 10, 2 );

function thb_filter_upload_name() {
	return esc_html__('Send to Theme Options', 'thevoux' );
}
add_filter( 'ot_upload_text', 'thb_filter_upload_name', 10, 2 );

function thb_header_list() {
	echo '<li class="theme_link"><a href="http://fuelthemes.ticksy.com/" target="_blank">Support Forum</a></li>';
}
add_filter( 'ot_header_list', 'thb_header_list' );

function thb_filter_ot_recognized_font_families( $array, $field_id ) {
	$array['helveticaneue'] = "'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif";
	ot_fetch_google_fonts( true, false );
	$ot_google_fonts = wp_list_pluck( get_theme_mod( 'ot_google_fonts', array() ), 'family' );
  $array = array_merge($array,$ot_google_fonts);

  if (ot_get_option( 'typekit_id')) {
  	$typekit_fonts = trim(ot_get_option( 'typekit_fonts'), ' ');
  	$typekit_fonts = explode(',', $typekit_fonts);

  	$array = array_merge($array,$typekit_fonts);
  }

  $self_hosted_names = array();
  if (ot_get_option( 'self_hosted_fonts')) {
  	$self_hosted_fonts = ot_get_option( 'self_hosted_fonts');

  	foreach ($self_hosted_fonts as $font) {
  		$self_hosted_names[] = $font['font_name'];
  	}

  	$array = array_merge($array,$self_hosted_names);
  }

  foreach ($array as $font => $value) {
		$thb_font_array[$value] = $value;
  }
  return $thb_font_array;
}
add_filter( 'ot_recognized_font_families', 'thb_filter_ot_recognized_font_families', 10, 2 );

function thb_filter_typography_fields2( $array, $field_id ) {

	if ( in_array($field_id, array('title_type', 'body_type', 'em_font') ) ) {
		$array = array( 'font-family');
	}
	if ( in_array($field_id, array('em_font', 'button_type' ) ) ) {
		$array = array( 'font-family', 'font-weight', 'letter-spacing' );
	}
	if ( in_array($field_id, array('h1_type','h2_type','h3_type','h4_type','h5_type','h6_type') ) ) {
		$array = array( 'font-family', 'font-size', 'font-style', 'font-weight', 'text-transform', 'line-height', 'letter-spacing' );
	}
	if ( in_array($field_id, array('article_title_type') ) ) {
		$array = array( 'font-size', 'font-style', 'font-variant', 'font-weight', 'text-decoration', 'text-transform', 'line-height', 'letter-spacing');
	}
	if ( in_array($field_id, array("menu_type", "submenu_type", "subheader_menu_type","mobile_menu_type", "mobile_submenu_type", "post_meta_type", "social_bar_type", "footer_menu_type", "post_dropcap_type") ) ) {
		$array = array( 'font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'text-decoration', 'text-transform', 'line-height', 'letter-spacing');
	}
   return $array;

}
add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields2', 10, 2 );

function thb_filter_typography_fields3( $array, $field_id ) {

   $fields = array('menu_left_type', 'menu_right_type');
   if ( in_array($field_id, $fields )) {
      $array = array('font-family', 'font-size', 'font-style', 'font-variant', 'font-weight', 'text-decoration', 'text-transform', 'line-height', 'letter-spacing');
   }

   return $array;

}
add_filter( 'ot_recognized_typography_fields', 'thb_filter_typography_fields3', 10, 2 );

function thb_social_links_settings( $id ) {

  $settings = array(
    array(
      'label'       => 'Social Networks to display',
      'id'          => 'footer_social_network',
      'type'        => 'select',
      'desc'        => 'Select your social network',
      'choices'     => array(
        array(
          'label'       => 'Facebook',
          'value'       => 'facebook'
        ),
        array(
          'label'       => 'Twitter',
          'value'       => 'twitter'
        ),
        array(
          'label'       => 'Pinterest',
          'value'       => 'pinterest'
        ),
        array(
          'label'       => 'Linkedin',
          'value'       => 'linkedin'
        ),
        array(
          'label'       => 'Instagram',
          'value'       => 'instagram'
        ),
        array(
          'label'       => 'Flickr',
          'value'       => 'flickr'
        ),
        array(
          'label'       => 'VK',
          'value'       => 'vk'
        ),
        array(
          'label'       => 'Tumblr',
          'value'       => 'tumblr'
        ),
        array(
          'label'       => 'Spotify',
          'value'       => 'spotify'
        ),
        array(
          'label'       => 'Youtube',
          'value'       => 'youtube'
        ),
        array(
          'label'       => 'Vimeo',
          'value'       => 'vimeo'
        ),
        array(
          'label'       => 'Dribbble',
          'value'       => 'dribbble'
        ),
        array(
          'label'       => '500px',
          'value'       => '500px'
        ),
        array(
          'label'       => 'Behance',
          'value'       => 'behance'
        )
      )
    ),
    array(
      'id'        => 'href',
      'label'     => 'Link',
      'desc'      => sprintf( esc_html__( 'Enter a link to the profile or page on the social website. Remember to add the %s part to the front of the link.', 'thevoux' ), '<code>http://</code>' ),
      'type'      => 'text',
    )
  );

  return $settings;

}
add_filter( 'ot_social_links_settings', 'thb_social_links_settings');
add_filter( 'ot_type_social_links_load_defaults', '__return_false');

function thb_filter_spacing_fields( $array, $field_id ) {

	if ( in_array($field_id, array("logo_padding", "logo_mobile_padding") ) ) {
		$array = array( 'top', 'bottom' );
	}
  return $array;

}

add_filter( 'ot_recognized_spacing_fields', 'thb_filter_spacing_fields', 10, 2 );

function thb_filter_measurement_unit_types( $array, $field_id ) {
	if ( in_array($field_id, array('site_borders_width', 'menu_margin') ) ) {
	  $array = array(
	    'px' => 'px',
	    'em' => 'em',
	    'pt' => 'pt'
	  );
	}
	return $array;
}
add_filter( 'ot_measurement_unit_types', 'thb_filter_measurement_unit_types', 10, 2 );

function thb_ot_line_height_unit_type( $array, $field_id ) {
	return 'em';
}
add_filter( 'ot_line_height_unit_type', 'thb_ot_line_height_unit_type', 10, 2 );

function thb_ot_line_height_high_range( $array, $field_id ) {
	return 3;
}
add_filter( 'ot_line_height_high_range', 'thb_ot_line_height_high_range', 10, 2 );

function thb_ot_line_height_range_interval( $array, $field_id ) {
	return 0.05;
}
add_filter( 'ot_line_height_range_interval', 'thb_ot_line_height_range_interval', 10, 2 );

function thb_ot_letter_spacing_high_range( $array, $field_id ) {
	return "0.2";
}
add_filter( 'ot_letter_spacing_high_range', 'thb_ot_letter_spacing_high_range', 10, 2 );

function thb_ot_letter_spacing_low_range( $array, $field_id ) {
	return "-0.2";
}
add_filter( 'ot_letter_spacing_low_range', 'thb_ot_letter_spacing_low_range', 10, 2 );

function thb_filter_ot_recognized_link_color_fields( $array, $field_id ) {
	$array = array(
		'link'    => esc_html_x( 'Standard', 'color picker', 'thevoux' ),
	  'hover'   => esc_html_x( 'Hover', 'color picker', 'thevoux' )
	);
	return $array;
}
add_filter( 'ot_recognized_link_color_fields', 'thb_filter_ot_recognized_link_color_fields', 10, 2 );

function thb_clear_font_cache() {
	$clear = filter_input( INPUT_GET, 'thb_clear_font_cache', FILTER_VALIDATE_BOOLEAN );
	if ($clear && current_user_can( 'manage_options' ) ) {
		delete_transient('ot_google_fonts_cache');
	}

}
add_action( 'admin_init', 'thb_clear_font_cache' );