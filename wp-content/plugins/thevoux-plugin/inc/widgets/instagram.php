<?php
// thb twitter
class widget_thbinstagram extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'thb_widget_instagram',
			'description' => esc_html__('Display Your Instagram Feed', 'thevoux' )
		);

		parent::__construct(
			'thb_instagram_widget',
			esc_html__( 'The Issue - Instagram' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array(
			'title'        => '',
			'username'     => 'fuelthemes',
			'access_token' => '',
			'columns'	     => '2',
			'layout'	     => 'thumbnail',
			'show'         => 6
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

		$instagram = thb_getInstagramPhotos($params['show'], $params['username'], $params['access_token']);

		if ($params['layout'] == 'slider') {
			?>
			<div class="thb-carousel thb-instagram-row row" data-fade="true" data-columns="1" data-autoplay="true" data-autoplay-speed="2000">
				<?php if (array_key_exists('data', $instagram)) { foreach ($instagram['data'] as $item) { ?>
					<div class="small-12 columns">
						<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
						<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
						<span><?php get_template_part( 'assets/img/svg/like.svg'); ?><em><?php echo thb_numberAbbreviation($item['likes']); ?></em>
						</figure>
					</div>
				<?php } } ?>
			</div>
			<div class="thb-instagram-footer">
				<a href="https://instagram.com/<?php echo esc_attr($params['username']); ?>" target="_blank">
					<i class="thb-icon-instagram"></i> <?php echo esc_attr($params['username']); ?>
				</a>
			</div>
			<?php
		} elseif ($params['layout'] == 'thumbnail') {
			$col = thb_translate_columns($params['columns']);
			?>
			<div class="thb-instagram-header">
				<a href="https://instagram.com/<?php echo esc_attr($params['username']); ?>" target="_blank">
					<img src="<?php echo esc_url($instagram['user_data']['profile_pic_url_hd']); ?>" alt="<?php echo esc_attr($params['username']); ?>" class="thb_instagram_avatar"/>
				</a>
				<div class="thb-twitter-user">
					<span class="thb-instagram-username"><?php echo esc_attr($params['username']); ?></span>
					<div class="thb-instagram-usermeta">
						<span><?php echo thb_numberAbbreviation(($instagram['user_data']['followed_by'])); ?> <?php esc_html_e( 'Followers', 'thevoux' ); ?></span>
						<span><?php echo thb_numberAbbreviation(($instagram['user_data']['follow'])); ?> <?php esc_html_e( 'Following', 'thevoux' ); ?></span>
					</div>
				</div>
			</div>
			<div class="instagram-row row low-padding">
				<?php if (array_key_exists('data', $instagram)) { foreach ($instagram['data'] as $item) { ?>
					<div class="small-6 <?php echo esc_attr($col); ?> columns">
						<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
						<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
						<span><?php get_template_part( 'assets/svg/like.svg'); ?><em><?php echo thb_numberAbbreviation($item['likes']); ?></em>
						</figure>
					</div>
				<?php } } ?>
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

			<!-- Username -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username:', 'thevoux' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $params['username'] ); ?>" /></p>

			<!-- access_token -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>"><?php esc_html_e( 'Access Token:', 'thevoux' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'access_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'access_token' ) ); ?>" type="text" value="<?php echo esc_attr( $params['access_token'] ); ?>" /></p>

			<!-- Layout -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>"><?php esc_html_e( 'Layout', 'thevoux' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'layout' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'layout' ) ); ?>" class="widefat">
					<option value="thumbnail" <?php selected( $params['layout'], 'thumbnail' ); ?>><?php esc_html_e( 'Thumbnails', 'thevoux' ); ?></option>
					<option value="slider" <?php selected( $params['layout'], 'slider' ); ?>><?php esc_html_e( 'Slider', 'thevoux' ); ?></option>
				</select>
			</p>

			<!-- Layout -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>"><?php esc_html_e( 'Columns:', 'thevoux' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'columns' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'columns' ) ); ?>" class="widefat">
					<option value="1" <?php selected( $params['columns'], '1' ); ?>><?php esc_html_e( '1 Column', 'thevoux' ); ?></option>
					<option value="2" <?php selected( $params['columns'], '2' ); ?>><?php esc_html_e( '2 Columns', 'thevoux' ); ?></option>
					<option value="3" <?php selected( $params['columns'], '3' ); ?>><?php esc_html_e( '3 Columns', 'thevoux' ); ?></option>
					<option value="4" <?php selected( $params['columns'], '4' ); ?>><?php esc_html_e( '4 Columns', 'thevoux' ); ?></option>
				</select>
			</p>
      <p>
				<label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Photos:', 'thevoux' ); ?></label>
				<input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($params['show']); ?>" class="widefat" />
			</p>
		<?php
	}
}