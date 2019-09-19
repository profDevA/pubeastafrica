<?php $hide_zero_shares = ot_get_option( 'hide_zero_shares', 'off'); ?>
<?php if ($hide_zero_shares === 'off' || thb_social_article_totalshares(get_the_ID()) !== 0) { ?>
<footer class="post-links share-link just-shares">
	<?php get_template_part( 'assets/svg/share.svg'); ?>
	<span><em><?php echo thb_social_article_totalshares(get_the_ID()); ?></em> <?php esc_html_e('Shares', 'thevoux' ); ?></span>
</footer>
<?php } ?>