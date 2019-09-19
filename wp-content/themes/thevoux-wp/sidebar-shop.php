<?php $shop_sidebar = isset($_GET['sidebar']) ? $_GET['sidebar'] : ot_get_option( 'shop_sidebar', 'no'); ?>
<div class="small-12 large-3 columns sidebar woo small-order-2<?php if ($shop_sidebar == 'left') { echo ' large-order-1'; } ?>">
	<div class="fixed-me">
		<?php dynamic_sidebar( 'shop' ); ?>
	</div>
</div>