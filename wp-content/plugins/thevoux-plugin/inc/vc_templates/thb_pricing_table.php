<?php function thb_pricing_table( $atts, $content = null ) {
	global $thb_pricing_columns;
	$atts = vc_map_get_attributes( 'thb_pricing_table', $atts );
	extract( $atts );
	
	$element_id = uniqid('thb-pricing-table-');
	$el_class[] = 'thb-pricing-table';
	$out ='';
	ob_start();
	
	
	?>
	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $el_class)); ?>">
		<div class="row">
			<?php echo wpb_js_remove_wpautop($content, false); ?>
		</div>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}
thb_add_short('thb_pricing_table', 'thb_pricing_table');