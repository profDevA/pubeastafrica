<?php
// @GET field id to edit.
$registration_id = absint( $_GET['registration'] );

// get the registration row for the id
$edit_registration = PROFILEPRESS_sql::sql_edit_registration_builder( $registration_id );

require_once VIEWS . '/include.settings-page-tab.php'; ?>
<br/>
<a class="button-secondary" href="?page=<?php echo REGISTRATION_BUILDER_SETTINGS_PAGE_SLUG; ?>"
   title="Back to Catalog">Back to Catalog</a>

<div id="poststuff" class="ppview">
	<div id="post-body" class="metabox-holder columns-2">
		<div id="post-body-content">
			<div class="meta-box-sortables ui-sortable">
				<form method="post">
					<div class="postbox">
						
            <button type="button" class="handlediv button-link" aria-expanded="true">
                <span class="screen-reader-text"><?php _e('Toggle panel'); ?></span>
                <span class="toggle-indicator" aria-hidden="true"></span>
            </button>
						<h3 class="hndle ui-sortable-handle"><span>Edit Registration Form</span></h3>
						<div class="inside">
							<table class="form-table">
								<tr>
									<th scope="row"><label for="title">Theme Name</label></th>
									<td>
										<input type="text" id="title" name="rfb_title" class="regular-text code" value="<?php echo isset( $_POST['rfb_title'] ) ? esc_attr( $_POST['rfb_title'] ) : $edit_registration['title']; ?>" required="required"/>

										<p class="description">This is the internal title of your<strong>Registration Form</strong> for easy reference..
										</p>
									</td>
								</tr>

								<tr>
									<th scope="row"><label for="structure">Registration Design</label>
									</th>
									<td>
										<?php
										$content        = isset( $_POST['rfb_structure'] ) ? stripslashes( $_POST['rfb_structure'] ) : $edit_registration['structure'];
										$editor_id      = 'pp_registration_structure';
										$wp_editor_args = array(
											'textarea_name' => 'rfb_structure',
											'textarea_rows' => 30,
											'wpautop'       => true,
											'teeny'         => false,
											'tinymce' => true
										);

										wp_editor( $content, $editor_id, $wp_editor_args ); ?>
										<p class="description">Registration Form Design & Structure</p>
									</td>
								</tr>
							</table>
							<p>
								<?php wp_nonce_field( 'edit_registration_builder' ); ?>
								<input class="button-primary" type="submit" name="edit_registration" value="<?php _e( 'Save Changes', 'ppress' ); ?>">
							</p>
						</div>
					</div>

					<div style="margin-top: -5px;" class="postbox">
						
            <button type="button" class="handlediv button-link" aria-expanded="true">
                <span class="screen-reader-text"><?php _e('Toggle panel'); ?></span>
                <span class="toggle-indicator" aria-hidden="true"></span>
            </button>
						<h3 class="hndle ui-sortable-handle" style="font-size: 18px;text-align: center"><span>Registration Form Preview</span></h3>

						<div class="inside">
							<iframe width="100%" height="500px" id="indexIframe" src="<?php echo admin_url( 'admin-ajax.php?action=pp-builder-preview' ); ?>"></iframe>
							<img style="display:none" id="loadingimg" src="<?php echo ASSETS_URL; ?>/images/loading.gif"/> &nbsp;&nbsp;
							<a style="text-align: center" class="button-secondary" id="preview_iframe">Preview Design</a>
						</div>
					</div>

					<div style="margin-top: -15px;" class="postbox">
						<div class="inside">
							<table class="form-table">
								<tr>
									<th scope="row"><label for="pp_registration_css">CSS Stylesheet</label>
									</th>
									<td>
										<textarea rows="30" name="rfb_css" id="pp_registration_css"><?php echo isset( $_POST['rfb_css'] ) ? stripslashes( $_POST['rfb_css'] ) : $edit_registration['css']; ?></textarea>

										<p class="description">CSS Stylesheet for the Registration Form</p>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="message_success">Success message</label>
									</th>
									<td>
										<textarea name="rfb_success_registration" id="message_success"><?php echo isset( $_POST['rfb_success_registration'] ) ? esc_textarea( $_POST['rfb_success_registration'] ) : $edit_registration['success_registration']; ?></textarea>

										<p class="description">Message to display on successful user registration </p>
									</td>
								</tr>
							</table>

						</div>
					</div>

					<div style="margin-top: -15px;" class="postbox">

						<div class="inside">
							<table class="form-table">
								<tr>
									<th scope="row"><label for="description">Create Widget</label>
									</th>
									<td>
										<input type="checkbox" disabled="disabled" name="rfb_make_widget" id="make-login-widget" value="yes" />
										<label for="make-login-widget"><strong>Make this a Widget</strong></label>

										<p class="description">Available in	<a href="https://profilepress.net/features/one-click-wordpress-widget-creation/" target="_blank">premium version</a> of the plugin</p>

									</td>
								</tr>
							</table>

							<p>
								<?php wp_nonce_field( 'edit_registration_builder' ); ?>
								<input class="button-primary" type="submit" name="edit_registration" value="<?php _e( 'Save Changes', 'ppress' ); ?>">
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php include_once VIEWS . '/include.plugin-settings-sidebar.php'; ?>
	</div>
	<br class="clear">
</div>

<script type="text/javascript">
	var codemirror_editor = CodeMirror.fromTextArea(document.getElementById("pp_registration_css"), {lineNumbers: true});

	(function ($) {

		// detect if a change event is fired in codemirror editor.
		codemirror_editor.on('change', function () {
			window.onbeforeunload = function (e) {
				return 'The changes you made will be lost if you navigate away from this page.';
			};
		});

		$('input[type="submit"]').click(function () {
			window.onbeforeunload = function (e) {
				e = null;
			};
		});

		$(window).load(function () {
			// if TinyMCE is in text mode
			$('#pp_registration_structure').on('change', function (e) {
				window.onbeforeunload = function (e) {
					return 'The changes you made will be lost if you navigate away from this page.';
				};
			});

			var raw_builder_structure = $('#pp_registration_structure').val();


			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					builder_structure: raw_builder_structure,
					action: 'pp-builder-preview'
				}
			})
				.done(function (builder_structure) {

					var builder_css = codemirror_editor.getValue();
					var iframe1 = $('#indexIframe').contents();

					$(iframe1).contents().find('body').html(builder_structure);
					$(iframe1).contents().find('style').html(builder_css);
				});

			$('input[type="submit"]').click(function () {
				window.onbeforeunload = function (e) {
					e = null;
				};
			});
		});

		$('#preview_iframe').click(function () {
			var raw_builder_structure = $('#pp_registration_structure').val();
			var builder_css = codemirror_editor.getValue();
			var iframe1 = $('#indexIframe').contents();

			// show pre-loader
			$("#loadingimg").show();

			$.ajax({
				type: "POST",
				url: ajaxurl,
				data: {
					builder_structure: raw_builder_structure,
					action: 'pp-builder-preview'
				}
			})
				.done(function (builder_structure) {
					$(iframe1).contents().find('body').html(builder_structure);
					$(iframe1).contents().find('style').html(builder_css);
					$("#loadingimg").hide();
				});
		});

	})(jQuery);

</script>