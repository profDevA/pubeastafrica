<?php function thb_subscribe( $atts, $content = null ) {
	$style = 'style1';
  $atts = vc_map_get_attributes( 'thb_subscribe', $atts );
  extract( $atts );
 	ob_start();

 	$content_old = $content;
 	$content = vc_value_from_safe( $content );

 	?>
 	<div class="thb_subscribe <?php echo esc_attr($style); ?>">
 		<?php if ($style === 'style1') { ?>
		 	<?php if ($title) { ?><h3><?php echo esc_html($title); ?></h3><?php } ?>
		 	<?php if ($content_old ) { ?><?php echo wp_kses_post($content); ?><?php } ?>
			<form class="newsletter-form" action="#" method="post" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_subscription' ) ); ?>">
				<input placeholder="<?php esc_attr_e("Your E-Mail",'thevoux' ); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
				<button type="submit" name="submit" class="btn large <?php echo esc_attr( $btn_color ); ?>"><?php esc_html_e("SIGN UP",'thevoux' ); ?></button>
				<?php do_action('thb_after_newsletter_submit'); ?>
			</form>
			<?php do_action('thb_after_newsletter_form'); ?>
		<?php } elseif ($style === 'style2') { ?>
			<div class="row align-middle">
				<?php if ($title || $content_old ) { ?>
				<div class="small-12 medium-6 columns">
					<?php if ($title) { ?><h3><?php echo esc_html($title); ?></h3><?php } ?>
					<?php if ($content) { ?><?php echo wp_kses_post($content); ?><?php } ?>
				</div>
				<?php } ?>
				<div class="small-12<?php if ($title || $content_old  ) { ?> medium-6 medium-text-right<?php }?> columns">
					<form class="newsletter-form" action="#" method="post" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_subscription' ) ); ?>">
						<input placeholder="<?php esc_attr_e("Your E-Mail",'thevoux' ); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
						<button type="submit" name="submit" class="btn <?php echo esc_attr( $btn_color ); ?>"><?php esc_html_e("SIGN UP",'thevoux' ); ?></button>
						<?php do_action('thb_after_newsletter_submit'); ?>
					</form>
					<?php do_action('thb_after_newsletter_form'); ?>
				</div>
			</div>
		<?php } elseif ($style === 'style3') { ?>
			<?php if ($title || $content_old ) { ?>
				<div class="subscribe_content">
					<?php if ($title) { ?><h3><?php echo esc_html($title); ?></h3><?php } ?>
					<?php if ($content) { ?><?php echo wp_kses_post($content); ?><?php } ?>
				</div>
			<?php } ?>
			<div>
				<form class="newsletter-form" action="#" method="post" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_subscription' ) ); ?>">
					<input placeholder="<?php esc_attr_e("Your E-Mail",'thevoux' ); ?>" type="text" name="widget_subscribe" class="widget_subscribe">
					<button type="submit" name="submit" class="btn <?php echo esc_attr( $btn_color ); ?>"><?php esc_html_e("SIGN UP",'thevoux' ); ?></button>
					<?php do_action('thb_after_newsletter_submit'); ?>
				</form>
				<?php do_action('thb_after_newsletter_form'); ?>
			</div>
		<?php } ?>
	</div>
	<?php
   $out = ob_get_clean();
  return $out;
}
thb_add_short('thb_subscribe', 'thb_subscribe');
