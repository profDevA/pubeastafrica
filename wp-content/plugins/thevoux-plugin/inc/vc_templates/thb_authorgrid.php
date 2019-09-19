<?php function thb_authorgrid( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_authorgrid', $atts );
  extract( $atts );
	$author_array = explode(',', $author_ids);
	$author_list = empty($author_array) ? array() : $author_array;

  if ($author_ids == '' || $author_ids == ' ') {
    $all_authors = get_users(
      array(
        'role__not_in' => array('1','2'),
      )
    );
    $author_list = array_column($all_authors, 'ID');
  } else {
    $author_array = explode(',', $author_ids);
    $author_list = $author_array;
  }
	switch($columns) {
		case 2:
			$col = 'medium-6 large-6';
			break;
		case 3:
			$col = 'medium-4 large-4';
			break;
		case 4:
			$col = 'medium-6 large-3';
			break;
		case 6:
			$col = 'medium-6 large-2';
			break;
	}
	ob_start();

	echo '<div class="row author_list">';
	foreach($author_list as $author) {
		?>
			<div class="small-12 <?php echo esc_attr($col); ?> columns">
				<section class="authorpage author_grid">
					<?php do_action('thb_author', $author); ?>
				</section>
			</div>
		<?php
	}
	echo '</div>';

	$out = ob_get_clean();

	wp_reset_query();
	wp_reset_postdata();

  return $out;
}
thb_add_short('thb_authorgrid', 'thb_authorgrid');
