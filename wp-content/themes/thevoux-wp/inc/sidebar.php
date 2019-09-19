<?php
function thb_sidebar_setup() {

	function thb_register_sidebars() {
		$widget_style = ot_get_option( 'widget_style', 'style1' );
		register_sidebar(array('name' => esc_html__( 'Blog Sidebar', 'thevoux' ), 'id' => 'blog', 'description' => esc_html__( 'The sidebar that shows up in your blog', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Article Sidebar', 'thevoux' ), 'id' => 'single', 'description' => esc_html__( 'The sidebar next to articles', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Article Ajax Sidebar', 'thevoux' ), 'id' => 'single-ajax', 'description' => esc_html__( 'The sidebar next to articles loaded via Ajax', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Author Sidebar', 'thevoux' ), 'id' => 'author', 'description' => esc_html__( 'The sidebar on author pages', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Archive Sidebar', 'thevoux' ), 'id' => 'archive', 'description' => esc_html__( 'The sidebar on archive pages', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Category Sidebar', 'thevoux' ), 'id' => 'category', 'description' => esc_html__( 'The sidebar on category pages', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Footer Column 1', 'thevoux' ), 'id' => 'footer1', 'description' => esc_html__( 'Footer - first column', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Footer Column 2', 'thevoux' ), 'id' => 'footer2', 'description' => esc_html__( 'Footer - second column', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Footer Column 3', 'thevoux' ), 'id' => 'footer3', 'description' => esc_html__( 'Footer - third column', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Footer Column 4', 'thevoux' ), 'id' => 'footer4', 'description' => esc_html__( 'Footer - forth column', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Footer Column 5', 'thevoux' ), 'id' => 'footer5', 'description' => esc_html__( 'Footer - fifth column', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		register_sidebar(array('name' => esc_html__( 'Footer Column 6', 'thevoux' ), 'id' => 'footer6', 'description' => esc_html__( 'Footer - sixth column', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));

		if ( thb_wc_supported() ) {
			register_sidebar(array('name' => esc_html__( 'Shop Sidebar', 'thevoux' ), 'id' => 'shop', 'description' => esc_html__( 'Sidebar for the Shop page', 'thevoux' ), 'before_widget' => '<div id="%1$s" class="widget woo ' . esc_attr($widget_style) . ' %2$s">', 'after_widget' => '</div>', 'before_title' => '<strong><span>', 'after_title' => '</span></strong>'));
		}
	}
	add_action( 'widgets_init', 'thb_register_sidebars' );
}
add_action( 'after_setup_theme', 'thb_sidebar_setup' );