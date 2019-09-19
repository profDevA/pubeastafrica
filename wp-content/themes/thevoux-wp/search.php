<?php get_header(); ?>
<?php get_template_part( 'inc/templates/header/archive-title' ); ?>
<?php $search_layout = ot_get_option( 'search_layout', 'style1'); ?>
<?php get_template_part( 'inc/templates/archive/'.$search_layout); ?>
<?php get_footer();