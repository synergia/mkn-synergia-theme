<?php
    global $dm_settings;
    if ( !is_author()) : ?>
    <div class="gl-sm-3 gl-cell ">
        <?php dynamic_sidebar( 'Left Sidebar' ); ?>
        <?php get_template_part('template-part', 'sponsorowane'); ?>

    </div>
<?php endif; ?>
