<?php

$statuses = wc_get_order_statuses();

// When integration loaded custom statuses is not loaded yet, so we need to
// merge it manually.
if ( function_exists( 'wc_order_status_manager' ) ) {
	$query = new WP_Query( array(
		'post_type'        => 'wc_order_status',
		'post_status'      => 'publish',
		'posts_per_page'   => -1,
		'suppress_filters' => 1,
		'orderby'          => 'menu_order',
		'order'            => 'ASC',
	) );

	$filtered_statuses = array();
	foreach ( $query->posts as $status ) {
		$filtered_statuses[ 'wc-' . $status->post_name ] = $status->post_title;
	}
	$statuses = array_merge( $statuses, $filtered_statuses );

	wp_reset_postdata();
}

foreach ( $statuses as $key => $value ) {
	$statuses[ $key ] = str_replace( 'wc-', '', $key );
}

$fields = array(
	'auth_key' => array(
		'title'       => __( 'Authentication Key', 'woocommerce-shipstation' ),
		'description' => __( 'Copy and paste this key into ShipStation during setup.', 'woocommerce-shipstation' ),
		'default'     => '',
		'type'        => 'text',
		'desc_tip'    => __( 'This is the <code>Auth Key</code> you set in ShipStation and allows ShipStation to communicate with your store.', 'woocommerce-shipstation' ),
		'custom_attributes' => array(
			'readonly' => 'readonly',
		),
		'value'        => WC_ShipStation_Integration::$auth_key,
	),
	'export_statuses' => array(
		'title'             => __( 'Export Order Statuses&hellip;', 'woocommerce-shipstation' ),
		'type'              => 'multiselect',
		'options'           => $statuses,
		'class'             => 'chosen_select',
		'css'               => 'width: 450px;',
		'description'       => __( 'Define the order statuses you wish to export to ShipStation.', 'woocommerce' ),
		'desc_tip'          => true,
		'custom_attributes' => array(
			'data-placeholder' => __( 'Select Order Statuses', 'woocommerce' ),
		),
	),
	'shipped_status' => array(
		'title'       => __( 'Shipped Order Status&hellip;', 'woocommerce-shipstation' ),
		'type'        => 'select',
		'options'     => $statuses,
		'description' => __( 'Define the order status you wish to update to once an order has been shipping via ShipStation. By default this is "Completed".', 'woocommerce' ),
		'desc_tip'    => true,
		'default'     => 'wc-completed',
	),
	'logging_enabled' => array(
		'title'       => __( 'Logging', 'woocommerce-shipstation' ),
		'label'       => __( 'Enable Logging', 'woocommerce-shipstation' ),
		'type'        => 'checkbox',
		'description' => __( 'Log all API interations.', 'woocommerce' ),
		'desc_tip'    => true,
		'default'     => 'yes',
	),
);

return $fields;
