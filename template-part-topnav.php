<header class="topbar">
    <a itemprop="url" class="topbar__logo" title="<?php bloginfo('name'); ?>" href="<?php echo site_url(); ?>" aria-label="Logo Synergii" role="represenation"></a>
    <h1 itemprop="name" class="topbar__appname"><?php bloginfo('name'); ?></h1>

    <nav class="nav" id="nav" role="navigation">
      <?php wp_nav_menu(array(
                    'theme_location' => 'main_menu',
                    'container' => '',
                    'menu_class' => 'nav__menu',
                    'walker' => new Walker_Simple_Example(),
                )); ?>
    </nav>
  <div id="nav-trigger" class="topbar__trigger">
    <div class="navicon-button x">
      <div class="navicon"></div>
    </div>
  </div>
  <!-- <nav id="nav-mobile"></nav> -->
</header>
