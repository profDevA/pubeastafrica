<?php
/* Display Post Grid Layouts */
function thb_DisplayPostGrid( $style, $columns, $disable_excerpts, $disable_postmeta, $featured_index, $i, $post_count = 0 ) {
  $featured_index = empty( $featured_index ) ? array() : explode(',', $featured_index );
  $col = thb_translate_columns( $columns );
  ?>
  <?php if ($style === 'style1') { ?>
    <div class="small-12 <?php echo esc_attr($col); ?> columns">
      <?php
        set_query_var( 'disable_excerpts', $disable_excerpts );
        set_query_var( 'disable_postmeta', $disable_postmeta );
        get_template_part( 'inc/templates/loop/style6' );
      ?>
    </div>
  <?php } elseif ($style === 'style4') { // Style 1 - Version 2 ?>
    <div class="small-12 <?php echo esc_attr($col); ?> columns">
      <?php
        get_template_part( 'inc/templates/loop/style7' );
      ?>
    </div>
  <?php } elseif ($style === 'style11') { // Style 1 - Version 3 ?>
    <div class="small-12 <?php echo esc_attr($col); ?> columns">
      <?php
        get_template_part( 'inc/templates/loop/style14' );
      ?>
    </div>
  <?php } elseif ($style === 'style2') { ?>
    <?php if (in_array($i, $featured_index )) { ?>
      <?php get_template_part( 'inc/templates/loop/style7' ); ?>
    <?php } else { ?>
      <?php get_template_part( 'inc/templates/loop/style1' ); ?>
    <?php } ?>
  <?php } elseif ($style === 'style2-alt') { ?>
    <?php if (in_array($i, $featured_index )) { ?>
      <?php
        set_query_var( 'thb_offset_style', 'offset-title' );
        get_template_part( 'inc/templates/loop/style7' );
        set_query_var( 'thb_offset_style', false );
      ?>
    <?php } else { ?>
      <?php get_template_part( 'inc/templates/loop/style1' ); ?>
    <?php } ?>
  <?php } elseif ($style === 'style2-bg') { ?>
    <?php if (in_array($i, $featured_index )) { ?>
      <?php
        set_query_var( 'thb_offset_style', false );
        get_template_part( 'inc/templates/loop/style7' );
      ?>
    <?php } else { ?>
      <?php
        set_query_var( 'thb_sharestyle', 'post-links-style2' );
        set_query_var( 'thb_noexcerpt', true );
        set_query_var( 'thb_author', true );
        set_query_var( 'thb_class', 'style1-bg' );
        set_query_var( 'thb_image_size', 'thevoux-style2' );
        get_template_part( 'inc/templates/loop/style1' );
      ?>
    <?php } ?>
  <?php } elseif ($style === 'style3') { ?>
    <div class="small-12 large-6 columns <?php if ($i % 2 == 0) { ?>even<?php } ?>">
      <?php get_template_part( 'inc/templates/loop/style2' ); ?>
    </div>
  <?php } elseif ($style === 'style5') { ?>
    <?php get_template_part( 'inc/templates/loop/style9' ); ?>
  <?php } elseif ($style === 'style6') { ?>
    <?php
      set_query_var( 'thb_image_size', 'thevoux-style1-2x' );
      get_template_part( 'inc/templates/loop/style7' );
    ?>
  <?php } elseif ($style === 'style7') { ?>
    <?php
      set_query_var( 'thb_image_size', 'thevoux-style1-2x' );
      get_template_part( 'inc/templates/loop/style12' );
    ?>
  <?php } elseif ($style === 'style8') { ?>
    <div class="small-12 <?php echo esc_attr($col); ?> columns">
      <?php get_template_part( 'inc/templates/loop/style8' ); ?>
    </div>
  <?php } elseif ($style === 'style9') { ?>
    <?php set_query_var( 'thb_i', $i ); ?>
    <?php get_template_part( 'inc/templates/loop/style13' ); ?>
  <?php } elseif ($style === 'style10') { ?>
    <div class="small-12 <?php echo esc_attr($col); ?> columns">
      <?php get_template_part( 'inc/templates/loop/post-carousel/style11' ); ?>
    </div>
  <?php } elseif ($style === 'style12') { ?>
    <?php set_query_var( 'thb_i', $i ); ?>
    <?php get_template_part( 'inc/templates/loop/style15' ); ?>
  <?php } ?>
  <?php if ($style === 'style13') { ?>
    <?php if ($i === 1) { ?>
      <div class="small-12 columns large-style16">
        <?php set_query_var( 'thb_title_size', 'h2' ); ?>
        <?php set_query_var( 'thb_image_size', 'thevoux-style9-3x'); ?>
        <?php set_query_var( 'thb_excerpt_length', 'thb_short_excerpt_length'); ?>
        <?php get_template_part( 'inc/templates/loop/style16' ); ?>
      </div>
    <?php } else { ?>
      <div class="small-12 <?php echo esc_attr($col); ?> columns">
        <?php set_query_var( 'thb_title_size', 'h3' ); ?>
        <?php set_query_var( 'thb_image_size', 'thevoux-style3'); ?>
        <?php set_query_var( 'thb_excerpt_length', 'thb_supershort_excerpt_length'); ?>
        <?php get_template_part( 'inc/templates/loop/style16' ); ?>
      </div>
    <?php } ?>
  <?php } ?>
  <?php
}