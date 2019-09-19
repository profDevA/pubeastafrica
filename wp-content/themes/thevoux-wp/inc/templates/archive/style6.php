<div class="row archive-page-container">
	<div class="small-12 medium-8 columns">
		<?php if (is_author()) { ?>
			<section id="authorpage" class="authorpage">
				<?php $author = get_user_by( 'slug', get_query_var( 'author_name' ) ); do_action('thb_author',$author->ID); ?>
			</section>
		<?php } ?>
		<?php $i = 1; if (have_posts()) :  while (have_posts()) : the_post(); ?>
			<?php if ($i == 3) { ?>
				<?php get_template_part( 'inc/templates/loop/style7' ); ?>
			<?php } else { ?>
				<?php get_template_part( 'inc/templates/loop/style1' ); ?>
			<?php } ?>
		<?php $i ++; endwhile; else : ?>
			<?php get_template_part( 'inc/templates/loop/notfound' ); ?>
		<?php endif; ?>
	</div>
	<?php do_action('thb_archive_sidebar'); ?>
</div>