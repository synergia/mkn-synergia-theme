
<?php if ( has_nav_menu( 'main_menu' ) ) : ?>

    <div class="dmbs-top-menu">
        <nav class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-1-collapse">
                        <span class="sr-only"><?php _e('Toggle navigation','synergia'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <?php if ( get_header_image() !='' || get_header_textcolor() !='blank' ) : ?>

                    <?php if ( get_header_image() !='' ) : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" height="47" width="300px" alt="" /></a>
                    <?php endif; ?>
                <?php endif; ?>

                <?php
                wp_nav_menu( array(
                        'theme_location'    => 'main_menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse navbar-1-collapse',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                );
                ?>
            </div>
        </nav>
    </div>

<?php endif; ?>