<?php

function thb_register_sponsor_taxonomy() {

  $labels = array(
		'name'                       => esc_html_x( 'Sponsors', 'taxonomy general name', 'thevoux' ),
		'singular_name'              => esc_html_x( 'Sponsor', 'taxonomy singular name', 'thevoux' ),
		'search_items'               => esc_html__( 'Search Sponsors', 'thevoux' ),
		'all_items'                  => esc_html__( 'All Sponsors', 'thevoux' ),
    'popular_items'              => esc_html__( 'Popular Sponsors', 'thevoux' ),
		'edit_item'                  => esc_html__( 'Edit Sponsor', 'thevoux' ),
		'update_item'                => esc_html__( 'Update Sponsor', 'thevoux' ),
		'add_new_item'               => esc_html__( 'Add New Sponsor', 'thevoux' ),
		'new_item_name'              => esc_html__( 'New Sponsor Name', 'thevoux' ),
		'separate_items_with_commas' => esc_html__( 'Separate sponsors with commas', 'thevoux' ),
		'add_or_remove_items'        => esc_html__( 'Add or remove sponsors', 'thevoux' ),
		'choose_from_most_used'      => esc_html__( 'Choose from the most used sponsors', 'thevoux' ),
		'not_found'                  => esc_html__( 'No sponsors found.', 'thevoux' ),
		'menu_name'                  => esc_html__( 'Sponsors', 'thevoux' ),
	);

  register_taxonomy("thb-sponsors",
  		array("post"),
  		array(
          'hierarchical' => false,
  				'labels' => $labels,
  				'show_ui' => true,
      		'query_var' => false,
          'public' => false,
          'show_in_rest' => true,
  				'rewrite' => array( 'slug' => 'thb-sponsor' )
  ));

  add_image_size( 'thb-sponsor-x2', 9999, 96, false );
}
add_action( 'init', 'thb_register_sponsor_taxonomy', 10 );
