<?php
// thb most discussed & shared Posts w/ Images
class widget_discussedsharedimages extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_discussedsharedimages',
			'description' => esc_html__('Display most discussed & shared posts with images','thevoux')
		);

		parent::__construct(
			'thb_discussedsharedimages_widget',
			esc_html__( 'Fuel Themes - Discussed & Shared Posts' , 'thevoux' ),
			$widget_ops
		);

		$this->defaults = array( 'title' => 'Most Discussed', 'show' => '3' );
	}

	function widget($args, $instance) {
		extract($args);
		$show = $instance['show'];


		echo $before_widget;

		?>
			<div class="thb_tabs">
				<dl class="tabs" role="tablist">
						<dd role="presentation" class="active">
							<h6><a href="#discussed_" role="tab"><?php esc_html_e('Most Discussed', 'thevoux' ); ?></a></h6>
						</dd>
						<dd role="presentation">
							<h6><a href="#shared_" role="tab"><?php esc_html_e('Most Shared', 'thevoux' ); ?></a></h6>
						</dd>
				</dl>
				<ul class="tabs-content">
					<li id="discussed_Tab" class="active">
						<ul>
							<?php
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
								$counts = 0;
								while  ($discussed_posts->have_posts()) : $discussed_posts->the_post();
									set_query_var( 'thb_counts', false );
									set_query_var( 'thb_class', false );
									set_query_var( 'thb_imagesize', 'thumbnail' );
									set_query_var( 'thb_shares', false );
									get_template_part( 'inc/templates/loop/listing');
								endwhile;
							?>
						</ul>
					</li>
					<li id="shared_Tab">
						<ul>
							<?php
								$args = array(
									'posts_per_page' => $show,
									'order' => 'DESC',
									'meta_key' => 'thb_pssc_counts',
									'orderby' => 'meta_value_num'
								);
								$shared_posts = new WP_Query( $args );
								$counts = 0;
								while  ($shared_posts->have_posts()) : $shared_posts->the_post();
									set_query_var( 'thb_counts', false );
									set_query_var( 'thb_class', false );
									set_query_var( 'thb_imagesize', 'thumbnail' );
									set_query_var( 'thb_shares', true );
									get_template_part( 'inc/templates/loop/listing');
								endwhile;
							?>
						</ul>
					</li>
				</ul>
			</div>
		<?php
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
	   <label for="<?php echo esc_attr($this->get_field_id( 'show' )); ?>"><?php esc_html_e('Number of Posts:', 'thevoux' ); ?></label>
	   <input id="<?php echo esc_attr($this->get_field_id( 'show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show' )); ?>" value="<?php echo esc_attr($instance['show']); ?>" class="widefat" />
	 </p>
	<?php
	}
}