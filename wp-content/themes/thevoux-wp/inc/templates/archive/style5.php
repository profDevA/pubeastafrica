<div class="row archive-page-container">
	<div class="small-12 columns">
		<?php if (is_author()) { ?>
			<section id="authorpage" class="authorpage">
				<?php $author = get_user_by( 'slug', get_query_var( 'author_name' ) ); do_action('thb_author',$author->ID); ?>
			</section>
		<?php } ?>
		<div class="row posts masonry">
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<?php set_query_var( 'thb_columns', 'medium-4' ); get_template_part( 'inc/templates/loop/masonry/masonry-style1' ); ?>
			<?php endwhile; else : ?>
				<?php get_template_part( 'inc/templates/loop/notfound' ); ?>
			<?php endif; ?>

		</div>
		<?php get_template_part( 'inc/templates/loop/post-nav' ); ?>
	</div>
</div>