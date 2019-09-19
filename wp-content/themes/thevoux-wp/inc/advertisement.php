<?php

function thb_adv_before_header() {
  $adv_before_header = ot_get_option( 'adv_before_header' );

  if ( $adv_before_header && '' !== $adv_before_header ) {
    echo '<aside class="thb_ad_before_header">' . do_shortcode( $adv_before_header ) . '</aside>';
  }
}
add_action( 'thb_adv_before_header', 'thb_adv_before_header', 10 );

function thb_adv_headerstyle1_left() {
  $adv_headerstyle1_left = ot_get_option( 'adv_headerstyle1_left' );

  if ( $adv_headerstyle1_left && '' !== $adv_headerstyle1_left ) {
    echo '<aside class="thb_ad_header show-for-medium">' . do_shortcode( $adv_headerstyle1_left ) . '</aside>';
  }
}
add_action( 'thb_adv_headerstyle1_left', 'thb_adv_headerstyle1_left', 10 );

function thb_adv_headerstyle3() {
  $adv_headerstyle3 = ot_get_option( 'adv_headerstyle3' );

  if ( $adv_headerstyle3 && '' !== $adv_headerstyle3 ) {
    echo '<aside class="thb_ad_header show-for-large">' . do_shortcode( $adv_headerstyle3 ) . '</aside>';
  }
}
add_action( 'thb_adv_headerstyle3', 'thb_adv_headerstyle3', 10 );

function thb_adv_gallery_header( $i ) {
  $adv_lightbox_header = ot_get_option( 'adv_lightbox_header' );

  if ( ! is_array( $adv_lightbox_header ) ) {
    return;
  }

  $adv_size = count( $adv_lightbox_header );

  if ( $i + 1 > $adv_size) {
    $i = $i % $adv_size;
  }

  if ( isset( $adv_lightbox_header[ $i ] ) && '' !== $adv_lightbox_header[ $i ]['ad_code'] ) {
    echo '<aside class="ad_container_gallery_header thb-ad-position-' . esc_attr( $i ) . '">';
    echo do_shortcode( $adv_lightbox_header[ $i ]['ad_code'] );
    echo '</aside>';
  }
}
add_action( 'thb_adv_gallery_header', 'thb_adv_gallery_header', 10, 1 );

function thb_adv_lightbox_sidebar( $i ) {
  $adv_lightbox_sidebar = ot_get_option( 'adv_lightbox_sidebar' );

  if ( ! is_array( $adv_lightbox_sidebar ) ) {
    return;
  }

  $adv_size = count( $adv_lightbox_sidebar );

  if ( $i + 1 > $adv_size ) {
    $i = $i % $adv_size;
  }

  if ( isset( $adv_lightbox_sidebar[ $i ] ) && '' !== $adv_lightbox_sidebar[ $i ]['ad_code'] ) {
    echo '<aside class="ad_container_gallery_sidebar thb-ad-position-' . esc_attr( $i ) . '">';
    echo do_shortcode( $adv_lightbox_sidebar[ $i ]['ad_code'] );
    echo '</aside>';
  }
}
add_action( 'thb_adv_lightbox_sidebar', 'thb_adv_lightbox_sidebar', 10, 1 );

// Articles.
function thb_ads_before_title() {
  $adv_before_title = ot_get_option( 'adv_before_title' );
  if ( $adv_before_title && '' !== $adv_before_title ) {
    echo '<aside class="ad_before_title cf">' . do_shortcode( $adv_before_title ) . '</aside>';
  }
}
add_action( 'thb_ads_before_title', 'thb_ads_before_title', 10 );

function thb_ads_before_content() {
  $adv_before_content = ot_get_option( 'adv_before_content' );
  if ( $adv_before_content && '' !== $adv_before_content ) {
    echo '<aside class="ad_before_content">' . do_shortcode( $adv_before_content ) . '</aside>';
  }
}
add_action( 'thb_ads_before_content', 'thb_ads_before_content', 10 );

function thb_ads_after_content() {
  $adv_after_content = ot_get_option( 'adv_after_content' );
  if ( $adv_after_content && '' !== $adv_after_content ) {
    echo '<aside class="ad_after_content cf">' . do_shortcode( $adv_after_content ) . '</aside>';
  }
}
add_action( 'thb_ads_after_content', 'thb_ads_after_content', 10 );

function thb_ads_after_article() {
  $adv_postend = ot_get_option( 'adv_postend' );
  if ( $adv_postend && '' !== $adv_postend ) {
    echo '<aside class="ad_container_bottom cf">' . do_shortcode( $adv_postend ) . '</aside>';
  }
}
add_action( 'thb_ads_after_article', 'thb_ads_after_article', 10 );

function thb_ads_after_article_ajax() {
  $adv_postend_ajax = ot_get_option( 'adv_postend_ajax' );
  if ( $adv_postend_ajax && '' !== $adv_postend_ajax ) {
    echo '<aside class="ad_container_bottom cf">' . do_shortcode( $adv_postend_ajax ) . '</aside>';
  }
}
add_action( 'thb_ads_after_article_ajax', 'thb_ads_after_article_ajax', 10 );
