<?php
/*
Template Name: Standard Page Layout
*/
?>
<?php get_header(); ?>
<div class="non-VC-page">
<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	<?php if ( post_password_required() ) { get_template_part( 'inc/templates/password-protected' ); } else { ?>
	<div <?php post_class('post'); ?> id="post-<?php the_ID(); ?>">
		<div class="post-content">
			<div class="row">
				<div class="small-12 columns">
					<header class="post-title">
						<h1 itemprop="headline"><?php the_title(); ?></h1>
					</header>
					<div class="post-content">
					<?php the_content('Read More'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
<?php endwhile; endif; ?>
</div>
<?php
get_footer();