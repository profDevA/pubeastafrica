<?php function thb_pricing_column( $atts, $content = null ) {
	global $thb_pricing_columns;
	$atts = vc_map_get_attributes( 'thb_pricing_column', $atts );
	extract( $atts );
	

	$image_full = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => 'full', 'class' => $retina ) );
	
	$content = vc_value_from_safe( $content );

	$el_class[] = 'thb-pricing-column';
	$el_class[] = 'small-12';
	$el_class[] = $thb_pricing_columns;
	$el_class[] = 'columns';
	$el_class[] = 'highlight-'.$highlight;
	$out ='';
	ob_start();
	
	/* Button */
	$link = ( $link == '||' ) ? '' : $link;
	$link_btn = vc_build_link( $link  );
	
	$link_to = $link_btn['url'];
	$a_title = $link_btn['title'];
	$a_target = $link_btn['target'] ? $link_btn['target'] : '_self';	
	
	/* Image */
	$image = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => 'full' ) );
	?>
	<div class="<?php echo esc_attr(implode(' ', $el_class)); ?>">
		<div class="pricing-container <?php if ($link) { ?>has-button<?php } ?>">
			<?php if ($image) { echo $image_full['thumbnail']; } ?>
			<div class="thb_pricing_head">
				<?php if ($title) { ?>
					<h4><?php echo esc_html($title); ?></h4>
				<?php } ?>
				<?php if ($price) { ?>
					<h3><?php echo esc_html($price); ?></h3>
				<?php } ?>
				<?php if ($sub_title) { ?>
					<p class="pricing_sub_title"><?php echo esc_html($sub_title); ?></p>
				<?php } ?>
			</div>
			<?php if ($content && $content !== '') { ?>
			<div class="pricing-description">
				<?php if ($content) { echo do_shortcode($content); } ?>
			</div>
			<?php } ?>
		</div>
		<?php if ($link) { ?>
		<a class="btn" href="<?php echo esc_attr($link_to); ?>" target="<?php echo sanitize_text_field( $a_target ); ?>" role="button" title="<?php echo esc_attr( $a_title ); ?>"><?php echo esc_attr($a_title); ?></a>
		<?php } ?>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}
thb_add_short('thb_pricing_column', 'thb_pricing_column');