<?php
// Get Total Shares.
function thb_social_article_totalshares( $id ) {
	$id    = $id ? $id : get_the_ID();
	$total = thb_all_count( $id );

	return thb_numberAbbreviation( $total );
}
add_action( 'thb_social_article_totalshares', 'thb_social_article_totalshares', 3 );

// Social Links.
function thb_article_get_accounts( $share_url, $post_id, $options ) {
	$sharing_buttons  = ot_get_option( $options, array() );
	$sharing_accounts = array();
	$post_url         = esc_url( $share_url );
	$post_title       = rawurlencode( get_the_title( $post_id ) );
	$post_content     = get_post_field( 'post_content', intval( $post_id ) );
	$post_thumbnail   = get_the_post_thumbnail_url( intval( $post_id ), 'full' );
	$twitter_user     = ot_get_option( 'twitter_bar_username', 'fuel_themes' );

	foreach ( $sharing_buttons as $button ) {
		switch ( $button ) {
			case 'facebook':
				$sharing_accounts['facebook'] = array(
				  'slug'  => 'facebook',
				  'url'   => esc_url( 'https://www.facebook.com/sharer.php?u=' . $share_url ),
				  'icon'  => 'fa fa-facebook',
				  'label' => esc_html__( 'Share', 'thevoux' ),
				  'count' => 'thb_facebook_count',
				);
				break;
			case 'twitter':
				$sharing_accounts['twitter'] = array(
				  'slug'  => 'twitter',
				  'url'   => esc_url( 'https://twitter.com/share?text=' . $post_title . '&via=' . $twitter_user . '&url=' . $share_url ),
				  'icon'  => 'fa fa-twitter',
				  'label' => esc_html__( 'Tweet', 'thevoux' ),
				);
				break;
			case 'pinterest':
				$sharing_accounts['pinterest'] = array(
				  'slug'  => 'pinterest',
				  'url'   => esc_url( 'https://pinterest.com/pin/create/bookmarklet/?url=' . $share_url . '&media=' . $post_thumbnail ),
				  'icon'  => 'fa fa-pinterest',
				  'label' => esc_html__( 'Pin', 'thevoux' ),
				  'count' => 'thb_pinterest_count',
				);
				break;
			case 'linkedin':
				$sharing_accounts['linkedin'] = array(
				  'slug'  => 'linkedin',
				  'url'   => esc_url( 'https://www.linkedin.com/cws/share?url=' . $share_url ),
				  'icon'  => 'fa fa-linkedin',
				  'label' => esc_html__( 'Share', 'thevoux' ),
				  'count' => 'thb_linkedin_count',
				);
				break;
			case 'email':
				$sharing_accounts['email'] = array(
				  'slug'  => 'email',
				  'url'   => esc_url( 'mailto:?subject=' . $post_title . '&body=' . $post_title . '%20' . $share_url ),
					'icon'  => 'fa fa-envelope-o',
				  'label' => esc_html__( 'Share', 'thevoux' ),
				);
				break;
			case 'vkontakte':
				$sharing_accounts['vkontakte'] = array(
				  'slug'  => 'vkontakte',
				  'url'   => esc_url( 'https://vk.com/share.php?url=' . $share_url ),
				  'icon'  => 'fa fa-vk',
				  'label' => esc_html__( 'Like', 'thevoux' ),
				);
				break;
			case 'whatsapp':
				$sharing_accounts['whatsapp'] = array(
				  'slug'  => 'whatsapp',
				  'url'   => esc_html( 'whatsapp://send?text=' . $share_url ),
				  'icon'  => 'fa fa-whatsapp',
				  'label' => esc_html__( 'Share', 'thevoux' ),
				);
				break;
			case 'reddit':
				$sharing_accounts['reddit'] = array(
				  'slug'  => 'reddit',
				  'url'   => esc_url( 'https://reddit.com/submit?url=' . $share_url ),
				  'icon'  => 'fa fa-reddit-alien',
				  'label' => esc_html__( 'Share', 'thevoux' ),
				);
				break;
		}
	}
	return $sharing_accounts;
}

// Show Social Sharing Icons for Articles.
function thb_social_article_detail( $id = false, $fixed = false, $class = false ) {
	$post_id          = get_the_ID();
	$post_url         = get_permalink();
	$sharing_buttons  = thb_article_get_accounts( $post_url, $post_id, 'sharing_buttons_article' );
	$hide_zero_shares = ot_get_option( 'hide_zero_shares_article', 'off' );
	$sharing_style    = ot_get_option( 'sharing_style', 'style1' );
	$classes[]        = 'share-article hide-on-print';
	$classes[]        = is_singular( 'post' ) || is_admin() ? 'share-article-single' : false;
	$classes[]        = $fixed ? 'fixed-me' : false;
	$classes[]        = $class;
	?>
	<aside class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php
			foreach ( $sharing_buttons as $button ) {
				if ( array_key_exists( 'count', $button ) ) {
					$count = thb_numberAbbreviation( $button['count']( $post_id ) );


					if ( $button['count']( $post_id ) === '0' && 'on' === $hide_zero_shares ) {
						unset( $button['count'] );
					}
				}
			?>
			<a href="<?php echo esc_attr( $button['url'] ); ?>" class="boxed-icon social <?php echo esc_attr( $button['slug'] ); ?> <?php echo esc_attr( $sharing_style ); ?>">
				<i class="<?php echo esc_attr( $button['icon'] ); ?>"></i>
				<?php if ( array_key_exists( 'count', $button ) ) { ?>
					<span class="thb-social-count"><?php echo esc_html( $count ); ?></span>
				<?php } ?>
			</a>
    <?php } ?>
    <?php $comment_icon = 'style1' === $sharing_style ? 'comment' : 'comment-style2'; ?>
		<a href="<?php the_permalink(); ?>" class="boxed-icon comment <?php echo esc_attr( $sharing_style ); ?>"><?php get_template_part( 'assets/svg/' . $comment_icon . '.svg' ); ?><span><?php echo esc_html( get_comments_number() ); ?></span></a>
	</aside>
<?php
}
add_action( 'thb_social_article_detail', 'thb_social_article_detail', 3, 3 );

// Show Social Sharing Icons for loop
function thb_social_article( $id ) {
	$post_id         = $id ? $id : get_the_ID();
	$post_url        = get_permalink();
	$sharing_buttons = thb_article_get_accounts( $post_url, $post_id, 'sharing_buttons' );
	?>
	<?php if ( ! empty( $sharing_buttons ) ) { ?>
		<?php get_template_part( 'assets/svg/share.svg' ); ?>
		<?php foreach ( $sharing_buttons as $button ) { ?>
			<a href="<?php echo esc_attr( $button['url'] ); ?>" class="boxed-icon fill social <?php echo esc_attr( $button['slug'] ); ?>">
				<i class="<?php echo esc_attr( $button['icon'] ); ?>"></i>
			</a>
		<?php } ?>
	<?php } ?>
	<?php
}
add_action( 'thb_social_article', 'thb_social_article', 3 );

// Show Social Sharing Icons for Products.
function thb_social_product() {
	$post_id          = get_the_ID();
	$post_url         = get_permalink();
	$sharing_buttons  = thb_article_get_accounts( $post_url, $post_id, 'sharing_buttons_article' );
	$hide_zero_shares = ot_get_option( 'hide_zero_shares_article', 'off' );
	$sharing_style    = ot_get_option( 'sharing_style', 'style1' );
	$classes[]        = 'share-article hide-on-print';
	?>
	<aside class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<?php
			foreach ( $sharing_buttons as $button ) {
				if ( array_key_exists( 'count', $button ) ) {
					$count = thb_numberAbbreviation( $button['count']( $post_id ) );

					if ( $button['count']( $post_id ) === 0 && 'on' === $hide_zero_shares ) {
						unset( $button['count'] );
					}
				}
			?>
			<a href="<?php echo esc_attr( $button['url'] ); ?>" class="boxed-icon social <?php echo esc_attr( $button['slug'] ); ?> <?php echo esc_attr( $sharing_style ); ?>">
				<i class="<?php echo esc_attr( $button['icon'] ); ?>"></i>
				<?php if ( array_key_exists( 'count', $button ) ) { ?>
					<span class="thb-social-count"><?php echo esc_html( $count ); ?></span>
				<?php } ?>
			</a>
			<?php
		}
		?>
	</aside>
	<?php
}
add_action( 'thb_social_product', 'thb_social_product', 3, 3 );
