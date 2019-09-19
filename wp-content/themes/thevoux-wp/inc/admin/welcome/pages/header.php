<h1>Welcome to <strong><?php echo esc_html(Thb_Theme_Admin::$thb_theme_name); ?></strong></h1>
<p class="about-text welcome-text">
	<?php echo esc_html(Thb_Theme_Admin::$thb_theme_name); ?> is now installed and ready to use with your WordPress site. Please activate your theme to import demo contents and get updates for your theme and bundled plugins.
</p>
<p class="wp-badge wp-thb-badge">
	Version: <?php echo esc_html(Thb_Theme_Admin::$thb_theme_version); ?></p>
<?php include 'tabs.php'; ?>