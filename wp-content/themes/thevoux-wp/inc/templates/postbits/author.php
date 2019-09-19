<?php
  if (ot_get_option( 'article_author', 'on') == 'off') { return; }
  $thb_id = get_the_author_meta( 'ID' );
  if ( get_the_author_meta('description', $thb_id ) == '') { return; }
?>
<div class="category_container author-information">
	<div class="inner">
		<section id="authorpage" class="authorpage">
			<?php do_action('thb_author'); ?>
		</section>
	</div>
</div>