<?php get_header(); ?>
<section class="content404">
	<div class="row">
		<div class="small-12 medium-5 columns text-left">
			<h1><?php echo wp_kses_post( 'USE THE <span>SUN’S</span><br>POWER', 'thevoux' ); ?></h1>
			<p><?php esc_html_e( 'We are sorry. But the page you are looking for cannot be found. You might try searching our site.', 'thevoux' ); ?></p>
			<?php get_search_form(); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn"><?php esc_html_e( 'Back To Home', 'thevoux' ); ?></a>
		</div>
	</div>
</section>
<?php
get_footer();
