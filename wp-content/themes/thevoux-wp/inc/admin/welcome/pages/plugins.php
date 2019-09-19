<div class="wrap about-wrap thb_welcome">
	<?php include 'header.php'; ?>
</div>
<div class="wrap about-wrap">
	<div class="theme-browser thb-plugins thb-content">
		<?php
			$key = Thb_Theme_Admin::$thb_product_key;
			$expired = Thb_Theme_Admin::$thb_product_key_expired;

			$cond = ($key != '' && $expired != 1);
		?>
		<?php if (!$cond) { ?>
			<div class="thb-error">
				<p><span class="dashicons dashicons-warning"></span> To install premium plugins you must <a href="<?php echo esc_url(admin_url( 'admin.php?page=thb-product-registration' )); ?>">Activate your Theme</a>.</p>
			</div>
		<?php } ?>
		<?php
		$thb_plugins = TGM_Plugin_Activation::$instance->plugins;
		$i = 0;
		foreach( $thb_plugins as $plugin ):
			if ( ! $plugin['required'] ) { continue; }

			$file_path = $plugin['file_path'];

			$actions = Thb_Theme_Admin()->thb_plugins_install( $plugin );

			if ( Thb_Theme_Admin()->thb_ispluginactive( $file_path ) ) {
				$plugin_status = 'active';
				$class = 'active';
			}
		?>
		<div class="theme <?php if (!$cond) { ?>disabled<?php } ?> <?php if (($i+1) % 3 == 0) { ?>last<?php }?>">
			<div class="theme-screenshot"><img src="<?php echo esc_attr($plugin['image_url']); ?>" /></div>
			<?php if( isset( $actions['update'] ) && $actions['update'] ): ?>
			<div class="update-message notice inline notice-warning notice-alt"><p>New version available.</p></div>
			<?php endif; ?>
			<h2 class="theme-name" id=""><?php echo esc_attr($plugin['name']); ?></h2>
			<div class="theme-actions">
				<?php foreach( $actions as $thb_action ) { echo wp_kses_post($thb_action); } ?>
			</div>


		</div>

		<?php $i++; endforeach; ?>
	</div>
</div>