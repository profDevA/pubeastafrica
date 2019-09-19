<?php function thb_instagram( $atts, $content = null ) {
   $atts = vc_map_get_attributes( 'thb_instagram', $atts );
   extract( $atts );

	switch($columns) {
		case 2:
			$col = 'small-6 medium-6';
			break;
		case 3:
			$col = 'small-12 medium-4';
			break;
		case 4:
			$col = 'small-6 medium-6 large-3';
			break;
		case 5:
			$col = 'small-12 thb-five';
			break;
		case 6:
			$col = 'small-6 medium-4 large-2';
			break;
  }
 	$out ='';
 	$nopadding = $column_padding ? 'no-padding ' : '';
 	$lowpadding = $low_padding ? 'low-padding ' : '';
	ob_start();
  if (!$username) {
		esc_html_e( 'Please check your Instagram username.', 'thevoux' );
	}
	$instagram = thb_getInstagramPhotos($number, $username, $access_token);

	$classes[] = 'row';
	$classes[] = $nopadding;
	$classes[] = $lowpadding;
	$classes[] = 'instagram-row';
	$classes[] = $style === 'style2' ? 'thb-freescroll' : false;
	?>
	<div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
    <?php if (array_key_exists('error', $instagram)) { echo esc_html($instagram['error']); } ?>

		<?php if (array_key_exists('data', $instagram)) { foreach ($instagram['data'] as $item) { ?>
      <div class="<?php echo esc_attr($col); ?> columns">
				<figure style="background-image:url(<?php echo esc_url($item['image_url']); ?>)">
				<?php if ($link == 'true') { ?>
					<a href="<?php echo esc_attr($item['link']); ?>" target="_blank" class="instagram-link"></a>
				<?php } ?>
				<span><?php get_template_part( 'assets/svg/like.svg'); ?><em><?php echo thb_numberAbbreviation($item['likes']); ?></em> <?php get_template_part( 'assets/svg/comment.svg'); ?><em><?php echo thb_numberAbbreviation($item['comments']); ?></em></span>
				</figure>
				<?php if ($style === 'style2') { ?>
				<figcaption><?php echo esc_attr($item['caption']); ?></figcaption>
				<?php } ?>
			</div>
		<?php } } ?>
	</div>
	<?php

	$out = ob_get_clean();

	return $out;
}
thb_add_short('thb_instagram', 'thb_instagram');