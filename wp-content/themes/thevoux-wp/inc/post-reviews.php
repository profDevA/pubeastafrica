<?php

function thb_post_review_average() {
	$thb_id = get_the_ID();
	if ( 'yes' === get_post_meta( $thb_id, 'is_review', true ) ) {
		$features = get_post_meta( $thb_id, 'post_ratings_percentage', true );
		$count    = is_array( $features ) ? count( $features ) : 0;
		$total    = 0;
		$return   = '';
		$average  = false;
		if ( $count > 0 && ! empty( $features ) ) {
			foreach ( $features as $feature ) {
				$total += $feature['feature_score'];
			}
			$average = round( $total / $count, 1 );
		}
		return $average;
	}
}

function thb_post_review() {
	$thb_id = get_the_ID();
	if ( 'yes' === get_post_meta( $thb_id, 'is_review', true ) ) {
		$review_title  = get_post_meta( $thb_id, 'post_ratings_title', true );
		$comments      = get_post_meta( $thb_id, 'post_ratings_comments', true );
		$features      = get_post_meta( $thb_id, 'post_ratings_percentage', true );
		$count         = $features ? count( $features ) : 0;
		$comment_count = $comments ? count( $comments ) : 0;
		$total         = 0;
		?>
		<div class="post-review cf" itemscope itemtype="http://schema.org/Review">
			<?php if ( $review_title ) { ?>
				<strong itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php echo esc_html( $review_title ); ?></span></strong>
			<?php } ?>
			<ul>
			<?php
			if ( $features ) {
				foreach ( $features as $feature ) {
					$total += $feature['feature_score'];
					?>
					<li class="thb-progressbar">
						<div class="row cf">
							<div class="small-12 medium-9 columns"><?php echo esc_attr( $feature['title'] ); ?></div>
							<div class="small-12 medium-3 columns show-for-medium"><?php echo esc_attr( $feature['feature_score'] ); ?></div>
						</div>
						<div class="thb-progress" data-progress="<?php echo esc_attr( 10 * $feature['feature_score'] ); ?>">
							<span></span>
						</div>
					</li>
					<?php
				}
			}
			?>
			</ul>
			<div class="row">
				<div class="small-12 medium-9 columns">
					<div class="row">
						<div class="small-12 medium-6 columns comment_section">
							<span class="post_comment good"><?php esc_html_e( 'The Good', 'thevoux' ); ?></span>
							<?php
							if ( $comments ) {
								foreach ( $comments as $comment ) {
									if ( 'positive' === $comment['feature_comment_type'] ) {
										?>
										<p class="positive"><?php echo esc_attr( $comment['title'] ); ?></p>
										<?php
									}
								}
							}
							?>
						</div>
						<div class="small-12 medium-6 columns comment_section">
							<span class="post_comment bad"><?php esc_html_e( 'The Bad', 'thevoux' ); ?></span>
							<?php
							if ( $comments ) {
								foreach ( $comments as $comment ) {
									if ( 'negative' === $comment['feature_comment_type'] ) {
										?>
										<p class="negative"><?php echo esc_attr( $comment['title'] ); ?></p>
										<?php
									}
								}
							}
							?>
						</div>
					</div>
				</div>
				<?php if ( $features ) { ?>
				<div class="small-12 medium-3 columns">
					<figure class="average" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<div class="thb-counter single-decimal">
							<div class="counter" data-count="<?php echo esc_html( round( $total / $count, 1 ) ); ?>" data-speed="1000">0</div>
						</div>
						<span itemprop="ratingValue" class="hide"><?php echo esc_html( round( $total / $count, 1 ) ); ?></span><span class="hide" itemprop="bestRating">10</span>
					</figure>
				</div>
				<?php } ?>
				<span class="hide" itemprop="author" itemscope itemtype="http://schema.org/Person">
					<span itemprop="name"><?php the_author_meta( 'display_name', $thb_id ); ?></span>
				</span>
			</div>
		</div>
		<?php
	}
}
add_action( 'thb_post_review', 'thb_post_review' );
