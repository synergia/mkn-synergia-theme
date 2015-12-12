<header class="header">
  <nav id="nav-main" role="navigation">
    <a href="<?php echo site_url(); ?>"><div class="logo"></div></a>
      <?php wp_nav_menu(array('theme_location' => 'main_menu', 'container' => '')); ?>
  </nav>
  <div id="nav-trigger">
    <span>Menu</span>
  </div>
  <nav id="nav-mobile"></nav>
</header>
