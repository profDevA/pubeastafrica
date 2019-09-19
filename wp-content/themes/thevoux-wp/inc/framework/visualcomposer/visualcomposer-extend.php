<?php
$thb_animation_array = array(
	"type" => "dropdown",
	"heading" => esc_html__( "Animation", 'thevoux' ),
	"param_name" => "animation",
	"value" => array(
		"None" => "",
		"Left" => "animation right-to-left",
		"Right" => "animation left-to-right",
		"Top" => "animation bottom-to-top",
		"Bottom" => "animation top-to-bottom",
		"Scale" => "animation scale",
		"Fade" => "animation fade-in"
	)
);

$thb_offset_array = array(
	'-100%' => '-100%',
	'-95%' => '-95%',
	'-90%' => '-90%',
	'-85%' => '-85%',
	'-80%' => '-80%',
	'-75%' => '-75%',
	'-70%' => '-70%',
	'-65%' => '-65%',
	'-60%' => '-60%',
	'-55%' => '-55%',
	'-50%' => '-50%',
	'-45%' => '-45%',
	'-40%' => '-40%',
	'-35%' => '-35%',
	'-30%' => '-30%',
	'-25%' => '-25%',
	'-20%' => '-20%',
	'-15%' => '-15%',
	'-10%' => '-10%',
	'-5%'  => '-5%',
	'0%'  => '0%',
	'5%'  => '5%',
	'10%' => '10%',
	'15%' => '15%',
	'20%' => '20%',
	'25%' => '25%',
	'30%' => '30%',
	'35%' => '35%',
	'40%' => '40%',
	'45%' => '45%',
	'50%' => '50%',
	'55%' => '55%',
	'60%' => '60%',
	'65%' => '65%',
	'70%' => '70%',
	'75%' => '75%',
	'80%' => '80%',
	'85%' => '85%',
	'90%' => '90%',
	'95%' => '95%',
	'100%' => '100%'
);

function thb_vc_gradient_direction( $group_name = 'Styling' ) {
	return array(
		"type" => "dropdown",
		'heading' => esc_html__( 'Gradient Direction', 'thevoux' ),
		'param_name' => 'bg_gradient_direction',
		"class" => "hidden-label",
		'description' => esc_html__( 'You can change the gradient direction here.', 'thevoux' ),
		'group' => $group_name,
		'edit_field_class' => 'vc_col-sm-6',
		"value" => array(
		  'Top to Bottom' => '0',
			'Bottom Left to Top Right' => '-135',
			'Top Left to Bottom Right' => '-45',
			'Left to Right' => '-90'
		),
		'std' => '-135'
	);
}
function thb_vc_gradient_color1( $group_name = 'Styling' ) {
	return array(
		'type' => 'colorpicker',
		'heading' => esc_html__( 'Background Gradient Color 1', 'thevoux' ),
		'param_name' => 'bg_gradient1',
		"class" => "hidden-label",
		'description' => esc_html__( 'Choose a first (top) color for the background gradient. Leave blank to disable.', 'thevoux' ),
		'group' => $group_name,
		'edit_field_class' => 'vc_col-sm-6',
	);
}

function thb_vc_gradient_color2( $group_name = 'Styling' ) {
	return array(
		'type' => 'colorpicker',
		'heading' => esc_html__( 'Background Gradient Color 2', 'thevoux' ),
		'param_name' => 'bg_gradient2',
		"class" => "hidden-label",
		'description' => esc_html__( 'Choose a second (bottom) color for the background gradient.', 'thevoux' ),
		'group' => $group_name,
		'edit_field_class' => 'vc_col-sm-6',
	);
}

/* Visual Composer Mappings */

// Adding animation to columns
vc_remove_param( "vc_column", "css_animation" );
vc_add_param("vc_column", array(
	"type" => "checkbox",
	"heading" => esc_html__( "Enable Fixed Content", 'thevoux' ),
	"param_name" => "fixed",
	"value" => array(
		esc_html__( "Yes", 'thevoux' ) =>"true"
	),
	'weight' => 1,
	"description" => esc_html__( "If you enable this, this column will be fixed.", 'thevoux' )
));
vc_add_param("vc_column_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__( "Enable Fixed Content", 'thevoux' ),
	"param_name" => "fixed",
	"value" => array(
		esc_html__( "Yes", 'thevoux' ) =>"true"
	),
	'weight' => 1,
	"description" => esc_html__( "If you enable this, this column will be fixed.", 'thevoux' )
));

vc_add_param("vc_column", $thb_animation_array);
vc_add_param("vc_column_inner", $thb_animation_array);

// Text Area
vc_remove_param("vc_column_text", "css_animation");
vc_add_param("vc_column_text", $thb_animation_array);

// Empty Space
vc_add_param('vc_empty_space',array(
	"type" => "textfield",
	"heading" => esc_html__( "Mobile Height", 'thevoux' ),
	"param_name" => "mobile_height",
	"admin_label" => true,
	"value" => '',
	'weight' => 1,
	"description" => esc_html__( "You can change the height in mobile devices", 'thevoux' )
));

// VC_ROW
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__( "Disable Column Padding", 'thevoux' ),
	"param_name" => "column_padding",
	"value" => array(
		esc_html__( "Yes", 'thevoux' ) => "false"
	),
	'weight' => 1,
	"description" => esc_html__( "You can have columns without spaces using this option", 'thevoux' )
));
vc_add_param("vc_row", array(
	"type" => "checkbox",
	"heading" => esc_html__( "Enable Full Width", 'thevoux' ),
	"param_name" => "full_width_row",
	"value" => array(
		esc_html__( "Yes", 'thevoux' ) =>"true"
	),
	'weight' => 1,
	"description" => esc_html__( "If you enable this, this row fill the full-screen in large screens", 'thevoux' )
));
vc_add_param("vc_row_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__( "Disable Column Padding", 'thevoux' ),
	"param_name" => "column_padding",
	"value" => array(
		esc_html__( "Yes", 'thevoux' ) => "false"
	),
	'weight' => 1,
	"description" => esc_html__( "You can have columns without spaces using this option", 'thevoux' )
));
vc_add_param("vc_row_inner", array(
	"type" => "checkbox",
	"heading" => esc_html__( "Enable Max Width", 'thevoux' ),
	"param_name" => "max_width",
	"value" => array(
		esc_html__( "Yes", 'thevoux' ) =>"true"
	),
	'weight' => 1,
	"description" => esc_html__( "If you enable this, this row will not fill the container.", 'thevoux' )
));

// Add / Remove parameters
vc_remove_param( "vc_row", "full_width" );
vc_remove_param( "vc_row", "gap" );
vc_remove_param( "vc_row", "equal_height" );
vc_remove_param( "vc_row", "css_animation" );
vc_remove_param( "vc_toggle", "color" );
vc_remove_param( "vc_toggle", "style" );
vc_remove_param( "vc_toggle", "size" );
vc_remove_param( "vc_row_inner", "gap" );
vc_remove_param( "vc_row_inner", "equal_height" );
vc_remove_param( "vc_row_inner", "css_animation" );

// Author List
vc_map( array(
	"name" => esc_html__( "Author List", 'thevoux' ),
	"base" => "thb_authorgrid",
	"icon" => "thb_vc_ico_authorgrid",
	"class" => "thb_vc_sc_authorgrid",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__( "Columns", 'thevoux' ),
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Six Columns' => "6",
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => esc_html__( "Select the layout of the authors.", 'thevoux' )
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Author IDs", 'thevoux' ),
	    "param_name" => "author_ids",
	    "description" => esc_html__( "Enter the Author IDs you would like to display seperated by comma", 'thevoux' )
	  )
	),
	"description" => esc_html__( "Display your blog authors in a grid", 'thevoux' )
) );

// Block Grid
vc_map( array(
	"name" => esc_html__( "Block Grid", 'thevoux' ),
	"base" => "thb_blockgrid",
	"icon" => "thb_vc_ico_blockgrid",
	"class" => "thb_vc_sc_blockgrid",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
		array(
	    "type" => "dropdown",
	    "heading" => esc_html__( "Style", 'thevoux' ),
	    "param_name" => "style",
	    "admin_label" => true,
	    "value" => array(
	    	'Style 1' => "style1"
	    ),
	    "description" => esc_html__( "This changes the layouts of the grids", 'thevoux' )
		),
		array(
		  "type" => "loop",
		  "heading" => esc_html__( "Post Source", 'thevoux' ),
		  "param_name" => "source",
		  "description" => esc_html__( "Set your post source here. Block Grids have fixed post counts, so it will be omitted inside source setting.", 'thevoux' )
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__( "Offset", 'thevoux' ),
		  "param_name" => "offset",
		  "description" => esc_html__( "You can offset your post with the number of posts entered in this setting", 'thevoux' )
		)
	),
	"description" => esc_html__( "Display your posts in different grid layouts.", 'thevoux' )
) );

// Border Shortcode
vc_map( array(
	"name" => esc_html__( "Border Container", 'thevoux' ),
	"base" => "thb_border",
	"icon" => "thb_vc_ico_border",
	"class" => "thb_vc_sc_border",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"show_settings_on_create" => true,
	"content_element" => true,
	"as_parent" => array('except' => 'thb_border'),
	"params" => array(
		array(
		    "type" => "dropdown",
		    "heading" => esc_html__( "Style", 'thevoux' ),
		    "param_name" => "style",
		    "admin_label" => true,
		    "value" => array(
		    	'Style 1' => "style1",
		    	'Style 2' => "style2",
		    	'Style 3' => "style3",
		    ),
		    "description" => esc_html__( "This changes the style of the background", 'thevoux' )
		),
	),
	"js_view" => 'VcColumnView',
	"description" => esc_html__( "Stylish Border Container that you can place elements in", 'thevoux' )
) );
class WPBakeryShortCode_Thb_Border extends WPBakeryShortCodesContainer { }

// Button shortcode
vc_map( array(
	"name" => esc_html__( "Button", 'thevoux' ),
	"base" => "thb_button",
	"icon" => "thb_vc_ico_button",
	"class" => "thb_vc_sc_button",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__( "Button Link & Text", 'thevoux' ),
		  "param_name" => "link",
		  "description" => esc_html__( "Set your button link & text here.", 'thevoux' )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Size", 'thevoux' ),
			"param_name" => "size",
			"value" => array(
				"Mini button" => "mini",
				"Small button" => "small",
				"Medium button" => "medium",
				"Large button" => "large"
			),
			"std" => "medium"
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Color", 'thevoux' ),
		  "param_name" => "color",
		  "group"			 => 'Styling',
		  'std' 			=> 'black',
		  "value" => array(
		  	'Black' => 'black',
		  	'White' => 'white',
		  	'Accent' => 'accent'
		  ),
		  "description" => esc_html__( "This changes the color of the button", 'thevoux' )
		),
		$thb_animation_array,
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Class Name", 'thevoux' ),
			"param_name" => "extra_class",
		),
	),
	"description" => esc_html__( "Add an animated button", 'thevoux' )
) );

// Cascading Images
vc_map( array(
	"name" => esc_html__( "Cascading Images", 'thevoux' ),
	"base" => "thb_cascading_parent",
	"icon" => "thb_vc_ico_cascading",
	"class" => "thb_vc_sc_cascading",
	"content_element"	=> true,
	"show_settings_on_create" => false,
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"as_parent" => array('only' => 'thb_cascading'),
	"description" => esc_html__( "Insert a cascading Image", 'thevoux' ),
	"js_view" => 'VcColumnView'
) );

vc_map( array(
	"name" => esc_html__( "Single Image", 'thevoux' ),
	"base" => "thb_cascading",
	"icon" => "thb_vc_ico_cascading",
	"class" => "thb_vc_sc_cascading",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"as_child"         => array('only' => 'thb_cascading_parent'),
	"params"           => array(
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Select Image', 'thevoux' ),
			'param_name'     => 'image',
			'description'    => esc_html__( 'Select Image for the layer', 'thevoux' )
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Offset X", 'thevoux' ),
		  "param_name" => "image_x",
		  "value" => $thb_offset_array,
		  "std" => "0%"
		),
		array(
		  "type" => "dropdown",
		  "heading" => __("Offset Y", 'thevoux' ),
		  "param_name" => "image_y",
		  "value" => $thb_offset_array,
		  "std" => "0%"
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Retina Size?", 'thevoux' ),
			"param_name" => "retina",
			"value" => array(
				"Yes" => "retina_size"
			),
			"description" => esc_html__( "If selected, the image will be display half-size, so it looks crisps on retina screens. Full Width setting will override this.", 'thevoux' )
		),
		$thb_animation_array,
		array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Add Border Radius?", 'thevoux' ),
	    "param_name" => "radius",
	    "group"					 => 'Styling',
	    "description" => esc_html__( "You can add Border Radius in px value.", 'thevoux' )
		),
		array(
		  "type" => "checkbox",
		  "heading" => esc_html__( "Add Box Shadow?", 'thevoux' ),
		  "param_name" => "thb_box_shadow",
		  "value" => array(
		  	"Yes" => "thb_box_shadow"
		  ),
		  "group"					 => 'Styling',
		  "description" => esc_html__( "You can add a Box Shadow to your image.", 'thevoux' )
		),
	)
) );

class WPBakeryShortCode_thb_cascading_parent extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_thb_cascading extends WPBakeryShortCode {}

// Google Map
vc_map( array(
	"name" => esc_html__( "Contact Map Parent", 'thevoux' ),
	"base" => "thb_contactmap",
	"icon" => "thb_vc_ico_contactmap",
	"class" => "thb_vc_sc_contactmap",
	"content_element"	=> true,
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"as_parent" => array('only' => 'thb_contactmap_pin'),
	"params" => array(
		array(
		  "type" => "textfield",
		  "heading" => esc_html__( "Map Height", 'thevoux' ),
		  "param_name" => "height",
		  "admin_label" => true,
		  "value" => 50,
		  "description" => esc_html__( "Enter height of the map in vh (0-100). For example, 50 will be 50% of viewport height and 100 will be full height. Make sure you have filled in your Google Maps API inside Appearance > Theme Options.", 'thevoux' )
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Map Zoom', 'thevoux' ),
			'param_name'     => 'zoom',
			'value'			 => '0',
			'description'    => esc_html__( 'Set map zoom level. Leave 0 to automatically fit to bounds.', 'thevoux' )
		),
		array(
			'type'           => 'checkbox',
			'heading'        => esc_html__( 'Map Controls', 'thevoux' ),
			'param_name'     => 'map_controls',
			'std'            => 'panControl, zoomControl, mapTypeControl, scaleControl',
			'value'          => array(
				esc_html__('Pan Control', 'thevoux' )             => 'panControl',
				esc_html__('Zoom Control', 'thevoux' )            => 'zoomControl',
				esc_html__('Map Type Control', 'thevoux' )        => 'mapTypeControl',
				esc_html__('Scale Control', 'thevoux' )           => 'scaleControl',
				esc_html__('Street View Control', 'thevoux' )     => 'streetViewControl'
			),
			'description'    => esc_html__( 'Toggle map options.', 'thevoux' )
		),
		array(
			'type'           => 'dropdown',
			'heading'        => esc_html__( 'Map Type', 'thevoux' ),
			'param_name'     => 'map_type',
			'std'            => 'roadmap',
			'value'          => array(
				esc_html__('Roadmap', 'thevoux' )   => 'roadmap',
				esc_html__('Satellite', 'thevoux' ) => 'satellite',
				esc_html__('Hybrid', 'thevoux' )    => 'hybrid',
			),
			'description' => esc_html__( 'Choose map style.', 'thevoux' )
		),
		array(
			'type' => 'textarea_raw_html',
			'heading' => esc_html__( 'Map Style', 'thevoux' ),
			'param_name' => 'map_style',
			'description' => esc_html__( 'Paste the style code here. Browse map styles in https://snazzymaps.com', 'thevoux' )
		),
	),
	"description" => esc_html__( "Insert your Contact Map", 'thevoux' ),
	"js_view" => 'VcColumnView'
) );

vc_map( array(
	"name" => esc_html__( "Contact Map Location", 'thevoux' ),
	"base" => "thb_contactmap_pin",
	"icon" => "thb_vc_ico_contactmap",
	"class" => "thb_vc_sc_contactmap",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"as_child"         => array('only' => 'thb_contactmap'),
	"params"           => array(
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Marker Image', 'thevoux' ),
			'param_name'     => 'marker_image',
			'description'    => esc_html__( 'Add your Custom marker image or use default one.', 'thevoux' )
		),
		array(
			'type'           => 'checkbox',
			'heading'        => esc_html__( 'Retina Marker', 'thevoux' ),
			'param_name'     => 'retina_marker',
			'std'            => '',
			'value'          => array(
				esc_html__( "Yes", 'thevoux' ) => 'yes',
			),
			'description'    => esc_html__( 'Enabling this option will reduce the size of marker for 50%, example if marker is 32x32 it will be 16x16.', 'thevoux' )
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Latitude', 'thevoux' ),
			'admin_label' 	 => true,
			'param_name'     => 'latitude',
			'description'    => esc_html__( 'Enter latitude coordinate. To select map coordinates <a href="http://www.latlong.net/convert-address-to-lat-long.html" target="_blank">click here</a>.', 'thevoux' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Longitude', 'thevoux' ),
			'admin_label' 	 => true,
			'param_name'     => 'longitude',
			'description'    => esc_html__( 'Enter longitude coordinate.', 'thevoux' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Marker Title', 'thevoux' ),
			'param_name'     => 'marker_title',
		),
		array(
			'type'           => 'textarea',
			'heading'        => esc_html__( 'Marker Description', 'thevoux' ),
			'param_name'     => 'marker_description',
		)
	)
) );

class WPBakeryShortCode_thb_contactmap extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_thb_contactmap_pin extends WPBakeryShortCode {}

// Content box shortcode
vc_map( array(
	"name" => esc_html__( "Content Box", 'thevoux' ),
	"base" => "thb_contentbox",
	"icon" => "thb_vc_ico_contentbox",
	"class" => "thb_vc_sc_contentbox",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__( "Top Image", 'thevoux' ),
			"param_name" => "image",
			"description" => esc_html__( "The image to show at the top.", 'thevoux' )
		),
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__( "Link Content Box?", 'thevoux' ),
		  "param_name" => "link",
		  "description" => esc_html__( "Enter url if you want this content box to have link.", 'thevoux' )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Heading", 'thevoux' ),
			"param_name" => "heading",
			"admin_label" => true
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Heading Color", 'thevoux' ),
			"param_name" => "heading_color",
			"description" => esc_html__( "You can change the heading color from here", 'thevoux' )
		),
		array(
			"type" => "textarea",
			"heading" => esc_html__( "Content", 'thevoux' ),
			"param_name" => "content"
		),
		array(
		  "type"              => "colorpicker",
		  "holder"            => "div",
		  "heading"           => esc_html__( "Content Color", 'thevoux' ),
		  "param_name"        => "content_color",
		  "admin_label" => false,
		),
		$thb_animation_array
	),
	"description" => esc_html__( "Content boxes with images", 'thevoux' )
) );

// Content Carousel Shortcode
vc_map( array(
	"name" => esc_html__( "Content Carousel", 'thevoux' ),
	"base" => "thb_content_carousel",
	"icon" => "thb_vc_ico_content_carousel",
	"class" => "thb_vc_sc_content_carousel",
	"as_parent" => array('except' => 'thb_content_carousel'),
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"show_settings_on_create" => true,
	"content_element" => true,
	"params" => array(
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Columns", 'thevoux' ),
		  "param_name" => "thb_columns",
		  "value" => array(
				'Six Columns' => "6",
				'Five Columns' => "5",
				'Four Columns' => "4",
				'Three Columns' => "3",
				'Two Columns' => "2",
				'One Column' => "1"
			),
			"std" => "3",
		  "description" => esc_html__( "Select the layout.", "thevoux" )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Pagination", 'thevoux' ),
			"param_name" => "thb_pagination",
			"group" => "Controls",
			"value" => array(
				"Yes" => "true"
			),
			"std" => "true"
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Navigation Arrows", 'thevoux' ),
			"param_name" => "thb_navigation",
			"group" => "Controls",
			"value" => array(
				"Yes" => "true"
			),
			"std" => ""
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Auto Play", 'thevoux' ),
			"param_name" => "autoplay",
			"value" => array(
				"Yes" => "true"
			),
			"description" => esc_html__( "If enabled, the carousel will autoplay.", 'thevoux' ),
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Speed of the AutoPlay", 'thevoux' ),
			"param_name" => "autoplay_speed",
			"value" => "4000",
			"description" => esc_html__( "Speed of the autoplay, default 4000 (4 seconds)", 'thevoux' ),
			"dependency" => Array('element' => "autoplay", 'value' => array('true'))
		),
		array(
	    "type" => "dropdown",
	    "heading" => esc_html__( "Margins between items", 'thevoux' ),
	    "param_name" => "thb_margins",
	    "group" => "Styling",
	    "std"=> "regular-padding",
	    "value" => array(
	    	'Regular' => "regular-padding",
	    	'Mini' => "mini-padding",
	    	'Pixel' => "pixel-padding",
	    	'None' => "no-padding"
	    ),
	    "description" => esc_html__( "This will change the margins between items", "thevoux" )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Overflow Visible?", 'thevoux' ),
			"param_name" => "thb_overflow",
			"group" => "Styling",
			"value" => array(
				"Yes" => "overflow-visible-only"
			),
			"std" => ""
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Class Name", 'thevoux' ),
			"param_name" => "extra_class",
		),
	),
	"js_view" => 'VcColumnView',
	"description" => esc_html__( "Display your content in a carousel", 'thevoux' )
) );

class WPBakeryShortCode_Thb_Content_Carousel extends WPBakeryShortCodesContainer { }

// Fade Type
vc_map( array(
	'base'  => 'thb_fadetype',
	'name' => esc_html__('Fade Type', 'thevoux' ),
	"description" => esc_html__( "Faded letter typing", 'thevoux' ),
	'category' => esc_html__('by Fuel Themes', 'thevoux' ),
	"icon" => "thb_vc_ico_fadetype",
	"class" => "thb_vc_sc_fadetype",
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'thevoux' ),
			'param_name' => 'fade_text',
			'value'		 => '<h2>*Unleash creativity with the powerful tools of thevoux, Developed by Fuel Themes*</h2>',
			'description'=> 'Enter the content to display with typing text. <br />
			Text within <b>*</b> will be animated, for example: <strong>*Sample text*</strong>. ',
			"admin_label" => true
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Class Name", 'thevoux' ),
			"param_name" => "extra_class",
		),
	)
) );

// Gradient Type
vc_map( array(
	'base'  => 'thb_gradienttype',
	'name' => esc_html__('Gradient Type', 'thevoux' ),
	"description" => esc_html__( "Text with Gradient Color", 'thevoux' ),
	'category' => esc_html__('by Fuel Themes', 'thevoux' ),
	"icon" => "thb_vc_ico_gradienttype",
	"class" => "thb_vc_sc_gradienttype",
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'thevoux' ),
			'param_name' => 'gradient_text',
			'value'		 => '<h2>Unleash creativity with the powerful tools of thevoux, Developed by Fuel Themes</h2>',
			'description'=> 'Enter the content to display with gradient.',
			"admin_label" => true
		),
		$thb_animation_array,
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Class Name", 'thevoux' ),
			"param_name" => "extra_class",
		),
	)
) );
vc_add_param( "thb_gradienttype", thb_vc_gradient_color1() );
vc_add_param( "thb_gradienttype", thb_vc_gradient_color2() );

// Gap shortcode
vc_map( array(
	"name" => esc_html__( "Gap", 'thevoux' ),
	"base" => "thb_gap",
	"icon" => "thb_vc_ico_gap",
	"class" => "thb_vc_sc_gap",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
		  "type" => "textfield",
		  "heading" => esc_html__( "Gap Height", 'thevoux' ),
		  "param_name" => "height",
		  "admin_label" => true,
		  "description" => esc_html__( "Enter height of the gap in px.", 'thevoux' )
		)
	),
	"description" => esc_html__( "Add a gap to seperate elements", 'thevoux' )
) );

// Icon List shortcode
vc_map( array(
	"name" => esc_html__( "Icon List", 'thevoux' ),
	"base" => "thb_iconlist",
	"icon" => "thb_vc_ico_iconlist",
	"class" => "thb_vc_sc_iconlist",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'thevoux' ),
			'param_name' => 'icon',
			'value' => 'fa fa-adjust', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
			),
			'description' => esc_html__( 'Select icon from library.', 'thevoux' ),
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Icon color", 'thevoux' ),
			"param_name" => "color"
		),
		$thb_animation_array,
		array(
			"type" => "exploded_textarea",
			"heading" => esc_html__( "List Items", 'thevoux' ),
			"admin_label" => true,
			"param_name" => "content",
			"description" => esc_html__( "Every new line will be treated as a list item", 'thevoux' )
		)
	),
	"description" => esc_html__( "Add lists with icons", 'thevoux' )
) );

// 3D Image shortcode
vc_map( array(
	"name" => esc_html__( "3D Hover Image", 'thevoux' ),
	"base" => "thb_threedimage",
	"icon" => "thb_vc_ico_threedimage",
	"class" => "thb_vc_sc_threedimage",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__( "Select Image", 'thevoux' ),
			"param_name" => "image"
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Full Width?", 'thevoux' ),
			"param_name" => "full_width",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
			"description" => esc_html__( "If selected, the image will always fill its container", 'thevoux' )
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Image alignment", 'thevoux' ),
		  "param_name" => "alignment",
		  "value" => array("Align left" => "left", "Align right" => "right", "Align center" => "center"),
		  "description" => esc_html__( "Select image alignment.", 'thevoux' )
		),
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__( "Image link", 'thevoux' ),
		  "param_name" => "img_link",
		  "description" => esc_html__( "Set Image Link here", 'thevoux' ),
		  "admin_label" => true,
		)
	),
	"description" => esc_html__( "Add a 3D animated image", 'thevoux' )
) );

// Image Hotspots shortcode
vc_map( array(
	"name" => esc_html__( "Image Hot Spots", 'thevoux' ),
	"base" => "thb_hotspots",
	"icon" => "thb_vc_ico_imagehotspots",
	"class" => "thb_vc_sc_hotspots",
	"admin_enqueue_js" => array( Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/js/vendor/jquery.hotspot.js'),
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__( "Select Image", 'thevoux' ),
			"param_name" => "image",
			"description" => esc_html__( "After selecting your image, you can then click on the image in the preview area to add your hotspots on the desired locations.", 'thevoux' )
		),
		array(
      'type' => 'thb_hotspot_param',
      'heading' => esc_html__( "Image Preview", 'thevoux' ),
      'param_name' => 'thb_hotspot_data',
      'edit_field_class' => 'vc_column vc_col-sm-12',
			"description" => esc_html__( "Click to add a hotspot - Drag to move it", 'thevoux' )
    ),
		array(
      'type' => 'dropdown',
      'param_name' => 'thb_tooltip_function',
      'heading' => esc_html__( "Tooltip Functionality", 'thevoux' ),
			"value" => array(
				"Show on Hover" => "hover",
				"Show on Click" => "click",
				"Show Always" => "always",
			),
			"std" => "hover",
			"group" => esc_html__( "Styling", 'thevoux' ),
    ),
		array(
      'type' => 'dropdown',
      'param_name' => 'thb_pin_color',
      'heading' => esc_html__( "Pin Color", 'thevoux' ),
			"value" => array(
				"Accent" => "pin-accent",
				"Black" => "pin-black",
				"White" => "pin-white",
			),
			"std" => "accent",
			"group" => esc_html__( "Styling", 'thevoux' ),
    ),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Pin Animation", 'thevoux' ),
			"param_name" => "animation",
			"value" => array(
				"None" => "",
				"Left" => "animation right-to-left",
				"Right" => "animation left-to-right",
				"Top" => "animation bottom-to-top",
				"Bottom" => "animation top-to-bottom",
				"Scale" => "animation scale",
				"Fade" => "animation fade-in"
			),
			"group" => esc_html__( "Styling", 'thevoux' ),
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Enable Pulsate Effect", 'thevoux' ),
			"param_name" => "thb_pulsate",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) => "thb-pulsate"
			),
			"std" => "thb-pulsate",
			"description" => esc_html__( "Shows a pulsate around the pin.", 'thevoux' ),
			"group" => esc_html__( "Styling", 'thevoux' ),
		)
	),
	"description" => esc_html__( "Add an image with hotspots", 'thevoux' )
) );

// Image shortcode
vc_map( array(
	"name" => esc_html__( "Image", 'thevoux' ),
	"base" => "thb_image",
	"icon" => "thb_vc_ico_image",
	"class" => "thb_vc_sc_image",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
			"type" => "attach_image", //attach_images
			"heading" => esc_html__( "Select Image", 'thevoux' ),
			"param_name" => "image"
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Retina Size?", 'thevoux' ),
			"param_name" => "retina",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) => "retina_size"
			),
			"description" => esc_html__( "If selected, the image will be display half-size, so it looks crisps on retina screens. Full Width setting will override this.", 'thevoux' )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Full Width?", 'thevoux' ),
			"param_name" => "full_width",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
			"description" => esc_html__( "If selected, the image will always fill its container", 'thevoux' )
		),
		$thb_animation_array,
		array(
		  "type" => "textfield",
		  "heading" => esc_html__( "Image size", 'thevoux' ),
		  "param_name" => "img_size",
		  "description" => esc_html__( "Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", 'thevoux' )
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Image alignment", 'thevoux' ),
		  "param_name" => "alignment",
		  "value" => array("Align left" => "left", "Align right" => "right", "Align center" => "center"),
		  "description" => esc_html__( "Select image alignment.", 'thevoux' )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Link to Full-Width Image?", 'thevoux' ),
			"param_name" => "lightbox",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			)
		),
		array(
		  "type" => "vc_link",
		  "heading" => esc_html__( "Image link", 'thevoux' ),
		  "param_name" => "img_link",
		  "description" => esc_html__( "Enter url if you want this image to have link.", 'thevoux' ),
		  "dependency" => Array('element' => "lightbox", 'is_empty' => true)
		)
	),
	"description" => esc_html__( "Add an animated image", 'thevoux' )
) );

// Instagram
vc_map( array(
	"name" => esc_html__( "Instagram", 'thevoux' ),
	"base" => "thb_instagram",
	"icon" => "thb_vc_ico_instagram",
	"class" => "thb_vc_sc_instagram",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Style", 'thevoux' ),
		  "param_name" => "style",
		  "admin_label" => true,
		  "value" => array(
		  	'Grid' => "style1",
		  	'Free Scroll' => "style2"
		  ),
		  "description" => esc_html__( "This changes the layouts of the photos", 'thevoux' )
		),
		array(
      "type" => "textfield",
      "heading" => esc_html__( "Instagram Username", 'thevoux' ),
      "param_name" => "username",
      "admin_label" => true,
      "description" => esc_html__( "Instagram username to retrieve photos from.", 'thevoux' )
	  ),
		array(
      "type" => "textfield",
      "heading" => esc_html__( "Instagram Access Token", 'thevoux' ),
      "param_name" => "access_token",
      "description" => esc_html__( "Instagram Access Token.", 'thevoux' )
	  ),
	  array(
      "type" => "textfield",
      "heading" => esc_html__( "Number of Photos", 'thevoux' ),
      "param_name" => "number",
      "admin_label" => true,
      "description" => esc_html__( "Number of Instagram Photos to retrieve", 'thevoux' )
	  ),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns", 'thevoux' ),
			"param_name" => "columns",
			"value" => array(
				'Six Columns' => "6",
				'Five Columns' => "5",
				'Four Columns' => "4",
				'Three Columns' => "3",
				'Two Columns' => "2"
			)
		),
		array(
	    "type" => "checkbox",
	    "heading" => esc_html__( "Link Photos to Instagram?", 'thevoux' ),
	    "param_name" => "link",
	    "value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
	    "description" => esc_html__( "Do you want to link the Instagram photos to instagram.com website?", 'thevoux' )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Disable Column Padding", 'thevoux' ),
			"param_name" => "column_padding",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) => "false"
			),
			"description" => esc_html__( "You can have columns without spaces using this option"	, 'thevoux' )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Low Column Padding", 'thevoux' ),
			"param_name" => "low_padding",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) => "false"
			),
			"description" => esc_html__( "You can have columns with smaller spacing. Does not work together with 'Disable Column Padding'", 'thevoux' )
		)
	),
	"description" => esc_html__( "Add Instagram Photos", 'thevoux' )
) );

// Instagram Block
vc_map( array(
	"name" => esc_html__( "Instagram Block", 'thevoux' ),
	"base" => "thb_instagram_block",
	"icon" => "thb_vc_ico_instagram",
	"class" => "thb_vc_sc_instagram",
	"category" => esc_html__( "by Fuel Themes", 'thevoux' ),
	"params"	=> array(
		array(
      "type" => "textfield",
      "heading" => esc_html__( 'Instagram Username', 'thevoux' ),
      "param_name" => "username",
      "admin_label" => true,
      "description" => esc_html__( "Instagram username to retrieve photos from.", 'thevoux' ),
	  ),
		array(
      "type" => "textfield",
      "heading" => esc_html__( "Instagram Access Token", 'thevoux' ),
      "param_name" => "access_token",
      "description" => esc_html__( "Instagram Access Token.", 'thevoux' )
	  ),
		array(
	    "type" => "checkbox",
	    "heading" => esc_html__( 'Link Photos to Instagram?', 'thevoux' ),
	    "param_name" => "link",
	    "value" => array(
				esc_html__( 'Yes', 'thevoux' ) =>"true"
			),
			"group" => 'Other',
	    "description" => esc_html__( "Do you want to link the Instagram photos to instagram.com website?", 'thevoux' )
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Color - 1", 'thevoux'),
			"param_name" => "thb_color",
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Select background color", 'thevoux')
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Color - 2", 'thevoux'),
			"param_name" => "thb_color2",
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Select background color", 'thevoux')
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Color - 3", 'thevoux'),
			"param_name" => "thb_color3",
			'edit_field_class' => 'vc_col-sm-4',
			"description" => esc_html__( "Select background color", 'thevoux')
		),
	),
	"description" => esc_html__( 'Add Instagram Photos', 'thevoux' )
) );

// Posts
vc_map( array(
	"name" => esc_html__( "Posts Grid", 'thevoux' ),
	"base" => "thb_postgrid",
	"icon" => "thb_vc_ico_postgrid",
	"class" => "thb_vc_sc_postgrid",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
	  array(
	      "type" => "thb_radio_image",
	      "heading" => esc_html__( "Style", 'thevoux' ),
	      "param_name" => "style",
				"std" => "style1",
	      "admin_label" => true,
				"options" => array(
		    	'style1' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style1.png",
		    	'style4' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style4.png",
		    	'style11' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style11.png",
		    	'style2' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style2.png",
		    	'style2-alt' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style2-alt.png",
		    	'style2-bg' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style2-bg.png",
		    	'style3' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style3.png",
		    	'style5' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style5.png",
		    	'style6' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style6.png",
					'style7' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style7.png",
					'style8' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style8.png",
					'style9' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style9.png",
					'style10' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style10.png",
					'style12' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style12.png",
					'style13' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postgrid/style13.png"
		    ),
	      "description" => esc_html__( "This changes the style of the posts", 'thevoux' )
	  ),
	  array(
	  	"type" => "checkbox",
	  	"heading" => esc_html__( "Add Title?", 'thevoux' ),
	  	"param_name" => "add_title",
	  	"value" => array(
	  		esc_html__( "Yes", 'thevoux' ) =>"true"
	  	),
	  	"description" => esc_html__( "If enabled, this will allow you to add a title above the posts", 'thevoux' )
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__( "Title Style", 'thevoux' ),
	      "param_name" => "title_style",
	      "admin_label" => true,
	      "value" => array(
	      	'Style 1' => "style1",
	      	'Style 2' => "style2",
	      	'Style 3' => "style3",
	      	'Style 4' => "style4"
	      ),
	      "description" => esc_html__( "This changes the style of the category titles", 'thevoux' ),
	      "dependency" => Array('element' => "add_title", 'value' => array('true'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Title", 'thevoux' ),
	    "param_name" => "title",
	    "description" => esc_html__( "Add your own title here", 'thevoux' ),
	    "dependency" => Array('element' => "add_title", 'value' => array('true'))
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__( "Columns", 'thevoux' ),
	      "param_name" => "columns",
	      "admin_label" => true,
	      "value" => array(
	      	'Six Columns' => "6",
	      	'Four Columns' => "4",
	      	'Three Columns' => "3",
	      	'Two Columns' => "2"
	      ),
	      "description" => esc_html__( "Select the layout of the posts.", 'thevoux' ),
	      "dependency" => Array('element' => "style", 'value' => array('style1', 'style4', 'style11', 'style8', 'style10', 'style13'))
	  ),
	  array(
	      "type" => "loop",
	      "heading" => esc_html__( "Post Source", 'thevoux' ),
	      "param_name" => "source",
	      "description" => esc_html__( "Set your post source here", 'thevoux' )
	  ),
	  array(
  	    "type" => "textfield",
  	    "heading" => esc_html__( "Offset", 'thevoux' ),
  	    "param_name" => "offset",
  	    "description" => esc_html__( "You can offset your post with the number of posts entered in this setting", 'thevoux' )
  	),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Featured Posts (Enlarged Post Image)", 'thevoux' ),
	    "param_name" => "featured_index",
	    "description" => esc_html__( "Enter the number for which posts to show as Featured (For ex, entering 1,3,5 will make those posts appear larger, these are not post IDs, just the number in which they appear)", 'thevoux' ),
	    "dependency" => Array('element' => "style", 'value' => array('style2', 'style2-alt'))
	  ),
	  array(
	  	"type" => "dropdown",
	  	"heading" => esc_html__( "Ajax Pagination", 'thevoux' ),
	  	"param_name" => "pagination",
			"group"					 => 'Pagination / Load More',
			"value" => array(
				'None' => "",
				'Pagination' => "true",
				'Load More' => "style2",
				'Infinite Load' => "style3"
			),
	  	"description" => esc_html__( "If enabled, this will show pagination underneath. Offset setting does not work.", 'thevoux' )
	  ),
	  array(
	  	"type" => "checkbox",
	  	"heading" => esc_html__( "Disable Post Excrepts", 'thevoux' ),
	  	"param_name" => "disable_excerpts",
	  	"value" => array(
	  		esc_html__( "Yes", 'thevoux' ) =>"true"
	  	),
	  	"description" => esc_html__( "You can hide the post excerpts here", 'thevoux' ),
	  	"dependency" => Array('element' => "style", 'value' => array('style1'))
	  ),
	  array(
	  	"type" => "checkbox",
	  	"heading" => esc_html__( "Disable Post Meta", 'thevoux' ),
	  	"param_name" => "disable_postmeta",
	  	"value" => array(
	  		esc_html__( "Yes", 'thevoux' ) =>"true"
	  	),
	  	"description" => esc_html__( "You can hide the post meta here", 'thevoux' ),
	  	"dependency" => Array('element' => "style", 'value' => array( 'style1' ) )
	  )
	),
	"description" => esc_html__( "Display your posts in different grid layouts.", 'thevoux' )
) );

// Posts Carousel
vc_map( array(
	"name" => esc_html__( "Posts Carousel", 'thevoux' ),
	"base" => "thb_postcarousel",
	"icon" => "thb_vc_ico_postcarousel",
	"class" => "thb_vc_sc_postcarousel",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
		array(
		    "type" => "thb_radio_image",
		    "heading" => esc_html__( "Style", 'thevoux' ),
		    "param_name" => "style",
		    "admin_label" => true,
				"std" => "style1",
				"options" => array(
		    	'style1' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style1.png",
					'style2' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style2.png",
					'style3' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style3.png",
					'style4' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style4.png",
					'style5' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style5.png",
					'style6' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style6.png",
					'style7' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style7.png",
					'style8' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style8.png",
					'style9' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style9.png",
					'style10' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style10.png",
					'style11' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcarousel/style11.png"
		    ),
		    "description" => esc_html__( "This changes the style of the posts", 'thevoux' )
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns", 'thevoux' ),
			"param_name" => "columns",
			"value" => array(
				'Six Columns' => "6",
				'Five Columns' => "5",
				'Four Columns' => "4",
				'Three Columns' => "3",
				'Two Columns' => "2",
				'One Columns' => "1"
			),
			"description" => esc_html__( "Select the layout.", 'thevoux' )
		),
		array(
		    "type" => "loop",
		    "heading" => esc_html__( "Post Source", 'thevoux' ),
		    "param_name" => "source",
		    "description" => esc_html__( "Set your post source here", 'thevoux' )
		),
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Offset", 'thevoux' ),
		    "param_name" => "offset",
		    "description" => esc_html__( "You can offset your post with the number of posts entered in this setting", 'thevoux' )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Centered Slides?", 'thevoux' ),
			"param_name" => "center",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
			"std" => "true",
			"description" => esc_html__( "When enabled shows the next and previous slides on the sides.", 'thevoux' ),
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Pagination", 'thevoux' ),
			"param_name" => "pagination",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
			"description" => esc_html__( "If enabled, this will show pagination circles underneath", 'thevoux' ),
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Navigation Arrows", 'thevoux' ),
			"param_name" => "navigation",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
			"description" => esc_html__( "If enabled, this will show navigation arrows on the side", 'thevoux' ),
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Add Title?", 'thevoux' ),
			"param_name" => "add_title",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
			"description" => esc_html__( "If enabled, this will allow you to add a title above the posts", 'thevoux' )
		),
		array(
		    "type" => "dropdown",
		    "heading" => esc_html__( "Title Style", 'thevoux' ),
		    "param_name" => "title_style",
		    "admin_label" => true,
		    "value" => array(
		    	'Style 1' => "style1",
		    	'Style 2' => "style2",
		    	'Style 3' => "style3",
		    	'Style 4' => "style4"
		    ),
		    "description" => esc_html__( "This changes the style of the category titles", 'thevoux' ),
		    "dependency" => Array('element' => "add_title", 'value' => array('true'))
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__( "Title", 'thevoux' ),
		  "param_name" => "title",
		  "description" => esc_html__( "Add your own title here", 'thevoux' ),
		  "dependency" => Array('element' => "add_title", 'value' => array('true'))
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Auto Play", 'thevoux' ),
			"param_name" => "autoplay",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) => "true"
			),
			"std" => "true",
			"description" => esc_html__( "If enabled, the carousel will autoplay.", 'thevoux' ),
			"dependency" => Array('element' => "thb_carousel", 'value' => array('true'))
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Speed of the AutoPlay", 'thevoux' ),
			"param_name" => "autoplay_speed",
			"value" => "4000",
			"description" => esc_html__( "Speed of the autoplay, default 4000 (4 seconds)", 'thevoux' ),
			"dependency" => Array('element' => "autoplay", 'value' => array('true'))
		),
	),
	"description" => esc_html__( "Display Posts from your blog in a Carousel", 'thevoux' )
) );

// Posts Category
vc_map( array(
	"name" => esc_html__( "Posts Category", 'thevoux' ),
	"base" => "thb_postcategory",
	"icon" => "thb_vc_ico_postcategory",
	"class" => "thb_vc_sc_postcategory",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
		array(
		    "type" => "thb_radio_image",
		    "heading" => esc_html__( "Style", 'thevoux' ),
		    "param_name" => "style",
		    "admin_label" => true,
				"std" => "style1",
				"options" => array(
		    	'style1' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style1.png",
					'style1-alt' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style1-alt.png",
					'style7' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style7.png",
					'style2' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style2.png",
					'style3' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style3.png",
					'style3-alt' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style3-alt.png",
					'style3-nothumbs' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style3-nothumbs.png",
					'style4' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style4.png",
					'style5' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style5.png",
					'style6' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postcategory/style6.png"
		    ),
		    "description" => esc_html__( "This changes the style of the category posts", 'thevoux' )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Add Title?", 'thevoux' ),
			"param_name" => "add_title",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) =>"true"
			),
			"std" => "true",
			"description" => esc_html__( "If enabled, this will add the category title on top.", 'thevoux' )
		),
		array(
		    "type" => "dropdown",
		    "heading" => esc_html__( "Title Style", 'thevoux' ),
		    "param_name" => "title_style",
		    "admin_label" => true,
		    "value" => array(
		    	'Style 1' => "style1",
		    	'Style 2' => "style2",
		    	'Style 3' => "style3",
		    	'Style 4' => "style4",
		    	'Style 5' => "style5"
		    ),
		    "description" => esc_html__( "This changes the style of the category titles", 'thevoux' ),
		    "dependency" => Array('element' => "add_title", 'value' => array('true'))
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Post Categories", 'thevoux' ),
		  "param_name" => "cat",
		  "value" => thb_blogCategories(),
		  "description" => esc_html__( "Which category would you like to show?", 'thevoux' )
		),
		array(
		  "type" => "textfield",
		  "heading" => esc_html__( "Offset", 'thevoux' ),
		  "param_name" => "offset",
		  "description" => esc_html__( "You can offset your post with the number of posts entered in this setting", 'thevoux' )
		)
	),
	"description" => esc_html__( "Display a Category with posts", 'thevoux' )
) );

// Post Masonry
vc_map( array(
	"name" => esc_html__( "Posts Masonry", 'thevoux' ),
	"base" => "thb_postmasonry",
	"icon" => "thb_vc_ico_postmasonry",
	"class" => "thb_vc_sc_postmasonry",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
		array(
		    "type" => "thb_radio_image",
		    "heading" => esc_html__( "Style", 'thevoux' ),
		    "param_name" => "style",
		    "admin_label" => true,
				"options" => array(
		    	'style1' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postmasonry/style1.png",
					'style2' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postmasonry/style2.png",
					'style3' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postmasonry/style3.png",
					'style4' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postmasonry/style4.png",
		    ),
				"std" => "style1",
		    "description" => esc_html__( "Select the style of the masonry.", 'thevoux' )
		),
		array(
		    "type" => "dropdown",
		    "heading" => esc_html__( "Columns", 'thevoux' ),
		    "param_name" => "columns",
		    "admin_label" => true,
		    "value" => array(
		    	'Four Columns' => "large-3",
		    	'Three Columns' => "large-4",
		    	'Two Columns' => "large-6"
		    ),
		    "description" => esc_html__( "Select the layout of the masonry.", 'thevoux' )
		),
		array(
		    "type" => "loop",
		    "heading" => esc_html__( "Post Source", 'thevoux' ),
		    "param_name" => "source",
		    "description" => esc_html__( "Set your post source here", 'thevoux' )
		),
		array(
		    "type" => "textfield",
		    "heading" => esc_html__( "Offset", 'thevoux' ),
		    "param_name" => "offset",
		    "description" => esc_html__( "You can offset your post with the number of posts entered in this setting", 'thevoux' )
		),
		array(
		    "type" => "checkbox",
		    "heading" => esc_html__( "Add Load More Button?", 'thevoux' ),
		    "param_name" => "loadmore",
		    "value" => array(
		    		esc_html__( "Yes", 'thevoux' ) =>"true"
		    	),
		    "description" => esc_html__( "Add Load More button at the bottom", 'thevoux' )
		),
	),
	"description" => esc_html__( "Show your posts in a masonry grid", 'thevoux' )
) );

// Posts Slider
vc_map( array(
	"name" => esc_html__( "Posts Slider", 'thevoux' ),
	"base" => "thb_postslider",
	"icon" => "thb_vc_ico_postslider",
	"class" => "thb_vc_sc_postslider",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
	  array(
	      "type" => "thb_radio_image",
	      "heading" => esc_html__( "Type", 'thevoux' ),
	      "param_name" => "style",
				"std" => "featured-style1",
				"options" => array(
		    	'featured-style1' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style1.png",
		    	'featured-style5' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style5.png",
					'featured-style2' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style2.png",
					'featured-style3' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style3.png",
					'featured-style8' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style8.png",
					'featured-style9' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style9.png",
					'featured-style9 offset' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style9-offset.png",
					'featured-style10' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style10.png",
					'featured-style11' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style11.png",
					'featured-style12' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style12.png",
					'featured-style13' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style13.png",
					'featured-style14' => Thb_Theme_Admin::$thb_theme_directory_uri."/assets/img/admin/postslider/featured-style14.png",
		    ),
	      "admin_label" => true,
	      "description" => esc_html__( "Select the slider style.", 'thevoux' )
	  ),
	  array(
	      "type" => "loop",
	      "heading" => esc_html__( "Post Source", 'thevoux' ),
	      "param_name" => "source",
	      "description" => esc_html__( "Set your post source here", 'thevoux' )
	  ),
	  array(
	      "type" => "textfield",
	      "heading" => esc_html__( "Offset", 'thevoux' ),
	      "param_name" => "offset",
	      "description" => esc_html__( "You can offset your post with the number of posts entered in this setting", 'thevoux' )
	  ),
	  array(
	  	"type" => "checkbox",
	  	"heading" => esc_html__( "Pagination", 'thevoux' ),
	  	"param_name" => "pagination",
	  	"value" => array(
	  		esc_html__( "Yes", 'thevoux' ) =>"true"
	  	),
	  	"description" => esc_html__( "If enabled, this will show pagination circles underneath", 'thevoux' ),
	  ),
	  array(
	  	"type" => "checkbox",
	  	"heading" => esc_html__( "Navigation Arrows", 'thevoux' ),
	  	"param_name" => "navigation",
	  	"value" => array(
	  		esc_html__( "Yes", 'thevoux' ) =>"true"
	  	),
	  	"description" => esc_html__( "If enabled, this will show navigation arrows on the side", 'thevoux' ),
	  ),
	  array(
	  	"type" => "checkbox",
	  	"heading" => esc_html__( "Auto Play", 'thevoux' ),
	  	"param_name" => "autoplay",
	  	"value" => array(
	  		esc_html__( "Yes", 'thevoux' ) => "true"
	  	),
	  	"std" => "",
	  	"description" => esc_html__( "If enabled, the slider will autoplay.", 'thevoux' )
	  ),
	  array(
	  	"type" => "textfield",
	  	"heading" => esc_html__( "Speed of the AutoPlay", 'thevoux' ),
	  	"param_name" => "autoplay_speed",
	  	"value" => "4000",
	  	"description" => esc_html__( "Speed of the autoplay, default 4000 (4 seconds)", 'thevoux' ),
	  	"dependency" => Array('element' => "autoplay", 'value' => array('true'))
	  ),
	),
	"description" => esc_html__( "Display Posts from your blog in a Slider", 'thevoux' )
) );

// Pricing Table Parent
vc_map( array(
	"name" => esc_html__( "Pricing Table", 'thevoux' ),
	"base" => "thb_pricing_table",
	"icon" => "thb_vc_ico_pricing_table",
	"class" => "thb_vc_sc_pricing_table",
	"content_element"	=> true,
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"as_parent" => array('only' => 'thb_pricing_column'),
	"params"	=> array(
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Columns", 'thevoux' ),
			"param_name" => "thb_pricing_columns",
			"admin_label" => true,
			"value" => array(
				'2 Columns' => "large-6",
				'3 Columns' => "large-4",
				'4 Columns' => "medium-4 large-3",
				'5 Columns' => "medium-6 thb-5",
				'6 Columns' => "medium-4 large-2"
			)
		)
	),
	"description" => esc_html__( "Pricing Table", 'thevoux' ),
	"js_view" => 'VcColumnView'
) );

vc_map( array(
	"name" => esc_html__( "Pricing Table Column", 'thevoux' ),
	"base" => "thb_pricing_column",
	"icon" => "thb_vc_ico_pricing_table",
	"class" => "thb_vc_sc_pricing_table",
	"as_child" => array('only' => 'thb_pricing_table'),
	"params"	=> array(
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Highlight?", 'thevoux' ),
			"param_name" => "highlight",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) => "true"
			),
			"description" => esc_html__( "If enabled, this column will be hightlighted.", 'thevoux' ),
		),
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Image', 'thevoux' ),
			'param_name'     => 'image',
			'description'    => esc_html__( 'Select an image if you would like to display one on top.', 'thevoux' )
		),
		array(
			"type" => "checkbox",
			"heading" => esc_html__( "Retina Size?", 'thevoux' ),
			"param_name" => "retina",
			"value" => array(
				esc_html__( "Yes", 'thevoux' ) => "retina_size"
			),
			"description" => esc_html__( "If selected, the image will be display half-size, so it looks crisps on retina screens. Full Width setting will override this.", 'thevoux' )
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Title', 'thevoux' ),
			'param_name'     => 'title',
			'admin_label'	 => true,
			'description'    => esc_html__( 'Title of this pricing column', 'thevoux' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Price', 'thevoux' ),
			'param_name'     => 'price',
			'description'    => esc_html__( 'Price of this pricing column.', 'thevoux' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Sub Title', 'thevoux' ),
			'param_name'     => 'sub_title',
			'description'    => esc_html__( 'Some information under the price.', 'thevoux' ),
		),
		array(
			'type'           => 'textarea_html',
			'heading'        => esc_html__( 'Description', 'thevoux' ),
			'param_name'     => 'content',
			'description'    => esc_html__( 'Include a small description for this box, this text area supports HTML too.', 'thevoux' ),
		),
		array(
			'type'           => 'vc_link',
			'heading'        => esc_html__( 'Pricing CTA Button', 'thevoux' ),
			'param_name'     => 'link',
			'description'    => esc_html__( 'Button at the end of the pricing table.', 'thevoux' ),
		),
	),
	"description" => esc_html__( "Add a pricing table", 'thevoux' )
) );

class WPBakeryShortCode_thb_pricing_table extends WPBakeryShortCodesContainer {}
class WPBakeryShortCode_thb_pricing_column extends WPBakeryShortCode {}

// slidetype
vc_map( array(
	'base'  => 'thb_slidetype',
	'name' => esc_html__('Slide Type', 'thevoux' ),
	"description" => esc_html__( "Animated text scrolling", 'thevoux' ),
	'category' => esc_html__('by Fuel Themes', 'thevoux' ),
	"icon" => "thb_vc_ico_slidetype",
	"class" => "thb_vc_sc_slidetype",
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'thevoux' ),
			'param_name' => 'slide_text',
			'value'		 => '<h2>*thevoux;Developed by Fuel Themes*</h2>',
			'description'=> 'Enter the content to display with typing text. <br />
			Text within <b>*</b> will be animated, for example: <strong>*Sample text*</strong>. <br />
			Text separator is <b>;</b> for example: <strong>*thevoux; Developed by Fuel Themes*</strong> which will create new lines at ;',
			"admin_label" => true,
		),
		array(
			"type" => "dropdown",
			"heading" => esc_html__( "Style", 'thevoux' ),
			"param_name" => "style",
			"admin_label" => true,
			"value" => array(
				'Lines' => "style1",
				'Words' => "style2",
				'Characters' => "style3",
			),
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Animated Text Color", 'thevoux' ),
			"param_name" => "thb_animated_color",
			"description" => esc_html__( "Uses the accent color by default", 'thevoux' )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Class Name", 'thevoux' ),
			"param_name" => "extra_class",
		),
	)
) );

// stroke type
vc_map( array(
	'base'  => 'thb_stroketype',
	'name' => esc_html__('Stroke Type', 'thevoux' ),
	"description" => esc_html__( "Text with Stroke style", 'thevoux' ),
	'category' => esc_html__('by Fuel Themes', 'thevoux' ),
	"icon" => "thb_vc_ico_stroketype",
	"class" => "thb_vc_sc_stroketype",
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'thevoux' ),
			'param_name' => 'slide_text',
			'value'		 => '<h1>thevoux</h1>',
			'description'=> 'Enter the content to display with stroke.',
			"admin_label" => true,
		),
		array(
			"type" => "colorpicker",
			"heading" => esc_html__( "Text Color", 'thevoux' ),
			"param_name" => "thb_color",
			"description" => esc_html__( "Select text color", 'thevoux' )
		),
		array(
		  "type" 					=> "textfield",
		  "heading" 			=> esc_html__( "Stroke Width", 'thevoux' ),
		  "param_name" 		=> "stroke_width",
		  "std"=> "2px",
		  "description" 	=> esc_html__( "Enter the value for the stroke width. ", "thevoux" )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Extra Class Name", 'thevoux' ),
			"param_name" => "extra_class",
		),
		$thb_animation_array
	)
) );

// Subscription shortcode
vc_map( array(
	"name" => esc_html__( "Subscription Form", 'thevoux' ),
	"base" => "thb_subscribe",
	"icon" => "thb_vc_ico_subscribe",
	"class" => "thb_vc_sc_subscribe",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params" => array(
		array(
	    "type" => "dropdown",
	    "heading" => esc_html__( "Style", 'thevoux' ),
	    "param_name" => "style",
	    "admin_label" => true,
	    "value" => array(
	    	'Vertical' => "style1",
	    	'Horizontal' => "style2",
	    	'Inline' => "style3"
	    ),
	    "description" => esc_html__( "This changes the style of the subscribe form", 'thevoux' )
		),
		array(
			"type" => "textfield",
			"heading" => esc_html__( "Title", 'thevoux' ),
			"admin_label" => true,
			"param_name" => "title"
		),
		array(
			"type" => "textarea_html",
			"heading" => esc_html__( "Description", 'thevoux' ),
			"param_name" => "content"
		),
		array(
		  "type" => "dropdown",
		  "heading" => esc_html__( "Button Color", 'thevoux' ),
		  "param_name" => "btn_color",
		  "group"			 => 'Styling',
		  'std' 			=> 'black',
		  "value" => array(
		  	'Black' => 'black',
		  	'White' => 'white',
		  	'Accent' => 'accent'
		  ),
		  "description" => esc_html__( "This changes the color of the button", 'thevoux' )
		),
	),
	"description" => esc_html__( "Add a subscription form", 'thevoux' )
) );

// Video Playlist
vc_map( array(
	"name" => esc_html__( "Video Playlist", 'thevoux' ),
	"base" => "thb_videos",
	"icon" => "thb_vc_ico_videos",
	"class" => "thb_vc_sc_videos",
	"category" => esc_html__( 'by Fuel Themes', 'thevoux' ),
	"params"	=> array(
		array(
		    "type" => "dropdown",
		    "heading" => esc_html__( "Style", 'thevoux' ),
		    "param_name" => "style",
		    "admin_label" => true,
		    "value" => array(
		    	'Horizontal' => "style1",
		    	'Vertical' => "style2"
		    ),
		    "description" => esc_html__( "This changes the style of the playlist", 'thevoux' )
		),
	  array(
	  	"type" => "dropdown",
	  	"heading" => esc_html__( "Post Source", 'thevoux' ),
	  	"param_name" => "source",
	  	"value" => array(
	  		'Most Recent' => "most-recent",
	  		'By Category' => "by-category",
	  		'By Tag' => "by-tag",
	  		'By Author' => "by-author",
	  	),
	  	"std" => "most-recent",
	  	"admin_label" => true,
	  	"description" => esc_html__( "Select the source of the posts you'd like to show.", 'thevoux' )
	  ),
	  array(
	    "type" => "checkbox",
	    "heading" => esc_html__( "Post Categories", 'thevoux' ),
	    "param_name" => "cat",
	    "value" => thb_blogCategories(),
	    "description" => esc_html__( "Which categories would you like to show?", 'thevoux' ),
	    "dependency" => Array('element' => "source", 'value' => array('by-category'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Number of posts", 'thevoux' ),
	    "param_name" => "item_count",
	    "value" => "4",
	    "description" => esc_html__( "The number of posts to show.", 'thevoux' )
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Tag slugs", 'thevoux' ),
	    "param_name" => "tag_slugs",
	    "description" => esc_html__( "Enter the tag slugs you would like to display seperated by comma", 'thevoux' ),
	    "dependency" => Array('element' => "source", 'value' => array('by-tag'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Author IDs", 'thevoux' ),
	    "param_name" => "author_ids",
	    "description" => esc_html__( "Enter the Author IDs you would like to display seperated by comma", 'thevoux' ),
	    "dependency" => Array('element' => "source", 'value' => array('by-author'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Offset", 'thevoux' ),
	    "param_name" => "offset",
	    "description" => esc_html__( "You can offset your post with the number of posts entered in this setting", 'thevoux' ),
	    "dependency" => Array('element' => "source", 'value' => array('most-recent', 'by-category', 'by-tag', 'by-author'))
	  ),
	  array(
	  	"type" => "checkbox",
	  	"heading" => esc_html__( "Add Title?", 'thevoux' ),
	  	"param_name" => "add_title",
	  	"value" => array(
	  		esc_html__( "Yes", 'thevoux' ) =>"true"
	  	),
	  	"description" => esc_html__( "If enabled, this will allow you to add a title above the posts", 'thevoux' )
	  ),
	  array(
	      "type" => "dropdown",
	      "heading" => esc_html__( "Title Style", 'thevoux' ),
	      "param_name" => "title_style",
	      "admin_label" => true,
	      "value" => array(
	      	'Style 1' => "style1",
	      	'Style 2' => "style2",
	      	'Style 3' => "style3",
	      	'Style 4' => "style4"
	      ),
	      "description" => esc_html__( "This changes the style of the category titles", 'thevoux' ),
	      "dependency" => Array('element' => "add_title", 'value' => array('true'))
	  ),
	  array(
	    "type" => "textfield",
	    "heading" => esc_html__( "Title", 'thevoux' ),
	    "param_name" => "title",
	    "description" => esc_html__( "Add your own title here", 'thevoux' ),
	    "dependency" => Array('element' => "add_title", 'value' => array('true'))
	  ),
	),
	"description" => esc_html__( "Display your videos in a playlist", 'thevoux' )
) );
