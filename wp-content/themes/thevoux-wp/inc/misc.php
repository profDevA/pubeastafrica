<?php
// Adds custom classes to the array of body classes.
function thb_body_classes( $classes ) {
	$classes[] = 'article-dropcap-' . ot_get_option( 'article_dropcap', 'on' );
	$classes[] = 'thb-borders-' . ot_get_option( 'site_borders', 'off' );
	$classes[] = 'thb-rounded-forms-' . ot_get_option( 'rounded_forms', 'off' );
	$classes[] = 'social_black-' . ot_get_option( 'social_black', 'off' );
	$classes[] = 'header_submenu_color-' . ot_get_option( 'header_submenu_color', 'light' );
	$classes[] = 'mobile_menu_animation-' . ot_get_option( 'mobile_menu_animation' );
	$classes[] = 'header-submenu-' . ot_get_option( 'header_submenu_style', 'style1' );
	$classes[] = 'thb-pinit-' . ot_get_option( 'thb_pinit', 'on' );
	$classes[] = 'thb-single-product-ajax-' . ot_get_option( 'shop_product_ajax_addtocart', 'on' );
	return $classes;
}
add_filter( 'body_class', 'thb_body_classes' );

// Youtube & Vimeo Embeds.
function thb_remove_youtube_controls( $code ) {
  if ( strpos( $code, 'youtu.be' ) !== false || strpos( $code, 'youtube.com') !== false || strpos( $code, 'player.vimeo.com' ) !== false ){
		if ( strpos( $code, 'youtu.be' ) !== false || strpos( $code, 'youtube.com') !== false ) {
    	$return = preg_replace("@src=(['\"])?([^'\">\s]*)@", 'src=$1$2&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3&playsinline=1&enablejsapi=1', $code);
		} else {
    	$return = $code;
		}
    $return = '<div class="flex-video widescreen' . ( strpos( $code, 'player.vimeo.com' ) !== false ? ' vimeo' : ' youtube').'">' . $return . '</div>';
  } else {
    $return = $code;
  }
  return $return;
}

add_filter( 'embed_handler_html', 'thb_remove_youtube_controls' );
add_filter( 'embed_oembed_html', 'thb_remove_youtube_controls' );

add_filter( 'wp_video_shortcode_library','thb_no_mediaelement' );

function thb_no_mediaelement() {
  return '';
}

// Author FB, TW & G+ Links.
function thb_my_new_contactmethods( $contactmethods ) {
	// Add Position.
	$contactmethods['position'] = esc_html__( 'Position', 'thevoux' );
	// Add Twitter.
	$contactmethods['twitter'] = esc_html__( 'Twitter URL', 'thevoux' );
	// Add Facebook.
	$contactmethods['facebook'] = esc_html__( 'Facebook URL', 'thevoux' );
	// Add Instagram.
	$contactmethods['instagram'] = esc_html__( 'Instagram Profile URL', 'thevoux' );

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'thb_my_new_contactmethods', 10, 1 );

// Font Awesome Array.
function thb_getIconArray(){
	$icons = array(
		'' => '', 'fa-glass' => 'fa-glass', 'fa-music' => 'fa-music', 'fa-search' => 'fa-search', 'fa-envelope-o' => 'fa-envelope-o', 'fa-heart' => 'fa-heart', 'fa-star' => 'fa-star', 'fa-star-o' => 'fa-star-o', 'fa-user' => 'fa-user', 'fa-film' => 'fa-film', 'fa-th-large' => 'fa-th-large', 'fa-th' => 'fa-th', 'fa-th-list' => 'fa-th-list', 'fa-check' => 'fa-check', 'fa-times' => 'fa-times', 'fa-search-plus' => 'fa-search-plus', 'fa-search-minus' => 'fa-search-minus', 'fa-power-off' => 'fa-power-off', 'fa-signal' => 'fa-signal', 'fa-cog' => 'fa-cog', 'fa-trash-o' => 'fa-trash-o', 'fa-home' => 'fa-home', 'fa-file-o' => 'fa-file-o', 'fa-clock-o' => 'fa-clock-o', 'fa-road' => 'fa-road', 'fa-download' => 'fa-download', 'fa-arrow-circle-o-down' => 'fa-arrow-circle-o-down', 'fa-arrow-circle-o-up' => 'fa-arrow-circle-o-up', 'fa-inbox' => 'fa-inbox', 'fa-play-circle-o' => 'fa-play-circle-o', 'fa-repeat' => 'fa-repeat', 'fa-refresh' => 'fa-refresh', 'fa-list-alt' => 'fa-list-alt', 'fa-lock' => 'fa-lock', 'fa-flag' => 'fa-flag', 'fa-headphones' => 'fa-headphones', 'fa-volume-off' => 'fa-volume-off', 'fa-volume-down' => 'fa-volume-down', 'fa-volume-up' => 'fa-volume-up', 'fa-qrcode' => 'fa-qrcode', 'fa-barcode' => 'fa-barcode', 'fa-tag' => 'fa-tag', 'fa-tags' => 'fa-tags', 'fa-book' => 'fa-book', 'fa-bookmark' => 'fa-bookmark', 'fa-print' => 'fa-print', 'fa-camera' => 'fa-camera', 'fa-font' => 'fa-font', 'fa-bold' => 'fa-bold', 'fa-italic' => 'fa-italic', 'fa-text-height' => 'fa-text-height', 'fa-text-width' => 'fa-text-width', 'fa-align-left' => 'fa-align-left', 'fa-align-center' => 'fa-align-center', 'fa-align-right' => 'fa-align-right', 'fa-align-justify' => 'fa-align-justify', 'fa-list' => 'fa-list', 'fa-outdent' => 'fa-outdent', 'fa-indent' => 'fa-indent', 'fa-video-camera' => 'fa-video-camera', 'fa-picture-o' => 'fa-picture-o', 'fa-pencil' => 'fa-pencil', 'fa-map-marker' => 'fa-map-marker', 'fa-adjust' => 'fa-adjust', 'fa-tint' => 'fa-tint', 'fa-pencil-square-o' => 'fa-pencil-square-o', 'fa-share-square-o' => 'fa-share-square-o', 'fa-check-square-o' => 'fa-check-square-o', 'fa-arrows' => 'fa-arrows', 'fa-step-backward' => 'fa-step-backward', 'fa-fast-backward' => 'fa-fast-backward', 'fa-backward' => 'fa-backward', 'fa-play' => 'fa-play', 'fa-pause' => 'fa-pause', 'fa-stop' => 'fa-stop', 'fa-forward' => 'fa-forward', 'fa-fast-forward' => 'fa-fast-forward', 'fa-step-forward' => 'fa-step-forward', 'fa-eject' => 'fa-eject', 'fa-chevron-left' => 'fa-chevron-left', 'fa-chevron-right' => 'fa-chevron-right', 'fa-plus-circle' => 'fa-plus-circle', 'fa-minus-circle' => 'fa-minus-circle', 'fa-times-circle' => 'fa-times-circle', 'fa-check-circle' => 'fa-check-circle', 'fa-question-circle' => 'fa-question-circle', 'fa-info-circle' => 'fa-info-circle', 'fa-crosshairs' => 'fa-crosshairs', 'fa-times-circle-o' => 'fa-times-circle-o', 'fa-check-circle-o' => 'fa-check-circle-o', 'fa-ban' => 'fa-ban', 'fa-arrow-left' => 'fa-arrow-left', 'fa-arrow-right' => 'fa-arrow-right', 'fa-arrow-up' => 'fa-arrow-up', 'fa-arrow-down' => 'fa-arrow-down', 'fa-share' => 'fa-share', 'fa-expand' => 'fa-expand', 'fa-compress' => 'fa-compress', 'fa-plus' => 'fa-plus', 'fa-minus' => 'fa-minus', 'fa-asterisk' => 'fa-asterisk', 'fa-exclamation-circle' => 'fa-exclamation-circle', 'fa-gift' => 'fa-gift', 'fa-leaf' => 'fa-leaf', 'fa-fire' => 'fa-fire', 'fa-eye' => 'fa-eye', 'fa-eye-slash' => 'fa-eye-slash', 'fa-exclamation-triangle' => 'fa-exclamation-triangle', 'fa-plane' => 'fa-plane', 'fa-calendar' => 'fa-calendar', 'fa-random' => 'fa-random', 'fa-comment' => 'fa-comment', 'fa-magnet' => 'fa-magnet', 'fa-chevron-up' => 'fa-chevron-up', 'fa-chevron-down' => 'fa-chevron-down', 'fa-retweet' => 'fa-retweet', 'fa-shopping-cart' => 'fa-shopping-cart', 'fa-folder' => 'fa-folder', 'fa-folder-open' => 'fa-folder-open', 'fa-arrows-v' => 'fa-arrows-v', 'fa-arrows-h' => 'fa-arrows-h', 'fa-bar-chart' => 'fa-bar-chart', 'fa-twitter-square' => 'fa-twitter-square', 'fa-facebook-square' => 'fa-facebook-square', 'fa-camera-retro' => 'fa-camera-retro', 'fa-key' => 'fa-key', 'fa-cogs' => 'fa-cogs', 'fa-comments' => 'fa-comments', 'fa-thumbs-o-up' => 'fa-thumbs-o-up', 'fa-thumbs-o-down' => 'fa-thumbs-o-down', 'fa-star-half' => 'fa-star-half', 'fa-heart-o' => 'fa-heart-o', 'fa-sign-out' => 'fa-sign-out', 'fa-linkedin-square' => 'fa-linkedin-square', 'fa-thumb-tack' => 'fa-thumb-tack', 'fa-external-link' => 'fa-external-link', 'fa-sign-in' => 'fa-sign-in', 'fa-trophy' => 'fa-trophy', 'fa-github-square' => 'fa-github-square', 'fa-upload' => 'fa-upload', 'fa-lemon-o' => 'fa-lemon-o', 'fa-phone' => 'fa-phone', 'fa-square-o' => 'fa-square-o', 'fa-bookmark-o' => 'fa-bookmark-o', 'fa-phone-square' => 'fa-phone-square', 'fa-twitter' => 'fa-twitter', 'fa-facebook' => 'fa-facebook', 'fa-github' => 'fa-github', 'fa-unlock' => 'fa-unlock', 'fa-credit-card' => 'fa-credit-card', 'fa-rss' => 'fa-rss', 'fa-hdd-o' => 'fa-hdd-o', 'fa-bullhorn' => 'fa-bullhorn', 'fa-bell' => 'fa-bell', 'fa-certificate' => 'fa-certificate', 'fa-hand-o-right' => 'fa-hand-o-right', 'fa-hand-o-left' => 'fa-hand-o-left', 'fa-hand-o-up' => 'fa-hand-o-up', 'fa-hand-o-down' => 'fa-hand-o-down', 'fa-arrow-circle-left' => 'fa-arrow-circle-left', 'fa-arrow-circle-right' => 'fa-arrow-circle-right', 'fa-arrow-circle-up' => 'fa-arrow-circle-up', 'fa-arrow-circle-down' => 'fa-arrow-circle-down', 'fa-globe' => 'fa-globe', 'fa-wrench' => 'fa-wrench', 'fa-tasks' => 'fa-tasks', 'fa-filter' => 'fa-filter', 'fa-briefcase' => 'fa-briefcase', 'fa-arrows-alt' => 'fa-arrows-alt', 'fa-users' => 'fa-users', 'fa-link' => 'fa-link', 'fa-cloud' => 'fa-cloud', 'fa-flask' => 'fa-flask', 'fa-scissors' => 'fa-scissors', 'fa-files-o' => 'fa-files-o', 'fa-paperclip' => 'fa-paperclip', 'fa-floppy-o' => 'fa-floppy-o', 'fa-square' => 'fa-square', 'fa-bars' => 'fa-bars', 'fa-list-ul' => 'fa-list-ul', 'fa-list-ol' => 'fa-list-ol', 'fa-strikethrough' => 'fa-strikethrough', 'fa-underline' => 'fa-underline', 'fa-table' => 'fa-table', 'fa-magic' => 'fa-magic', 'fa-truck' => 'fa-truck', 'fa-pinterest' => 'fa-pinterest', 'fa-pinterest-square' => 'fa-pinterest-square', 'fa-google-plus-square' => 'fa-google-plus-square', 'fa-google-plus' => 'fa-google-plus', 'fa-money' => 'fa-money', 'fa-caret-down' => 'fa-caret-down', 'fa-caret-up' => 'fa-caret-up', 'fa-caret-left' => 'fa-caret-left', 'fa-caret-right' => 'fa-caret-right', 'fa-columns' => 'fa-columns', 'fa-sort' => 'fa-sort', 'fa-sort-desc' => 'fa-sort-desc', 'fa-sort-asc' => 'fa-sort-asc', 'fa-envelope' => 'fa-envelope', 'fa-linkedin' => 'fa-linkedin', 'fa-undo' => 'fa-undo', 'fa-gavel' => 'fa-gavel', 'fa-tachometer' => 'fa-tachometer', 'fa-comment-o' => 'fa-comment-o', 'fa-comments-o' => 'fa-comments-o', 'fa-bolt' => 'fa-bolt', 'fa-sitemap' => 'fa-sitemap', 'fa-umbrella' => 'fa-umbrella', 'fa-clipboard' => 'fa-clipboard', 'fa-lightbulb-o' => 'fa-lightbulb-o', 'fa-exchange' => 'fa-exchange', 'fa-cloud-download' => 'fa-cloud-download', 'fa-cloud-upload' => 'fa-cloud-upload', 'fa-user-md' => 'fa-user-md', 'fa-stethoscope' => 'fa-stethoscope', 'fa-suitcase' => 'fa-suitcase', 'fa-bell-o' => 'fa-bell-o', 'fa-coffee' => 'fa-coffee', 'fa-cutlery' => 'fa-cutlery', 'fa-file-text-o' => 'fa-file-text-o', 'fa-building-o' => 'fa-building-o', 'fa-hospital-o' => 'fa-hospital-o', 'fa-ambulance' => 'fa-ambulance', 'fa-medkit' => 'fa-medkit', 'fa-fighter-jet' => 'fa-fighter-jet', 'fa-beer' => 'fa-beer', 'fa-h-square' => 'fa-h-square', 'fa-plus-square' => 'fa-plus-square', 'fa-angle-double-left' => 'fa-angle-double-left', 'fa-angle-double-right' => 'fa-angle-double-right', 'fa-angle-double-up' => 'fa-angle-double-up', 'fa-angle-double-down' => 'fa-angle-double-down', 'fa-angle-left' => 'fa-angle-left', 'fa-angle-right' => 'fa-angle-right', 'fa-angle-up' => 'fa-angle-up', 'fa-angle-down' => 'fa-angle-down', 'fa-desktop' => 'fa-desktop', 'fa-laptop' => 'fa-laptop', 'fa-tablet' => 'fa-tablet', 'fa-mobile' => 'fa-mobile', 'fa-circle-o' => 'fa-circle-o', 'fa-quote-left' => 'fa-quote-left', 'fa-quote-right' => 'fa-quote-right', 'fa-spinner' => 'fa-spinner', 'fa-circle' => 'fa-circle', 'fa-reply' => 'fa-reply', 'fa-github-alt' => 'fa-github-alt', 'fa-folder-o' => 'fa-folder-o', 'fa-folder-open-o' => 'fa-folder-open-o', 'fa-smile-o' => 'fa-smile-o', 'fa-frown-o' => 'fa-frown-o', 'fa-meh-o' => 'fa-meh-o', 'fa-gamepad' => 'fa-gamepad', 'fa-keyboard-o' => 'fa-keyboard-o', 'fa-flag-o' => 'fa-flag-o', 'fa-flag-checkered' => 'fa-flag-checkered', 'fa-terminal' => 'fa-terminal', 'fa-code' => 'fa-code', 'fa-reply-all' => 'fa-reply-all', 'fa-star-half-o' => 'fa-star-half-o', 'fa-location-arrow' => 'fa-location-arrow', 'fa-crop' => 'fa-crop', 'fa-code-fork' => 'fa-code-fork', 'fa-chain-broken' => 'fa-chain-broken', 'fa-question' => 'fa-question', 'fa-info' => 'fa-info', 'fa-exclamation' => 'fa-exclamation', 'fa-superscript' => 'fa-superscript', 'fa-subscript' => 'fa-subscript', 'fa-eraser' => 'fa-eraser', 'fa-puzzle-piece' => 'fa-puzzle-piece', 'fa-microphone' => 'fa-microphone', 'fa-microphone-slash' => 'fa-microphone-slash', 'fa-shield' => 'fa-shield', 'fa-calendar-o' => 'fa-calendar-o', 'fa-fire-extinguisher' => 'fa-fire-extinguisher', 'fa-rocket' => 'fa-rocket', 'fa-maxcdn' => 'fa-maxcdn', 'fa-chevron-circle-left' => 'fa-chevron-circle-left', 'fa-chevron-circle-right' => 'fa-chevron-circle-right', 'fa-chevron-circle-up' => 'fa-chevron-circle-up', 'fa-chevron-circle-down' => 'fa-chevron-circle-down', 'fa-html5' => 'fa-html5', 'fa-css3' => 'fa-css3', 'fa-anchor' => 'fa-anchor', 'fa-unlock-alt' => 'fa-unlock-alt', 'fa-bullseye' => 'fa-bullseye', 'fa-ellipsis-h' => 'fa-ellipsis-h', 'fa-ellipsis-v' => 'fa-ellipsis-v', 'fa-rss-square' => 'fa-rss-square', 'fa-play-circle' => 'fa-play-circle', 'fa-ticket' => 'fa-ticket', 'fa-minus-square' => 'fa-minus-square', 'fa-minus-square-o' => 'fa-minus-square-o', 'fa-level-up' => 'fa-level-up', 'fa-level-down' => 'fa-level-down', 'fa-check-square' => 'fa-check-square', 'fa-pencil-square' => 'fa-pencil-square', 'fa-external-link-square' => 'fa-external-link-square', 'fa-share-square' => 'fa-share-square', 'fa-compass' => 'fa-compass', 'fa-caret-square-o-down' => 'fa-caret-square-o-down', 'fa-caret-square-o-up' => 'fa-caret-square-o-up', 'fa-caret-square-o-right' => 'fa-caret-square-o-right', 'fa-eur' => 'fa-eur', 'fa-gbp' => 'fa-gbp', 'fa-usd' => 'fa-usd', 'fa-inr' => 'fa-inr', 'fa-jpy' => 'fa-jpy', 'fa-rub' => 'fa-rub', 'fa-krw' => 'fa-krw', 'fa-btc' => 'fa-btc', 'fa-file' => 'fa-file', 'fa-file-text' => 'fa-file-text', 'fa-sort-alpha-asc' => 'fa-sort-alpha-asc', 'fa-sort-alpha-desc' => 'fa-sort-alpha-desc', 'fa-sort-amount-asc' => 'fa-sort-amount-asc', 'fa-sort-amount-desc' => 'fa-sort-amount-desc', 'fa-sort-numeric-asc' => 'fa-sort-numeric-asc', 'fa-sort-numeric-desc' => 'fa-sort-numeric-desc', 'fa-thumbs-up' => 'fa-thumbs-up', 'fa-thumbs-down' => 'fa-thumbs-down', 'fa-youtube-square' => 'fa-youtube-square', 'fa-youtube' => 'fa-youtube', 'fa-xing' => 'fa-xing', 'fa-xing-square' => 'fa-xing-square', 'fa-youtube-play' => 'fa-youtube-play', 'fa-dropbox' => 'fa-dropbox', 'fa-stack-overflow' => 'fa-stack-overflow', 'fa-instagram' => 'fa-instagram', 'fa-flickr' => 'fa-flickr', 'fa-adn' => 'fa-adn', 'fa-bitbucket' => 'fa-bitbucket', 'fa-bitbucket-square' => 'fa-bitbucket-square', 'fa-tumblr' => 'fa-tumblr', 'fa-tumblr-square' => 'fa-tumblr-square', 'fa-long-arrow-down' => 'fa-long-arrow-down', 'fa-long-arrow-up' => 'fa-long-arrow-up', 'fa-long-arrow-left' => 'fa-long-arrow-left', 'fa-long-arrow-right' => 'fa-long-arrow-right', 'fa-apple' => 'fa-apple', 'fa-windows' => 'fa-windows', 'fa-android' => 'fa-android', 'fa-linux' => 'fa-linux', 'fa-dribbble' => 'fa-dribbble', 'fa-skype' => 'fa-skype', 'fa-foursquare' => 'fa-foursquare', 'fa-trello' => 'fa-trello', 'fa-female' => 'fa-female', 'fa-male' => 'fa-male', 'fa-gratipay' => 'fa-gratipay', 'fa-sun-o' => 'fa-sun-o', 'fa-moon-o' => 'fa-moon-o', 'fa-archive' => 'fa-archive', 'fa-bug' => 'fa-bug', 'fa-vk' => 'fa-vk', 'fa-weibo' => 'fa-weibo', 'fa-renren' => 'fa-renren', 'fa-pagelines' => 'fa-pagelines', 'fa-stack-exchange' => 'fa-stack-exchange', 'fa-arrow-circle-o-right' => 'fa-arrow-circle-o-right', 'fa-arrow-circle-o-left' => 'fa-arrow-circle-o-left', 'fa-caret-square-o-left' => 'fa-caret-square-o-left', 'fa-dot-circle-o' => 'fa-dot-circle-o', 'fa-wheelchair' => 'fa-wheelchair', 'fa-vimeo-square' => 'fa-vimeo-square', 'fa-try' => 'fa-try', 'fa-plus-square-o' => 'fa-plus-square-o', 'fa-space-shuttle' => 'fa-space-shuttle', 'fa-slack' => 'fa-slack', 'fa-envelope-square' => 'fa-envelope-square', 'fa-wordpress' => 'fa-wordpress', 'fa-openid' => 'fa-openid', 'fa-university' => 'fa-university', 'fa-graduation-cap' => 'fa-graduation-cap', 'fa-yahoo' => 'fa-yahoo', 'fa-google' => 'fa-google', 'fa-reddit' => 'fa-reddit', 'fa-reddit-square' => 'fa-reddit-square', 'fa-stumbleupon-circle' => 'fa-stumbleupon-circle', 'fa-stumbleupon' => 'fa-stumbleupon', 'fa-delicious' => 'fa-delicious', 'fa-digg' => 'fa-digg', 'fa-pied-piper-pp' => 'fa-pied-piper-pp', 'fa-pied-piper-alt' => 'fa-pied-piper-alt', 'fa-drupal' => 'fa-drupal', 'fa-joomla' => 'fa-joomla', 'fa-language' => 'fa-language', 'fa-fax' => 'fa-fax', 'fa-building' => 'fa-building', 'fa-child' => 'fa-child', 'fa-paw' => 'fa-paw', 'fa-spoon' => 'fa-spoon', 'fa-cube' => 'fa-cube', 'fa-cubes' => 'fa-cubes', 'fa-behance' => 'fa-behance', 'fa-behance-square' => 'fa-behance-square', 'fa-steam' => 'fa-steam', 'fa-steam-square' => 'fa-steam-square', 'fa-recycle' => 'fa-recycle', 'fa-car' => 'fa-car', 'fa-taxi' => 'fa-taxi', 'fa-tree' => 'fa-tree', 'fa-spotify' => 'fa-spotify', 'fa-deviantart' => 'fa-deviantart', 'fa-soundcloud' => 'fa-soundcloud', 'fa-database' => 'fa-database', 'fa-file-pdf-o' => 'fa-file-pdf-o', 'fa-file-word-o' => 'fa-file-word-o', 'fa-file-excel-o' => 'fa-file-excel-o', 'fa-file-powerpoint-o' => 'fa-file-powerpoint-o', 'fa-file-image-o' => 'fa-file-image-o', 'fa-file-archive-o' => 'fa-file-archive-o', 'fa-file-audio-o' => 'fa-file-audio-o', 'fa-file-video-o' => 'fa-file-video-o', 'fa-file-code-o' => 'fa-file-code-o', 'fa-vine' => 'fa-vine', 'fa-codepen' => 'fa-codepen', 'fa-jsfiddle' => 'fa-jsfiddle', 'fa-life-ring' => 'fa-life-ring', 'fa-circle-o-notch' => 'fa-circle-o-notch', 'fa-rebel' => 'fa-rebel', 'fa-empire' => 'fa-empire', 'fa-git-square' => 'fa-git-square', 'fa-git' => 'fa-git', 'fa-hacker-news' => 'fa-hacker-news', 'fa-tencent-weibo' => 'fa-tencent-weibo', 'fa-qq' => 'fa-qq', 'fa-weixin' => 'fa-weixin', 'fa-paper-plane' => 'fa-paper-plane', 'fa-paper-plane-o' => 'fa-paper-plane-o', 'fa-history' => 'fa-history', 'fa-circle-thin' => 'fa-circle-thin', 'fa-header' => 'fa-header', 'fa-paragraph' => 'fa-paragraph', 'fa-sliders' => 'fa-sliders', 'fa-share-alt' => 'fa-share-alt', 'fa-share-alt-square' => 'fa-share-alt-square', 'fa-bomb' => 'fa-bomb', 'fa-futbol-o' => 'fa-futbol-o', 'fa-tty' => 'fa-tty', 'fa-binoculars' => 'fa-binoculars', 'fa-plug' => 'fa-plug', 'fa-slideshare' => 'fa-slideshare', 'fa-twitch' => 'fa-twitch', 'fa-yelp' => 'fa-yelp', 'fa-newspaper-o' => 'fa-newspaper-o', 'fa-wifi' => 'fa-wifi', 'fa-calculator' => 'fa-calculator', 'fa-paypal' => 'fa-paypal', 'fa-google-wallet' => 'fa-google-wallet', 'fa-cc-visa' => 'fa-cc-visa', 'fa-cc-mastercard' => 'fa-cc-mastercard', 'fa-cc-discover' => 'fa-cc-discover', 'fa-cc-amex' => 'fa-cc-amex', 'fa-cc-paypal' => 'fa-cc-paypal', 'fa-cc-stripe' => 'fa-cc-stripe', 'fa-bell-slash' => 'fa-bell-slash', 'fa-bell-slash-o' => 'fa-bell-slash-o', 'fa-trash' => 'fa-trash', 'fa-copyright' => 'fa-copyright', 'fa-at' => 'fa-at', 'fa-eyedropper' => 'fa-eyedropper', 'fa-paint-brush' => 'fa-paint-brush', 'fa-birthday-cake' => 'fa-birthday-cake', 'fa-area-chart' => 'fa-area-chart', 'fa-pie-chart' => 'fa-pie-chart', 'fa-line-chart' => 'fa-line-chart', 'fa-lastfm' => 'fa-lastfm', 'fa-lastfm-square' => 'fa-lastfm-square', 'fa-toggle-off' => 'fa-toggle-off', 'fa-toggle-on' => 'fa-toggle-on', 'fa-bicycle' => 'fa-bicycle', 'fa-bus' => 'fa-bus', 'fa-ioxhost' => 'fa-ioxhost', 'fa-angellist' => 'fa-angellist', 'fa-cc' => 'fa-cc', 'fa-ils' => 'fa-ils', 'fa-meanpath' => 'fa-meanpath', 'fa-buysellads' => 'fa-buysellads', 'fa-connectdevelop' => 'fa-connectdevelop', 'fa-dashcube' => 'fa-dashcube', 'fa-forumbee' => 'fa-forumbee', 'fa-leanpub' => 'fa-leanpub', 'fa-sellsy' => 'fa-sellsy', 'fa-shirtsinbulk' => 'fa-shirtsinbulk', 'fa-simplybuilt' => 'fa-simplybuilt', 'fa-skyatlas' => 'fa-skyatlas', 'fa-cart-plus' => 'fa-cart-plus', 'fa-cart-arrow-down' => 'fa-cart-arrow-down', 'fa-diamond' => 'fa-diamond', 'fa-ship' => 'fa-ship', 'fa-user-secret' => 'fa-user-secret', 'fa-motorcycle' => 'fa-motorcycle', 'fa-street-view' => 'fa-street-view', 'fa-heartbeat' => 'fa-heartbeat', 'fa-venus' => 'fa-venus', 'fa-mars' => 'fa-mars', 'fa-mercury' => 'fa-mercury', 'fa-transgender' => 'fa-transgender', 'fa-transgender-alt' => 'fa-transgender-alt', 'fa-venus-double' => 'fa-venus-double', 'fa-mars-double' => 'fa-mars-double', 'fa-venus-mars' => 'fa-venus-mars', 'fa-mars-stroke' => 'fa-mars-stroke', 'fa-mars-stroke-v' => 'fa-mars-stroke-v', 'fa-mars-stroke-h' => 'fa-mars-stroke-h', 'fa-neuter' => 'fa-neuter', 'fa-genderless' => 'fa-genderless', 'fa-facebook-official' => 'fa-facebook-official', 'fa-pinterest-p' => 'fa-pinterest-p', 'fa-whatsapp' => 'fa-whatsapp', 'fa-server' => 'fa-server', 'fa-user-plus' => 'fa-user-plus', 'fa-user-times' => 'fa-user-times', 'fa-bed' => 'fa-bed', 'fa-viacoin' => 'fa-viacoin', 'fa-train' => 'fa-train', 'fa-subway' => 'fa-subway', 'fa-medium' => 'fa-medium', 'fa-y-combinator' => 'fa-y-combinator', 'fa-optin-monster' => 'fa-optin-monster', 'fa-opencart' => 'fa-opencart', 'fa-expeditedssl' => 'fa-expeditedssl', 'fa-battery-full' => 'fa-battery-full', 'fa-battery-three-quarters' => 'fa-battery-three-quarters', 'fa-battery-half' => 'fa-battery-half', 'fa-battery-quarter' => 'fa-battery-quarter', 'fa-battery-empty' => 'fa-battery-empty', 'fa-mouse-pointer' => 'fa-mouse-pointer', 'fa-i-cursor' => 'fa-i-cursor', 'fa-object-group' => 'fa-object-group', 'fa-object-ungroup' => 'fa-object-ungroup', 'fa-sticky-note' => 'fa-sticky-note', 'fa-sticky-note-o' => 'fa-sticky-note-o', 'fa-cc-jcb' => 'fa-cc-jcb', 'fa-cc-diners-club' => 'fa-cc-diners-club', 'fa-clone' => 'fa-clone', 'fa-balance-scale' => 'fa-balance-scale', 'fa-hourglass-o' => 'fa-hourglass-o', 'fa-hourglass-start' => 'fa-hourglass-start', 'fa-hourglass-half' => 'fa-hourglass-half', 'fa-hourglass-end' => 'fa-hourglass-end', 'fa-hourglass' => 'fa-hourglass', 'fa-hand-rock-o' => 'fa-hand-rock-o', 'fa-hand-paper-o' => 'fa-hand-paper-o', 'fa-hand-scissors-o' => 'fa-hand-scissors-o', 'fa-hand-lizard-o' => 'fa-hand-lizard-o', 'fa-hand-spock-o' => 'fa-hand-spock-o', 'fa-hand-pointer-o' => 'fa-hand-pointer-o', 'fa-hand-peace-o' => 'fa-hand-peace-o', 'fa-trademark' => 'fa-trademark', 'fa-registered' => 'fa-registered', 'fa-creative-commons' => 'fa-creative-commons', 'fa-gg' => 'fa-gg', 'fa-gg-circle' => 'fa-gg-circle', 'fa-tripadvisor' => 'fa-tripadvisor', 'fa-odnoklassniki' => 'fa-odnoklassniki', 'fa-odnoklassniki-square' => 'fa-odnoklassniki-square', 'fa-get-pocket' => 'fa-get-pocket', 'fa-wikipedia-w' => 'fa-wikipedia-w', 'fa-safari' => 'fa-safari', 'fa-chrome' => 'fa-chrome', 'fa-firefox' => 'fa-firefox', 'fa-opera' => 'fa-opera', 'fa-internet-explorer' => 'fa-internet-explorer', 'fa-television' => 'fa-television', 'fa-contao' => 'fa-contao', 'fa-500px' => 'fa-500px', 'fa-amazon' => 'fa-amazon', 'fa-calendar-plus-o' => 'fa-calendar-plus-o', 'fa-calendar-minus-o' => 'fa-calendar-minus-o', 'fa-calendar-times-o' => 'fa-calendar-times-o', 'fa-calendar-check-o' => 'fa-calendar-check-o', 'fa-industry' => 'fa-industry', 'fa-map-pin' => 'fa-map-pin', 'fa-map-signs' => 'fa-map-signs', 'fa-map-o' => 'fa-map-o', 'fa-map' => 'fa-map', 'fa-commenting' => 'fa-commenting', 'fa-commenting-o' => 'fa-commenting-o', 'fa-houzz' => 'fa-houzz', 'fa-vimeo' => 'fa-vimeo', 'fa-black-tie' => 'fa-black-tie', 'fa-fonticons' => 'fa-fonticons', 'fa-reddit-alien' => 'fa-reddit-alien', 'fa-edge' => 'fa-edge', 'fa-credit-card-alt' => 'fa-credit-card-alt', 'fa-codiepie' => 'fa-codiepie', 'fa-modx' => 'fa-modx', 'fa-fort-awesome' => 'fa-fort-awesome', 'fa-usb' => 'fa-usb', 'fa-product-hunt' => 'fa-product-hunt', 'fa-mixcloud' => 'fa-mixcloud', 'fa-scribd' => 'fa-scribd', 'fa-pause-circle' => 'fa-pause-circle', 'fa-pause-circle-o' => 'fa-pause-circle-o', 'fa-stop-circle' => 'fa-stop-circle', 'fa-stop-circle-o' => 'fa-stop-circle-o', 'fa-shopping-bag' => 'fa-shopping-bag', 'fa-shopping-basket' => 'fa-shopping-basket', 'fa-hashtag' => 'fa-hashtag', 'fa-bluetooth' => 'fa-bluetooth', 'fa-bluetooth-b' => 'fa-bluetooth-b', 'fa-percent' => 'fa-percent', 'fa-gitlab' => 'fa-gitlab', 'fa-wpbeginner' => 'fa-wpbeginner', 'fa-wpforms' => 'fa-wpforms', 'fa-envira' => 'fa-envira', 'fa-universal-access' => 'fa-universal-access', 'fa-wheelchair-alt' => 'fa-wheelchair-alt', 'fa-question-circle-o' => 'fa-question-circle-o', 'fa-blind' => 'fa-blind', 'fa-audio-description' => 'fa-audio-description', 'fa-volume-control-phone' => 'fa-volume-control-phone', 'fa-braille' => 'fa-braille', 'fa-assistive-listening-systems' => 'fa-assistive-listening-systems', 'fa-american-sign-language-interpreting' => 'fa-american-sign-language-interpreting', 'fa-deaf' => 'fa-deaf', 'fa-glide' => 'fa-glide', 'fa-glide-g' => 'fa-glide-g', 'fa-sign-language' => 'fa-sign-language', 'fa-low-vision' => 'fa-low-vision', 'fa-viadeo' => 'fa-viadeo', 'fa-viadeo-square' => 'fa-viadeo-square', 'fa-snapchat' => 'fa-snapchat', 'fa-snapchat-ghost' => 'fa-snapchat-ghost', 'fa-snapchat-square' => 'fa-snapchat-square', 'fa-pied-piper' => 'fa-pied-piper', 'fa-first-order' => 'fa-first-order', 'fa-yoast' => 'fa-yoast', 'fa-themeisle' => 'fa-themeisle', 'fa-google-plus-official' => 'fa-google-plus-official', 'fa-font-awesome' => 'fa-font-awesome'
	);
	return $icons;
}

// Thb Get Columns.
function thb_getColumns( $columns ) {

	switch( $columns ) {
		case 2:
			$col = 'medium-6 large-6';
			break;
		case 3:
			$col = 'medium-4 large-4';
			break;
		case 6:
			$col = 'medium-4 large-2';
			break;
		case 4:
		default:
			$col = 'medium-6 large-3';
			break;
	}

	return $col;
}

// Shorten large numbers into abbreviations (i.e. 1,500 = 1.5k).
function thb_numberAbbreviation( $number ) {
  $abbrevs = array(
		12 => 'T',
		9  => 'B',
		6  => 'M',
		3  => 'K',
		0  => '',
	);

	if ( $number > 999) {
    foreach ( $abbrevs as $exponent => $abbrev ) {
      if ( $number >= pow( 10, $exponent ) ) {
				$display_num = $number / pow( 10, $exponent );
				$decimals    = ( $exponent >= 3 && round( $display_num ) < 100 ) ? 1 : 0;
				return number_format( $display_num, $decimals ) . $abbrev;
      }
    }
	} else {
		return $number;
	}
}

// Excerpts.
add_filter( 'excerpt_length', 'thb_default_excerpt_length' );
add_filter( 'excerpt_more', 'thb_default_excerpt_more' );

function thb_long_excerpt_length() {
	return 55;
}
function thb_default_excerpt_length() {
	return 55;
}
function thb_short_excerpt_length() {
	return 32;
}
function thb_supershort_excerpt_length() {
	return 15;
}
function thb_widget_excerpt_length() {
	return 10;
}
function thb_default_excerpt_more(){
	return '&hellip;';
}
/* Display Title */
function thb_displayTitle( $tag = 'h3', $id = false ) {
	$id = $id ? $id : get_the_ID();
	$frmt = '<div class="post-title"><%s itemprop="headline"><a href="%s" title="%s">%s</a></%s></div>';
	echo sprintf( $frmt, $tag, get_permalink($id), the_title_attribute("echo=0"), get_the_title($id), $tag);
}
add_action( 'thb_displayTitle', 'thb_displayTitle', 10, 2);
// Translate Columns.
function thb_translate_columns( $size ) {
	if ( $size == 6 ) {
		return 'medium-2';
	}	elseif ( $size == 5 ) {
		return 'medium-1/5';
	}	elseif ( $size == 4 ) {
		return 'medium-3';
	}	elseif ( $size == 3 ) {
		return 'medium-4';
	}	elseif ( $size == 2 ) {
		return 'medium-6';
	} else {
		return 'medium-12';
	}
}
// Social.
function thb_fb_information() {
	global $post;
	$sharing_type            = ot_get_option( 'sharing_buttons_article' ) ? ot_get_option( 'sharing_buttons_article' ) : array();
	$general_disable_og_tags = ot_get_option( 'general_disable_og_tags' );

	if ( 'on' !== $general_disable_og_tags ) {
		if ( in_array( 'facebook', $sharing_type, true ) && is_single() ) {
			$image_id = get_post_thumbnail_id();
		  $image_link = wp_get_attachment_image_src( $image_id,'full' );
		  if ( function_exists('wpb_resize') && has_post_thumbnail() ) {
				$image = wpb_resize( $image_id, null, 1200, 630, true );
		  }
			$description = has_excerpt( $post->ID ) ? get_the_excerpt() : wp_trim_words( strip_tags( strip_shortcodes( $post->post_content ) ), 55, '…' );
			?>
			<meta property="og:title" content="<?php the_title_attribute(); ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:description" content="<?php echo esc_html( $description); ?>" />
			<?php if (has_post_thumbnail()) { ?>
				<meta property="og:image" content="<?php echo esc_attr( $image['url'] ); ?>" />
			<?php } ?>
			<meta property="og:url" content="<?php the_permalink(); ?>" />
			<meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo('name' ) ); ?>"/>
			<?php
		}
	}
}
add_action( 'wp_head', 'thb_fb_information' );

// Author Box.
function thb_author($id) {
	$id = $id ? $id : get_the_author_meta( 'ID' );
	?>
	<?php echo get_avatar( $id , '164', '', '', array( 'class' => 'lazyload' ) ); ?>
	<div class="author-content">
		<h5><a href="<?php echo get_author_posts_url( $id ); ?>"><?php the_author_meta('display_name', $id ); ?></a></h5>
		<?php if ( get_the_author_meta( 'position', $id) !== '' ) { ?>
			<h4><?php echo get_the_author_meta( 'position', $id ); ?></h4>
		<?php } ?>
		<p><?php the_author_meta( 'description', $id ); ?></p>
		<?php if ( get_the_author_meta( 'url', $id ) !== '' ) { ?>
			<a href="<?php echo get_the_author_meta( 'url', $id ); ?>" class="boxed-icon fill" target="_blank"><i class="fa fa-link"></i></a>
		<?php } ?>
		<?php if ( get_the_author_meta( 'twitter', $id ) !== '' ) { ?>
			<a href="<?php echo get_the_author_meta( 'twitter', $id ); ?>" class="boxed-icon fill twitter" target="_blank"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if ( get_the_author_meta( 'facebook', $id ) !== '' ) { ?>
			<a href="<?php echo get_the_author_meta( 'facebook', $id ); ?>" class="boxed-icon fill facebook"v><i class="fa fa-facebook"></i></a>
		<?php } ?>
		<?php if ( get_the_author_meta( 'instagram', $id ) !== '' ) { ?>
			<a href="<?php echo get_the_author_meta( 'instagram', $id ); ?>" class="boxed-icon fill instagram" target="_blank"><i class="fa fa-instagram"></i></a>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_author', 'thb_author',3 );

// Gallery Check.
function thb_is_gallery() {
	$format = get_post_format();

	if ( 'gallery' === $format ) {
		echo 'has-gallery';
	} elseif ( 'video' === $format ){
		echo 'has-gallery has-video';
	} else {
		return false;
	}
}
add_action( 'thb_is_gallery', 'thb_is_gallery', 1 );

// Post Icon.
function thb_post_icon() {
	$format    = get_post_format();
	$thb_id    = get_the_ID();
	$is_review = get_post_meta( $thb_id, 'is_review', true ) === 'yes';

	if ( ! ( $format === 'gallery' || $format === 'video' || $is_review ) ) {
		return;
	}
	if ( $is_review) {
		$thb_post_review_average = thb_post_review_average();

		if ( !is_numeric($thb_post_review_average)) {
			return;
		}
	}
	?>
	<div class="thb-post-icon">
		<?php if ( $format === 'gallery' ) { ?>
			<?php
				$post_gallery_photos = get_post_meta( $thb_id, 'post-gallery-photos', true );
				if ( $post_gallery_photos) {
					$post_gallery_photos_arr = explode( ',', $post_gallery_photos );
					$count = count( $post_gallery_photos_arr );
				}
			?>
			<?php get_template_part( 'assets/svg/gallery.svg' ); ?>
			<span class="gallery_count"><?php echo esc_attr( $count ); ?></span>
		<?php } elseif ( $format === 'video' ) { ?>
			<?php get_template_part( 'assets/svg/video.svg' ); ?>
		<?php } elseif ( $is_review ) { ?>
			<span class="review_count"><?php echo esc_attr( $thb_post_review_average ); ?></span>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_post_icon', 'thb_post_icon' );

// Post Meta.
function thb_PostMeta() {
	$logo     = ot_get_option( 'thb_logo', Thb_Theme_Admin::$thb_theme_directory_uri .'assets/img/logo.png' );
	$photo_id = get_post_thumbnail_id();
	$image    = wp_get_attachment_image_src( $photo_id, 'full' );
	?>
	<aside class="post-bottom-meta hide">
		<meta itemprop="mainEntityOfPage" content="<?php the_permalink(); ?>">
		<span class="vcard author" itemprop="author" content="<?php the_author(); ?>">
			<span class="fn"><?php the_author(); ?></span>
		</span>
		<time class="time publised entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" itemprop="datePublished" content="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_attr( get_the_date( ) ); ?></time>
		<meta itemprop="dateModified" class="updated" content="<?php the_modified_date( 'c' ); ?>">
		<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo esc_url( $logo ); ?>">
			</span>
		</span>
		<span itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
			<meta itemprop="url" content="<?php echo esc_attr( $image[0] ); ?>">
			<meta itemprop="width" content="<?php echo esc_attr( $image[1] ); ?>" />
			<meta itemprop="height" content="<?php echo esc_attr( $image[2] ); ?>" />
		</span>
	</aside>
	<?php
}
add_action( 'thb_PostMeta', 'thb_PostMeta' );

// Thb Header Search.
function thb_quick_search() {
	if ( ot_get_option( 'header_search', 'on') === 'off') {
		return;
	}
 ?>
 	<aside class="quick_search">
		<?php get_template_part( 'assets/svg/search.svg' ); ?>
		<?php get_search_form( true ); ?>
	</aside>
<?php
}
add_action( 'thb_quick_search', 'thb_quick_search', 3 );

// Site Borders.
function thb_borders() {
	if ( ot_get_option( 'site_borders', 'off') === 'on' ) {
	?>
	<div class="thb-borders"></div>
	<?php
	}
}
add_action( 'thb_borders', 'thb_borders', 3 );

// Archive Sidebar.
function thb_archive_sidebar() {
	if ( is_author() ) {
		get_sidebar( 'author' );
	} elseif ( is_tag() ) {
		get_sidebar( 'tag' );
	} elseif ( is_category() ) {
		get_sidebar( 'category' );
	} elseif ( is_search() ) {
		get_sidebar( 'archive' );
	} else {
		get_sidebar( 'archive' );
	}
}
add_action( 'thb_archive_sidebar', 'thb_archive_sidebar', 3 );

// Load Template.
function thb_load_template_part( $template_name ) {
	ob_start();
	get_template_part( $template_name );
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

// Page Content.
function thb_page_content( $page ) {
	if ( $page ) {
		$args = array(
	    'page_id'     => $page,
	    'post_status' => 'publish'
		);
		$page_query = new WP_Query($args);
		if ( $page_query->have_posts()) : while ($page_query->have_posts()) : $page_query->the_post();
			the_content();
		endwhile; endif;

		echo '<style>';
		echo get_post_meta( $page, '_wpb_shortcodes_custom_css', true );
		echo '</style>';

		wp_reset_query();
	}
}
add_action( 'thb_page_content', 'thb_page_content', 99, 1 );

// THB Social Icons.
function thb_social() {
 ?>
	<?php if ( ot_get_option( 'fb_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'fb_link' ) ); ?>" class="facebook icon-1x social" target="_blank"><i class="fa fa-facebook"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'pinterest_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'pinterest_link' ) ); ?>" class="pinterest icon-1x social" target="_blank"><i class="fa fa-pinterest"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'twitter_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'twitter_link' ) ); ?>" class="twitter icon-1x social" target="_blank"><i class="fa fa-twitter"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'linkedin_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'linkedin_link' ) ); ?>" class="linkedin icon-1x social" target="_blank"><i class="fa fa-linkedin"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'instragram_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'instragram_link' ) ); ?>" class="instagram icon-1x social" target="_blank"><i class="fa fa-instagram"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'xing_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'xing_link' ) ); ?>" class="xing icon-1x social" target="_blank"><i class="fa fa-xing"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'tumblr_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'tumblr_link' ) ); ?>" class="tumblr icon-1x social" target="_blank"><i class="fa fa-tumblr"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'vk_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'vk_link' ) ); ?>" class="vk icon-1x social" target="_blank"><i class="fa fa-vk"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'soundcloud_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'soundcloud_link' ) ); ?>" class="soundcloud icon-1x social" target="_blank"><i class="fa fa-soundcloud"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'dribbble_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'dribbble_link' ) ); ?>" class="dribbble icon-1x social" target="_blank"><i class="fa fa-dribbble"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'youtube_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'youtube_link' ) ); ?>" class="youtube icon-1x social" target="_blank"><i class="fa fa-youtube-play"></i></a>
	<?php } ?>
	<?php if ( ot_get_option( 'spotify_link' ) ) { ?>
	<a href="<?php echo esc_url( ot_get_option( 'spotify_link' ) ); ?>" class="spotify icon-1x social" target="_blank"><i class="fa fa-spotify"></i></a>
	<?php } ?>
<?php
}
add_action( 'thb_social', 'thb_social',3 );

function thb_social_header() {
	$social_style = ot_get_option( 'header_socialstyle', 'style1' );
	?>

	<aside class="social_header">
	<?php if ( $social_style === 'style1' ) { ?>
		<div>
	<?php } ?>
		<?php if ( ot_get_option( 'fb_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'fb_link_header' ) ); ?>" class="facebook icon-1x" target="_blank"><i class="fa fa-facebook-official"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'pinterest_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'pinterest_link_header' ) ); ?>" class="pinterest icon-1x" target="_blank"><i class="fa fa-pinterest"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'twitter_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'twitter_link_header' ) ); ?>" class="twitter icon-1x" target="_blank"><i class="fa fa-twitter"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'linkedin_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'linkedin_link_header' ) ); ?>" class="linkedin icon-1x" target="_blank"><i class="fa fa-linkedin"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'instragram_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'instragram_link_header' ) ); ?>" class="instagram icon-1x" target="_blank"><i class="fa fa-instagram"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'xing_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'xing_link_header' ) ); ?>" class="xing icon-1x" target="_blank"><i class="fa fa-xing"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'tumblr_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'tumblr_link_header' ) ); ?>" class="tumblr icon-1x" target="_blank"><i class="fa fa-tumblr"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'vk_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'vk_link_header' ) ); ?>" class="vk icon-1x" target="_blank"><i class="fa fa-vk"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'soundcloud_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'soundcloud_link_header' ) ); ?>" class="soundcloud icon-1x" target="_blank"><i class="fa fa-soundcloud"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'dribbble_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'dribbble_link_header' ) ); ?>" class="dribbble icon-1x" target="_blank"><i class="fa fa-dribbble"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'youtube_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'youtube_link_header' ) ); ?>" class="youtube icon-1x" target="_blank"><i class="fa fa-youtube-play"></i></a>
		<?php } ?>
		<?php if ( ot_get_option( 'spotify_link_header' ) ) { ?>
		<a href="<?php echo esc_url( ot_get_option( 'spotify_link_header' ) ); ?>" class="spotify icon-1x" target="_blank"><i class="fa fa-spotify"></i></a>
		<?php } ?>
	<?php if ( $social_style === 'style1' ) { ?>
		</div>
		<i class="social_toggle"><?php get_template_part( 'assets/svg/social.svg' ); ?></i>
	<?php } ?>
	</aside>
	<?php
}
add_action( 'thb_social_header', 'thb_social_header', 3 );

// Thb Mobile Toggle.
function thb_mobile_toggle($small = true ) {
	$mobile_icon = ot_get_option( 'mobile_menu_icon', 'on' );
	$classes[]   = 'mobile-toggle';
	$classes[]   = 'on' !== $mobile_icon ? 'hide-for-large' : false;
	$classes[]   = 'small';
	?>
	<a href="#" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"><div><span></span><span></span><span></span></div></a>
	<?php
}
add_action( 'thb_mobile_toggle', 'thb_mobile_toggle', 1, 1 );

// Secondary Area.
function thb_secondary_area( $menu = false ) {
	if ( $menu ) {
		if ( has_nav_menu('secondary-menu') ) {
		?>
		<nav class="full-menu-container show-for-large">
		<?php
		  wp_nav_menu(
				array(
					'theme_location' => 'secondary-menu',
					'depth'          => 2,
					'container'      => false,
					'menu_class'     => 'secondary-menu full-menu nav submenu-style-' . ot_get_option( 'header_submenu_style', 'style1' ),
					'walker'         => new thb_MegaMenu_tagandcat_Walker,
				)
			);
		?>
		</nav>
		<?php
		}
	}
	do_action( 'thb_social_header' );
	do_action( 'thb_quick_search' );
	do_action( 'thb_quick_cart' );
}
add_action( 'thb_secondary_area', 'thb_secondary_area', 1, 1 );

// Custom Password Protect Form.
function thb_password_form() {
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p class="password-text">' . esc_html__( "This is a protected area. Please enter your password:", 'thevoux' ) . '</p>
    <input name="post_password" type="password" placeholder="' . esc_html__( 'Password', 'thevoux' ) . '"/><input type="submit" name="Submit" class="btn small" value="' . esc_attr__( 'Submit', 'thevoux' ) . '" /></form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'thb_password_form' );

// Post Categories Array.
function thb_blogCategories(){
	$blog_categories = get_categories();
	$out             = array();
	foreach ( $blog_categories as $category ) {
		$out[$category->name] = $category->cat_ID;
	}
	return $out;
}

// First letter of Content.
function thb_FirstLetter() {
	$content = get_the_excerpt();
	return mb_substr( $content,0,1, 'utf-8' );
}

// Human time.
function thb_human_time_diff_enhanced( $duration = 60 ) {
	$post_time  = get_the_time( 'U' );
	$human_time = '';
	$time_now   = date( 'U' );

	// use human time if less that $duration days ago (60 days by default).
	// 60 seconds * 60 minutes * 24 hours * $duration days.
	if ( $post_time > $time_now - ( 60 * 60 * 24 * $duration ) ) {
		$human_time = sprintf( __( '%s ago', 'thevoux' ), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
	} else {
		$human_time = get_the_date();
	}
	if ( ot_get_option( 'relative_dates', 'on') === 'off') {
		return get_the_date();
	} else {
		return $human_time;
	}
}
// Cookie Bar.
function thb_add_cookiebar() {
	get_template_part( 'inc/templates/header/cookie-bar' );
}
add_action( 'wp_footer', 'thb_add_cookiebar', 10 );

// Post Category Class.
function thb_add_category_slug( $thelist, $separator = false, $parents = false ) {
	$categories = get_the_category();
	$output     = '';

  if ( ! $categories || is_wp_error( $categories ) ) {
    return $thelist;
  }
  if ( !is_admin()) {
  	$l = count($categories);
  	$i = 1;
		foreach ( $categories as $category ) {
	    $output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="cat-' . esc_attr( $category->slug) . '" aria-label="' . esc_attr( $category->name) . '">' . esc_html( $category->name) . '</a>' . ($l > $i ? $separator : '' );

	    $i++;
	  }
		return $output;
  } else {
  	return $thelist;
  }
}

add_filter( 'the_category', 'thb_add_category_slug', 10, 3 );

// Post Top Info.
function thb_post_top($categories = true, $time = false) {
	?>
	<div class="thb-post-top">
		<?php if ( $categories ) { do_action( 'thb_categories' ); }  ?>
		<?php if ( $time ) { ?>
			<aside class="post-date">
				<?php echo esc_html(thb_human_time_diff_enhanced()); ?>
			</aside>
		<?php } ?>
	</div>
	<?php
}
add_action( 'thb_post_top', 'thb_post_top', 10, 2 );

// Add Sponsored Template.
function thb_sponsored_setup() {
	function thb_sponsored_template() {
		if ( ! is_single() ) { return; }
		get_template_part( 'inc/templates/postbits/sponsored' );
	}

	$sponsored_position = ot_get_option( 'sponsored_position', 'above-title' );

	if ( $sponsored_position === 'above-title') {
		add_action( 'thb_post_top', 'thb_sponsored_template', 0);
	} elseif ( $sponsored_position === 'below-content') {
		add_action( 'thb_ads_after_content', 'thb_sponsored_template', 0);
	}
}
add_action( 'after_setup_theme', 'thb_sponsored_setup' );

// Post Categories.
function thb_categories( $style = false ) {
	if ( has_category() ) {
		$category_style_link = ot_get_option( 'category_style_link', 'style1' );
		$category_style_link = $style ? $style : $category_style_link;
		?>
		<aside class="post-meta <?php echo esc_attr( $category_style_link ); ?>">
			<?php the_category( '<i>,</i> ' ); ?>
		</aside>
	<?php
	}
}
add_action( 'thb_categories', 'thb_categories', 11, 1);

// Post Author.
function thb_post_author() {
	?>
	<aside class="post-author">
		<em><?php esc_html_e( 'by', 'thevoux' ); ?></em> <?php the_author_posts_link(); ?>
        <em class="post-view-count"><i class="fa fa-eye">&nbsp;</i><?= gt_get_post_view();?></em>
    </aside>

	<?php
}
add_action( 'thb_post_author', 'thb_post_author', 10);

// Add Lightbox Class.
function thb_image_rel( $content ) {
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="mfp"$6>$7</a>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}
add_filter( 'the_content', 'thb_image_rel' );

// Footer Items.
function thb_footer_items() {
	if ('on' === ot_get_option( 'scroll_totop', 'on' ) ) {
	?>
		<a href="#" title="<?php esc_attr_e( 'Scroll To Top', 'thevoux' ); ?>" id="scroll_totop">
			<?php get_template_part( 'assets/svg/arrow_prev.svg' ); ?>
		</a>
	<?php
	}
	if ('on' === ot_get_option( 'selection_sharing', 'off' ) ) {
		$selection_sharing_type = ot_get_option( 'selection_sharing_buttons') ? ot_get_option( 'selection_sharing_buttons') : array();
		$twitter_user = ot_get_option( 'twitter_bar_username', 'anteksiler' );
	?>
	<div id="thbSelectionSharerPopover" class="thb-selectionSharer" data-appid="<?php echo esc_attr(ot_get_option( 'selection_sharing_appid' ) ); ?>" data-user="<?php echo esc_attr( $twitter_user); ?>">
	  <div id="thb-selectionSharerPopover-inner">
	    <ul>
	    	<?php if (in_array( 'twitter', $selection_sharing_type, true ) ) { ?>
	      <li><a class="action twitter" href="#" title="<?php esc_attr_e( 'Share this selection on Twitter', 'thevoux' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
	      <?php } ?>
	      <?php if (in_array( 'facebook', $selection_sharing_type, true ) ) { ?>
	      <li><a class="action facebook" href="#" title="<?php esc_attr_e( 'Share this selection on Facebook', 'thevoux' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
	      <?php } ?>
	      <?php if (in_array( 'email', $selection_sharing_type, true ) ) { ?>
	      <li><a class="action email" href="#" title="<?php esc_attr_e( 'Share this selection by Email', 'thevoux' ); ?>" target="_blank"><i class="fa fa-envelope"></i></a></li>
	      <?php } ?>
	    </ul>
	  </div>
	</div>
	<?php }
}
add_action( 'wp_footer', 'thb_footer_items', 3 );

// Remove VC-added P tags.
function thb_remove_vc_added_p( $content ) {
	if ( substr( $content, 0, 4 ) === '</p>' ) {
		$content = substr( $content, 4 );
	}
	if ( substr( $content, -3 ) === '<p>' ) {
		$content = substr( $content, 0, -3 );
	}
	return $content;
}

// Remove Empty P tags./
function thb_remove_p( $content ){
	$to_remove = array(
	  '<p>['    => '[',
	  ']</p>'   => ']',
	  ']<br />' => ']',
	);

	$content = strtr( $content, $to_remove );
	return $content;
}

add_filter( 'the_content', 'thb_remove_p' );

// P tag fix for certain shortcodes.
function shortcode_empty_paragraph_fix( $content ) {
  $block = join( '|', array( 'thb_slidetype', 'thb_fadetype' ) );

  // opening tag.
  $rep = preg_replace( "/(<p>)?(\n|\r)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/", '[$3$4]', $content );

  // closing tag.
  $rep = preg_replace( "/(<p>)?(\n|\r)?\[\/($block)](<\/p>|<br \/>)?/", '[/$3]', $rep );

  return $rep;
}
add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );

// Gradient Generation.
function thb_css_gradient( $color_start, $color_end, $angle = -32, $full = true ) {

	$return = 'linear-gradient( ' . str_replace( 'deg', '', $angle ) . 'deg,' . esc_attr( $color_end ) . ',' . esc_attr( $color_start ) . ' )';

	if ( $full === true ) {
		return 'background:' . $color_start . ';background:' . $return . ';';
	}

	return $return;
}

// Add Shortcode.
function thb_add_short( $name, $call ) {
	$func = 'add' . '_shortcode';
	return $func( $name, $call );
}

// Encoding.
function thb_encode( $value ) {
  $func = 'base64' . '_encode';
  return $func( $value );
}
function thb_decode( $value ) {
  $func = 'base64' . '_decode';
  return $func( $value );
}
function thb_after_newsletter_form() {
	$newsletter_privacy_checkbox = ot_get_option( 'newsletter_privacy_checkbox', 'on' );
	$rand                        = wp_rand(0,1000);

	if ( $newsletter_privacy_checkbox === 'on' ) {
		?>
		<div class="thb-custom-checkbox">
	    <input type="checkbox" id="thb-newsletter-privacy-<?php echo esc_attr( $rand); ?>" name="thb-newsletter-privacy" class="thb-newsletter-privacy" checked>
	    <label for="thb-newsletter-privacy-<?php echo esc_attr( $rand); ?>"><?php esc_html_e( 'I would like to receive news and special offers.', 'thevoux' ); ?></label>
		</div>
		<?php
	}
}
add_filter( 'thb_after_newsletter_form', 'thb_after_newsletter_form' );

// Woocommerce.
function thb_wc_supported() {
	return class_exists( 'WooCommerce' );
}
function thb_is_woocommerce() {
	if (!thb_wc_supported()) {
		return false;
	}
	return ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() );
}

// Move Array Keys.
function thb_moveKeyBefore( $arr, $find, $move ) {
  if ( ! isset( $arr[$find], $arr[$move] ) ) {
    return $arr;
  } else {
    $elem = [$move => $arr[$move]];
    $start = array_splice($arr, 0, array_search( $find, array_keys( $arr ) ) );
    return $start + $elem + $arr;
  }
}

// VC AJAX Support.
function thb_register_vc_shortcodes() {
  if ( class_exists( 'WPBMap' ) && method_exists( 'WPBMap', 'addAllMappedShortcodes' ) ) {
		WPBMap::addAllMappedShortcodes();
  }
}
add_action( 'thb_vc_ajax', 'thb_register_vc_shortcodes', 10 );

// DNS Prefetching.
function thb_dns_prefetch() {
	echo '<meta http-equiv="x-dns-prefetch-control" content="on">
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.gstatic.com" />
	<link rel="dns-prefetch" href="//0.gravatar.com/" />
	<link rel="dns-prefetch" href="//2.gravatar.com/" />
	<link rel="dns-prefetch" href="//1.gravatar.com/" />';
}
add_action( 'wp_head', 'thb_dns_prefetch', 0 );

// Redirect.
function thb_disable_redirect_canonical( $redirect_url, $requested_url ) {
	if ( is_single() || is_page() ) { $redirect_url = false; }
	return $redirect_url;
}
add_filter( 'redirect_canonical', 'thb_disable_redirect_canonical', 10, 2 );

// Mobile Check.
function thb_is_mobile() {
	$is_mobile = Thb_Theme_Admin::$thb_is_mobile;
	return ( $is_mobile->isMobile() && ! $is_mobile->isTablet() );
}
function thb_is_tablet() {
	$is_mobile = Thb_Theme_Admin::$thb_is_mobile;
	return $is_mobile->isTablet();
}
