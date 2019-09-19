<?php
	$subfooter_color = ot_get_option( 'subfooter_color', 'light');
	$subfooter_content = (isset($_GET['subfooter_content']) ? htmlspecialchars($_GET['subfooter_content']) : ot_get_option( 'subfooter_content', 'footer-text'));

	$classes[] = $subfooter_color;
	$classes[] = 'style1';
?>
<?php if (ot_get_option( 'subfooter') != 'off') { ?>
<!-- Start Sub-Footer -->
<aside id="subfooter" class="<?php echo esc_attr(implode(' ', $classes)); ?>">
	<div class="row">
		<div class="small-12 columns">
			<?php if ($subfooter_content == 'footer-icons') {  ?>
				<?php do_action( 'thb_social' ); ?>
			<?php } elseif ($subfooter_content == 'footer-text') { ?>
				<p><?php echo do_shortcode(ot_get_option( 'subfooter_text')); ?></p>
			<?php } elseif ($subfooter_content == 'footer-menu') { ?>
				<?php wp_nav_menu( array( 'menu' => ot_get_option( 'subfooter_menu'), 'depth' => 1, 'container' => false  ) ); ?>
			<?php } ?>
		</div>
	</div>
</aside>
<!-- End Sub-Footer -->
<?php } ?>