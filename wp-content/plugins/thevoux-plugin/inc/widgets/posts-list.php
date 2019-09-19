<?php
// thb latest Posts List
class widget_latestlist extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_latestlist',
			'description' => esc_html__('Display posts with excerpts','thevoux')
		);

		parent::__construct(
			'thb_latestlist_widget',
			esc_html__( 'Fuel Themes - Posts with Excerpts' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array(
			'title'              => '',
			'posts_per_page'     => 5,
			'orderby'            => 'date',
			'order'              => 'desc',
			'time_frame'         => '',
			'category'           => false
		);
	}

	function widget($args, $instance) {
		$params = array_merge( $this->defaults, $instance );

		$query_args = array(
			'posts_per_page'      => $params['posts_per_page'],
			'order'               => $params['order'],
			'no_found_rows'       => true,
			'post_type'						=> 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);


		// Category
		if ( $params['category'] ) {
			$query_args['cat'] = $params['category'];
		}

		// Post order.
		if ( 'shares' === 	$params['orderby'] ) {
			$query_args['orderby'] = 'meta_value_num';
			$query_args['meta_key'] = 'thb_pssc_counts';
		} elseif ( 'comments' === 	$params['orderby'] ) {
			$query_args['orderby'] = 'comment_count';
		} elseif ( 'views' === 	$params['orderby'] ) {
			if (function_exists('thb_most_viewed')) {
				$posts__in = thb_most_viewed($params['trending_date'], $params['posts_per_page']);
				$query_args['posts__in'] = $posts__in;
				$query_args['orderby'] = 'post__in';
			}
		} elseif ( 'rand' === 	$params['orderby'] ) {
			$query_args['orderby'] = 'rand';
		}

		// Time Frame
		if ( $params['time_frame'] ) {
			$query_args['date_query'] = array(
				array(
					'column' => 'post_date_gmt',
					'after'  => $params['time_frame'] . ' ago',
				),
			);
		}

		// Before Widget.
		echo $args['before_widget'];

		// Title.
		if ( $params['title'] ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
		}

		$widget_posts = new WP_Query($query_args);
		echo '<ul>';
		while  ($widget_posts->have_posts()) : $widget_posts->the_post(); ?>
			<?php add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' ); ?>
			<li class="post cf">
				<?php do_action('thb_post_top', false, true); ?>
				<header class="post-title">
					<h6><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h6>
				</header>
				<div class="post-content small">
				<?php the_excerpt(); ?>
				</div>
			</li>
		<?php endwhile;
		echo '</ul>';

		wp_reset_postdata();
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

			<!-- Number of Posts -->
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>"><?php esc_html_e( 'Number of Posts', 'thevoux' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per_page' ) ); ?>" type="number" value="<?php echo esc_attr( $params['posts_per_page'] ); ?>" /></p>

			<!-- Order by -->
			<p class="thb_orderby_row">
				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Order by', 'thevoux' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'orderby' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>" class="widefat">
					<option value="date" <?php selected( $params['orderby'], 'date' ); ?>><?php esc_html_e( 'Date', 'thevoux' ); ?></option>
					<option value="shares" <?php selected( $params['orderby'], 'shares' ); ?>><?php esc_html_e( 'Shares', 'thevoux' ); ?></option>
					<option value="rand" <?php selected( $params['orderby'], 'rand' ); ?>><?php esc_html_e( 'Random', 'thevoux' ); ?></option>
				</select>
			</p>

			<!-- Order -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'thevoux' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" class="widefat">
					<option value="desc" <?php selected( $params['order'], 'desc' ); ?>><?php esc_html_e( 'Descending', 'thevoux' ); ?></option>
					<option value="asc" <?php selected( $params['order'], 'asc' ); ?>><?php esc_html_e( 'Ascending', 'thevoux' ); ?></option>
				</select>
			</p>

			<!-- Time Frame -->
			<p class="thb_timeframe_row"><label for="<?php echo esc_attr( $this->get_field_id( 'time_frame' ) ); ?>"><?php esc_html_e( 'Time Frame', 'thevoux' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'time_frame' ) ); ?>" placeholder="<?php esc_html_e( '6 months', 'thevoux' ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'time_frame' ) ); ?>" type="text" value="<?php echo esc_attr( $params['time_frame'] ); ?>" /></p>

			<!-- Category -->
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category', 'thevoux' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>[]" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" class="widefat" style="height: auto !important;" multiple="multiple" size="8">
					<?php
						$cat_args = array(
							'hide_empty'   => 0,
							'hierarchical' => 1,
							'selected'     => (array) $params['category'],
							'walker'       => new THB_Posts_Categories_Tree_Walker(),
						);

						$allowed_html = array(
							'option' => array(
								'class'    => true,
								'value'    => true,
								'selected' => true,
							),
						);

						echo wp_kses( walk_category_dropdown_tree( get_categories( $cat_args ), 0, $cat_args ), $allowed_html );
					?>
				</select>
			</p>
		<?php
	}
}