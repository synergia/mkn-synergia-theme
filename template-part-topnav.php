<header class="header">
  <nav id="nav-main" role="navigation">
    <a title="<?php bloginfo('name'); ?>" href="<?php echo site_url(); ?>"><div class="logo"></div></a>
    <span class="app-name"><?php bloginfo('name'); ?></span>
      <?php wp_nav_menu(array('theme_location' => 'main_menu', 'container' => '')); ?>
  </nav>
  <div id="nav-trigger">
    <div class="navicon-button x">
      <div class="navicon"></div>
    </div>
  </div>
  <nav id="nav-mobile"></nav>
</header>
