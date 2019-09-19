<?php get_header(); ?>
<?php
	if ( is_home() ) {
		do_action( 'thb_page_content', ot_get_option( 'blog_top_content' ) );
	}
?>
<div class="row">
	<section class="blog-section small-12 medium-8 columns">
		<div class="row">
			<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
				<div class="small-12 medium-6 columns">
				<?php get_template_part( 'inc/templates/loop/style6' ); ?>
				</div>
			<?php endwhile; else : ?>
			  	<?php get_template_part( 'inc/templates/loop/notfound' ); ?>
			<?php endif; ?>
		</div>
		<?php get_template_part( 'inc/templates/loop/post-nav' ); ?>
	</section>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
