<?php
/**
 * Initialize the meta boxes.
 */
add_action( 'admin_init', 'thb_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */


function thb_custom_meta_boxes() {

  /**
   * Create a custom meta boxes array that we pass to
   * the OptionTree Meta Box API Class.
   */
  $page_metabox = array(
    'id'          => 'page_meta_style',
    'title'       => esc_html__('Page Settings', 'thevoux'),
    'pages'       => array( 'page' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    	array(
    	  'id'          => 'tab0',
    	  'label'       => esc_html__('Header', 'thevoux'),
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => esc_html__('Transparent Header', 'thevoux'),
    	  'id'          => 'header_transparent',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('This will make the header transparent on this page only, and the content will come below it', 'thevoux'),
    	  'std'         => 'off'
    	),
      array(
        'label'       => esc_html__('Transparent Header Color', 'thevoux'),
        'id'          => 'header_transparent_color',
        'type'        => 'radio-image',
        'std'		      => 'light-transparent-header',
        'desc'        => esc_html__('This changes the color of the header', 'thevoux'),
        'condition'   => 'header_transparent:is(on)'
      ),
    )
  );
  $post_metabox = array(
    'id'          => 'post_meta_style',
    'title'       => esc_html__('Post Settings', 'thevoux'),
    'pages'       => array( 'post' ),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => apply_filters( 'thb_post_metabox_fields', array(
    	array(
    	  'id'          => 'tab1',
    	  'label'       => esc_html__('Article Layout', 'thevoux'),
    	  'type'        => 'tab'
    	),
    	array(
    	  'label'       => esc_html__('Override Default Article Style?', 'thevoux'),
    	  'id'          => 'article_style_override',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('You can change the article style here', 'thevoux'),
    	  'std'         => 'off'
    	),
      array(
        'label'       => esc_html__('Article Style', 'thevoux'),
        'id'          => 'post-style',
        'type'        => 'radio-image',
        'std'		  		=> 'style1',
        'condition'   => 'article_style_override:is(on)'
      ),
      array(
        'label'       => esc_html__('Top Image', 'thevoux'),
        'id'          => 'post-top-image',
        'type'        => 'upload',
        'desc'        => esc_html__('The image to display on top.', 'thevoux'),
        'operator' 		=> 'or',
        'condition'   => 'post-style:is(style2),post-style:is(style3)'
      ),
      array(
        'id'          => 'tab2',
        'label'       => esc_html__('Reviews', 'thevoux'),
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__('Is this a review post?', 'thevoux'),
        'id'          => 'is_review',
        'type'        => 'radio',
        'desc'        => esc_html__('Select yes, if you would like to display review settings', 'thevoux'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Yes', 'thevoux'),
            'value'       => 'yes'
          ),
          array(
            'label'       => esc_html__('No', 'thevoux'),
            'value'       => 'no'
          )
        ),
        'std'         => 'no'
      ),
      array(
        'label'       => esc_html__('Review Title', 'thevoux'),
        'id'          => 'post_ratings_title',
        'type'        => 'text',
        'desc'        => esc_html__('Title of the review', 'thevoux'),
        'condition'   => 'is_review:is(yes)'
      ),
      array(
        'label'       => esc_html__('Ratings', 'thevoux'),
        'id'          => 'post_ratings_percentage',
        'type'        => 'list-item',
        'desc'        => esc_html__('Please add ratings to rate this review for', 'thevoux'),
        'settings'    => array(
          array(
            'label'       => esc_html__('Score', 'thevoux'),
            'id'          => 'feature_score',
            'desc'        => esc_html__('Value should be between 0-10', 'thevoux'),
            'std'         => '5',
            'type'        => 'numeric-slider',
            'min_max_step'=> '0,10,1'
          )
        ),
        'condition'   => 'is_review:is(yes)'
      ),
      array(
        'label'       => esc_html__('Comments Positive/Negative', 'thevoux'),
        'id'          => 'post_ratings_comments',
        'type'        => 'list-item',
        'desc'        => esc_html__('Please add comments', 'thevoux'),
        'settings'    => array(
          array(
            'label'       => esc_html__('Comment Type', 'thevoux'),
            'id'          => 'feature_comment_type',
            'type'        => 'radio',
            'desc'        => esc_html__('Is this a negative or a positive comment?', 'thevoux'),
            'choices'     => array(
              array(
                'label'       => esc_html__('Positive', 'thevoux'),
                'value'       => 'positive'
              ),
              array(
                'label'       => esc_html__('Negative', 'thevoux'),
                'value'       => 'negative'
              )
            ),
            'std'         => 'negative'
          ),
        ),
        'condition'   => 'is_review:is(yes)'
      ),
      array(
        'id'          => 'tab3',
        'label'       => esc_html__('Gallery Format', 'thevoux'),
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__('Gallery Style', 'thevoux'),
        'id'          => 'gallery_style',
        'type'        => 'radio-image',
        'desc'        => esc_html__('You can use different Gallery styles depending on your content.', 'thevoux'),
        'std'         => 'style1'
      ),
      array(
        'id'          => 'tab4',
        'label'       => esc_html__('Video Format', 'thevoux'),
        'type'        => 'tab'
      ),
      array(
        'label'       => esc_html__('Video URL', 'thevoux'),
        'id'          => 'post_video',
        'type'        => 'text',
        'desc'        => esc_html__('Video URL. You can find a list of websites you can embed here: <a href="http://codex.wordpress.org/Embeds">Wordpress Embeds</a>', 'thevoux'),
        'std'         => ''
      ),
      array(
        'id'          => 'tab5',
        'label'       => esc_html__('Shop The Look', 'thevoux'),
        'type'        => 'tab'
      ),
      array(
        'id'          => 'post_shopthelook',
        'label'       => esc_html__( 'Select Products', 'thevoux' ),
        'desc'        => esc_html__( 'Select products to display inside the Shop The Look section. Requires WooCommerce.', 'thevoux' ),
        'type'        => 'product_select'
      ),
    ))
  );


  /**
   * Register our meta boxes using the
   * ot_register_meta_box() function.
   */
  ot_register_meta_box( $page_metabox );
	ot_register_meta_box( $post_metabox );
  
}
