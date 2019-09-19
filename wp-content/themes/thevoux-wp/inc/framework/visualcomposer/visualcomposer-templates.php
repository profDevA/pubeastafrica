<?php
require get_theme_file_path('/inc/framework/visualcomposer/templates/thb-carousel.php');
require get_theme_file_path('/inc/framework/visualcomposer/templates/thb-listing.php');
require get_theme_file_path('/inc/framework/visualcomposer/templates/thb-hero.php');
require get_theme_file_path('/inc/framework/visualcomposer/templates/thb-homepage.php');
require get_theme_file_path('/inc/framework/visualcomposer/templates/thb-page.php');
require get_theme_file_path('/inc/framework/visualcomposer/templates/thb-general.php');

/* Render Templates Page */
add_filter( 'vc_templates_render_category', 'thb_renderTemplateBlock', 10 );
function thb_renderTemplateBlock( $category ) {

	$Thb_Panel_Editor = new Vc_Templates_Panel_Editor;
	if ( 'thb_templates' === $category['category'] ) {
		ob_start();
		?>
		<div class="thb_templates_container vc_column vc_col-sm-12">
			<div class="thb_template_warning">
				<p><?php esc_html_e('These templates append the Page Builder elements to your page. The added elements still need to be configured from their settings for your content such as images, post sources, etc.', 'thevoux' ); ?></p>
			</div>
			<div class="theme-browser wp-clearfix">
			<?php foreach ($category['templates'] as $key => $template) { ?>
				<div class="thb_template theme <?php echo strtolower(implode(' ', $template['cat'])); ?>">
					<div class="theme-screenshot">
						<img src="<?php echo esc_url($template['thumbnail']); ?>" alt="<?php echo esc_attr($template['name']); ?>"/>
					</div>
					<h2 class="theme-name thb_template_name"><?php echo esc_attr($template['name']); ?></h2>
					<div class="theme-actions">
								<a class="button button-primary thb_template_import" data-thb-id="<?php echo esc_attr($key); ?>"><?php esc_html_e('Add', 'thevoux' ); ?></a>
						</div>
				</div>
			<?php } ?>
			</div>
		</div>
		<div class="thb_library_categories">
			<ul>
				<li data-sort="all" class="active">All <span class="count">-</span></li>
				<li data-sort="homepage">Home Pages <span class="count">-</span></li>
				<li data-sort="page" class="">Other Pages <span class="count">-</span></li>
				<li data-sort="listing">Listings <span class="count">-</span></li>
				<li data-sort="listing-sidebar">Listings - Sidebar<span class="count">-</span></li>
				<li data-sort="carousel">Carousels <span class="count">-</span></li>
				<li data-sort="sliders">Sliders <span class="count">-</span></li>
				<li data-sort="general">General <span class="count">-</span></li>
				<li data-sort="subscription">Subscription <span class="count">-</span></li>
				<li data-sort="video">Video <span class="count">-</span></li>
			</ul>
		</div>
		<?php
		$category['output'] = ob_get_clean();
	}

	return $category;
}

/* Add Template Category & its templates */
add_filter( 'vc_get_all_templates', 'thb_templates' );
function thb_templates( $data ) {
	$thb_template_category = array(
		'category' => 'thb_templates',
		'category_name' => 	Thb_Theme_Admin::$thb_theme_name,
		'category_description' => esc_html__('Homepage layouts used inside the demos', 'thevoux'),
		'category_weight' => 1,
		'templates' => thb_template_get_list()
	);
	$data[] = $thb_template_category;
	return $data;
}

/* Ajax Action */
add_action("wp_ajax_thb_load_template", "thb_load_template");
function thb_load_template() {
	$id = filter_input( INPUT_POST, 'template_unique_id', FILTER_SANITIZE_STRING );

  $template = thb_template_get_list($id);
  echo '' . $template['sc'];
	wp_die();
}

/* Template List */
function thb_template_get_list( $id = false) {
	$template_list = array();

	$template_list = thb_get_homepage_templates($template_list);
	$template_list = thb_get_page_templates($template_list);
	$template_list = thb_get_carousel_templates($template_list);
	$template_list = thb_get_listing_templates($template_list);
	$template_list = thb_get_hero_templates($template_list);
	$template_list = thb_get_general_templates($template_list);
	if ( $id ) {
		return $template_list[$id];
	}
	return $template_list;
}