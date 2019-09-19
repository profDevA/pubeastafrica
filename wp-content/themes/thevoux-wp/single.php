<?php get_header(); ?>
<?php
	$thb_id   = $wp_query->get_queried_object_id();
	$style    = ot_get_option( 'article_style', 'style1' );
	$infinite = ot_get_option( 'infinite_load', 'on' );

	if ( 'on' === get_post_meta( $thb_id, 'article_style_override', true ) ) {
		$style = get_post_meta( $thb_id, 'post-style', true );
	}
?>
<div id="infinite-article" data-infinite="<?php echo esc_attr( $infinite ); ?>" data-security="<?php echo esc_attr( wp_create_nonce( 'thb_infinite_ajax' ) ); ?>">
	<?php do_action( 'thb_page_content', ot_get_option( 'article_top_content' ) ); ?>
	<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
		<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
		<?php get_template_part( 'inc/templates/single/' . $style ); ?>
		<?php } ?>
	<?php endwhile; endif; ?>
</div>
<?php
get_footer();
