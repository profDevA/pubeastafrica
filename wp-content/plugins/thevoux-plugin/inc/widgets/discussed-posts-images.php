<?php
// thb most discussed Posts w/ Images
class widget_discussedimages extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_discussedimages',
			'description' => esc_html__('Display most discussed posts with images','thevoux')
		);

		parent::__construct(
			'thb_discussedimages_widget',
			esc_html__( 'Fuel Themes - Most Discussed Posts' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array( 'title' => 'Most Discussed', 'show' => '3' );
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];

		$args = array(
			'post_type'=>'post',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $show,
			'orderby' => 'comment_count',
			'order'=> 'DESC'
		);
		$discussed_posts = new WP_Query( $args );
		if (!$discussed_posts->found_posts) {
			$discussed_posts = new WP_Query(array(
				'post_type'=>'post',
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1,
				'no_found_rows' => true,
				'posts_per_page' => $show
			));
		}
		echo $before_widget;
		echo $before_title . $title . $after_title;
		echo '<ul>';
		$counts = 0;

		while  ($discussed_posts->have_posts()) : $discussed_posts->the_post();
			set_query_var( 'thb_counts', false );
			set_query_var( 'thb_class', false );
			set_query_var( 'thb_imagesize', 'thumbnail' );
			set_query_var( 'thb_shares', false );
			get_template_part( 'inc/templates/loop/listing');
		endwhile;
		echo '</ul>';
		echo $after_widget;

		wp_reset_query();
	}
	function update( $new_instance, $old_instance ) {
	 $instance = $new_instance;

	 return $instance;
	}
	function form($instance) {
	 $defaults = $this->defaults;
	 $instance = wp_parse_args( (array) $instance, $defaults ); ?>

	 <p>
	   <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux' ); ?></label>
	   <input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
	 </p>

	 <p>
	   <label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Posts:', 'thevoux' ); ?></label>
	   <input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>" class="widefat" />
	 </p>
	<?php
	}
}