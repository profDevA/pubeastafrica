<?php
// thb Subscribe Widget
class thb_subscribe_widget extends WP_Widget {

	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_subscribe_widget',
			'description' => esc_html__('A widget that gathers email addresses.','thevoux')
		);

		parent::__construct(
			'thb_subscribe_widget',
			esc_html__( 'Fuel Themes - Subscribe Widget' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array( 'title' => '', 'desc' => '', 'image' => '', 'style' => 'dark-text'  );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$image = array_key_exists('image', $instance) ? strip_tags( $instance['image'] ) : false;
		$style = array_key_exists('style', $instance) ? strip_tags( $instance['style'] ) : false;
		$desc = $instance['desc'];

		echo $before_widget;
		echo ($title ? $before_title . $title . $after_title : '');

		$has_image = $image ? 'has-image' : '';
		$btn_color = $style === 'light-text' ? 'transparent-white' : 'transparent-black';
		?>
		<div class="newsletter-container <?php echo esc_attr( $style . ' ' . $has_image ); ?>">
			<?php if ($image) { ?>
			 <div class="parallax_bg" style="background-image: url(<?php echo esc_attr( $image ); ?>);"
						data-top-bottom="transform: translate3d(0px, 5%, 0px);"
						data-bottom-top="transform: translate3d(0px, -5%, 0px);"></div>
			<?php } ?>
			<div class="newsletter-form-container">
	      <p><?php echo esc_html($desc); ?></p>
	      <form class="newsletter-form" action="#" method="post" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_subscription' ) ); ?>">
	      	<input placeholder="<?php esc_attr_e("Your E-Mail",'thevoux' ); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
					<button type="submit" name="submit" class="btn small <?php echo esc_attr($btn_color); ?>"><?php esc_html_e( 'SUBSCRIBE NOW', 'thevoux' ); ?></button>
					<?php do_action('thb_after_newsletter_submit'); ?>
	      </form>
				<?php do_action('thb_after_newsletter_form'); ?>
      </div>
		</div>
		<?php

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = $this->defaults;
		$instance = wp_parse_args( (array) $instance, $defaults );
		$style = $instance['style'];
		?>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Widget Title:', 'thevoux' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>"><?php esc_html_e('Short Description:', 'thevoux' ); ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'desc' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'desc' )); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
		</p>
		<p>
		  <label for="<?php echo esc_attr($this->get_field_name( 'image' )); ?>"><?php esc_html_e( 'Background Image:', 'thevoux' ); ?></label>
		  <input name="<?php echo esc_attr($this->get_field_name( 'image' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'image' )); ?>" class="widefat" type="text" size="36"  value="<?php echo esc_attr($instance['image']); ?>" />
		  <input class="thb-upload-image button" type="button" value="Upload Image" onclick="ThbImage.uploader( '<?php echo esc_attr($this->id); ?>', '<?php echo esc_attr($this->get_field_id( 'image' )); ?>', '<?php echo esc_attr($this->get_field_id( 'image_alt' )); ?>' ); return false;" />
		  <input name="<?php echo esc_attr($this->get_field_name( 'image_alt' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'image_alt' )); ?>"  type="hidden" value="<?php echo esc_attr($instance['image_alt']); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('style1')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('style1')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="dark-text" <?php if($style === 'dark-text' || !$style){ echo 'checked="checked"'; } ?> /> <?php esc_html_e('Dark Text', 'thevoux' ); ?>
			</label><br>
			<label for="<?php echo esc_attr($this->get_field_id('style2')); ?>">
			<input id="<?php echo esc_attr($this->get_field_id('style2')); ?>" name="<?php echo esc_attr($this->get_field_name('style')); ?>" type="radio" value="light-text" <?php if($style === 'light-text'){ echo 'checked="checked"'; } ?> /> <?php esc_html_e('Light Text', 'thevoux' ); ?>
			</label>
		</p>
		<?php if (current_user_can( 'manage_options' )) { ?>
			<p>
				<a href="?thb_download_emails=true" class="button button-primary"><?php esc_html_e('Download Emails', 'thevoux' ); ?></a>
			</p>
		<?php } ?>
	<?php
	}
}
add_action( 'widgets_init', 'thb_subscribe_widgets' );