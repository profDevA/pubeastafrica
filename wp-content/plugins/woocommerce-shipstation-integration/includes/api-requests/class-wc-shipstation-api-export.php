<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_Shipstation_API_Export Class
 */
class WC_Shipstation_API_Export extends WC_Shipstation_API_Request {

	/**
	 * Constructor
	 */
	public function __construct() {
		if ( ! WC_Shipstation_API::authenticated() ) {
			exit;
		}
	}

	/**
	 * Do the request
	 */
	public function request() {
		global $wpdb;

		$this->validate_input( array( 'start_date', 'end_date' ) );

		header( 'Content-Type: text/xml' );
		$xml               = new DOMDocument( '1.0', 'utf-8' );
		$xml->formatOutput = true;
		$page              = max( 1, isset( $_GET['page'] ) ? absint( $_GET['page'] ) : 1 );
		$exported          = 0;
		$tz_offset         = get_option( 'gmt_offset' ) * 3600;
		$raw_start_date    = wc_clean( urldecode( $_GET['start_date'] ) );
		$raw_end_date      = wc_clean( urldecode( $_GET['end_date'] ) );

		// Parse start and end date
		if ( $raw_start_date && false === strtotime( $raw_start_date ) ) {
			$month      = substr( $raw_start_date, 0, 2 );
			$day        = substr( $raw_start_date, 2, 2 );
			$year       = substr( $raw_start_date, 4, 4 );
			$time       = substr( $raw_start_date, 9, 4 );
			$start_date = gmdate( 'Y-m-d H:i:s', strtotime( $year . '-' . $month . '-' . $day . ' ' . $time ) );
		} else {
			$start_date = gmdate( 'Y-m-d H:i:s', strtotime( $raw_start_date ) );
		}

		if ( $raw_end_date && false === strtotime( $raw_end_date ) ) {
			$month      = substr( $raw_end_date, 0, 2 );
			$day        = substr( $raw_end_date, 2, 2 );
			$year       = substr( $raw_end_date, 4, 4 );
			$time       = substr( $raw_end_date, 9, 4 );
			$end_date   = gmdate( 'Y-m-d H:i:s', strtotime( $year . '-' . $month . '-' . $day . ' ' . $time ) );
		} else {
			$end_date   = gmdate( 'Y-m-d H:i:s', strtotime( $raw_end_date ) );
		}

		if ( version_compare( WC_VERSION, '3.1', '>=' ) ) {
			$order_ids = wc_get_orders( array(
				'date_modified' => $start_date . '...' . $end_date,
				'type'          => 'shop_order',
				'status'        => WC_ShipStation_Integration::$export_statuses,
				'return'        => 'ids',
				'orderby'       => 'date_modified',
				'order'         => 'DESC',
				'paged'         => $page,
				'limit'         => WC_SHIPSTATION_EXPORT_LIMIT,
			) );
			$order_ids = array_map( function( $order_or_id ) {
				return is_a( $order_or_id, 'WC_Order' ) ? $order_or_id->get_id() : $order_or_id;
			}, $order_ids );
		} else {
			$order_ids = $wpdb->get_col(
				$wpdb->prepare( "
						SELECT ID FROM {$wpdb->posts}
						WHERE post_type = 'shop_order'
						AND post_status IN ( '" . implode( "','", WC_ShipStation_Integration::$export_statuses ) . "' )
						AND %s <= post_modified_gmt
						AND post_modified_gmt <= %s
						ORDER BY post_modified_gmt DESC
						LIMIT %d, %d
					",
					$start_date,
					$end_date,
					WC_SHIPSTATION_EXPORT_LIMIT * ( $page - 1 ),
					WC_SHIPSTATION_EXPORT_LIMIT
				)
			);
		}

		// Figure out how to retrieve this using WC Query class.
		$max_results = $wpdb->get_var(
			$wpdb->prepare( "
					SELECT COUNT(ID) FROM {$wpdb->posts}
					WHERE post_type = 'shop_order'
					AND post_status IN ( '" . implode( "','", WC_ShipStation_Integration::$export_statuses ) . "' )
					AND %s <= post_modified_gmt
					AND post_modified_gmt <= %s
				",
				$start_date,
				$end_date
			)
		);

		$orders_xml = $xml->createElement( 'Orders' );

		foreach ( $order_ids as $order_id ) {
			if ( ! apply_filters( 'woocommerce_shipstation_export_order', true, $order_id ) ) {
				continue;
			}

			$order     = wc_get_order( $order_id );
			$order_xml = $xml->createElement( 'Order' );
			$wc_gte_30 = version_compare( WC_VERSION, '3.0', '>=' );// gte greater than or equal to 3.0
			$formatted_order_number = ltrim( $order->get_order_number(), '#' );
			$this->xml_append( $order_xml, 'OrderNumber', $formatted_order_number );
			$this->xml_append( $order_xml, 'OrderID', $order_id );

			if ( $wc_gte_30 ) {
				// Sequence of date ordering: date paid > date completed > date created
				$order_timestamp = $order->get_date_paid() ?: $order->get_date_completed() ?: $order->get_date_created();
				$order_timestamp = $order_timestamp->getOffsetTimestamp();
			} else {
				$order_timestamp = $order->order_date;
			}

			$order_timestamp -= $tz_offset;
			$this->xml_append( $order_xml, 'OrderDate', gmdate( 'm/d/Y H:i', $order_timestamp ), false );
			$this->xml_append( $order_xml, 'OrderStatus', $order->get_status() );
			$this->xml_append( $order_xml, 'PaymentMethod', $wc_gte_30 ? $order->get_payment_method() : $order->payment_method );
			$this->xml_append( $order_xml, 'OrderPaymentMethodTitle', $wc_gte_30 ? $order->get_payment_method_title() : $order->payment_method_title );
			$last_modified = strtotime( $wc_gte_30 ? $order->get_date_modified()->date( 'm/d/Y H:i' ) : $order->modified_date ) - $tz_offset;
			$this->xml_append( $order_xml, 'LastModified', gmdate( 'm/d/Y H:i', $last_modified ), false );
			$this->xml_append( $order_xml, 'ShippingMethod', implode( ' | ', $this->get_shipping_methods( $order ) ) );

			$this->xml_append( $order_xml, 'OrderTotal', $order->get_total(), false );
			$this->xml_append( $order_xml, 'TaxAmount', wc_round_tax_total( $order->get_total_tax() ), false );

			if ( class_exists( 'WC_COG' ) ) {
				$this->xml_append( $order_xml, 'CostOfGoods', wc_format_decimal( $order->wc_cog_order_total_cost ), false );
			}

			$this->xml_append( $order_xml, 'ShippingAmount', $wc_gte_30 ? $order->get_shipping_total() : $order->get_total_shipping(), false );
			$this->xml_append( $order_xml, 'CustomerNotes', $wc_gte_30 ? $order->get_customer_note() : $order->customer_note );
			$this->xml_append( $order_xml, 'InternalNotes', implode( ' | ', $this->get_order_notes( $order ) ) );

			// Custom fields - 1 is used for coupon codes
			$this->xml_append( $order_xml, 'CustomField1', implode( ' | ', version_compare( WC_VERSION, '3.7', 'ge' ) ? $order->get_coupon_codes() : $order->get_used_coupons() ) );

			// Custom fields 2 and 3 can be mapped to a custom field via the following filters
			$meta_key = apply_filters( 'woocommerce_shipstation_export_custom_field_2', '' );
			if ( $meta_key ) {
				$this->xml_append( $order_xml, 'CustomField2', apply_filters( 'woocommerce_shipstation_export_custom_field_2_value', get_post_meta( $order_id, $meta_key, true ), $order_id ) );
			}

			$meta_key = apply_filters( 'woocommerce_shipstation_export_custom_field_3', '' );
			if ( $meta_key ) {
				$this->xml_append( $order_xml, 'CustomField3', apply_filters( 'woocommerce_shipstation_export_custom_field_3_value', get_post_meta( $order_id, $meta_key, true ), $order_id ) );
			}

			// Customer data
			$customer_xml = $xml->createElement( 'Customer' );
			$this->xml_append( $customer_xml, 'CustomerCode', $wc_gte_30 ? $order->get_billing_email() : $order->billing_email );

			$billto_xml = $xml->createElement( 'BillTo' );
			$this->xml_append( $billto_xml, 'Name', ( $wc_gte_30 ? $order->get_billing_first_name() : $order->billing_first_name ) . ' ' . ( $wc_gte_30 ? $order->get_billing_last_name() : $order->billing_last_name ) );
			$this->xml_append( $billto_xml, 'Company', $wc_gte_30 ? $order->get_billing_company() : $order->billing_company );
			$this->xml_append( $billto_xml, 'Phone', $wc_gte_30 ? $order->get_billing_phone() : $order->billing_phone );
			$this->xml_append( $billto_xml, 'Email', $wc_gte_30 ? $order->get_billing_email() : $order->billing_email );
			$customer_xml->appendChild( $billto_xml );

			$shipto_xml = $xml->createElement( 'ShipTo' );

			$shipping_country = $wc_gte_30 ? $order->get_shipping_country() : $order->shipping_country;
			if ( empty( $shipping_country ) ) {
				$name = ( $wc_gte_30 ? $order->get_billing_first_name() : $order->billing_first_name ) . ' ' . ( $wc_gte_30 ? $order->get_billing_last_name() : $order->billing_last_name );
				$this->xml_append( $shipto_xml, 'Name', $name );
				$this->xml_append( $shipto_xml, 'Company', $wc_gte_30 ? $order->get_billing_company() : $order->billing_company );
				$this->xml_append( $shipto_xml, 'Address1', $wc_gte_30 ? $order->get_billing_address_1() : $order->billing_address_1 );
				$this->xml_append( $shipto_xml, 'Address2', $wc_gte_30 ? $order->get_billing_address_2() : $order->billing_address_2 );
				$this->xml_append( $shipto_xml, 'City', $wc_gte_30 ? $order->get_billing_city() : $order->billing_city );
				$this->xml_append( $shipto_xml, 'State', $wc_gte_30 ? $order->get_billing_state() : $order->billing_state );
				$this->xml_append( $shipto_xml, 'PostalCode', $wc_gte_30 ? $order->get_billing_postcode() : $order->billing_postcode );
				$this->xml_append( $shipto_xml, 'Country', $wc_gte_30 ? $order->get_billing_country() : $order->billing_country );
				$this->xml_append( $shipto_xml, 'Phone', $wc_gte_30 ? $order->get_billing_phone() : $order->billing_phone );
			} else {
				$name = ( $wc_gte_30 ? $order->get_shipping_first_name() : $order->shipping_first_name ) . ' ' . ( $wc_gte_30 ? $order->get_shipping_last_name() : $order->shipping_last_name );
				$this->xml_append( $shipto_xml, 'Name', $name );
				$this->xml_append( $shipto_xml, 'Company', $wc_gte_30 ? $order->get_shipping_company() : $order->shipping_company );
				$this->xml_append( $shipto_xml, 'Address1', $wc_gte_30 ? $order->get_shipping_address_1() : $order->shipping_address_1 );
				$this->xml_append( $shipto_xml, 'Address2', $wc_gte_30 ? $order->get_shipping_address_2() : $order->shipping_address_2 );
				$this->xml_append( $shipto_xml, 'City', $wc_gte_30 ? $order->get_shipping_city() : $order->shipping_city );
				$this->xml_append( $shipto_xml, 'State', $wc_gte_30 ? $order->get_shipping_state() : $order->shipping_state );
				$this->xml_append( $shipto_xml, 'PostalCode', $wc_gte_30 ? $order->get_shipping_postcode() : $order->shipping_postcode );
				$this->xml_append( $shipto_xml, 'Country', $wc_gte_30 ? $order->get_shipping_country() : $order->shipping_country );
				$this->xml_append( $shipto_xml, 'Phone', $wc_gte_30 ? $order->get_billing_phone() : $order->billing_phone );
			}
			$customer_xml->appendChild( $shipto_xml );

			$order_xml->appendChild( $customer_xml );

			// Item data
			$found_item = false;
			$items_xml  = $xml->createElement( 'Items' );
			// Merge arrays without loosing indexes.
			$order_items = $order->get_items() + $order->get_items( 'fee' );
			foreach ( $order_items as $item_id => $item ) {
				if ( $wc_gte_30 ) {
					$product  = is_callable( array( $item, 'get_product' ) ) ? $item->get_product() : false;
				} else {
					$product  = $order->get_product_from_item( $item );
				}
				$item_needs_no_shipping = ! $product || ! $product->needs_shipping();
				$item_not_a_fee         = 'fee' !== $item['type'];
				if ( $item_needs_no_shipping && $item_not_a_fee ) {
					continue;
				}

				$found_item = true;
				$item_xml   = $xml->createElement( 'Item' );
				$this->xml_append( $item_xml, 'LineItemID', $item_id );

				if ( 'fee' === $item['type'] ) {
					$this->xml_append( $item_xml, 'Name', $wc_gte_30 ? $item->get_name() : $item['name'] );
					$this->xml_append( $item_xml, 'Quantity', 1, false );
					$this->xml_append( $item_xml, 'UnitPrice', $order->get_item_total( $item, false, true ), false );
				}

				// handle product specific data
				if ( $product && $product->needs_shipping() ) {
					$this->xml_append( $item_xml, 'SKU', $product->get_sku() );
					$this->xml_append( $item_xml, 'Name', $product->get_title() );
					// image data
					$image_id   = $product->get_image_id();
					$image_url = $image_id ? current( wp_get_attachment_image_src( $image_id, 'shop_thumbnail' ) ) : '';
					$this->xml_append( $item_xml, 'ImageUrl', $image_url );

					$this->xml_append( $item_xml, 'Weight', wc_get_weight( $product->get_weight(), 'oz' ), false );
					$this->xml_append( $item_xml, 'WeightUnits', 'Ounces', false );
					$this->xml_append( $item_xml, 'Quantity', $item['qty'], false );
					$this->xml_append( $item_xml, 'UnitPrice', $order->get_item_subtotal( $item, false, true ), false );
				}

				if ( $item['item_meta'] ) {
					if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
						$item_meta = new WC_Order_Item_Meta( $item, $product );
						$formatted_meta = $item_meta->get_formatted( '_' );
					} else {
						add_filter( 'woocommerce_is_attribute_in_product_name', '__return_false' );
						$formatted_meta = $item->get_formatted_meta_data();
					}

					if ( ! empty( $formatted_meta ) ) {
						$options_xml = $xml->createElement( 'Options' );

						foreach ( $formatted_meta as $meta_key => $meta ) {
							$option_xml  = $xml->createElement( 'Option' );

							if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
								$this->xml_append( $option_xml, 'Name', $meta['label'] );
								$this->xml_append( $option_xml, 'Value', $meta['value'] );
							} else {
								$this->xml_append( $option_xml, 'Name', $meta->display_key );
								$this->xml_append( $option_xml, 'Value', wp_strip_all_tags( $meta->display_value ) );
							}

							$options_xml->appendChild( $option_xml );
						}

						$item_xml->appendChild( $options_xml );
					}
				}

				$items_xml->appendChild( $item_xml );
			}

			if ( ! $found_item ) {
				continue;
			}

			// Append cart level discount line
			if ( $order->get_total_discount() ) {
				$item_xml  = $xml->createElement( 'Item' );
				$this->xml_append( $item_xml, 'SKU', 'total-discount' );
				$this->xml_append( $item_xml, 'Name', __( 'Total Discount', 'woocommerce-shipstation' ) );
				$this->xml_append( $item_xml, 'Adjustment', 'true', false );
				$this->xml_append( $item_xml, 'Quantity', 1, false );
				$this->xml_append( $item_xml, 'UnitPrice', $order->get_total_discount() * -1, false );
				$items_xml->appendChild( $item_xml );
			}

			// Append items XML
			$order_xml->appendChild( $items_xml );
			$orders_xml->appendChild( $order_xml );

			$exported ++;

			// Add order note to indicate it has been exported to Shipstation.
			if ( 'yes' !== get_post_meta( $order_id, '_shipstation_exported', true ) ) {
				$order->add_order_note( __( 'Order has been exported to Shipstation', 'woocommerce-shipstation' ) );
				update_post_meta( $order_id, '_shipstation_exported', 'yes' );
			}
		}

		$orders_xml->setAttribute( 'page', $page );
		$orders_xml->setAttribute( 'pages', ceil( $max_results / WC_SHIPSTATION_EXPORT_LIMIT ) );
		$xml->appendChild( $orders_xml );
		echo $xml->saveXML();

		/* translators: 1: total count */
		$this->log( sprintf( __( 'Exported %s orders', 'woocommerce-shipstation' ), $exported ) );
	}

	/**
	 * Get shipping method names
	 * @param  WC_Order $order
	 * @return array
	 */
	private function get_shipping_methods( $order ) {
		$shipping_methods = $order->get_shipping_methods();
		$shipping_method_names = array();

		foreach ( $shipping_methods as $shipping_method ) {
			// Replace non-AlNum characters with space
			$method_name = preg_replace( '/[^A-Za-z0-9 \-\.\_,]/', '', $shipping_method['name'] );
			$shipping_method_names[] = $method_name;
		}

		return $shipping_method_names;
	}

	/**
	 * Get Order Notes
	 * @param  WC_Order $order
	 * @return array
	 */
	private function get_order_notes( $order ) {
		$args = array(
			'post_id' => version_compare( WC_VERSION, '3.0.0', '>=' ) ? $order->get_id() : $order->id,
			'approve' => 'approve',
			'type'    => 'order_note',
		);

		remove_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_order_comments' ), 10, 1 );

		$notes = get_comments( $args );

		add_filter( 'comments_clauses', array( 'WC_Comments', 'exclude_order_comments' ), 10, 1 );

		$order_notes = array();

		foreach ( $notes as $note ) {
			if ( 'WooCommerce' !== $note->comment_author ) {
				$order_notes[] = $note->comment_content;
			}
		}

		return $order_notes;
	}

	/**
	 * Append XML as cdata
	 */
	private function xml_append( $append_to, $name, $value, $cdata = true ) {
		$data = $append_to->appendChild( $append_to->ownerDocument->createElement( $name ) );
		if ( $cdata ) {
			$data->appendChild( $append_to->ownerDocument->createCDATASection( $value ) );
		} else {
			$data->appendChild( $append_to->ownerDocument->createTextNode( $value ) );
		}
	}
}

return new WC_Shipstation_API_Export();
