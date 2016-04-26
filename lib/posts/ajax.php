<?php

// Infinite Scroll //
function load_posts(){

     $post_offset = $_POST['post_offset'];

     $args = array(
         'numberposts' => -1,
         'post_type' => 'post',
         'offset' => $post_offset
     );

     $posts = new WP_Query($args);
     project_card($posts);
     die();
}

add_action('wp_ajax_load_posts', 'load_posts');           // for logged in user
add_action('wp_ajax_nopriv_load_posts', 'load_posts');
?>
