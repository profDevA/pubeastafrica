<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * WC_ShipStation_Integration Class
 */
class WC_ShipStation_Integration extends WC_Integration {

	public static $auth_key        = null;
	public static $export_statuses = array();
	public static $logging_enabled = true;
	public static $shipped_status  = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->id                 = 'shipstation';
		$this->method_title       = __( 'ShipStation', 'woocommerce-shipstation' );
		$this->method_description = __( 'ShipStation allows you to retrieve &amp; manage orders, then print labels &amp; packing slips with ease.', 'woocommerce-shipstation' );

		if ( ! get_option( 'woocommerce_shipstation_auth_key', false ) ) {
			update_option( 'woocommerce_shipstation_auth_key', $this->generate_key() );
		}

		// Load admin form
		$this->init_form_fields();

		// Load settings
		$this->init_settings();

		self::$auth_key             = get_option( 'woocommerce_shipstation_auth_key', false );
		self::$export_statuses      = $this->get_option( 'export_statuses', array( 'wc-processing', 'wc-on-hold', 'wc-completed', 'wc-cancelled' ) );
		self::$logging_enabled      = 'yes' === $this->get_option( 'logging_enabled', 'yes' );
		self::$shipped_status       = $this->get_option( 'shipped_status', 'wc-completed' );

		// Force saved value
		$this->settings['auth_key'] = self::$auth_key;

		// Hooks
		add_action( 'woocommerce_update_options_integration_shipstation', array( $this, 'process_admin_options' ) );
		add_filter( 'woocommerce_subscriptions_renewal_order_meta_query', array( $this, 'subscriptions_renewal_order_meta_query' ), 10, 4 );

		$settings_notice_dismissed = get_user_meta( get_current_user_id(), 'dismissed_shipstation-setup_notice' );

		if ( ! $settings_notice_dismissed ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_notices', array( $this, 'settings_notice' ) );
		}
	}

	/**
	 * Enqueue admin scripts/styles
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'shipstation-admin', plugins_url( 'assets/css/admin.css', dirname( __FILE__ ) ) );
	}

	/**
	 * Generate a key
	 * @return string
	 */
	public function generate_key() {
		$to_hash = get_current_user_id() . date( 'U' ) . mt_rand();
		return 'WCSS-' . hash_hmac( 'md5', $to_hash, wp_hash( $to_hash ) );
	}

	/**
	 * Init integration form fields
	 */
	public function init_form_fields() {
		$this->form_fields = include( 'data/data-settings.php' );
	}

	/**
	 * Prevents WooCommerce Subscriptions from copying across certain meta keys to renewal orders.
	 * @param  array $order_meta_query
	 * @param  int $original_order_id
	 * @param  int $renewal_order_id
	 * @param  string $new_order_role
	 * @return array
	 */
	public function subscriptions_renewal_order_meta_query( $order_meta_query, $original_order_id, $renewal_order_id, $new_order_role ) {
		if ( 'parent' == $new_order_role ) {
			$order_meta_query .= ' AND `meta_key` NOT IN ('
							. "'_tracking_provider', "
							. "'_tracking_number', "
							. "'_date_shipped', "
							. "'_order_custtrackurl', "
							. "'_order_custcompname', "
							. "'_order_trackno', "
							. "'_order_trackurl' )";
		}
		return $order_meta_query;
	}

	/**
	 * Settings prompt
	 */
	public function settings_notice() {
		if ( ! empty( $_GET['tab'] ) && 'integration' === $_GET['tab'] ) {
			return;
		}

		$logo_title = __( 'ShipStation logo', 'woocommerce-shipstation' );
		?>
		<div id="message" class="updated woocommerce-message shipstation-setup">
			<img class="shipstation-logo" alt="<?php echo esc_attr( $logo_title ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" src="<?php echo plugins_url( 'assets/images/shipstation-logo-blue.png', dirname( __FILE__ ) ); ?>" />
			<a class="woocommerce-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'wc-hide-notice', 'shipstation-setup' ), 'woocommerce_hide_notices_nonce', '_wc_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'woocommerce' ); ?></a>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: %s: ShipStation URL */
						__( 'To begin printing shipping labels with ShipStation head over to <a class="shipstation-external-link" href="%s" target="_blank">ShipStation.com</a> and log in or create a new account.', 'woocommerce-shipstation' ),
						array(
							'a' => array(
								'class'  => array(),
								'href'   => array(),
								'target' => array(),
							),
						)
					),
					'https://www.shipstation.com/partners/woocommerce/?ref=partner-woocommerce'
				);
				?>
			</p>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: %s: ShipStation Auth Key */
						__( 'After logging in, add a selling channel for WooCommerce and use your Auth Key (<code>%s</code>) to connect your store.', 'woocommerce-shipstation' ),
						array( 'code' => array() )
					),
					self::$auth_key
				);
				?>
			</p>
			<p><?php esc_html_e( "Once connected you're good to go!", 'woocommerce-shipstation' ); ?></p>
			<hr>
			<p>
				<?php
				printf(
					wp_kses(
						/* translators: %1$s: ShipStation plugin settings URL, %2$s: ShipStation documentation URL */
						__( 'You can find other settings for this extension <a href="%1$s">here</a> and view the documentation <a href="%2$s">here</a>.', 'woocommerce-shipstation' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					admin_url( 'admin.php?page=wc-settings&tab=integration&section=shipstation' ),
					'https://docs.woocommerce.com/document/shipstation-for-woocommerce/'
				);
				?>
			</p>
		</div>
		<?php
	}
}

