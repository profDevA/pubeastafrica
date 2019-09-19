<?php
	$thb_id        = get_the_id();
	$image_id      = get_post_thumbnail_id();
	$image_url     = wp_get_attachment_image_src( $image_id, 'full' );
	$post_image    = get_post_meta( $thb_id, 'post-top-image', true ) ? get_post_meta( $thb_id, 'post-top-image', true ) : $image_url[0];
	$fixed         = ot_get_option( 'article_fixed_sidebar', 'on' );
	$fullwidth     = ot_get_option( 'article_fullwidth', 'off' );
	$dropcap       = ot_get_option( 'article_dropcap', 'on' );
	$gallery_style = get_post_meta(get_the_ID(), 'gallery_style', true );
?>
<div class="post-detail-row style2">
	<div class="post-header">
		<div class="parallax_bg" data-bottom-top="transform: translate3d(0px, -20%, 0px);" data-top-bottom="transform: translate3d(0px, 20%, 0px);" style="background-image: url(<?php echo esc_html( $post_image ); ?>);"></div>
	</div>

	<div class="row post-detail-style2-row">
		<div class="small-12 medium-12 <?php echo esc_attr( 'on' === $fullwidth ? 'large-12' : 'large-8' ); ?> columns">
			<article itemscope itemtype="http://schema.org/Article" <?php post_class( 'post post-detail post-detail-style2' ); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>">
				<div class="post-title-container">
					<?php do_action( 'thb_ads_before_title' ); ?>
					<?php do_action( 'thb_post_top', true, true); ?>
					<header class="post-title entry-header">
						<?php the_title( '<h1 class="entry-title" itemprop="headline"><a href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h1>' ); ?>
					</header>
					<?php do_action( 'thb_post_author' ); ?>
				</div>
				<?php
					// The following determines what the post format is and shows the correct file accordingly
					$format = get_post_format();
					if ($format) {
						set_query_var( 'thb_image_size', 'thevoux-single-2x' );
						if ($format !== 'gallery' || ($format == 'gallery' && $gallery_style !== 'style2' )) {
							get_template_part( 'inc/templates/postbits/'.$format );
						}
					}
				?>
				<div class="post-share-container">
					<?php do_action( 'thb_social_article_detail', false, true, 'show-for-medium' ); ?>
					<div class="post-content-container">
						<?php do_action( 'thb_ads_before_content' ); ?>
						<div class="post-content entry-content cf" data-first="<?php echo esc_attr( thb_FirstLetter() ); ?>" itemprop="articleBody">
							<?php echo the_content(); ?>
							<?php
								if ($format == 'gallery' && $gallery_style == 'style2' ) {
									get_template_part( 'inc/templates/postbits/gallery-style2' );
								}
							?>
							<?php
								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'thevoux' ),
									'after'  => '</div>',
								) );
							?>
							<?php get_template_part( 'inc/templates/postbits/post-shopthelook' ); ?>
							<?php do_action( 'thb_post_review' ); ?>
							<?php do_action( 'thb_ads_after_content' ); ?>
							<?php get_template_part( 'inc/templates/postbits/tags' ); ?>
							<?php get_template_part( 'inc/templates/postbits/author' ); ?>
							<?php get_template_part( 'inc/templates/postbits/post-nav' ); ?>
						</div>
					</div>
					<?php do_action( 'thb_social_article_detail', false, false, 'hide-for-medium' ); ?>
					<?php do_action( 'thb_PostMeta' ); ?>
				</div>

			</article>
			<?php comments_template( '', true ); ?>
			<?php if ( ! wp_doing_ajax() && ot_get_option( 'related_posts', 'on' ) !== 'off' ) { ?>
				<?php get_template_part( 'inc/templates/postbits/post-related' ); ?>
			<?php } ?>
		</div>
		<?php if ( 'off' === $fullwidth ) { ?>
			<?php if ( wp_doing_ajax() ) { get_sidebar( 'single-ajax' ); } else { get_sidebar( 'single' ); } ?>
		 <?php } ?>
	</div>
	<?php if ( wp_doing_ajax() ) { do_action( 'thb_ads_after_article_ajax' ); } else { do_action( 'thb_ads_after_article' ); } ?>
</div>
