<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_Shipstation_API_Request Class
 */
abstract class WC_Shipstation_API_Request {

	/**
	 * Stores logger class
	 * @var WC_Logger
	 */
	private $log = null;

	/**
	 * Log something
	 * @param  string $message
	 */
	public function log( $message ) {
		if ( 'no' === WC_ShipStation_Integration::$logging_enabled ) {
			return;
		}
		if ( is_null( $this->log ) ) {
			$this->log = new WC_Logger();
		}
		$this->log->add( 'shipstation', $message );
	}

	/**
	 * Run the request
	 */
	public function request() {}

	/**
	 * Validate data
	 * @param  array $required_fields fields to look for
	 */
	function validate_input( $required_fields ) {
		foreach ( $required_fields as $required ) {
			if ( empty( $_GET[ $required ] ) ) {
				/* translators: 1: field name */
				$this->trigger_error( sprintf( __( 'Missing required param: %s', 'woocommerce-shipstation' ), $required ) );
			}
		}
	}

	/**
	 * Trigger and log an error
	 * @param  string $message
	 */
	public function trigger_error( $message ) {
		$this->log( $message );
		wp_send_json_error( $message );
	}
}

