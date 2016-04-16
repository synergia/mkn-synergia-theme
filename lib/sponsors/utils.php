<?php

add_image_size( 'sponsor_logo', auto, 75, false );


add_action('carbon_register_fields', 'crb_register_custom_fields');
function crb_register_custom_fields() {
    include_once(dirname(__FILE__) . '/link.php');
}
