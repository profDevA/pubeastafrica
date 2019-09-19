<?php get_header(); ?>
<?php get_template_part( 'inc/templates/header/category-title' ); ?>
<?php
  $global_layout   = ot_get_option( 'category_layout', 'style1');
  $the_category    = get_queried_object_id();
  $category_layout = get_term_meta( $the_category, 'thb_cat_layout', true );

  if ( ! empty( $category_layout ) ) {
    $global_layout = $category_layout;
  }
?>
<?php get_template_part( 'inc/templates/archive/' . $global_layout ); ?>
<?php
get_footer();
