<?php
// thb twitter
class thb_twitter extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'thb_widget_twitter',
			'description' => esc_html__('Display Your Twitter Feed', 'thevoux')
		);

		parent::__construct(
			'thb_twitter_widget',
			esc_html__( 'Fuel Themes - Twitter' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array(
			'title'    => '',
			'layout'	 => 'list',
			'username' => 'ripple',
			'show'     => 5
		);
	}

	function widget($args, $instance) {
		$params = array_merge( $this->defaults, $instance );

    // Before Widget.
		echo $args['before_widget'];

		// Title.
		if ( $params['title'] ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
		}
    $tweets = thb_gettweets($params['show'], $params['username']);
		if (array_key_exists('errors',$tweets)) {
			echo esc_html($tweets['errors'][0]['message']);
			return;
		}
		$twitter_data = thb_twitter_data($tweets);

		if ($params['layout'] == 'slider') { ?>
		<div class="thb-twitter-carousel-wrapper">
			<div class="thb-twitter-carousel-header">
				<i class="fa fa-twitter"></i>
			</div>
			<div class="thb-carousel slick" data-columns="1" data-fade="true" data-autoplay="1" data-adaptive="true">
				<?php foreach($twitter_data['tweets'] as $tweet) { ?>
					<div class="thb-tweet">
						<div class="thb-tweet-text"><?php echo wp_kses_post($tweet['text']); ?></div>
						<div class="thb-tweet-time"><a href="https://twitter.com/<?php echo esc_html($twitter_data['screen_name']); ?>/status/<?php echo esc_attr( $tweet['id'] ); ?>" target="_blank"><?php echo esc_html($tweet['time']); ?></a></div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php } else { ?>
		<div class="thb-twitter-header">
			<a href="https://twitter.com/<?php echo esc_attr($twitter_data['screen_name']); ?>" target="_blank">
				<img src="<?php echo esc_url($twitter_data['background']); ?>" alt="<?php echo esc_attr($twitter_data['name']); ?>" class="thb_twitter_header_bg"/>
				<img src="<?php echo esc_url($twitter_data['avatar']); ?>" alt="<?php echo esc_attr($twitter_data['name']); ?>" class="thb_twitter_avatar"/>
			</a>
		</div>
		<div class="thb-twitter-content">
			<div class="thb-twitter-user">
				<span class="thb-twitter-username"><?php echo esc_html($twitter_data['name']); ?></span><span class="thb-twitter-screenname">@<?php echo esc_html($twitter_data['screen_name']); ?></span>
				<div class="thb-twitter-usermeta">
					<span><?php echo thb_numberAbbreviation($twitter_data['following']); ?> <?php esc_html_e('Following', 'thevoux' ); ?></span>
					<span><?php echo thb_numberAbbreviation($twitter_data['followers']); ?> <?php esc_html_e('Followers', 'thevoux' ); ?></span>
				</div>
			</div>
			<div class="thb-twitter-tweets">
				<?php foreach($twitter_data['tweets'] as $tweet) { ?>
					<div class="thb-tweet">
						<i class="fa fa-twitter"></i>
						<div class="thb-tweet-text"><?php echo wp_kses_post($tweet['text']); ?></div>
						<div class="thb-tweet-time"><a href="https://twitter.com/<?php echo esc_html($twitter_data['screen_name']); ?>/status/<?php echo esc_attr( $tweet['id'] ); ?>" target="_blank"><?php echo esc_html($tweet['time']); ?></a></div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
		}
		echo $args['after_widget'];
	}
	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		return $instance;
	}
	function form($instance) {
		$params = array_merge( $this->defaults, $instance );
		?>
			<!-- Title -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'thevoux' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $params['title'] ); ?>" /></p>

			<!-- Layout -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'thevoux' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" class="widefat">
					<option value="list" <?php selected( $params['layout'], 'list' ); ?>><?php esc_html_e( 'List', 'thevoux' ); ?></option>
					<option value="slider" <?php selected( $params['layout'], 'slider' ); ?>><?php esc_html_e( 'Slider', 'thevoux' ); ?></option>
				</select>
			</p>

			<!-- Username -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'thevoux' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $params['username'] ); ?>" /></p>

      <p>
				<label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Tweets:', 'thevoux' ); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($params['show']); ?>" class="widefat" />
			</p>
		<?php
	}
}