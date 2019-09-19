<?php

function thb_get_hero_templates($template_list) {
	$template_list['hero_01'] = array(
		'name' => esc_html__( 'Hero - 01', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e1.jpg",
		'cat' => array( 'Hero', 'Carousel' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" section_color="light-bg"][vc_column][thb_postcarousel columns="3" navigation="true" source="by_id:310,293,289,280,212" cat="6,3,1" item_count="6"][thb_gap height="50"][/vc_column][/vc_row][vc_row equal_height="true"][vc_column width="2/3"][thb_postgrid style="style2" pagination="true" item_count="8" featured_index="3,5"][/vc_column][vc_column fixed="true" width="1/3" skrollr="" el_class="sidebar"][vc_widget_sidebar sidebar_id="home_1" el_class="class"][thb_gap height="30"][/vc_column][/vc_row]',
	);

	$template_list['hero_02'] = array(
		'name' => esc_html__( 'Hero - 02', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e2.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row equal_height="true" vertical_center="" enable_parallax="" parallax_speed="0.5" mouse_scroll=""][vc_column width="3/4" offset="vc_col-lg-9 vc_col-md-12 vc_col-xs-12"][thb_postslider style="featured-style3" pagination="true" source="size:3|post_type:post|categories:3" cat="1" width="870" height="600"][thb_gap height="30"][thb_postgrid style="style2" source="size:5|post_type:post" item_count="3" author_ids="3"][/vc_column][vc_column fixed="true" width="1/4" offset="vc_hidden-md vc_hidden-sm vc_hidden-xs"][vc_widget_sidebar sidebar_id="home_2"][thb_gap height="30"][/vc_column][/vc_row]',
	);

	$template_list['hero_03'] = array(
		'name' => esc_html__( 'Hero - 03', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e3.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row][vc_column width="3/4"][thb_postslider pagination="true" source="size:3|post_type:post|categories:4" cat="3" item_count="3" width="870" height="540"][thb_gap height="60"][/vc_column][vc_column width="1/4"][thb_image full_width="true" animation="animation fade-in" image="53" img_link="||"][thb_gap height="60"][/vc_column][/vc_row]',
	);

	$template_list['hero_04'] = array(
		'name' => esc_html__( 'Hero - 04', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e4.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row][vc_column][thb_postslider style="featured-style8" navigation="true" source="size:3t|post_type:post|categories:5" cat="5" item_count="3" width="1170" height="600"][thb_gap height="45"][/vc_column][/vc_row]',
	);

	$template_list['hero_05'] = array(
		'name' => esc_html__( 'Hero - 05', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e5.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row equal_height="true"][vc_column][thb_gap height="50"][thb_postslider style="featured-style9" pagination="true" navigation="true" source="tags:24" width="1170" height="550" tag_slugs="beauty"][thb_gap height="40"][vc_column_text]

		<hr />

		[/vc_column_text][thb_gap height="40"][/vc_column][/vc_row]',
	);

	$template_list['hero_06'] = array(
		'name' => esc_html__( 'Hero - 06', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e6.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row css=".vc_custom_1485892419479{border-bottom-width: 1px !important;border-bottom-color: #eaeaea !important;border-bottom-style: solid !important;}"][vc_column width="2/3" el_class="content-section with-border"][thb_gap height="40"][thb_postslider style="featured-style10" navigation="true" source="size:All|order_by:date|order:DESC|post_type:post|by_id:327,310,113" width="900" height="600" post_ids="327, 310, 19" offset="7"][thb_gap height="40"][/vc_column][vc_column width="1/3"][thb_gap height="40"][vc_widget_sidebar sidebar_id="home_1"][/vc_column][/vc_row][vc_row]',
	);

	$template_list['hero_7'] = array(
		'name' => esc_html__( 'Hero - 07', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e7.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true"][vc_column][thb_postslider style="featured-style11" pagination="true" source="size:3|post_type:post|by_id:21,19,37"][/vc_column][/vc_row][vc_row]',
	);

	$template_list['hero_08'] = array(
		'name' => esc_html__( 'Hero - 08', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e8.jpg",
		'cat' => array( 'Hero', 'Carousel' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true"][vc_column][thb_postcarousel style="style8" columns="3" navigation="true" source="size:6|post_type:post"][thb_gap height="100"][/vc_column][/vc_row]',
	);

	$template_list['hero_09'] = array(
		'name' => esc_html__( 'Hero - 09', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e9.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true"][vc_column][thb_postslider style="featured-style12" pagination="true" source="size:4|post_type:post"][thb_gap height="100"][/vc_column][/vc_row]',
	);

	$template_list['hero_10'] = array(
		'name' => esc_html__( 'Hero - 10', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e10.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true"][vc_column][thb_postslider style="featured-style13" navigation="true" source="size:3|post_type:post"][/vc_column][/vc_row]',
	);

	$template_list['hero_11'] = array(
		'name' => esc_html__( 'Hero - 11', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e11.jpg",
		'cat' => array( 'Hero', 'Sliders' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true"][vc_column][thb_postslider style="featured-style14" navigation="true" source="size:3|post_type:post"][/vc_column][/vc_row]',
	);

  $template_list['hero_12'] = array(
  	'name' => esc_html__( 'Hero - 12', 'thevoux' ),
  	'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e12.jpg",
  	'cat' => array( 'Hero' ),
  	'sc' => '[vc_row column_padding="false" full_width_row="true"][vc_column][thb_blockgrid source="post_type:post"][/vc_column][/vc_row]',
  );

	$template_list['hero_13'] = array(
  	'name' => esc_html__( 'Hero - 13', 'thevoux' ),
  	'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e13.jpg",
  	'cat' => array( 'Hero' ),
  	'sc' => '[vc_row column_padding="false" full_width_row="true" css=".vc_custom_1540382526582{padding-top: 25vh !important;padding-bottom: 25vh !important;background-image: url(http://thevoux.fuelthemes.net/vicki/wp-content/uploads/sites/12/2018/10/top_img.jpg?id=39) !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="hero-row"][vc_column][vc_row_inner max_width="true"][vc_column_inner el_class="text-center"][thb_slidetype slide_text="<h1>* A stylish American;<em><strong>FASHION BLOGGER</strong></em>*</h1>" thb_animated_color="#ffffff"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
  );

	$template_list['hero_14'] = array(
  	'name' => esc_html__( 'Hero - 14', 'thevoux' ),
  	'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/hero/hero_e14.jpg",
  	'cat' => array( 'Hero' ),
  	'sc' => '[vc_row][vc_column][thb_postslider navigation="true" autoplay="true" source="size:3|post_type:post"][/vc_column][/vc_row]',
  );

	return $template_list;
}
