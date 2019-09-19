<?php $hide_zero_shares = ot_get_option( 'hide_zero_shares', 'off'); ?>
<footer class="post-links just-shares and-comments">
	<?php if ($hide_zero_shares === 'off' || thb_social_article_totalshares(get_the_ID()) !== 0) { ?>
		<div class="share-link">
			<?php get_template_part( 'assets/svg/share.svg'); ?>
			<span><em><?php echo thb_social_article_totalshares(get_the_ID()); ?></em> <?php esc_html_e('Shares', 'thevoux' ); ?></span>
		</div>
	<?php } ?>
	<a href="<?php echo get_comments_link( $post->ID ); ?>" title="<?php the_title_attribute(); ?>" class="comment-link">
		<?php get_template_part( 'assets/svg/comment.svg'); ?>
		<span><?php comments_number(__('0 Comments', 'thevoux'), __('1 Comment', 'thevoux'), __('% Comments', 'thevoux') ); ?></span>
	</a>
</footer>
