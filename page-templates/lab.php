<?php
/*
Template Name: Lab
*/
?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<?php

$lab_state = htmlspecialchars($_POST['state']);

file_put_contents('/export/sun1000-2/synergia/public_html/wp-content/uploads/state.txt', $lab_state);


?>
<?php get_footer(); ?>
