<?php
	$thb_id = get_the_ID();
	$fixed  = 'on' === ot_get_option( 'article_fixed_sidebar', 'on' ) ? 'fixed-me' : '';
	$style  = get_post_meta( $thb_id, 'post-style', true ) ? get_post_meta( $thb_id, 'post-style', true ) : 'style1';
?>
<aside class="sidebar small-12 medium-4 columns">
	<div class="sidebar_inner <?php echo esc_attr( $fixed . ' ' . $style ); ?>">
		<?php dynamic_sidebar( 'single-ajax' ); ?>
	</div>
</aside>