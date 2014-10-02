<?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
    <div class="dmbs-footer-menu">
            <nav role="navigation">
                <div class="container">
                    <?php
                    wp_nav_menu( array(
                            'theme_location'    => 'footer_menu',
                            'depth'             => 2,
                            'container'         => 'div',
                            'container_class'   => 'collapse navbar-collapse navbar-2-collapse',
                            'menu_class'        => 'nav navbar-nav',
                            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                            'walker'            => new wp_bootstrap_navwalker())
                    );
                    ?>
                </div>
            </nav>
    </div>
<?php endif; ?>
