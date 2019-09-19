<?php

// Get Instagram Photos
function thb_getInstagramPhotos( $number = 6, $username, $access_token = false ) {

	if ( $access_token && '' !== $access_token ) {
		$result = thb_getInstagramPhotos_json( $number, $username, $access_token  );
	} else {
		$result = thb_getInstagramPhotos_html( $number, $username );
	}

	return $result;
}
function thb_getInstagramPhotos_json( $number = 6, $username, $access_token ) {

	// Check Access Token
	if ( ! $access_token ) {
		$result['error'] = esc_html( 'Please enter an Instagram Access Token.', 'thevoux' );
		return $result;
	}
	// Check Username
	if ( ! $username ) {
		$result['error'] = esc_html( 'Please enter an Instagram User.', 'thevoux' );
		return $result;
	}

	$transient_name = 'thb-instagram-media-' . $username . '-' . $number . '-' . $access_token;
	$result = get_transient( $transient_name );

	if ( ! $result ) {
		$instagram_self_link = add_query_arg( array(
			'access_token' => $access_token,
		), 'https://api.instagram.com/v1/users/self' );

		$instagram_self_request = wp_safe_remote_get( $instagram_self_link,
			array(
				'timeout'     => 120,
				'httpversion' => '1.1',
				'redirection' => 10,
				'sslverify'   => false,
			)
		);

		$user = wp_remote_retrieve_body( $instagram_self_request );
		$user  = json_decode( $user );

		usleep( 180000 );

		$instagram_recent_photos = add_query_arg( array(
			'count'        => $number,
			'access_token' => $access_token,
		), 'https://api.instagram.com/v1/users/self/media/recent' );

		$instagram_recent_request = wp_safe_remote_get( $instagram_recent_photos,
			array(
				'timeout'     => 120,
				'httpversion' => '1.1',
				'redirection' => 10,
				'sslverify'   => false,
			)
		);

		$image_data = wp_remote_retrieve_body( $instagram_recent_request );
		$image_data = json_decode( $image_data );


		// User Data
		if ( isset( $user->data->counts->follows ) ) {
			$user_data['follow'] = $user->data->counts->follows;
		}
		if ( isset( $user->data->counts->followed_by ) ) {
			$user_data['followed_by'] = $user->data->counts->followed_by;
		}
		if ( isset( $user->data->profile_picture ) ) {
			$user_data['profile_pic_url_hd'] = $user->data->profile_picture;
		}
		if ( isset( $user->data->bio ) ) {
			$user_data['biography'] = $user->data->bio;
		}
		if ( isset( $user->data->website ) ) {
			$user_data['external_url'] = $user->data->website;
		}
		$result['user_data'] = $user_data;

		// Media Data
		foreach ($image_data->data as $key => $edge) {
			if ( ! isset( $edge->images ) || ! $edge->images ) {
				continue;
			}

			$result['data'][$key] = array(
				'link'      => $edge->link,
				'image_url' => $edge->images->standard_resolution->url,
				'likes'     => $edge->likes->count,
				'comments'  => $edge->comments->count,
			);
			if ( isset( $edge->caption->text ) ) {
				$text = strtok( $edge->caption->text, "\n" );

				$result['data'][$key]['caption'] = strip_tags( $text );
			}
		}
		set_transient($transient_name, $result, HOUR_IN_SECONDS);
	}
	return $result;
}
function thb_getInstagramPhotos_html( $number = 6, $username ) {

	// Check Username
	if ( ! $username ) {
		$result['error'] = esc_html( 'Please enter an Instagram User.', 'thevoux' );
		return $result;
	}

	$transient_name = 'thb-instagram-media-' . $username . '-' . $number;
	$result = get_transient( $transient_name );
	if ( ! $result ) {

		$remote_url = 'https://instagram.com/' . $username;
		$request_params = array(
			'timeout'    => 10,
			'user-agent' => thb_random_user_agent(),
			'headers'    => array(
				'Accept-language' => 'en',
			),
			'sslverify'  => false,
		);

		$proxies = array(
			'https://boomproxy.com/browse.php?u=',
			'https://eu.hidester.com/proxy.php?u=',
			'https://proxy-us2.toolur.com/browse.php?u=',
			'https://proxy-us3.toolur.com/browse.php?u=',
			'https://proxy-fr1.toolur.com/browse.php?u=',
			'https://eu2.free-proxy.com/browse.php?u=',
		);

		$remote_url = $proxies[ array_rand( $proxies ) ] . urlencode( $remote_url );

		$request = wp_safe_remote_get( $remote_url, $request_params );

		if ( is_wp_error( $request ) ) {
			return false;
		}

		$data = wp_remote_retrieve_body( $request );

    // Get Data
    preg_match( '/window\._sharedData = (.*);<\/script>/', $data, $ins_data );

    $ins_data_full = array_shift( $ins_data );
    $ins_data_json = array_shift( $ins_data );

		if ( ! $ins_data_json ) {
			return esc_html__( 'Instagram html data cannot be retrieved.', 'thevoux' );
		}
		$image_data = false;

    if ( $ins_data_json ) {
      $instagram_json = json_decode( $ins_data_json, true );

			// Instagram data is not set.
			if ( ! isset( $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user'] ) ) {
				return esc_html__( 'Instagram data is not set, please check the ID.', 'thevoux' );
			}
			$thb_user_data = $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user'];

			// Images not found.
			if ( ! isset( $thb_user_data['edge_owner_to_timeline_media']['edges'] ) ) {
				return esc_html__( 'There are no images in your account or the account is private.', 'thevoux' );
			}
      // Live Count.
      if ( ! empty( $thb_user_data['edge_owner_to_timeline_media']['edges'] ) ) {
        $image_data = $thb_user_data['edge_owner_to_timeline_media']['edges'];
      } else {
        $result['error'] = esc_html__( 'There are no images in your account or the account is private.', 'thevoux' );
      }

			// User Data.
			if ( ! empty( $instagram_json['entry_data']['ProfilePage'][0]['graphql']['user'] ) ) {
        $user_data['followed_by']        = $thb_user_data['edge_followed_by']['count'];
				$user_data['follow']             = $thb_user_data['edge_follow']['count'];
				$user_data['profile_pic_url_hd'] = $thb_user_data['profile_pic_url_hd'];
      }

    } else {
      $result['error'] = esc_html__( 'Instagram html data cannot be retrieved.', 'thevoux' );
    }
		if ($image_data) {

			foreach ($image_data as $key => $edge) {
				if ( ! isset( $edge['node']['thumbnail_src'] ) && $edge['node']['thumbnail_src'] ) {
					continue;
				}
				$result['data'][$key] = array(
					'link'      => 'http://instagram.com/p/'.$edge['node']['shortcode'].'/',
					'image_url' => $edge['node']['thumbnail_src'],
					'likes'     => $edge['node']['edge_liked_by']['count'],
					'comments'  => $edge['node']['edge_media_to_comment']['count'],
				);
				if ( isset( $edge['node']['edge_media_to_caption']['edges'][0]['node']['text'] ) ) {
					$text = strtok( $edge['node']['edge_media_to_caption']['edges'][0]['node']['text'], "\n" );

					$result['data'][$key]['caption'] = strip_tags( $text );
				}
			}
			// Number of images.
			$result['data'] = array_slice( $result['data'], 0, $number, true );
			$result['user_data'] = $user_data;
			set_transient($transient_name, $result, HOUR_IN_SECONDS);
		}

	}
	return $result;
}