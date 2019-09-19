<?php
// Edit category fields.
function thb_edit_category_vars( $term, $taxonomy ) {
	$selected_layout = get_term_meta( $term->term_id, 'thb_cat_layout', true );
	$archive_layouts = thb_get_archive_layouts();
	$selected_layout = ( '' === $selected_layout ? ot_get_option( 'category_layout', 'style1' ) : $selected_layout );
	?>
	<tr class="form-field">
		<th colspan="2">
			<h2><?php esc_html_e( 'The Voux Settings', 'thevoux' ); ?></h2>
		</th>
	</tr>
	<tr class="form-field">
	<th scope="row" valign="top">
		<label><?php esc_html_e( 'Category Layout', 'thevoux' ); ?></label>
	</th>
		<td>
			<div class="thb-radio-images">
				<?php foreach ( $archive_layouts as $layout ) { ?>
					<div class="thb-radio-image">
						<label for="thb-radio-image-<?php echo esc_attr( $layout['value'] ); ?>">
							<img src="<?php echo esc_url( $layout['src'] ); ?>" alt="<?php echo esc_attr( $layout['label'] ); ?>" class="thb-radio-image-img" />
							<input type="radio" name="thb_cat_layout" id="thb-radio-image-<?php echo esc_attr( $layout['value'] ); ?>" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $layout['value'], $selected_layout, true ); ?> />
							<span></span>
						</label>
					</div>
				<?php } ?>
			</div>
		</td>
	</tr>
	<?php
}
add_action( 'category_edit_form_fields', 'thb_edit_category_vars', 20, 2 );

// Save Category Variables.
function thb_category_var_save( $term_id ) {
	$thb_cat_layout = filter_input( INPUT_POST, 'thb_cat_layout', FILTER_SANITIZE_STRING );
	if ( $thb_cat_layout ) {
		update_term_meta( $term_id, 'thb_cat_layout', $thb_cat_layout );
	}
}
add_action( 'created_term', 'thb_category_var_save', 10, 3 );
add_action( 'edit_category', 'thb_category_var_save', 10, 3 );
