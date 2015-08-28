<?php
    global $dm_settings;
    if ($dm_settings['left_sidebar'] != 0) : ?>
    <div class="gl-sm-<?php echo $dm_settings['left_sidebar_width']; ?> gl-cell ">
        <?php dynamic_sidebar( 'Left Sidebar' ); ?>
        <?php get_template_part('template-part', 'sponsorowane'); ?>

    </div>
<?php endif; ?>
