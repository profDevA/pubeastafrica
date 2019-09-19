		</div><!-- End role["main"] -->
	<?php do_action( 'thb_page_content', ot_get_option( 'footer_top_content' ) ); ?>
	<?php get_template_part( 'inc/templates/footer/social_bar' ); ?>
	<?php get_template_part( 'inc/templates/footer/' . ot_get_option( 'footer_style', 'style1' ) ); ?>
	<?php get_template_part( 'inc/templates/footer/subfooter-' . ot_get_option( 'subfooter_style', 'style1' ) ); ?>
	</div> <!-- End #content-container -->
</div> <!-- End #wrapper -->
<?php

	/*
	* Always have wp_footer() just before the closing </body>
	* tag of your theme, or you will break many plugins, which
	* generally use this hook to reference JavaScript files.
	*/
	wp_footer();
?>
</body>
</html>
