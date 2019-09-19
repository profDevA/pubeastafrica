<?php function thb_blockgrid( $atts, $content = null ) {
  $atts = vc_map_get_attributes( 'thb_blockgrid', $atts );
  extract( $atts );

	$source .= '|offset:'.$offset;

	$source_data = VcLoopSettings::parseData( $source );

	switch($style) {
		case 'style1':
			$source_data['size'] = 5;
		break;
	}
	$query_builder = new ThbLoopQueryBuilder( $source_data );
	$posts = $query_builder->build();
	$posts = $posts[1];

	$i = 0;
 	ob_start();
 	?>
 	<div class="thb-block-grid thb-block-grid-<?php echo esc_attr($style); ?>">
		<?php if ($posts->have_posts()) : ?>
			<?php if ('style1' == $style) { ?>
				<div class="row thb-grid-parent-row">
					<div class="small-12 large-6 columns">
						<?php while ($posts->have_posts()) : $posts->the_post(); ?>
							<?php if ($i === 0) { ?>
								<?php get_template_part( 'inc/templates/loop/blockgrid/style1'); ?>
							</div>
							<div class="small-12 large-6 columns">
									<div class="row thb-grid-children-row">
							<?php } elseif ( $i > 0 ) { ?>
										<div class="small-12 medium-6 columns">
											<?php get_template_part( 'inc/templates/loop/blockgrid/style1'); ?>
										</div>
							<?php } ?>
									<?php $i++; endwhile; ?>
									</div> <!-- .thb-grid-children-row -->
							</div>
	 			</div><!-- .thb-grid-parent-row -->
	 		<?php } ?>
		<?php endif; ?>
	</div> <!-- .thb-block-grid -->
	<?php
	$out = ob_get_clean();
	wp_reset_query();
	return $out;
}
thb_add_short('thb_blockgrid', 'thb_blockgrid');