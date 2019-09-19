<?php
// Edit category header field.
function thb_edit_category_header_img( $term, $taxonomy ) {
	$image = '';
	$image = absint( get_woocommerce_term_meta( $term->term_id, 'header_id', true ) );

	?>
	<tr class="form-field">
		<th colspan="2"><h2><?php esc_html_e( 'The Voux Settings', 'thevoux' ); ?></h2></th>
	</tr>
	<tr class="form-field">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Header', 'thevoux' ); ?></label></th>
		<td>
			<div class="thb-upload-image-field">
				<?php if ( ! empty( $image ) ) { ?>
					<div class="thb-image-holder">
						<?php echo wp_get_attachment_image( $image, 'thumbnail' ); ?>
					</div>
				<?php } ?>
				<input type="hidden" class="thb-image-id" id="product_cat_header_id" name="product_cat_header_id" value="<?php echo esc_attr( $header_id ); ?>" />
				<a class="thb-upload-image button"><?php esc_html_e( 'Upload/Add image', 'thevoux' ); ?></a>
				<a class="thb-remove-image button"><?php esc_html_e( 'Remove image', 'thevoux' ); ?></a>
			</div>
		</td>
	</tr>
	<?php
}
add_action( 'product_cat_edit_form_fields', 'thb_edit_category_header_img', 20, 2 );

// woocommerce_category_header_img_save function.
function thb_category_header_img_save( $term_id, $tt_id, $taxonomy ) {
	if ( isset( $_POST['product_cat_header_id'] ) ) {
		update_woocommerce_term_meta( $term_id, 'header_id', wp_unslash( absint( $_POST['product_cat_header_id'] ) ) );
	}
	delete_transient( 'wc_term_counts' );
}

add_action( 'created_term', 'thb_category_header_img_save', 10, 3 );
add_action( 'edit_term', 'thb_category_header_img_save', 10, 3 );


// Header column added to category admin.
function thb_woocommerce_product_cat_header_columns( $columns ) {
	$new_columns           = array();
	$new_columns['cb']     = $columns['cb'];
	$new_columns['thumb']  = esc_html__( 'Image', 'thevoux' );
	$new_columns['header'] = esc_html__( 'Header', 'thevoux' );

	unset( $columns['cb'] );
	unset( $columns['thumb'] );

	return array_merge( $new_columns, $columns );
}
add_filter( 'manage_edit-product_cat_columns', 'thb_woocommerce_product_cat_header_columns' );


// Thumbnail column value added to category admin.
function thb_woocommerce_product_cat_header_column( $columns, $column, $id ) {
	if ( 'header' === $column ) {
		$image     = '';
		$header_id = get_woocommerce_term_meta( $id, 'header_id', true );

		if ( $header_id ) {
			$image = wp_get_attachment_image_url( $header_id, 'thumbnail' );
		} else {
			$image = wc_placeholder_img_src();
		}
		$columns .= '<img src="' . esc_url( $image ) . '" alt="Thumbnail" class="wp-post-image" height="40" width="40" />';
	}
	return $columns;
}
add_filter( 'manage_product_cat_custom_column', 'thb_woocommerce_product_cat_header_column', 10, 3 );
