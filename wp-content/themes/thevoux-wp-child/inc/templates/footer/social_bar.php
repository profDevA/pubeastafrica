<?php
 $footer_social_bar = ot_get_option( 'footer_social_bar', 'off');
 $footer_social_buttons = ot_get_option( 'footer_social_buttons', array());
 $length = count($footer_social_buttons);

 if ($footer_social_bar === 'on' && $length  > 0) {
?>
<aside class="social_bar">
	<ul class="row small-up-1 medium-up-2 large-up-<?php echo esc_attr($length); ?> align-center align-middle">
		<?php foreach ($footer_social_buttons as $social) {
		?>
			<li class="column"><a href="<?php echo esc_attr($social['href']); ?>"><i class="fa fa-<?php echo esc_attr($social['footer_social_network']); ?>"></i> <?php echo esc_attr($social['footer_social_network']); ?></a></li>
		<?php } ?>
	</ul>
</aside>

<?php } ?>
