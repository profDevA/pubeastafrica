<?php get_header(); ?>
<div class="post-detail-row attachment-page">
	<div class="row">
		<div class="small-12 medium-12 large-12 columns">
			<article itemscope itemtype="http://schema.org/BlogPosting" <?php post_class( 'post post-detail' ); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>">
				<header class="post-title entry-header">
					<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>
				</header>
				<?php do_action( 'thb_post_top', false, true ); ?>
				<?php do_action( 'thb_social_article_detail', false, true, 'show-for-medium' ); ?>
				<div class="post-content-container">
					<div class="post-content entry-content cf">
						<?php echo wp_get_attachment_image( $attachment_id, $size = 'original', $icon = false ); ?>
					</div>
				</div>
				<?php do_action( 'thb_social_article_detail', false, false, 'hide-for-medium' ); ?>
			</article>
		</div>
	</div>
</div>
<?php
get_footer();
