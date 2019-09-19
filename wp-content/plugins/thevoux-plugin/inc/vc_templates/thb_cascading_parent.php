<?php function thb_cascading_parent( $atts, $content = null ) {
	
	ob_start(); ?>
	<div class="thb_cascading_images">
		<?php echo wpb_js_remove_wpautop($content, false); ?>
	</div>
	<?php 
	$out = ob_get_clean();
	return $out;
}
thb_add_short('thb_cascading_parent', 'thb_cascading_parent');