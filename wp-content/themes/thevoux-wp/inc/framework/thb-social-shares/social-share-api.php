<?php
/**
 * Get Social Shares class
 *
 * @author  Bishoy A. <hi@bishoy.me>
 */

class thb_ShareCount {
	/**
	 * URL to check it's shares
	 * @var string
	 */
	private $url;

	/**
	 * Timeout (Maximum time for CURL request)
	 * @var integer
	 */
	private $timeout;

	/**
	 * The constructor
	 * @param string  $url
	 * @param integer $timeout
	 */
	public function __construct( $url, $timeout = 20 ) {
		$this->url     = rawurlencode( $url );
		$this->raw_url = $url;
		$this->timeout = $timeout;
	}

	/**
	 * Get Linked In Shares
	 * @return integer
	 */
	public function thb_linkedin_count() {
		$return_data = wp_remote_get( "http://www.linkedin.com/countserv/count/share?url=$this->url&format=json", array( 'timeout' => $this->timeout) );
		if ( is_wp_error( $return_data ) ) {
			error_log($return_data->get_error_message());
			return 0;
		}
		$return_data = wp_remote_retrieve_body( $return_data );
		$json = json_decode( $return_data, true );
		return isset( $json['count'] ) ? intval( $json['count'] ) : 0;
	}

	/**
	 * Get Facebook Shares
	 * @return integer
	 */
	 public function thb_facebook_count() {

		$thb_fb_access_token = apply_filters( 'thb_fb_access_token', '2187816051486436|FhSa3jBsZeAmkfzdIYWzN7v0jSU' );
 		$json_url = 'https://graph.facebook.com/?id=' . $this->url . '&fields=engagement&access_token=' . $thb_fb_access_token;

 		$json = wp_remote_get($json_url, array( 'timeout' => $this->timeout));
 		// Check for error
 		if ( is_wp_error( $json ) ) {
 			error_log($json->get_error_message());
 			return;
 		}
 		$data = wp_remote_retrieve_body( $json );

 		$json = json_decode($data);

 		return isset( $json->engagement->share_count ) ? intval( $json->engagement->share_count ) : 0;
 	}

	/**
	 * Get pinterest Pins
	 * @return integer
	 */
	public function thb_pinterest_count() {
		$return_data = wp_remote_get( 'https://api.pinterest.com/v1/urls/count.json?url='.$this->url, array( 'timeout' => $this->timeout) );

		if ( is_wp_error( $return_data ) ) {
			error_log($return_data->get_error_message());
			return 0;
		}
		$return_data = wp_remote_retrieve_body( $return_data );
		$json_string = preg_replace("/[^(]*\((.*)\)/", "$1", $return_data );
		$json = json_decode( $json_string, true );

		return isset( $json['count'] ) ? intval( $json['count'] ) : 0;
	}

	/**
	 * Get all counts
	 * @return integer total count
	 */
	public function thb_all_count() {
		$count = 0;

		$fb = $this->thb_facebook_count();
		$pi = $this->thb_pinterest_count();
		$li = $this->thb_linkedin_count();
		$count = $fb + $pi + $li;

		return $count;
	}
}