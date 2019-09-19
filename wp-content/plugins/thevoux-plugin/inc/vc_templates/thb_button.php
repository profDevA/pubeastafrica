<?php function thb_button( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_button', $atts );
  extract( $atts );

	$element_id = uniqid("thb-button-");

	$link = ( $link == '||' ) ? '' : $link;
	$link = vc_build_link( $link  );

	$link_to = $link['url'];
	$a_title = $link['title'];
	$a_target = $link['target'] ? $link['target'] : '_self';

	$classes[] = 'button';
	$classes[] = $size;
	$classes[] = $animation;
  $classes[] = $extra_class;
  $classes[] = $color;

	ob_start();
	?>
	<a id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $classes)); ?>" href="<?php echo esc_attr($link_to); ?>" target="<?php echo sanitize_text_field( $a_target ); ?>" role="button" title="<?php echo esc_attr( $a_title ); ?>"><?php echo esc_attr($a_title); ?></a>
	<?php
  $out = ob_get_clean();

  return $out;
}
thb_add_short('thb_button', 'thb_button');
