<?php
// thb Flickr Widget
class widget_thbflickr extends WP_Widget {
	function __construct(){
		$widget_ops = array(
			'classname'   => 'widget_flickr',
			'description' => esc_html__('Display Your Flickr Images','thevoux')
		);

		parent::__construct(
			'thb_flickr_widget',
			esc_html__( 'Fuel Themes - Flickr' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array( 'title' => 'Flickr', 'show' => '10', 'account' => 'eyetwist' );
	}

	public function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$account = $instance['account'];
		$show = $instance['show'];

		// Output
		echo $before_widget;
		echo $before_title . $title . $after_title;
			if($account && $show) {

				if (!get_transient('thb-flickr-account-'.$account)) {
					$request = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=0388a3691d9cbddb7969e1297b8424a5&username='.urlencode($account).'&format=json');
					if ( is_wp_error( $request ) ) {
						return false;
					}
					$data = wp_remote_retrieve_body( $request );
					$person = trim($data , 'jsonFlickrApi()');
					$person = json_decode($person);
					set_transient('thb-flickr-account-'.$account, $person->user->id, 0);
				}

				if (get_transient('thb-flickr-account-'.$account)) {
					$id = get_transient('thb-flickr-account-'.$account);
					$request = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.urls.getUserPhotos&api_key=0388a3691d9cbddb7969e1297b8424a5&user_id='.$id.'&format=json');
					if ( is_wp_error( $request ) ) {
						return false;
					} else {
						$data = wp_remote_retrieve_body( $request );
						$photos_url = trim($data, 'jsonFlickrApi()');
						$photos_url = json_decode($photos_url);

						set_transient('thb-flickr-url-'.$account, $photos_url->user->url, 0);
					}

					$request = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=0388a3691d9cbddb7969e1297b8424a5&user_id='.$id.'&per_page='.$show.'&format=json');
					if ( is_wp_error( $request ) ) {
						return false;
					} else {
						$data = wp_remote_retrieve_body( $request );
						$photos = trim($data, 'jsonFlickrApi()');
						$photos = json_decode($photos);

						set_transient('thb-flickr-photos-'.$account, $photos, 0);
					}


				} else {
					return '<p>Could not retrieve flickr photos.</p>';
				}
			}
		$photolist = get_transient('thb-flickr-photos-'.$account);
		$photourl = get_transient('thb-flickr-url-'.$account);
		if ($photolist && $photourl) {

		?>
			<div class="photocontainer">
				<?php
				foreach($photolist->photos->photo as $photo) {
					 $photo = (array) $photo;
					 $url = "http://farm" . esc_attr($photo['farm']) . ".static.flickr.com/" . esc_attr($photo['server']) . "/" . esc_attr($photo['id']) . "_" . esc_attr($photo['secret']) . '_s' . ".jpg";
				?>
					<div class="overlay-effect">
						<figure style="background-image:url(<?php echo esc_url($url); ?>)">
							<a href="<?php echo esc_attr($photourl); ?><?php echo esc_attr($photo['id']); ?>" target='_blank'></a>
						</figure>
					</div>
				<?php } ?>
			</div>
		<?php
		} else {
			echo '<p>Invalid flickr username.</p>';
		}
		echo $after_widget;
	}
	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		return $instance;
	}
	// Settings form
	public function form($instance) {
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>"  class="widefat" />
		</p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'account' )); ?>">Flickr Username:</label>
			<input id="<?php echo esc_attr($this->get_field_id( 'account' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'account' )); ?>" value="<?php echo esc_attr($instance['account']); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Images:', 'thevoux' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>"  class="widefat" />
		</p>
    <?php
	}
}