<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_image_size( 'sponsor_logo', 75, false );

add_action('carbon_register_fields', 'crb_sponsor_link');
function crb_sponsor_link() {
    Container::make('post_meta', 'Link')
        ->show_on_post_type('sponsorowane')
        ->set_context('side')
        ->set_priority('high')
        ->add_fields(array(
            Field::make('text', 'crb_sponsor_link', 'Podaj link')
        ));
}
