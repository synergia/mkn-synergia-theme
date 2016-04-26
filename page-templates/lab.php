<?php
/*
Template Name: Lab
*/
?>
<?php get_header(); ?>

<?php $ultron_state = ultron_get_state(); ?>

<?php get_template_part('parts/topbar'); ?>
<div class="compensator">
    <div class="ultron">
        <div class="ultron__state">
            <?php echo $ultron_state[0]; ?>
        </div>
        <div class="ultron__datetime">
            <?php echo date_i18n('H:i:s d.m.Y',$ultron_state[1]); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
