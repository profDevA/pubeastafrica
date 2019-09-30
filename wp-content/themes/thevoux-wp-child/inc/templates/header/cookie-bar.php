<?php if ( 'on' === ot_get_option( 'thb_cookie_bar', 'on' ) ) { ?>
<aside class="thb-cookie-bar">
	<div class="thb-cookie-text">
  	<?php echo do_shortcode( ot_get_option( 'thb_cookie_bar_content', '<p>Our site uses cookies. Learn more about our use of cookies: <a href="#">Cookie Policy</a></p>' ) ); ?>
	</div>
	<a class="button transparent-white mini"><?php esc_html_e( 'ACCEPT', 'thevoux' ); ?></a>
</aside>
<?php }
