<?php
function thb_get_social_list($labels = true, $counts = true, $layout = 'thb-social-vertical', $style = 'fill-color') {

  $socials = array(
    'facebook' => array(
      'option' => ot_get_option( 'facebook_page_username'),
      'label' => esc_html__('Facebook', 'thevoux'),
      'url' => esc_url('https://facebook.com/%1$s')
    ),
    'twitter' => array(
      'option' => ot_get_option( 'twitter_bar_username'),
      'label' => esc_html__('Twitter', 'thevoux'),
      'url' => esc_url('https://twitter.com/%1$s')
    ),
    'instagram' => array(
      'option' => ot_get_option( 'instagram_username'),
      'label' => esc_html__('Instagram', 'thevoux'),
      'url' => esc_url('https://instagram.com/%1$s')
    ),
    'pinterest' => array(
      'option' => ot_get_option( 'social_pinterest_user'),
      'label' => esc_html__('Pinterest', 'thevoux'),
      'url' => esc_url('https://pinterest.com/%1$s')
    ),
    'youtube' => array(
      'option' => ot_get_option( 'yt_id'),
      'label' => esc_html__('Youtube', 'thevoux'),
      'url'   => array(
        'user'    => esc_url('https://youtube.com/user/%1$s'),
				'channel' => esc_url('https://youtube.com/channel/%1$s'),
  		),
    ),
    'medium' => array(
      'option' => ot_get_option( 'social_medium_user'),
      'label' => esc_html__('Medium', 'thevoux'),
      'url' => esc_url('https://medium.com/%1$s')
    ),
    'vimeo' => array(
      'option' => ot_get_option( 'vimeo_channel'),
      'label' => esc_html__('Vimeo', 'thevoux'),
      'url' => esc_url('https://vimeo.com/channels/%1$s')
    )
  );
  $active_links = array_filter($socials, function($value) {
      return $value['option'] !== '' || !empty($value['option']);
  });

  if ($active_links) {
    $classes[] = 'thb-social-links-container';
    $classes[] = $style;
    $classes[] = $layout;
    ?>
  <div class="<?php echo esc_attr(implode(' ', $classes)); ?>">
  <?php foreach ($active_links as $network => $value) {

    if ($value['option'] == '' || empty($value['option'])) { return; }

    if ($counts) {
      $data = thb_social_links_get_count($network, $value['option']);
    }

    if ($network == 'youtube') {
      $yt_type = ot_get_option( 'social_youtube_type', 'channel');

      $url = sprintf($value['url'][$yt_type], $value['option']);

    } else {
      $url = sprintf($value['url'], $value['option']);
    }
    ?>
    <div class="thb-social-link-wrap">
      <a href="<?php echo esc_url($url); ?>" target="_blank" class="thb-social-link social-link-<?php echo esc_attr($network); ?>">
        <div class="thb-social-label-container">
          <div class="thb-social-icon-container"><i class="fa fa-<?php echo esc_attr($network); ?>"></i></div>
          <?php if ($labels) { ?><div class="thb-social-label"><?php echo esc_html($value['label']); ?></div><?php }?>
        </div>
        <?php if ($counts && !empty($data)) { ?>
          <div class="thb-social-count">
            <?php if (array_key_exists('error', $data)) { echo esc_html($data['error']); } else { echo esc_html($data['count']); } ?>
         </div>
        <?php } ?>
      </a>
    </div>
  <?php } ?>
  </div>
  <?php }
}