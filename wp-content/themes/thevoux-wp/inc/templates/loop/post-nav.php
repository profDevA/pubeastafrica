<?php if ( get_next_posts_link() || get_previous_posts_link()) { ?>
<div class="blog_nav">
	<?php if ( get_next_posts_link() ) : ?>
		<a href="<?php echo next_posts(); ?>" class="next"><i class="fa fa-angle-left"></i> <?php esc_html_e( 'Older Posts', 'thevoux' ); ?></a>
	<?php endif; ?>
	<?php if ( get_previous_posts_link() ) : ?>
		<a href="<?php echo previous_posts(); ?>" class="prev"><?php esc_html_e( 'Newer Posts', 'thevoux' ); ?> <i class="fa fa-angle-right"></i></a>
	<?php endif; ?>
</div>
<?php } ?>