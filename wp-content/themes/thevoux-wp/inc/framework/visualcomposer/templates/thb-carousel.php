<?php 

function thb_get_carousel_templates($template_list) {
	$template_list['carousel_01'] = array(
		'name' => esc_html__( 'Carousel - 01', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e1.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row][vc_column][vc_column_text]
		<h5 style="text-align: center;">FEATURED NEWS</h5>
		[/vc_column_text][thb_gap height="30"][thb_postcarousel style="style4" columns="4" center="" navigation="true" source="size:5|post_type:post" post_ids="337, 339, 11, 341, 310, 361"][thb_gap height="30"][thb_image animation="animation bottom-to-top" alignment="center" image="58"][thb_gap height="60"][/vc_column][/vc_row]',
	);
	
	$template_list['carousel_02'] = array(
		'name' => esc_html__( 'Carousel - 02', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e2.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row][vc_column width="2/3"][thb_postcarousel style="style7" columns="2" center="" pagination="true" add_title="true" title_style="style4" source="size:4|order_by:rand|post_type:post" title="YOU MUST READ THIS"][/vc_column][vc_column fixed="true" width="1/3" el_class="sidebar"][vc_widget_sidebar sidebar_id="home_1"][thb_gap height="60"][/vc_column][/vc_row]',
	);
	
	$template_list['carousel_03'] = array(
		'name' => esc_html__( 'Carousel - 03', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e3.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row full_width_row="true" css=".vc_custom_1507725290243{margin-top: 10vh !important;margin-bottom: 10vh !important;padding-top: 10vh !important;padding-bottom: 10vh !important;background-color: #f7f7f7 !important;}"][vc_column css=".vc_custom_1507659399018{padding-right: 5% !important;padding-left: 5% !important;}"][vc_column_text animation="animation fade-in"]
		<p style="text-align: center; font-size: 14px; letter-spacing: 0.1em;">YOU MUST READ THIS</p>
		[/vc_column_text][thb_gap height="60"][thb_postcarousel style="style9" columns="5" center="" navigation="true" source="size:7|post_type:post|categories:4,5"][/vc_column][/vc_row]',
	);
	
	$template_list['carousel_04'] = array(
		'name' => esc_html__( 'Carousel - 04', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e4.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" css=".vc_custom_1526924872251{margin-bottom: 10vh !important;padding-top: 10vh !important;padding-bottom: 10vh !important;background-color: #eef5eb !important;}"][vc_column][vc_row_inner max_width="true"][vc_column_inner][thb_postcarousel style="style10" center="" pagination="true" source="size:8|post_type:post"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);
	
	$template_list['carousel_05'] = array(
		'name' => esc_html__( 'Carousel - 05', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e5.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" css=".vc_custom_1525178320922{margin-top: 10vh !important;margin-bottom: 10vh !important;padding-top: 10vh !important;padding-bottom: 10vh !important;background-color: #faf2e2 !important;}"][vc_column][vc_row_inner max_width="true"][vc_column_inner][vc_column_text]
		<h3 style="text-align: center;"><strong>Featured Posts</strong></h3>
		[/vc_column_text][vc_empty_space height="35px"][thb_postcarousel style="style11" columns="3" center="" source="size:6|post_type:post"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);
	
	$template_list['carousel_06'] = array(
		'name' => esc_html__( 'Carousel - 06', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e6.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row][vc_column][thb_gap height="30"][thb_postcategory style="style4"][/vc_column][/vc_row][vc_row][vc_column][thb_gap height="50"][vc_column_text]
		<h1 style="text-align: center;"><span style="color: #ee0065;"><em>LOOK</em></span>BOOKS</h1>
		[/vc_column_text][thb_gap height="35"][thb_postcarousel style="style3" columns="5" center="" navigation="true" source="by-tag" item_count="7" tag_slugs="street, models"][thb_gap height="50"][/vc_column][/vc_row]',
	);
	
	$template_list['carousel_07'] = array(
		'name' => esc_html__( 'Carousel - 07', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e7.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row][vc_column][thb_postgrid style="style3" source="size:4|post_type:post" item_count="2" author_ids="3" offset="5"][thb_gap height="50"][thb_border][vc_column_text]
		<h4 style="text-align: center;">You Must Have These Goodies</h4>
		[/vc_column_text][vc_empty_space height="30px"][thb_postcarousel style="style3" columns="5" center="" pagination="true" source="by-category" cat="67" item_count="6"][/thb_border][thb_gap height="50"][thb_postcategory cat="1"][/vc_column][/vc_row]',
	);
	
	$template_list['carousel_08'] = array(
		'name' => esc_html__( 'Carousel - 08', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/carousel/carousel_e8.jpg",
		'cat' => array( 'Carousel' ),
		'sc' => '[vc_row full_width="" vertical_center="" enable_parallax="" parallax_speed="0.5" mouse_scroll=""][vc_column][thb_gap height="40"][vc_row_inner max_width="true" content_placement="middle" css=".vc_custom_1527499986259{border-top-width: 3px !important;border-right-width: 0px !important;border-bottom-width: 3px !important;border-left-width: 0px !important;padding-top: 37px !important;padding-right: 0px !important;padding-bottom: 37px !important;padding-left: 0px !important;border-left-color: #ee0065 !important;border-left-style: solid !important;border-right-color: #ee0065 !important;border-right-style: solid !important;border-top-color: #ee0065 !important;border-top-style: solid !important;border-bottom-color: #ee0065 !important;border-bottom-style: solid !important;}" full_height="" vertical_center="" full_width="true" el_class="cf"][vc_column_inner el_class="text-center" width="1/3"][vc_column_text]
		<h1 style="text-align: center; line-height: 1;"><span style="color: #ee0065;">HOTTEST</span>
		<em>STUFF</em></h1>
		[/vc_column_text][thb_gap height="40"][thb_button animation="animation bottom-to-top" caption="SEE ALL" link="url:%23|title:VIEW%20ALL||"][/vc_column_inner][vc_column_inner width="2/3"][thb_postcarousel style="style2" columns="2" center="" navigation="true" source="size:5|post_type:post" cat="6,3,1,14" offset="10"][/vc_column_inner][/vc_row_inner][thb_gap height="60"][/vc_column][/vc_row]',
	);
	
	return $template_list;
}