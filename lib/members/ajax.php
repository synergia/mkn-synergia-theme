<?php

function load_member_page()
{
    $id = $_POST['id'];
    $current_member = get_userdata($id);
    include locate_template('template-part-member.php');
    die();
}
add_action('wp_ajax_load_member_page', 'load_member_page');           // for logged in user
add_action('wp_ajax_nopriv_load_member_page', 'load_member_page');
