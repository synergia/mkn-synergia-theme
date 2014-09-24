<?php global $dm_settings; ?>

<div class="container dmbs-container">

<?php if ($dm_settings['show_header'] != 0) : ?>

    <div class="row dmbs-header">


        <div class="col-md-8 dmbs-header-text">
            <?php if ( get_header_textcolor() != 'blank' ) : ?>
                <h1><a class="custom-header-text-color" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                <h4 class="custom-header-text-color"><?php bloginfo( 'description' ); ?></h4>
            <?php endif; ?>
            <?php else : ?>
                <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                <h4><?php bloginfo( 'description' ); ?></h4>
            <?php endif; ?>
        </div>

    </div>

<?php endif; ?>