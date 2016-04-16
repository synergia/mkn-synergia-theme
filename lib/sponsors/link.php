<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Link')
    ->show_on_post_type('sponsorowane')
    ->set_context('side')
    ->set_priority('high')
    ->add_fields(array(
        Field::make('text', 'crb_sponsor_link', 'Podaj link')

    ));
