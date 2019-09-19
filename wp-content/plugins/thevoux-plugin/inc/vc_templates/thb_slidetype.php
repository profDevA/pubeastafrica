<?php function thb_slidetype( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_slidetype', $atts );
  extract( $atts );
  
	$out = $text = '';
	$element_id = uniqid('thb-slidetype-');
	$slide_text_safe = vc_value_from_safe($slide_text);
	
	$slide_text_safe = thb_remove_vc_added_p($slide_text_safe);
	
	$class[] = 'thb-slidetype';
	$class[] = $extra_class;
	ob_start();
	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $class)); ?>" data-style="<?php echo esc_attr($style); ?>">
		<?php 
			if( preg_match_all("/(\*.*?\*)/is", $slide_text_safe, $entries) ) {
				foreach($entries[0] as $entry) {
				  $text = substr($entry, 1, -1); // Remove Asteriks
				  $slidetype = explode(';', $text);
				  $slidetype = array_map('trim', $slidetype); // Trim Whitespace
				  $slide_text_safe = str_replace($entry, '<placeholder>', $slide_text_safe);
					$slide_text_toadd = '';
				  foreach ($slidetype as $type) {
				  	$slide_text_toadd .= '<span class="thb-slidetype-entry"><span class="lines">'.$type.'</span></span>';
				  }
				}
				
			}
			echo str_replace('<placeholder>', $slide_text_toadd, $slide_text_safe);
		?>
		<?php if($thb_animated_color) { ?>
		<style>
			#<?php echo esc_attr($element_id); ?> .thb-slidetype-entry {
				color: <?php echo esc_attr($thb_animated_color); ?>;
			}
		</style>
		<?php } ?>
	</div>
  
  <?php
  $out = ob_get_clean();
     
  return $out;
}
thb_add_short('thb_slidetype', 'thb_slidetype');