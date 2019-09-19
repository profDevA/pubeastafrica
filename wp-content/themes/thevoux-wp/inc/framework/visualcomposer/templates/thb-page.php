<?php 

function thb_get_page_templates($template_list) {
	$template_list['page_01'] = array(
		'name' => esc_html__( 'Contact - 01', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/pages/page_01.jpg",
		'cat' => array( 'Page' ),
		'sc' => '[vc_row el_class="contact-row" full_width="" equal_height="" vertical_center="" enable_parallax="" parallax_speed="0.5" mouse_scroll=""][vc_column][thb_gap height="80"][vc_column_text]
		<h1 style="text-align: center;">GET IN TOUCH</h1>
		<p style="text-align: center;"><span style="font-size: 18px;">If you have issues with something not displaying properly, please ensure ad-block is
		disabled before reporting a bug.</span></p>
		[/vc_column_text][thb_gap height="40"][vc_row_inner][vc_column_inner width="1/3"][thb_contentbox heading="Say Hello " animation="animation bottom-to-top" image="69"]Telephone: 755.755.1124
		Fax: 755.755.0640
		hello@fuelthemes.net[/thb_contentbox][/vc_column_inner][vc_column_inner width="1/3"][thb_contentbox heading="Our Location" animation="animation bottom-to-top" image="70"]1170 Northeast Industrial Park Road Meridian, MS 39301[/thb_contentbox][/vc_column_inner][vc_column_inner width="1/3"][thb_contentbox heading="Career" animation="animation bottom-to-top" image="71"]Steelkilt here hissed out something, inaudible to all but the Captain.[/thb_contentbox][/vc_column_inner][/vc_row_inner][thb_gap height="80"][/vc_column][/vc_row]',
	);
	
	$template_list['page_02'] = array(
		'name' => esc_html__( 'Contact - 02', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/pages/page_02.jpg",
		'cat' => array( 'Page' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" equal_height="" vertical_center="" enable_parallax="" parallax_speed="0.5" mouse_scroll=""][vc_column][thb_contactmap height="50" zoom="9" map_controls="panControl,zoomControl" map_style="JTVCJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJhZG1pbmlzdHJhdGl2ZSUyMiUyQyUyMnN0eWxlcnMlMjIlM0ElNUIlN0IlMjJ2aXNpYmlsaXR5JTIyJTNBJTIyb2ZmJTIyJTdEJTVEJTdEJTJDJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJwb2klMjIlMkMlMjJzdHlsZXJzJTIyJTNBJTVCJTdCJTIydmlzaWJpbGl0eSUyMiUzQSUyMnNpbXBsaWZpZWQlMjIlN0QlNUQlN0QlMkMlN0IlMjJmZWF0dXJlVHlwZSUyMiUzQSUyMnJvYWQlMjIlMkMlMjJzdHlsZXJzJTIyJTNBJTVCJTdCJTIydmlzaWJpbGl0eSUyMiUzQSUyMnNpbXBsaWZpZWQlMjIlN0QlNUQlN0QlMkMlN0IlMjJmZWF0dXJlVHlwZSUyMiUzQSUyMndhdGVyJTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMnZpc2liaWxpdHklMjIlM0ElMjJzaW1wbGlmaWVkJTIyJTdEJTVEJTdEJTJDJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJ0cmFuc2l0JTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMnZpc2liaWxpdHklMjIlM0ElMjJzaW1wbGlmaWVkJTIyJTdEJTVEJTdEJTJDJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJsYW5kc2NhcGUlMjIlMkMlMjJzdHlsZXJzJTIyJTNBJTVCJTdCJTIydmlzaWJpbGl0eSUyMiUzQSUyMnNpbXBsaWZpZWQlMjIlN0QlNUQlN0QlMkMlN0IlMjJmZWF0dXJlVHlwZSUyMiUzQSUyMnJvYWQuaGlnaHdheSUyMiUyQyUyMnN0eWxlcnMlMjIlM0ElNUIlN0IlMjJ2aXNpYmlsaXR5JTIyJTNBJTIyb2ZmJTIyJTdEJTVEJTdEJTJDJTdCJTIyZmVhdHVyZVR5cGUlMjIlM0ElMjJyb2FkLmxvY2FsJTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMnZpc2liaWxpdHklMjIlM0ElMjJvbiUyMiU3RCU1RCU3RCUyQyU3QiUyMmZlYXR1cmVUeXBlJTIyJTNBJTIycm9hZC5oaWdod2F5JTIyJTJDJTIyZWxlbWVudFR5cGUlMjIlM0ElMjJnZW9tZXRyeSUyMiUyQyUyMnN0eWxlcnMlMjIlM0ElNUIlN0IlMjJ2aXNpYmlsaXR5JTIyJTNBJTIyb24lMjIlN0QlNUQlN0QlMkMlN0IlMjJmZWF0dXJlVHlwZSUyMiUzQSUyMnJvYWQuYXJ0ZXJpYWwlMjIlMkMlMjJzdHlsZXJzJTIyJTNBJTVCJTdCJTIydmlzaWJpbGl0eSUyMiUzQSUyMm9mZiUyMiU3RCU1RCU3RCUyQyU3QiUyMmZlYXR1cmVUeXBlJTIyJTNBJTIyd2F0ZXIlMjIlMkMlMjJzdHlsZXJzJTIyJTNBJTVCJTdCJTIyY29sb3IlMjIlM0ElMjIlMjM1Zjk0ZmYlMjIlN0QlMkMlN0IlMjJsaWdodG5lc3MlMjIlM0EyNiU3RCUyQyU3QiUyMmdhbW1hJTIyJTNBNS44NiU3RCU1RCU3RCUyQyU3QiU3RCUyQyU3QiUyMmZlYXR1cmVUeXBlJTIyJTNBJTIycm9hZC5oaWdod2F5JTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMndlaWdodCUyMiUzQTAuNiU3RCUyQyU3QiUyMnNhdHVyYXRpb24lMjIlM0EtODUlN0QlMkMlN0IlMjJsaWdodG5lc3MlMjIlM0E2MSU3RCU1RCU3RCUyQyU3QiUyMmZlYXR1cmVUeXBlJTIyJTNBJTIycm9hZCUyMiU3RCUyQyU3QiU3RCUyQyU3QiUyMmZlYXR1cmVUeXBlJTIyJTNBJTIybGFuZHNjYXBlJTIyJTJDJTIyc3R5bGVycyUyMiUzQSU1QiU3QiUyMmh1ZSUyMiUzQSUyMiUyMzAwNjZmZiUyMiU3RCUyQyU3QiUyMnNhdHVyYXRpb24lMjIlM0E3NCU3RCUyQyU3QiUyMmxpZ2h0bmVzcyUyMiUzQTEwMCU3RCU1RCU3RCU1RA==" full_height=""][thb_contactmap_pin retina_marker="yes" latitude="42.78" longitude="-75" marker_title="The Voux" marker_description="6100 Wilshire Blvd 2nd Floor Los Angeles CA 90048 +1 310 499 7700
		info@stylesuite.nl"][/thb_contactmap][/vc_column][/vc_row][vc_row css=".vc_custom_1430856317055{margin-bottom: 60px !important;}" equal_height="" vertical_center="" enable_parallax="" parallax_speed="0.5" mouse_scroll=""][vc_column width="7/12" css=".vc_custom_1481315785154{margin-top: -80px !important;padding-top: 30px !important;padding-right: 30px !important;padding-bottom: 30px !important;padding-left: 30px !important;background-color: #ffffff !important;}" full_height="" enable_parallax="" parallax_speed="0.5" el_class="up-column"][vc_column_text]
		<h1>How can <em>we</em> <strong>help</strong>?</h1>
		[/vc_column_text][thb_gap height="70"][vc_column_text]
		<h4><strong>Get In Touch</strong></h4>
		But as the junior mates were hurrying to execute the order, a pale man, with.[/vc_column_text][thb_gap height="30"][contact-form-7 id="339"][/vc_column][vc_column width="5/12" el_class="text-center" full_height="" enable_parallax="" parallax_speed="0.5"][thb_gap height="60"][thb_border][vc_column_text]
		<h4><strong>Connect With Voux</strong></h4>
		Such was the state of his mouth, that he could hardly.
		
		[icon type="fa-facebook" size="icon-4x" url="#" box="true"] [icon type="fa-twitter" size="icon-4x" url="#" box="true"] [icon type="fa-instagram" size="icon-4x" url="#" box="true"][/vc_column_text][/thb_border][/vc_column][/vc_row]',
	);
	
	$template_list['page_03'] = array(
		'name' => esc_html__( 'Author List', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/pages/page_03.jpg",
		'cat' => array( 'Page' ),
		'sc' => '[vc_row parallax="" parallax_image="" row_id="" column_padding="" full_width_row="" equal_height="" full_height="" vertical_center="" enable_parallax="" parallax_speed="0.5" bg_video_src_mp4="" bg_video_src_ogv="" bg_video_src_webm="" bg_video_overlay_color="" mouse_scroll=""][vc_column width="1/1" fixed="" animation="" full_height="" enable_parallax="" parallax_speed="0.5"][thb_gap height="40"][vc_column_text]
		<h1 style="text-align: center;">Authors</h1>
		[/vc_column_text][thb_gap height="40"][thb_authorgrid columns="3" author_ids="2,3,4,5,6,7"][/vc_column][/vc_row]',
	);
	
	return $template_list;
}