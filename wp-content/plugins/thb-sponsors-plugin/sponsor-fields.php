<?php

/**
 * Add Sponsor Custom Fields.
 */
function thb_add_sponsor_custom_fields() {
?>
	<div class="form-field term-url-wrap">
		<label for="tag-url"><?php esc_html_e( 'Sponsor URL:', 'thevoux' ); ?></label>
		<input name="thb_sponsor_url" id="tag-url" type="text" value="" size="40">
		<p><?php esc_html_e( 'The URL that sponsor links to.', 'thevoux' ); ?></p>
	</div>
	<div class="form-field thb-sponsor-logo-wrap">
		<label><?php esc_html_e( 'Sponsor Logo', 'thevoux' ); ?></label>
		<div class="thb-upload-image-field">
			<div class="thb-image-holder">

			</div>
			<input type="hidden" class="thb-image-id" id="thb_sponsor_logo_image" name="thb_sponsor_logo_image" value="" />
			<a class="thb-upload-image button"><?php esc_html_e( 'Upload/Add image', 'thevoux' ); ?></a>
			<a class="thb-remove-image button"><?php esc_html_e( 'Remove image', 'thevoux' ); ?></a>
		</div>
		<p><?php esc_html_e( 'Upload your logo for the sponsor here.', 'thevoux' ); ?></p>
	</div>

	<?php
}
add_action( 'thb-sponsors_add_form_fields', 'thb_add_sponsor_custom_fields' );

/**
 * Edit Sponsor Custom Fields.
 */
function thb_edit_sponsor_custom_fields( $tag, $taxonomy ) {
	$image = get_term_meta( $tag->term_id, 'thb_sponsor_logo_image', true );
	$thb_sponsor_logo_url   = get_term_meta( $tag->term_id, 'thb_sponsor_url', true );
	?>
	<table class="form-table">
		<tbody>
			<tr class="form-field term-url-wrap">
				<th scope="row"><label for="thb_sponsor_url"><?php esc_html_e( 'Sponsor URL', 'thevoux' ); ?></label></th>
							<td><input name="thb_sponsor_url" id="thb_sponsor_url" type="text" value="<?php echo esc_attr( $thb_sponsor_logo_url ); ?>" size="40">
				<p class="description"><?php esc_html_e( 'You can link Sponsor logo to this url.', 'thevoux' ); ?></p></td>
			</tr>
			<tr class="form-field thb-sponsor-logo-wrap">
				<th scope="row">
					<label><?php esc_html_e( 'Sponsor Logo', 'thevoux' ); ?></label>
				</th>
				<td>
					<div class="thb-upload-image-field">
						<?php if ( ! empty( $image ) ) :  ?>
							<div class="thb-image-holder">
								<?php echo wp_get_attachment_image( $image, 'thumbnail' ); ?>
							</div>
						<?php endif; ?>
						<input type="hidden" class="thb-image-id" id="thb_sponsor_logo_image" name="thb_sponsor_logo_image" value="<?php echo esc_attr($image); ?>" />
						<a class="thb-upload-image button"><?php esc_html_e( 'Upload/Add image', 'thevoux' ); ?></a>
						<a class="thb-remove-image button"><?php esc_html_e( 'Remove image', 'thevoux' ); ?></a>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}
add_action( 'thb-sponsors_edit_form_fields', 	'thb_edit_sponsor_custom_fields', 10, 2 );

/**
 * Save Sponsor Custom Fields.
 */
function thb_sponsor_save_custom_form_fields( $term_id ) {
	$thb_sponsor_logo_image 	= filter_input( INPUT_POST, 'thb_sponsor_logo_image', FILTER_SANITIZE_STRING );
	$thb_sponsor_url 			= filter_input( INPUT_POST, 'thb_sponsor_url', FILTER_SANITIZE_STRING );
	update_term_meta( $term_id, 'thb_sponsor_logo_image', $thb_sponsor_logo_image );
	update_term_meta( $term_id, 'thb_sponsor_url', $thb_sponsor_url );
}
add_action( 'create_thb-sponsors', 'thb_sponsor_save_custom_form_fields', 10, 2 );
add_action( 'edited_thb-sponsors', 'thb_sponsor_save_custom_form_fields', 10, 2 );
