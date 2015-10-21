
<?php if ( has_nav_menu( 'main_menu' ) ) : ?>

    <div class="dmbs-top-menu">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">

<!--
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1-collapse">
                        <span class="sr-only"><?php _e('Toggle navigation','synergia'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
-->
                    <button class="lines-button x" type="button" data-toggle="collapse" data-target=".navbar-1-collapse" role="button" aria-label="Toggle Navigation">
  <span class="lines"></span>
</button>

                    <a href="<?php echo site_url(); ?>"><div class="logo"></div></a>
                    <?php get_template_part('template-part', 'recruit'); ?>

                </div>


                <?php
                wp_nav_menu( array(
                        'theme_location'    => 'main_menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse navbar-1-collapse',
                        'menu_class'        => 'navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                );
                ?>
            </div>
        </nav>
    </div>

<?php endif; ?>
