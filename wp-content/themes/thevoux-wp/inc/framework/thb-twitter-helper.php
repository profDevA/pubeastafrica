<?php
/* Thb Tweets */
function thb_gettweets($count = 5, $username = 'fuel_themes') {
	$transient_name = 'thb_twitter_'. $username .'_'.$count;
	$cache = get_transient($transient_name);

	if ( empty( $cache ) ) {
		$token = get_transient( 'thb_twitter_access_token' );

		if ( !$token ) {
			$bearer_token_credential = 't0w3HYVODhFG0m34IFXg:lE7n2D4CFcikzCUIwF9JYj6fKSkjJ8la1oEmpYXk';
			$credentials = thb_encode( $bearer_token_credential );

			$args = array(
				'method' => 'POST',
				'httpversion' => '1.1',
				'blocking' => true,
				'headers' => array(
					'Authorization' => 'Basic ' . $credentials,
					'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
				),
				'body' => array( 'grant_type' => 'client_credentials' )
			);

			add_filter( 'https_ssl_verify', '__return_false' );
			$response = wp_remote_post( esc_url( 'https://api.twitter.com/oauth2/token', null, '' ), $args );

			$keys = json_decode( wp_remote_retrieve_body( $response ) );

			$token = isset( $keys->access_token ) ? $keys->access_token : null;

			set_transient('thb_twitter_access_token', $token, 12 * HOUR_IN_SECONDS);
		}
		// Get Data
		$args = array(
			'httpversion' => '1.1',
			'blocking' => true,
			'headers' => array(
				'Authorization' => "Bearer $token",
			),
		);
		add_filter( 'https_ssl_verify', '__return_false' );

		$url = add_query_arg( array(
			'screen_name'     => $username,
			'count'           => $count,
			'include_rts'     => false,
			'exclude_replies' => false,
		), 'https://api.twitter.com/1.1/statuses/user_timeline.json' );

		$response = wp_remote_get( $url, $args );

		remove_filter( 'https_ssl_verify', '__return_false' );

		//  Check for Errors
		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code( $response ) !== 200 ) {

			$cache = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( ! isset( $cache['errors'] ) ) {

				$cache = array();

				$cache['errors'][0]['message'] = 'Not available!';
			}
		} else {
			$cache = json_decode( wp_remote_retrieve_body( $response ) );
			set_transient($transient_name, $cache, HOUR_IN_SECONDS);
		}
	}
	return $cache;
}
/* Structure Data */
function thb_twitter_data($tweets) {

	$twitter = array();
	if ( is_array( $tweets ) && $tweets ) {
		$twitter['name']        = $tweets[0]->user->name;
		$twitter['screen_name'] = $tweets[0]->user->screen_name;
		$twitter['avatar']      = $tweets[0]->user->profile_image_url_https;
		$twitter['background']  = $tweets[0]->user->profile_banner_url;
		$twitter['following']   = (int) $tweets[0]->user->friends_count;
		$twitter['followers']   = (int) $tweets[0]->user->followers_count;

		$thb_twitter_helper = new ThbTwitterHelper();

		foreach($tweets as $tweet) {
			$twitter['tweets'][] =  array(
				'id' => $tweet->id_str,
	  		'text' => $thb_twitter_helper->thb_getTweetText($tweet),
	  		'url' => $thb_twitter_helper->thb_getTweetURL($tweet),
				'retweet_count' => $tweet->retweet_count > 0 ? $tweet->retweet_count : '',
				'fav_count' => $tweet->favorite_count > 0 ? $tweet->favorite_count : '',
	  		'time' => $thb_twitter_helper->thb_getTweetTime($tweet)
	  	);
		}
	}
	return $twitter;
}

/* Convert Twitter Text */
class ThbTwitterHelper {
  public function thb_getTweetText($tweet) {

    if($tweet->text) {

      $tweet_text = $tweet->text;

      // link links
      $tweet_text = preg_replace('/(https?)\:\/\/([a-z0-9\/\.\&\#\?\-\+\~\_\,]+)/i', '<a target="_blank" href="'.('$1://$2').'">$1://$2</a>', $tweet_text);

      // mention links
      $tweet_text = preg_replace('/\@([a-aA-Z0-9\.\_\-]+)/i', '<a target="_blank" href="https://twitter.com/$1">@'.'$1</a>', $tweet_text);

      // hashtags links
      $tweet_text = preg_replace('/\#([a-aA-Z0-9\.\_\-]+)/i', '<a target="_blank" href="https://twitter.com/search?q\=$1">#$1</a>', $tweet_text);

      return $tweet_text;
    } else {
    	return '';
    }
  }
  public function thb_getTweetTime($tweet) {
    if($tweet->created_at) {
        return human_time_diff(strtotime($tweet->created_at), current_time('timestamp') ).' '.esc_html__('ago', 'thevoux' );
    } else {
    	return '';
    }
  }
  public function thb_getTweetURL($tweet) {
    if(!empty($tweet->id_str) && $tweet->user->screen_name) {
      return 'https://twitter.com/'.$tweet->user->screen_name.'/statuses/'.$tweet->id_str;
    } else {
    	return '#';
    }
  }
}