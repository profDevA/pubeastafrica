<?php
	$VC = class_exists( 'WPBakeryVisualComposerAbstract' );
?>
<?php get_header(); ?>
<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
	<?php
	if ( post_password_required() ) {
		get_template_part( 'inc/templates/password-protected' );
	} elseif ( $VC && !thb_is_woocommerce() ) { ?>
		<div <?php post_class(); ?>>
			<?php the_content(); ?>
		</div>
	<?php } elseif ( thb_is_woocommerce() ) { ?>
		<?php get_template_part( 'inc/templates/header/archive-title' ); ?>
		<div <?php post_class( 'page-padding' ); ?>>
			<div class="row">
				<div class="small-12 columns">
					<div class="post-content no-vc">
						<?php the_content();?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if ( comments_open() || get_comments_number() ) : ?>
		<!-- Start #comments -->
		<?php comments_template( '', true ); ?>
		<!-- End #comments -->
	<?php endif; ?>
<?php endwhile; endif; ?>
<?php
get_footer();
