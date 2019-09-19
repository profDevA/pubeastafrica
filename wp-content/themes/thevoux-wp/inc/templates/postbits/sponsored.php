<?php
$post_sponsors_selected = get_the_terms(get_the_ID(),'thb-sponsors');

if ( false !== $post_sponsors_selected && ! empty( $post_sponsors_selected ) && is_array($post_sponsors_selected)) { ?>
<aside class="thb-article-sponsors">
  <?php foreach ( $post_sponsors_selected as $sponsor_id ) { ?>
		<?php

      $sponsor = get_term( $sponsor_id );
      $thb_sponsor_logo_image = get_term_meta( $sponsor->term_id, 'thb_sponsor_logo_image', true );
		  $thb_sponsor_url = get_term_meta( $sponsor->term_id, 'thb_sponsor_url', true );
    ?>
    <div class="thb-sponsor">
      <div class="sponsored-by"><?php esc_html_e('Sponsored by', 'thevoux' ); ?></div>
      <?php if ( ! empty( $thb_sponsor_url ) ) { ?> <a href="<?php echo esc_url( $thb_sponsor_url );?>" target="_blank" rel="nofollow"><?php } ?>
			     <div class="thb-sponsor-logo"><?php echo wp_get_attachment_image( $thb_sponsor_logo_image, 'thb-sponsor-x2' ); ?></div>
			<?php if ( ! empty( $thb_sponsor_url ) ) { ?> </a><?php } ?>
      <?php if ( ! empty( $sponsor -> description ) ) { ?>
				<p class="thb-sponsor-text"><?php echo( esc_html( $sponsor-> description ) ); ?></p>
			<?php } ?>
    </div>
  <?php } ?>
</aside>
<?php } ?>
