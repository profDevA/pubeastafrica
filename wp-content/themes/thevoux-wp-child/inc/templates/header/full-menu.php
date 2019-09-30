<?php if(has_nav_menu('nav-menu')) { ?>
  <?php wp_nav_menu( array( 'theme_location' => 'nav-menu', 'depth' => 3, 'container' => false, 'menu_class' => 'full-menu nav submenu-style-' . ot_get_option( 'header_submenu_style', 'style1'), 'walker' => new thb_MegaMenu_tagandcat_Walker ) ); ?>
<?php } ?>