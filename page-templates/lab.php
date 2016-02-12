<?php
/*
Template Name: Lab
*/
?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'topbar'); ?>

<?php

// $lab_state = htmlspecialchars($_POST['state']);
//
// file_put_contents('/export/sun1000-2/synergia/public_html/wp-content/uploads/state.txt', $lab_state);
echo wp_next_scheduled( 'update_members_meta' );
// wp_clear_scheduled_hook('update_users_meta');

// update_number_of_projects();

?>
<?php get_footer(); ?>
