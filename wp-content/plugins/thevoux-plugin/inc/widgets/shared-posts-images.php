<?php
// thb shared Posts w/ Images
class widget_sharedimages extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_sharedimages',
			'description' => esc_html__('Display most shared posts with images','thevoux')
		);

		parent::__construct(
			'thb_sharedimages_widget',
			esc_html__( 'Fuel Themes - Most Shared Posts with Images' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array(
			'title' => 'Most Shared',
			'show' => '3',
			'style' => 'style1'
		);
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$show = $instance['show'];
		$style = isset($instance['style']) ? $instance['style'] : 'style1';
		$args = array(
			'posts_per_page'      => $show,
			'no_found_rows'       => true,
			'order'               => 'DESC',
			'meta_key'            => 'thb_pssc_counts',
			'orderby'             => 'meta_value_num',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		);
		$posts = new WP_Query( $args );
		$counts = 0;
		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');
		echo '<ul class="shared-'.esc_attr($style).'">';
		while  ($posts->have_posts()) : $posts->the_post();
		$counts ++;
		set_query_var('thb_shares', true);
		if ($style == 'style1') {
			get_template_part( 'inc/templates/loop/listing');
		 } elseif ($style == 'style2') {
		 	set_query_var('thb_class', 'panr');
		 	set_query_var('thb_counts', $counts);
		 	set_query_var('thb_imagesize', 'thevoux-widget-2x');
		 	get_template_part( 'inc/templates/loop/listing');
		} elseif ($style == 'style3') {
			get_template_part( 'inc/templates/loop/listing-style2');
		} ?>
		<?php endwhile;
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
		$instance = wp_parse_args( (array) $instance, $defaults );
		$style = $instance['style'];?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('style1')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('style1')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="style1" <?php if($style === 'style1' || !$style){ echo 'checked="checked"'; } ?> /> Style 1
			</label><br>
			<label for="<?php echo esc_attr($this->get_field_id('style2')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('style2')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="style2" <?php if($style === 'style2'){ echo 'checked="checked"'; } ?> /> Style 2
			</label><br>
			<label for="<?php echo esc_attr($this->get_field_id('style3')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('style3')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="style3" <?php if($style === 'style3'){ echo 'checked="checked"'; } ?> /> Style 3
			</label>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Posts:', 'thevoux' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>"  class="widefat" />
		</p>
	<?php
	}
}