<?php
$thb_id = get_the_ID();
$post_gallery_photos = get_post_meta($thb_id, 'post-gallery-photos', true);
if ($post_gallery_photos) {
  $post_gallery_photos_arr = explode(',', $post_gallery_photos);
  $count = count($post_gallery_photos_arr);
}
$i = 1;

if ($count < 1) { return; }

?>
<div class="thb-gallery-container" id="thb-gallery-<?php the_ID(); ?>">
<?php
foreach($post_gallery_photos_arr as $attachment) {
  $attachment_post = get_post($attachment);
  $caption = $attachment_post->post_excerpt;
  $thb_title = $attachment_post->post_title;

  ?>
  <figure class="thb-gallery-item">
  	<div class="thb-gallery-image">
  	  <?php	echo wp_get_attachment_image($attachment, 'thvoux-masonry-2x'); ?>
  	  <div class="thb-gallery-nav">
  	  	<span class="arrow to_top <?php if (1 == $i) { ?> visually-hidden<?php } ?>"><?php get_template_part( 'assets/svg/arrow_prev.svg'); ?></span>
  	  	<div class="count"><?php echo esc_html($i); ?> <em>/</em> <?php echo esc_html($count); ?></div>
  	  	<span class="arrow to_bottom <?php if ($count == $i) { ?> visually-hidden<?php } ?>"><?php get_template_part( 'assets/svg/arrow_next.svg'); ?></span>
  	  </div>
  	</div>
  	<div class="thb-gallery-content">
  		<?php if ($thb_title) { ?>
  		<h5><?php echo esc_html($thb_title); ?></h5>
  		<?php } ?>
  		<?php if ($caption) { ?>
  		<p><?php echo wp_kses_post($caption); ?></p>
  		<?php } ?>
  	</div>
  </figure>
  <?php
  $i++;
}
?>
</div>
