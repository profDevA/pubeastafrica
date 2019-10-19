<?php
if ( ! class_exists( 'WC_Abstract_Privacy' ) ) {
	return;
}

class WC_ShipStation_Privacy extends WC_Abstract_Privacy {
	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		parent::__construct( __( 'ShipStation', 'woocommerce-shipstation' ) );

		$this->add_exporter( 'woocommerce-shipstation-order-data', __( 'WooCommerce ShipStation Order Data', 'woocommerce-shipstation' ), array( $this, 'order_data_exporter' ) );

		$this->add_eraser( 'woocommerce-shipstation-order-data', __( 'WooCommerce ShipStation Data', 'woocommerce-shipstation' ), array( $this, 'order_data_eraser' ) );
	}

	/**
	 * Returns a list of orders.
	 *
	 * @param string  $email_address
	 * @param int     $page
	 *
	 * @return array WP_Post
	 */
	protected function get_orders( $email_address, $page ) {
		$user = get_user_by( 'email', $email_address ); // Check if user has an ID in the DB to load stored personal data.

		$order_query    = array(
			'limit'          => 10,
			'page'           => $page,
		);

		if ( $user instanceof WP_User ) {
			$order_query['customer_id'] = (int) $user->ID;
		} else {
			$order_query['billing_email'] = $email_address;
		}

		return wc_get_orders( $order_query );
	}

	/**
	 * Gets the message of the privacy to display.
	 *
	 */
	public function get_privacy_message() {
		/* translators: 1: URL to documentation */
		return wpautop( sprintf( __( 'By using this extension, you may be storing personal data or sharing data with an external service. <a href="%s" target="_blank">Learn more about how this works, including what you may want to include in your privacy policy.</a>', 'woocommerce-shipstation' ), 'https://docs.woocommerce.com/document/privacy-shipping/#woocommerce-shipstation' ) );
	}

	/**
	 * Handle exporting data for Orders.
	 *
	 * @param string $email_address E-mail address to export.
	 * @param int    $page          Pagination of data.
	 *
	 * @return array
	 */
	public function order_data_exporter( $email_address, $page = 1 ) {
		$done           = false;
		$data_to_export = array();

		$orders = $this->get_orders( $email_address, (int) $page );

		$done = true;

		if ( 0 < count( $orders ) ) {
			foreach ( $orders as $order ) {
				$data_to_export[] = array(
					'group_id'    => 'woocommerce_orders',
					'group_label' => __( 'Orders', 'woocommerce-shipstation' ),
					'item_id'     => 'order-' . $order->get_id(),
					'data'        => array(
						array(
							'name'  => __( 'ShipStation tracking provider', 'woocommerce-shipstation' ),
							'value' => get_post_meta( $order->get_id(), '_tracking_provider', true ),
						),
						array(
							'name'  => __( 'ShipStation tracking number', 'woocommerce-shipstation' ),
							'value' => get_post_meta( $order->get_id(), '_tracking_number', true ),
						),
						array(
							'name'  => __( 'ShipStation date shipped', 'woocommerce-shipstation' ),
							'value' => get_post_meta( $order->get_id(), '_date_shipped', true ) ? date( 'Y-m-d H:i:s', get_post_meta( $order->get_id(), '_date_shipped', true ) ) : '',
						),
					),
				);
			}

			$done = 10 > count( $orders );
		}

		return array(
			'data' => $data_to_export,
			'done' => $done,
		);
	}

	/**
	 * Finds and erases order data by email address.
	 *
	 * @since 3.4.0
	 * @param string $email_address The user email address.
	 * @param int    $page  Page.
	 * @return array An array of personal data in name value pairs
	 */
	public function order_data_eraser( $email_address, $page ) {
		$orders = $this->get_orders( $email_address, (int) $page );

		$items_removed  = false;
		$items_retained = false;
		$messages       = array();

		foreach ( (array) $orders as $order ) {
			$order = wc_get_order( $order->get_id() );

			list( $removed, $retained, $msgs ) = $this->maybe_handle_order( $order );
			$items_removed  |= $removed;
			$items_retained |= $retained;
			$messages        = array_merge( $messages, $msgs );
		}

		// Tell core if we have more orders to work on still
		$done = count( $orders ) < 10;

		return array(
			'items_removed'  => $items_removed,
			'items_retained' => $items_retained,
			'messages'       => $messages,
			'done'           => $done,
		);
	}

	/**
	 * Handle eraser of data tied to Orders
	 *
	 * @param WC_Order $order
	 * @return array
	 */
	protected function maybe_handle_order( $order ) {
		$order_id             = $order->get_id();
		$item_count           = get_post_meta( $order->get_id(), '_shipstation_shipped_item_count', true );
		$tracking_provider    = get_post_meta( $order->get_id(), '_tracking_provider', true );
		$tracking_number      = get_post_meta( $order->get_id(), '_tracking_number', true );
		$date_shipped         = get_post_meta( $order->get_id(), '_date_shipped', true );
		$shipstation_exported = get_post_meta( $order->get_id(), '_shipstation_exported', true );

		if ( empty( $item_count ) && empty( $tracking_provider ) && empty( $tracking_number )
			&& empty( $date_shipped ) && empty( $shipstation_exported ) ) {
			return array( false, false, array() );
		}

		delete_post_meta( $order->get_id(), '_shipstation_shipped_item_count' );
		delete_post_meta( $order->get_id(), '_tracking_provider' );
		delete_post_meta( $order->get_id(), '_tracking_number' );
		delete_post_meta( $order->get_id(), '_date_shipped' );
		delete_post_meta( $order->get_id(), '_shipstation_exported' );

		return array( true, false, array( __( 'ShipStation Order Data Erased.', 'woocommerce-shipstation' ) ) );
	}
}

new WC_ShipStation_Privacy();
