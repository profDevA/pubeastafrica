<?php function thb_postcarousel( $atts, $content = null ) {
	$autoplay = true;
  $atts = vc_map_get_attributes( 'thb_postcarousel', $atts );
  extract( $atts );

	ob_start();
	switch($style) {
		case 'style1':
			$style_class = 'featured-style4';
			break;
		case 'style2':
			$style_class = 'featured-style5';
			break;
		case 'style3':
			$style_class = 'featured-style6';
			break;
		case 'style4':
			$style_class = $style;
			break;
		case 'style5':
			$style_class = 'featured-style-carousel';
			break;
		case 'style8':
			$style_class = 'c-style13';
			break;
	}
	$pagi = ($pagination == 'true' ? 'true' : 'false');
	$nav = ($navigation == 'true' ? 'true' : 'false');

	if ($style === 'style5') {
		$pagi = 'false';
		$nav = 'true';
	}
	$source .= '|offset:'.$offset;
	$source_data = VcLoopSettings::parseData( $source );
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$posts = $query_builder->build();
	$posts = $posts[1];

	$classes[] = 'slick';
	$classes[] = $pagi === 'true' ? 'dark-pagination bottom-margin' : false;
	$classes[] = ($style == 'style3' && $nav == 'true') ? 'outset-nav' : false;
	$classes[] = ($style == 'style5') ? 'outset-nav' : false;
	$classes[] = $style == 'style3' ? 'mini-columns' : false;
	$classes[] = $style == 'style8' ? 'flex' : false;
	$classes[] = in_array($style, array('style2', 'style4', 'style6', 'style9', 'style11')) ? 'row' : false;
	$classes[] = 'post-carousel post-carousel-'.$style;
	$classes[] = in_array($style, array('style2', 'style3', 'style4', 'style6', 'style8', 'style9')) ? 'center-arrows' : false;
	$classes[] = $style == 'style11' ? 'overflow-visible' : false;

	if ( $posts->have_posts() ) { ?>
		<?php if ($add_title === 'true') { ?>
			<div class="category_title <?php echo esc_attr($title_style); ?>">
				<h2><?php echo esc_html( $title ); ?></h2>
			</div>
		<?php } ?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-center="<?php echo esc_attr($center); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-pagination="<?php echo esc_attr($pagi); ?>" data-navigation="<?php echo esc_attr($nav); ?>" data-autoplay="<?php echo esc_attr($autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>">
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<?php if ($style == 'style1') { ?>
					<div>
						<?php
							add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
							set_query_var( 'thb_style', 'featured-style4' );
							set_query_var( 'thb_image_size', 'thevoux-single-2x' );
							get_template_part( 'inc/templates/loop/post-carousel/style1');
						?>
					</div>
				<?php } elseif ($style == 'style2') { ?>
					<div class="columns">
						<?php
							get_template_part( 'inc/templates/loop/post-carousel/style2');
						?>
					</div>
				<?php } elseif ($style == 'style3') { ?>
					<div class="columns">
						<?php
							get_template_part( 'inc/templates/loop/post-carousel/style3');
						?>
					</div>
				<?php } elseif ($style == 'style4') { ?>
					<div class="columns">
						<?php
							get_template_part( 'inc/templates/loop/post-carousel/style4');
						?>
					</div>
				<?php } elseif ($style == 'style5') { ?>
					<?php
						get_template_part( 'inc/templates/loop/post-carousel/style5');
					?>
				<?php } elseif ($style == 'style6') { ?>
					<div class="columns">
						<?php
							get_template_part( 'inc/templates/loop/post-carousel/style6');
						?>
					</div>
				<?php } elseif ($style == 'style7') { ?>
					<div>
						<?php
							add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
							set_query_var( 'thb_style', 'category-widget-slider' );
							set_query_var( 'thb_image_size', 'thevoux-vertical-2x' );
							get_template_part( 'inc/templates/loop/post-carousel/style1');
						?>
					</div>
				<?php } elseif ($style == 'style8') { ?>
					<div>
						<?php
							add_filter( 'excerpt_length', 'thb_supershort_excerpt_length' );
							set_query_var( 'thb_style', 'carousel-style8' );
							set_query_var( 'thb_image_size', 'thevoux-single-2x' );
							get_template_part( 'inc/templates/loop/post-carousel/style8');
						?>
					</div>
				<?php } elseif ($style == 'style9') { ?>
					<div class="columns">
						<?php
							get_template_part( 'inc/templates/loop/post-carousel/style6');
						?>
					</div>
				<?php } elseif ($style == 'style10') { ?>
					<div class="columns">
						<?php
							get_template_part( 'inc/templates/loop/post-carousel/style10');
						?>
					</div>
				<?php } elseif ($style == 'style11') { ?>
					<div class="columns">
						<?php
							get_template_part( 'inc/templates/loop/post-carousel/style11');
						?>
					</div>
				<?php } ?>
			<?php endwhile; ?>
		</div>
	<?php }
	set_query_var( 'thb_style', false );
	$out = ob_get_clean();

	wp_reset_query();
	wp_reset_postdata();
	return $out;
}
thb_add_short('thb_postcarousel', 'thb_postcarousel');