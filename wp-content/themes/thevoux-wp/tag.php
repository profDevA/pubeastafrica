<?php get_header(); ?>
<?php get_template_part( 'inc/templates/header/archive-title' ); ?>
<?php $tag_layout = ot_get_option( 'tag_layout', 'style1' ); ?>
<?php get_template_part( 'inc/templates/archive/' . $tag_layout ); ?>
<?php
get_footer();
