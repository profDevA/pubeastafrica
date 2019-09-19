<?php
	if (is_category()) {
		$thb_cat = get_queried_object();
		$thb_cat_id = $thb_cat->term_id;
		$category_header = ot_get_option( 'category_headers');
		$category_bg = isset($category_header[$thb_cat_id]['bg']) ? $category_header[$thb_cat_id]['bg'] : Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/archive-title.jpg';
		$category_color = isset($category_header[$thb_cat_id]['color']) ? $category_header[$thb_cat_id]['color'] : '#fff';
	}
	$header_boxed = ot_get_option( 'header_boxed', 'off');
?>
<!-- Start Category title -->
<?php if ($header_boxed === 'on') { ?>
<div class="row">
	<div class="small-12 columns">
<?php } ?>
<div id="category-title" class="parallax_bg" <?php if ($category_bg) { ?>style="background-image: url(<?php echo esc_attr($category_bg); ?>);"<?php } ?>>
	<div class="row">
		<div class="small-12 medium-10 large-8 medium-centered columns">
				<?php echo '<h1 style="color:'.esc_attr($category_color).';">'.single_cat_title('', false).'</h1>'; ?>
			 <?php if ($desc = category_description()) { echo wp_kses_post($desc); } ?>
		</div>
	</div>
</div>
<?php if ($header_boxed === 'on') { ?>
	</div>
</div>
<?php } ?>
<!-- End Category title -->