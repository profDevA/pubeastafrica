<?php get_header(); ?>
<?php $author_layout = ot_get_option( 'author_layout', 'style1' ); ?>
<?php get_template_part( 'inc/templates/archive/' . $author_layout ); ?>
<?php
get_footer();
