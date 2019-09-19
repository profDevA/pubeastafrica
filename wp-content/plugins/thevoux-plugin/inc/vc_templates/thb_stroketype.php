<?php function thb_stroketype( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_stroketype', $atts );
  extract( $atts );
  
	$out = $text = '';
	$element_id = uniqid('thb-stroketype-');
	$stroke_text_safe = vc_value_from_safe($slide_text);
	
	$stroke_text_safe = thb_remove_vc_added_p($stroke_text_safe);
	
	$class[] = 'thb-stroketype';
	$class[] = $extra_class;
	$class[] = $animation;
	ob_start();
	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $class)); ?>">
		<?php echo wp_kses_post($stroke_text_safe); ?>
		
		<style>
			<?php if ($thb_color) { ?>
			#<?php echo esc_attr($element_id); ?> * {
				color: <?php echo esc_attr($thb_color); ?>;
				-webkit-text-stroke-color: <?php echo esc_attr($thb_color); ?>;
		    -moz-text-stroke-color: <?php echo esc_attr($thb_color); ?>;
		    -o-text-stroke-color: <?php echo esc_attr($thb_color); ?>;
		    -ms-text-stroke-color: <?php echo esc_attr($thb_color); ?>;
		    text-stroke-color: <?php echo esc_attr($thb_color); ?>;
			}
			<?php } ?>
			<?php if ($stroke_width) { ?>
			#<?php echo esc_attr($element_id); ?> * {
				-webkit-text-stroke-width: <?php echo esc_attr($stroke_width); ?>;
		    -moz-text-stroke-width: <?php echo esc_attr($stroke_width); ?>;
		    -o-text-stroke-width: <?php echo esc_attr($stroke_width); ?>;
		    -ms-text-stroke-width: <?php echo esc_attr($stroke_width); ?>;
		    text-stroke-width: <?php echo esc_attr($stroke_width); ?>;
			}
			<?php } ?>
		</style>
	</div>
  
  <?php
  $out = ob_get_clean();
     
  return $out;
}
thb_add_short('thb_stroketype', 'thb_stroketype');