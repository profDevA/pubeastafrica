<?php
add_action( 'wp_ajax_nopriv_thb_infinite_ajax', 'thb_infinite_ajax' );
add_action( 'wp_ajax_thb_infinite_ajax', 'thb_infinite_ajax' );

function thb_infinite_ajax() {
	check_ajax_referer( 'thb_infinite_ajax', 'security' );
	global $post;
	$id            = filter_input( INPUT_POST, 'post_id', FILTER_VALIDATE_INT );
	$post          = get_post( $id );
	$previous_post = get_previous_post();

	if ( $id && $previous_post ) {
		$args  = array(
			'p'              => $previous_post->ID,
			'no_found_rows'  => true,
			'posts_per_page' => 1,
			'post_status'    => 'publish',
		);
		$query = new WP_Query( $args );
		do_action( 'thb_vc_ajax' );
		add_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) : $query->the_post();
				global $more;
				$more  = -1;
				$style = ot_get_option( 'article_style', 'style1' );

				if ( 'on' === get_post_meta( $previous_post->ID, 'article_style_override', true ) ) {
					$style = get_post_meta( $previous_post->ID, 'post-style', true );
				}
				get_template_part( 'inc/templates/single/' . $style );
			endwhile;
		}
	}
	wp_die();
}

add_action( 'wp_ajax_nopriv_thb_ajax', 'thb_load_more' );
add_action( 'wp_ajax_thb_ajax', 'thb_load_more' );

function thb_load_more() {
	check_ajax_referer( 'thb_ajax', 'security' );
	$style   = filter_input( INPUT_POST, 'style', FILTER_SANITIZE_STRING );
	$loop    = filter_input( INPUT_POST, 'loop', FILTER_SANITIZE_STRING );
	$page    = filter_input( INPUT_POST, 'page', FILTER_SANITIZE_STRING );
	$columns = filter_input( INPUT_POST, 'columns', FILTER_SANITIZE_STRING );

	$source_data          = VcLoopSettings::parseData( $loop );
	$source_data['paged'] = $page;
	$query_builder        = new ThbLoopQueryBuilder( $source_data );
	$posts                = $query_builder->build();
	$posts                = $posts[1];

	ob_start();
	add_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );

	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) : $posts->the_post();
			set_query_var( 'thb_columns', $columns );
			get_template_part( 'inc/templates/loop/masonry/masonry-' . $style );
		endwhile;
	}

	$out = ob_get_contents();
	$out = preg_replace( '/(\>)\s*(\<)/m', '$1$2', $out );
	if ( ob_get_contents() ) {
		ob_end_clean();
	}
	echo '' . $out;
	wp_die();
}

add_action( 'wp_ajax_nopriv_thb_posts', 'thb_posts' );
add_action( 'wp_ajax_thb_posts', 'thb_posts' );

function thb_posts() {
	check_ajax_referer( 'thb_posts_ajax', 'security' );
	$style          = filter_input( INPUT_POST, 'style', FILTER_SANITIZE_STRING );
	$loop           = filter_input( INPUT_POST, 'loop', FILTER_SANITIZE_STRING );
	$page           = filter_input( INPUT_POST, 'page', FILTER_SANITIZE_STRING );
	$columns        = filter_input( INPUT_POST, 'columns', FILTER_SANITIZE_STRING );
	$thb_i          = filter_input( INPUT_POST, 'thb_i', FILTER_VALIDATE_INT );
	$featured_index = filter_input( INPUT_POST, 'featured_index', FILTER_SANITIZE_STRING );

	$source_data          = VcLoopSettings::parseData( $loop );
	$source_data['paged'] = $page;
	$source_data          = thb_moveKeyBefore( $source_data, 'offset', 'paged' );
	$query_builder        = new ThbLoopQueryBuilder( $source_data );
	$posts                = $query_builder->build();
	$posts                = $posts[1];

	ob_start();
	add_filter( 'wp_get_attachment_image_attributes', 'thb_lazy_low_quality', 10, 3 );

	$i = 1;
	if ( $posts->have_posts() ) {
		while ( $posts->have_posts() ) : $posts->the_post();
		thb_DisplayPostGrid($style, $columns, $disable_excerpts, false, $featured_index, $i, $post_count);
		$i++;
		endwhile;
	}

	$out = ob_get_clean();

	echo '' . $out;
	wp_die();
}

function thb_ajax_parse_embed() {
	check_ajax_referer( 'thb_video_playlist', 'security' );
	$id       = filter_input( INPUT_POST, 'post_ID', FILTER_VALIDATE_INT );
	$thb_post = get_post( $id );
	if ( ! $thb_post ) {
		wp_send_json_error();
	}
	$video_url = get_post_meta( $id, 'post_video', true );
	if ( '' !== $video_url && wp_oembed_get( $video_url ) ) {
		$parsed = '<div class="flex-video widescreen">' . wp_oembed_get( $video_url ) . '</div>';
	} else {
		$parsed = wp_video_shortcode(
			array(
				'src' => $video_url,
			)
		);
	}
	wp_send_json_success(
		array(
			'body' => $parsed,
		)
	);
}
add_action( 'wp_ajax_thb-parse-embed', 'thb_ajax_parse_embed', 1 );
add_action( 'wp_ajax_nopriv_thb-parse-embed', 'thb_ajax_parse_embed', 1 );

// Email Subscribe.
function thb_subscribe_emails() {
	check_ajax_referer( 'thb_subscription', 'security' );

	// the email.
	$email   = filter_input( INPUT_POST, 'email', FILTER_SANITIZE_EMAIL );
	$privacy = filter_input( INPUT_POST, 'privacy', FILTER_VALIDATE_BOOLEAN );
	$checked = filter_input( INPUT_POST, 'checked', FILTER_VALIDATE_BOOLEAN );

	if ( $privacy && ! $checked ) {
		echo '<div class="woocommerce-error">' . __( 'Please accept the terms of our newsletter.', 'thevoux' ) . '</div>';
		wp_die();
	}
	// if the email is valid.
	if ( is_email( $email ) ) {

		// get all the current emails.
		$stack = get_option( 'subscribed_emails' );

		// if there are no emails in the database.
		if ( ! $stack ) {
			// update the option with the first email as an array.
			update_option( 'subscribed_emails', array( $email ) );
		} else {
			// if the email already exists in the array.
			if ( in_array( $email, $stack ) ) {
				echo '<div class="woocommerce-error">' . __( '<strong>Oh snap!</strong> That email address is already subscribed!', 'thevoux' ) . '</div>';
			} else {

				// If there is more than one email, add the new email to the array.
				array_push( $stack, $email );

				// update the option with the new set of emails.
				update_option( 'subscribed_emails', $stack );

				echo '<div class="woocommerce-message">' . __( '<strong>Well done!</strong> Your address has been added.', 'thevoux' ) . '</div>';
			}
		}
	} else {
		echo '<div class="woocommerce-error">' . __( '<strong>Oh snap!</strong> Please enter a valid email address.', 'thevoux' ) . '</div>';
	}
	wp_die();
}
add_action( 'wp_ajax_nopriv_thb_subscribe_emails', 'thb_subscribe_emails' );
add_action( 'wp_ajax_thb_subscribe_emails', 'thb_subscribe_emails' );

// Thb Newsletter Popup.
function thb_newsletter() {

	if ( ! class_exists( 'TheVoux_plugin' ) ) { return; }

	$newsletter = ot_get_option( 'newsletter', 'on' );

	if ( $newsletter !== 'on' ) { return; }

	if ( ! is_admin() ) {
			$newsletter_image = ot_get_option( 'newsletter_image' );
	 	?>
		<aside id="newsletter-popup" class="mfp-hide theme-popup newsletter-popup">
			<?php if ( $newsletter_image ) { ?>
				<figure class="newsletter-image"><?php echo wp_get_attachment_image( $newsletter_image, 'thevoux-vertical-2x' ); ?></figure>
			<?php } ?>
			<div class="newsletter-content">
				<div class="newsletter-form-container">
					<?php
						$newsletter_title = ot_get_option( 'newsletter_title' );
						$newsletter_text  = ot_get_option( 'newsletter_text' );
					?>
					<?php if ( $newsletter_title ) { ?>
						<h2><?php echo esc_html( $newsletter_title ); ?></h2>
					<?php } ?>
					<?php if ( $newsletter_text ) { ?>
						<?php echo wp_kses_post( wpautop( $newsletter_text ) ); ?>
					<?php } ?>
		            <?php echo do_shortcode('[mc4wp_form id="813"]'); ?>
					<?php do_action('thb_after_newsletter_form'); ?>
	      </div>
			</div>
		</aside>
		<?php
	}
}
add_action( 'wp_footer', 'thb_newsletter' );

add_action( 'wp_ajax_ajax_action', 'thb_newsletter' ); // ajax for logged in users
add_action( 'wp_ajax_nopriv_ajax_action', 'thb_newsletter' ); // ajax for not logged in users
