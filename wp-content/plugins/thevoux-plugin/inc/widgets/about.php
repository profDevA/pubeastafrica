<?php
// thb Featured Video
class widget_thbabout extends WP_Widget {
	function __construct() {
   $widget_ops = array(
   		'classname'   => 'widget_about',
   		'description' => esc_html__('Display your information','thevoux')
   	);

   	parent::__construct(
   		'thb_about_widget',
   		esc_html__( 'Fuel Themes - About Me' , 'thevoux' ),
   		$widget_ops
   	);

   	$this->defaults = array( 'title' => 'About Me', 'image' => '', 'image_alt' => '', 'description' => '' );

		add_action('admin_enqueue_scripts', array($this, 'thb_assets'));
	}

	function widget($args, $instance) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$description = $instance['description'];
		$image = $instance['image'];
		$image_alt = $instance['image_alt'];
		// Output
		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');

		?>
			<figure>
				<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>" />
			</figure>
		<?php
		if ($description) {
			echo wpautop($description);
		}

		echo $after_widget;
	}
	function thb_assets($hook) {
		if ( 'widgets.php' != $hook ) {
        return;
    }

    wp_enqueue_media();

    wp_localize_script( 'thb-admin-meta', 'ThbImageWidget', array(
    	'frame_title' => esc_html__( 'Select an Image', 'thevoux' ),
    	'button_title' => esc_html__( 'Insert Into Widget', 'thevoux' ),
    ) );
	}
	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;

		return $instance;
	}
	// Settings form
	function form($instance) {

		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux' ); ?></label>
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
		</p>
		<p>
	    <label for="<?php echo esc_attr($this->get_field_name( 'image' )); ?>"><?php esc_html_e( 'Image:', 'thevoux' ); ?></label>
	    <input name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr($instance['image']); ?>" />
	    <input class="thb-upload-image button" type="button" value="Upload Image" onclick="ThbImage.uploader( '<?php echo esc_attr($this->id); ?>', '<?php echo esc_attr($this->get_field_id( 'image' )); ?>', '<?php echo esc_attr($this->get_field_id( 'image_alt' )); ?>' ); return false;" />
	    <input name="<?php echo esc_attr($this->get_field_name( 'image_alt' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'image_alt' )); ?>"  type="hidden" value="<?php echo esc_attr($instance['image_alt']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'description' )); ?>"><?php esc_html_e('Short Description:', 'thevoux' ); ?></label>
			<textarea id="<?php echo esc_attr($this->get_field_id( 'description' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'description' )); ?>" class="widefat" rows="5"><?php echo esc_textarea($instance['description']); ?></textarea>
		</p>
    <?php
	}
}