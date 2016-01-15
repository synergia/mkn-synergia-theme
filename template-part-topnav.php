<header class="header">
  <nav id="nav-main" role="navigation">
    <a itemprop="url" title="<?php bloginfo('name'); ?>" href="<?php echo site_url(); ?>"><div class="logo"></div></a>
    <h1 itemprop="name" class="app-name"><?php bloginfo('name'); ?></h1>
      <?php wp_nav_menu(array('theme_location' => 'main_menu', 'container' => '')); ?>
  </nav>
  <div id="nav-trigger">
    <div class="navicon-button x">
      <div class="navicon"></div>
    </div>
  </div>
  <nav id="nav-mobile"></nav>
</header>
