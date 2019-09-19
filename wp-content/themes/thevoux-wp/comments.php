<?php
/*-----------------------------------------------------------------------------------*/
/*  Begin processing our comments
/*-----------------------------------------------------------------------------------*/
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
if ( wp_doing_ajax() ) {
	return;
}

$article_expanded_comments = ot_get_option( 'article_expanded_comments', 'off' );
?>

<!-- Start #comments -->
<section id="comments" class="cf full <?php echo esc_attr( 'expanded-comments-' . $article_expanded_comments ); ?>">
	<div class="row">
		<div class="small-12 columns">
	<div class="commentlist_parent">
		<a href="#" class="comment-button <?php if (get_comments_number() == 0) { ?>disabled<?php } ?>">
			<?php get_template_part( 'assets/svg/comment.svg'); ?>
			<?php comments_number(__('No Comments Yet', 'thevoux'), __('1 Comment', 'thevoux'), __('% Comments', 'thevoux') ); ?>
		</a>
	<?php if ( have_comments() ) : ?>
			<div class="commentlist_container">
				<ol class="commentlist">
					<?php wp_list_comments(
						array(
							'type'		  => 'comment',
							'style'       => 'ol',
							'short_ping'  => true,
							'avatar_size' => 56
						)
					); ?>
				</ol>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
					<div class="navigation">
						<div class="nav-previous"><?php previous_comments_link(); ?></div>
						<div class="nav-next"><?php next_comments_link(); ?></div>
					</div><!-- .navigation -->
				<?php } ?>
			</div>

	<?php else :
		if ( ! comments_open() ) :
	?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed', 'thevoux' ); ?></p>
	<?php endif; // end ! comments_open() ?>

	<?php endif; // end have_comments() ?>

	<?php
		// Comment Form
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? ' aria-required="true" data-required="true"' : '' );

		$defaults = array( 'fields' => apply_filters( 'comment_form_default_fields', array(

			'author' => '<div class="row"><div class="small-12 medium-6 columns"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Name', 'thevoux' ) . '"/></div>',

			'email'  => '<div class="small-12 medium-6 columns"><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' placeholder="' . esc_attr__( 'Email', 'thevoux' ) . '" /></div>',

			'url'    => '<div class="small-12 columns"><input name="url" size="30" id="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" type="text" placeholder="' . esc_attr__( 'Website', 'thevoux' ) . '"/></div></div>' ) ),

			'comment_field' => '<div class="row"><div class="small-12 columns"><textarea name="comment" id="comment"' . $aria_req . ' rows="10" cols="58" placeholder="' . esc_attr__( 'Your Comment', 'thevoux' ) . '"></textarea></div></div>',

			'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'thevoux' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',

			'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'thevoux' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',

			'comment_notes_before' => '<p class="comment-notes">' . esc_attr__( 'Your email address will not be published.', 'thevoux' ) . '</p>',
			'comment_notes_after' => '',
			'id_form' => 'form-comment',
			'id_submit' => 'submit',
			'title_reply' => esc_attr__( 'Leave a Reply', 'thevoux' ),
			'title_reply_to' => esc_attr__( 'Leave a Reply to %s', 'thevoux' ),
			'cancel_reply_link' => esc_attr__( 'Cancel reply', 'thevoux' ),
			'label_submit' => esc_attr__( 'Submit Comment', 'thevoux' ),
		);
	comment_form($defaults);
	?>
		</div>
		</div>
	</div>
</section>
<!-- End #comments -->
