<?php

function thb_get_listing_templates($template_list) {
	$template_list['listing_01'] = array(
		'name' => esc_html__( 'Listing - 01', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e1.jpg",
		'cat' => array( 'Listing', 'Listing-Sidebar' ),
		'sc' => '[vc_row equal_height="true"][vc_column width="2/3"][thb_postgrid style="style2" pagination="true" item_count="8" featured_index="3,5"][/vc_column][vc_column fixed="true" width="1/3" skrollr="" el_class="sidebar"][vc_widget_sidebar sidebar_id="home_1" el_class="class"][thb_gap height="30"][/vc_column][/vc_row]',
	);

	$template_list['listing_02'] = array(
		'name' => esc_html__( 'Listing - 02', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e2.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column][thb_gap height="30"][thb_postcategory style="style4"][/vc_column][/vc_row]',
	);

	$template_list['listing_03'] = array(
		'name' => esc_html__( 'Listing - 03', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e3.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column][thb_postcarousel style="style3" columns="5" center="" pagination="true" source="by-category" cat="67" item_count="6"][/thb_border][thb_gap height="50"][thb_postcategory cat="1"][/vc_column][/vc_row]',
	);

	$template_list['listing_04'] = array(
		'name' => esc_html__( 'Listing - 04', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e4.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column][thb_postmasonry columns="large-4" loadmore="true" source="size:8|post_type:post"][/vc_column][/vc_row]',
	);

	$template_list['listing_06'] = array(
		'name' => esc_html__( 'Listing - 06', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e6.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row equal_height="true" vertical_center="" enable_parallax="" parallax_speed="0.5" mouse_scroll=""][vc_column width="3/4"][vc_row_inner][vc_column_inner width="1/2"][thb_postcategory style="style3" cat="6"][thb_gap height="20"][/vc_column_inner][vc_column_inner width="1/2"][thb_postcategory style="style3" cat="1"][thb_gap height="20"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column fixed="true" width="1/4" full_height="" enable_parallax="" parallax_speed="0.5"][vc_widget_sidebar sidebar_id="home_5"][/vc_column][/vc_row]',
	);

	$template_list['listing_07'] = array(
		'name' => esc_html__( 'Listing - 07', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e7.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row equal_height="true" vertical_center="" enable_parallax="" parallax_speed="0.5" mouse_scroll=""][vc_column width="3/4"][thb_postcategory style="style2" cat="14"][/vc_column][vc_column fixed="true" width="1/4" full_height="" enable_parallax="" parallax_speed="0.5"][vc_widget_sidebar sidebar_id="home_5"][/vc_column][/vc_row]',
	);

	$template_list['listing_08'] = array(
		'name' => esc_html__( 'Listing - 08', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e8.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column][vc_column_text]

		<hr />

		&nbsp;
		<p style="text-align: center;"><span style="color: #000000;"><strong style="font-size: 12px;">FEATURED ARTICLES</strong></span></p>
		[/vc_column_text][thb_gap height="30"][thb_postgrid style="style4" columns="2" source="size:2|order:DESC|post_type:post" post_ids="10, 7"][thb_gap height="30"][/vc_column][/vc_row][vc_row][vc_column][thb_postgrid columns="3" source="size:3|order_by:rand|post_type:post" post_ids="13, 15, 18"][/vc_column][/vc_row]',
	);

	$template_list['listing_09'] = array(
		'name' => esc_html__( 'Listing - 09', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e9.jpg",
		'cat' => array( 'Listing', 'Listing-Sidebar' ),
		'sc' => '[vc_row equal_height="true"][vc_column width="2/3"][thb_postgrid style="style2" add_title="true" title_style="style3" pagination="true" item_count="5" title="THE LATEST AND GREATEST" source="size:5|post_type:post"][/vc_column][vc_column fixed="true" width="1/3" el_class="sidebar"][vc_widget_sidebar sidebar_id="home"][/vc_column][/vc_row]',
	);

	$template_list['listing_10'] = array(
		'name' => esc_html__( 'Listing - 10', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e10.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row equal_height="true"][vc_column][thb_postgrid style="style5" item_count="3" source="size:3|post_type:post"][vc_column_text][/vc_column][/vc_row]',
	);

	$template_list['listing_11'] = array(
		'name' => esc_html__( 'Listing - 11', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e11.jpg",
		'cat' => array( 'Listing', 'Listing-Sidebar' ),
		'sc' => '[vc_row][vc_column width="2/3" el_class="content-section with-border"][thb_gap height="40"][vc_row_inner][vc_column_inner fixed="true" width="1/3"][vc_widget_sidebar sidebar_id="home_2"][thb_gap height="40"][/vc_column_inner][vc_column_inner width="2/3"][thb_postgrid style="style6" pagination="true" item_count="6"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column fixed="true" width="1/3"][thb_gap height="40"][vc_widget_sidebar sidebar_id="home_3"][/vc_column][/vc_row][vc_row]',
	);

	$template_list['listing_12'] = array(
		'name' => esc_html__( 'Listing - 12', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e12.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column][thb_gap height="100"][vc_column_text]
		<h5 style="text-align: center;">TRENDING NEWS</h5>
		[/vc_column_text][thb_gap height="40"][thb_postmasonry style="style2" columns="large-4" loadmore="true" source="size:9|post_type:post"][thb_gap height="100"][/vc_column][/vc_row]',
	);

	$template_list['listing_13'] = array(
		'name' => esc_html__( 'Listing - 13', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e13.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column width="1/4"][thb_border style="style3"][vc_column_text el_class="text-left"]
		<h2 style="line-height: 1;"><strong>FASHION
		NEWS</strong></h2>
		&nbsp;

		<a style="font-size: 12px;" href="http://ftthevoux.staging.wpengine.com/madison/">SEE ALL FASHION</a>[/vc_column_text][/thb_border][thb_gap height="60"][/vc_column][vc_column width="3/4"][thb_postgrid columns="4" disable_excerpts="true" disable_postmeta="true" source="size:4|order_by:rand|post_type:post"][thb_gap height="60"][/vc_column][/vc_row]',
	);

	$template_list['listing_14'] = array(
		'name' => esc_html__( 'Listing - 14', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e14.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column][thb_postcategory style="style1-alt" title_style="style4" cat="2"][thb_gap height="60"][thb_image animation="animation fade-in" alignment="center" image="185" img_link="url:https%3A%2F%2Fthemeforest.net%2Fitem%2Fthe-voux-a-comprehensive-magazine-theme%2F11400130|title:Purchase%20The%20Voux%20Today!|target:%20_blank|"][thb_gap height="100"][/vc_column][/vc_row]',
	);

	$template_list['listing_15'] = array(
		'name' => esc_html__( 'Listing - 15', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e15.jpg",
		'cat' => array( 'Listing', 'Listing-Sidebar' ),
		'sc' => '[vc_row][vc_column width="2/3"][thb_postgrid style="style2-alt" add_title="true" title_style="style4" pagination="true" item_count="7" featured_index="1,5" source="size:6|post_type:post" title="LATEST NEWS"][thb_gap height="60"][/vc_column][vc_column fixed="true" width="1/3" el_class="sidebar"][vc_widget_sidebar sidebar_id="home_2"][thb_gap height="60"][/vc_column][/vc_row]',
	);

	$template_list['listing_16'] = array(
		'name' => esc_html__( 'Listing - 16', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e16.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column width="2/3"][thb_postgrid style="style7" pagination="true" item_count="7" source="size:6|post_type:post" offset="6"][thb_gap height="60"][/vc_column][vc_column fixed="true" width="1/3" el_class="sidebar"][vc_widget_sidebar sidebar_id="home_1"][thb_gap height="60"][/vc_column][/vc_row]',
	);

	$template_list['listing_17'] = array(
		'name' => esc_html__( 'Listing - 17', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e17.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row][vc_column][thb_image retina="retina_size" animation="animation fade-in" alignment="center" image="209"][thb_gap height="20"][vc_column_text animation="animation fade-in"]
		<p style="text-align: center; font-size: 14px; letter-spacing: 0.1em;">WHAT IS TRENDING NOW</p>
		[/vc_column_text][thb_gap height="60"][vc_row_inner][vc_column_inner width="1/3"][thb_postcategory style="style3-nothumbs" title_style="style5" cat="2"][/vc_column_inner][vc_column_inner width="1/3"][thb_postcategory style="style3-nothumbs" title_style="style5" cat="8"][/vc_column_inner][vc_column_inner width="1/3"][thb_postcategory style="style3-nothumbs" title_style="style5" cat="5"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);

	$template_list['listing_18'] = array(
		'name' => esc_html__( 'Listing - 18', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e18.jpg",
		'cat' => array( 'Listing', 'Listing-Sidebar' ),
		'sc' => '[vc_row][vc_column width="2/3"][thb_postgrid style="style2-bg" source="size:4|post_type:post" offset="4"][/vc_column][vc_column fixed="true" width="1/3" el_class="sidebar"][vc_widget_sidebar sidebar_id="home_1"][/vc_column][/vc_row]',
	);

	$template_list['listing_19'] = array(
		'name' => esc_html__( 'Listing - 19', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e19.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row full_width_row="true" css=".vc_custom_1507725332088{margin-top: 10vh !important;margin-bottom: 10vh !important;padding-top: 10vh !important;padding-bottom: 10vh !important;background-color: #f7f7f7 !important;}"][vc_column][vc_column_text animation="animation fade-in"]
		<p style="text-align: center; font-size: 14px; letter-spacing: 0.1em;">EDITOR’S PICKS</p>
		[/vc_column_text][thb_gap height="60"][vc_row_inner max_width="true"][vc_column_inner][thb_postgrid style="style8" columns="2" source="size:6|order:ASC|post_type:post"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner el_class="text-center"][thb_button size="small" animation="animation bottom-to-top" caption="VIEW ALL" link="url:http%3A%2F%2Fftthevoux.staging.wpengine.com%2Fcatherine%2F|title:VIEW%20ALL%20POSTS||" target_blank="true"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);

	$template_list['listing_20'] = array(
		'name' => esc_html__( 'Listing - 20', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e20.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" el_class="trending-news-bg" css=".vc_custom_1526929614494{background-image: url(http://ftthevoux.staging.wpengine.com/bold-beautiful/wp-content/uploads/sites/10/2018/05/trending-news-bg.png?id=235) !important;}"][vc_column][vc_row_inner max_width="true" css=".vc_custom_1526929735525{padding-top: 120px !important;}"][vc_column_inner][vc_column_text]<strong><span style="color: #ffffff; font-size: 18px;">Fashion</span></strong>[/vc_column_text][vc_empty_space height="50px"][thb_postcategory style="style7" add_title="" cat="2"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);

	$template_list['listing_21'] = array(
		'name' => esc_html__( 'Listing - 21', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e21.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" css=".vc_custom_1526929308914{padding-top: 10vh !important;padding-bottom: 10vh !important;background-color: #f5f5f5 !important;}"][vc_column][vc_row_inner max_width="true"][vc_column_inner][vc_column_text]<span style="color: #131313;"><strong><span style="font-size: 18px;">Lifestyle</span></strong></span>[/vc_column_text][vc_empty_space height="50px"][/vc_column_inner][/vc_row_inner][vc_row_inner max_width="true"][vc_column_inner][thb_postgrid style="style9" source="size:3|post_type:post" offset="5"][/vc_column_inner][/vc_row_inner][vc_row_inner max_width="true" css=".vc_custom_1527624230484{padding-top: 4vh !important;}"][vc_column_inner el_class="text-center"][thb_button size="small" link="url:%23|title:VIEW%20ALL||"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);

	$template_list['listing_22'] = array(
		'name' => esc_html__( 'Listing - 22', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e22.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" css=".vc_custom_1527251885741{padding-top: 12vh !important;padding-bottom: 12vh !important;background-color: #f8f8f8 !important;}"][vc_column][vc_row_inner max_width="true"][vc_column_inner][vc_column_text]
		<p style="text-align: left;"><span style="color: #0f0f0f;"><strong>Todays Top Stories</strong></span></p>
		[/vc_column_text][vc_empty_space height="50px"][thb_postgrid style="style10" columns="3" source="size:6|post_type:post"][vc_empty_space height="10vh"][thb_image animation="animation bottom-to-top" alignment="center" image="206" img_link="url:https%3A%2F%2Fthemeforest.net%2Fitem%2Fthe-voux-a-comprehensive-magazine-theme%2F11400130|title:The%20Voux|target:%20_blank|"][vc_empty_space height="10vh"][thb_postgrid style="style10" columns="3" source="size:6|post_type:post" offset="6"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);

	$template_list['listing_23'] = array(
		'name' => esc_html__( 'Listing - 23', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e23.jpg",
		'cat' => array( 'Listing' ),
		'sc' => '[vc_row column_padding="false" full_width_row="true" el_class="center-row-bg" css=".vc_custom_1540465483300{background-image: url(http://thevoux.fuelthemes.net/vicki/wp-content/uploads/sites/12/2018/10/left-flower.jpg?id=80) !important;}"][vc_column][vc_row_inner max_width="true"][vc_column_inner][thb_image retina="retina_size" animation="animation fade-in" alignment="center" image="71"][vc_empty_space height="80px"][/vc_column_inner][/vc_row_inner][vc_row_inner max_width="true"][vc_column_inner][thb_postgrid style="style12" pagination="style2" source="size:3|post_type:post"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]',
	);

	$template_list['listing_24'] = array(
		'name' => esc_html__( 'Listing - 24', 'thevoux' ),
		'thumbnail' => Thb_Theme_Admin::$thb_theme_directory_uri."assets/img/admin/demos/listing/listing_e24.jpg",
		'cat' => array( 'Listing', 'Listing-Sidebar' ),
		'sc' => '[vc_row][vc_column width="2/3"][thb_postgrid style="style13" columns="2" pagination="true" item_count="7" source="size:9|post_type:post" offset="4"][thb_gap height="60"][/vc_column][vc_column fixed="true" width="1/3" el_class="sidebar"][vc_widget_sidebar sidebar_id="home_1"][thb_gap height="60"][/vc_column][/vc_row]',
	);

	return $template_list;
}
