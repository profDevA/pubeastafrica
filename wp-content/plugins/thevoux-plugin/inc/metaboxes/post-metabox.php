<?php
add_filter('thb_post_metabox_fields', function($array) {
  $new_metaboxes = array(
    array(
      'id'          => 'tab0',
      'label'       => esc_html__('General', 'thevoux'),
      'type'        => 'tab'
    ),
    array(
      'label'       => esc_html__('Featured Image Credit', 'thevoux'),
      'id'          => 'standard-featured-credit',
      'type'        => 'text',
      'desc'        => esc_html__('Featured Image Credit, enter the copyright information for your featured image if needed.', 'thevoux'),
      'std'         => ''
    ),
    array(
      'label'       => esc_html__('Via Source', 'thevoux'),
      'id'          => 'post_via',
      'type'        => 'list-item',
      'desc'        => esc_html__('You can add via sources for your articles here', 'thevoux'),
      'settings'    => array(
        array(
          'label'       => esc_html__('Via Source URL', 'thevoux'),
          'id'          => 'post_source_url',
          'desc'        => esc_html__('Enter a URL for your via source here', 'thevoux'),
          'type'        => 'text',
        )
      )
    ),
    array(
      'label'       => esc_html__('Source', 'thevoux'),
      'id'          => 'post_source',
      'type'        => 'list-item',
      'desc'        => esc_html__('You can add sources for your articles here', 'thevoux'),
      'settings'    => array(
        array(
          'label'       => esc_html__('Source URL', 'thevoux'),
          'id'          => 'post_source_url',
          'desc'        => esc_html__('Enter a URL for your source here', 'thevoux'),
          'type'        => 'text',
        )
      )
    )
  );
  return array_merge($new_metaboxes, $array);
});
$post_metabox_gallery = array(
  'id'          => 'post_meta_gallery',
  'title'       => esc_html__('Post Gallery', 'thevoux'),
  'pages'       => array( 'post' ),
  'context'     => 'side',
  'priority'    => 'high',
  'fields'      => array(
    array(
      'label'       => esc_html__('Post Gallery', 'thevoux'),
      'id'          => 'post-gallery-photos',
      'type'        => 'gallery',
      'desc'        => esc_html__('The image captions will be used as image information on the right side.', 'thevoux')
    )
  )
);
ot_register_meta_box( $post_metabox_gallery );