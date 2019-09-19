<?php $hide_zero_shares = ot_get_option( 'hide_zero_shares', 'off'); ?>
<footer class="post-links">
	<a href="<?php echo get_comments_link( $post->ID ); ?>" title="<?php the_title_attribute(); ?>" class="post-link comment-link"><?php get_template_part( 'assets/svg/comment.svg'); ?></a> 
	<aside class="share-article-loop share-link post-link">
		<?php do_action('thb_social_article', $post->ID ); ?>
	</aside>
	<?php if ($hide_zero_shares === 'off' || thb_social_article_totalshares(get_the_ID()) !== '0') { ?>
	<span><?php echo thb_social_article_totalshares(get_the_ID()); ?> <?php esc_html_e('Shares', 'thevoux' ); ?></span>
	<?php } ?>
</footer>