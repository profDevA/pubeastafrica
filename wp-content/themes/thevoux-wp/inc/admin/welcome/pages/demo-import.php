<div class="wrap about-wrap thb_welcome thb_product_registration">
	<?php include 'header.php'; ?>
</div>
<main id="thb-adm-popup">
  <div class="thb-popup-box">
    <span class="thb-popup-close">
      <span class="dashicons dashicons-no"></span>
    </span>
    <figure>
      <img src="" alt="Fuel Themes">
      <div class="thb-import-loading">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
          <path fill="#fff" d="M43.935,25.145c0-10.318-8.364-18.683-18.683-18.683c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615c8.072,0,14.615,6.543,14.615,14.615H43.935z" transform="rotate(219.617 25 25)">
            <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"></animateTransform>
          </path>
        </svg>
        <div class="thb-loading-text">Page will refresh after the import is done.</div>
      </div>
    </figure>
    <h3><?php esc_html_e('Import Content', 'thevoux' ); ?></h3>
    <p><?php esc_html_e('You can select import data type you want.', 'thevoux' ); ?></p>
    <form action="" method="post">
      <div class="thb-check-line">
        <div>
          <div>
            <input type="checkbox" name="ty-contents" id="ty-contents" class="child-opened thb-checked" checked>
            <label for="ty-contents"><?php esc_html_e('Contents', 'thevoux' ); ?></label>
          </div>
          <div class="child-check done">
            <input type="checkbox" name="ty-contents-media" id="ty-contents-media" class="thb-checked" checked>
            <label for="ty-contents-media"><?php esc_html_e('Media Files (Thumbnail images, etc.)', 'thevoux' ); ?></label>
          </div>
        </div>
        <div>
          <input type="checkbox" name="ty-theme-options" id="ty-theme-options" class="thb-checked" checked>
          <label for="ty-theme-options"><?php esc_html_e('Theme Options', 'thevoux' ); ?></label>
        </div>
        <div>
          <input type="checkbox" name="ty-widgets" id="ty-widgets" class="thb-checked" checked>
          <label for="ty-widgets"><?php esc_html_e('Widgets', 'thevoux' ); ?></label>
        </div>
      </div>
      <button type="submit" class="button button-primary"><?php esc_html_e('Import Selected', 'thevoux' ); ?></button>
    </form>
  </div>
</main>
<div class="wrap about-wrap">

<?php
	$key = Thb_Theme_Admin::$thb_product_key;
	$expired = Thb_Theme_Admin::$thb_product_key_expired;

	$cond = ($key != '' && $expired != 1);

?>
<div class="theme-browser thb-demo-import thb-content">
<?php if (!$cond) { ?>
	<div class="thb-error">
		<p><span class="dashicons dashicons-warning"></span> To install any of the demo content sites below you must <a href="<?php echo esc_url(admin_url( 'admin.php?page=thb-product-registration' )); ?>">Activate your Theme</a>.</p>
	</div>
<?php
	} else {
		include 'requirements.php';
 	}
?>
<?php
	$demos = thb_Theme_Admin()->thbDemos();
	$i = 0;
 	foreach ($demos as $demo) {
 		?>
 		<div class="theme <?php if (!$cond) { ?>disabled<?php } ?> <?php if (($i+1) % 3 == 0) { ?>last<?php }?>">
 			<div class="theme-screenshot"><img src="<?php echo esc_attr($demo['import_image']); ?>" /></div>
 			<h2 class="theme-name" id=""><?php echo esc_attr($demo['import_file_name']); ?></h2>
 			<div class="theme-actions">
        <span class="button button-primary import-opts-btn <?php if (!$cond) { ?>disabled<?php } ?>" data-demo="<?php echo esc_attr($i++); ?>">Import Options</span>
					<a class="button" href="<?php echo esc_attr($demo['import_demo_url']); ?>" target="_blank"><i class="dashicons-before dashicons-share-alt2"></i></a>
 			</div>
 		</div>
 		<?php
 	}
?>
</div>