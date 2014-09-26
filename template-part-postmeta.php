<?php global $dm_settings; ?>
<?php if ($dm_settings['show_postmeta'] != 0) : ?>
<div class="meta">
    <p class="left">
        <?php the_time('F jS, Y'); ?>
        <?php edit_post_link(__('Edit','synergia')); ?>
    </p>
    <p class="right"><?php the_category(', '); ?></p>
</div>
<?php endif; ?>
