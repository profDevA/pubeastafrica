<?php
	$thb_id = get_the_ID();
	$logo = ot_get_option( 'logo', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo.png');
	$lightbox_post_title = ot_get_option( 'lightbox_post_title', 'on');
	$lightbox_image_title = ot_get_option( 'lightbox_image_title', 'on');
	$lightbox_image_caption = ot_get_option( 'lightbox_image_caption', 'on');
	$lightbox_image_source = ot_get_option( 'lightbox_image_source', 'on');
	$lightbox_color = isset($_GET['lightbox_color']) ? $_GET['lightbox_color'] : ot_get_option( 'lightbox_color', 'lightbox-light');
	$lightbox_style = isset($_GET['lightbox_style']) ? $_GET['lightbox_style'] : ot_get_option( 'lightbox_style', 'lightbox-style1');
	$post_gallery_photos = get_post_meta($thb_id, 'post-gallery-photos', true);

	$adv_gallery_header = ot_get_option( 'adv_gallery_header');
  if ($post_gallery_photos) {
		$post_gallery_photos_arr = explode(',', $post_gallery_photos);
		$count = count( $post_gallery_photos_arr );
  }
	if ( $lightbox_color === 'lightbox-dark' ) {
		$logo = ot_get_option( 'logo_light', Thb_Theme_Admin::$thb_theme_directory_uri . 'assets/img/logo_light.png' );
	}
	$i = 1;

	$classes[] = 'post-gallery-content';
	$classes[] = $lightbox_style;
	$classes[] = $lightbox_color;
?>
<div id="post-gallery-<?php echo esc_attr( $thb_id ); ?>" class="mfp-hide">

	<?php if ( $post_gallery_photos ) { foreach ( $post_gallery_photos_arr as $photo_id ) { ?>
		<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
			<div class="lightbox-header">
				<div class="row full-width-row">
					<?php if ($lightbox_style == 'lightbox-style1') { ?>
						<div class="small-6 medium-2 columns">
							<a href="<?php echo esc_url(home_url('/')); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
								<img src="<?php echo esc_url($logo); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
							</a>
						</div>
						<div class="small-6 medium-8 columns show-for-medium center-column">
							<?php do_action('thb_adv_gallery_header', $i - 1); ?>
						</div>
						<div class="small-6 medium-2 columns close-column">
							<button title="<?php esc_attr_e('Close (Esc)', 'thevoux' ); ?>" class="lightbox-header-button lightbox-grid"><?php get_template_part( 'assets/svg/grid.svg'); ?></button>
							<button title="<?php esc_attr_e('Close (Esc)', 'thevoux' ); ?>" class="lightbox-header-button lightbox-close"><?php get_template_part( 'assets/svg/arrows_remove.svg'); ?></button>
						</div>
					<?php } else { ?>
						<div class="small-6 medium-8 columns">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logolink" title="<?php bloginfo('name'); ?>">
								<img src="<?php echo esc_url( $logo ); ?>" class="logoimg" alt="<?php bloginfo('name'); ?>"/>
							</a>
							<?php if ( $lightbox_post_title === 'on' ) { ?>
								<h5><?php the_title(); ?></h5>
							<?php } ?>
						</div>
						<div class="small-6 medium-4 columns close-column">
						<?php if ($lightbox_style === 'lightbox-style2') { ?>
							<aside class="meta">
								<?php echo esc_attr($i) . '<em>/</em>'. esc_attr( $count ); ?>
							</aside>
						<?php } ?>
							<button title="<?php esc_attr_e('Close (Esc)', 'thevoux' ); ?>" class="lightbox-header-button lightbox-grid"><?php get_template_part( 'assets/svg/grid.svg'); ?></button>
							<button title="<?php esc_attr_e('Close (Esc)', 'thevoux' ); ?>" class="lightbox-header-button lightbox-close"><?php get_template_part( 'assets/svg/arrows_remove.svg'); ?></button>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="row full-width-row no-padding thb-content-row">
				<div class="small-12 medium-7 large-9 columns image">
					<?php echo wp_get_attachment_image( $photo_id, 'full' ); ?>

					<?php if ($i == 1) { ?>
						<div class="thb-gallery-grid">
							<div class="row">
							<?php $j = 1; foreach ($post_gallery_photos_arr as $photo) { ?>
								<div class="small-4 medium-3 columns"><div class="thb-grid-image"><span class="thb-grid-count"><?php echo esc_attr($j); ?></span><?php echo wp_get_attachment_image( $photo, 'thevoux-thumbnail-3x' ); ?></div></div>
							<?php $j++; } ?>
							</div>
						</div>
					<?php } ?>
					<a href="#" class="thb-gallery-arrow prev"><?php get_template_part( 'assets/svg/arrow_prev.svg'); ?></a>
					<a href="#" class="thb-gallery-arrow next"><?php get_template_part( 'assets/svg/arrow_next.svg'); ?></a>
				</div>
				<div class="small-12 medium-5 large-3 columns image-text">
					<div class="lightbox-text-content">
						<?php if ($lightbox_style === 'lightbox-style1') { ?>
							<aside class="meta">
								<span><?php echo '<em>' . esc_attr( $i ) . '</em> ' . esc_html__( 'of', 'thevoux' ) . ' ' . esc_attr( $count ); ?></span>
							</aside>
						<?php } ?>
						<?php $the_image = get_post($photo_id); ?>
						<?php if ( $lightbox_post_title == 'on' && $lightbox_style == 'lightbox-style1') { ?>
							<h5><?php the_title(); ?></h5>
						<?php } ?>
						<?php if ( isset( $the_image->post_title ) && $lightbox_image_title === 'on') { ?>
							<h6><?php echo esc_html($the_image->post_title); ?></h6>
						<?php } ?>
						<?php if ( isset( $the_image->post_excerpt ) && $lightbox_image_caption === 'on') { ?>
							<p><?php echo wp_kses_post($the_image->post_excerpt); ?></p>
						<?php } ?>
						<?php if ( isset( $the_image->post_content ) && $lightbox_image_source === 'on') { ?>
							<small><?php esc_html_e('Source:', 'thevoux' ); ?> <?php echo esc_html($the_image->post_content); ?></small>
						<?php } ?>
					</div>
					<?php do_action('thb_adv_lightbox_sidebar', $i - 1); ?>
				</div>
			</div>
		</div>
	<?php $i++; } }?>
</div>
