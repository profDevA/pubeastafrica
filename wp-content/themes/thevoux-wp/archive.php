<?php get_header(); ?>
<?php get_template_part( 'inc/templates/header/archive-title' ); ?>
<?php $archive_layout = ot_get_option( 'archive_layout', 'style1' ); ?>
<?php get_template_part( 'inc/templates/archive/' . $archive_layout ); ?>
<?php
get_footer();
