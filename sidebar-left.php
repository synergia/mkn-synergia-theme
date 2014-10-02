<?php
    global $dm_settings;
    if ($dm_settings['left_sidebar'] != 0) : ?>
    <div class="col-sm-<?php echo $dm_settings['left_sidebar_width']; ?> dmbs-left">
        <?php dynamic_sidebar( 'Left Sidebar' ); ?>
        <?php get_template_part('template-part', 'sponsorowane'); ?>

    </div>
<?php endif; ?>
