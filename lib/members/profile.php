<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
// Modyfikacje powiązane z kontem członka //

add_action('carbon_register_fields', 'crb_register_member_images');
function crb_register_member_images()
{
    Container::make('user_meta', 'Zdjęcia i obrazki')
        // ->show_on_user_role('synergia_member')
        ->add_fields(array(
            Field::make('image', 'crb_member_profile_image', 'Obrazek profilowy')
                ->set_value_type('url')
                ->help_text('Można też wkleić URL'),
            Field::make('image', 'crb_member_cover_image', 'Obrazek tła')
                ->set_value_type('url')
                ->help_text('Można też wkleić URL, a nawet lepiej')
        ));

}
add_action('carbon_register_fields', 'crb_register_member_social_links');
function crb_register_member_social_links() {

Container::make('user_meta', 'Linki do portali społecznościowych, CV i poczta')
    ->add_fields(array(
        Field::make('text', 'crb_member_github_link', 'URL Github'),
        Field::make('text', 'crb_member_facebook_link', 'URL Facebook'),
        Field::make('text', 'crb_member_twitter_link', 'URL Twitter'),
        Field::make('text', 'crb_member_lastfm_link', 'URL Last.fm'),
        Field::make('text', 'crb_member_cv_link', 'URL do CV'),
        Field::make('checkbox', 'crb_show_mail', 'Pokazyj adres email')
            ->set_option_value('no')
            ->help_text('Zaznacz, jeśli chcesz, by był wyświetlany'),

    ));
}
if (current_user_can('administrator')){
    add_action('carbon_register_fields', 'crb_register_management_board');
}
function crb_register_management_board() {

    Container::make('user_meta', 'Obierz zarząd lub prezesa')
        ->add_fields(array(
            Field::make('set', 'crb_managment_board', 'Mianuj na członka zarządu lub prezesa')
            ->help_text('With great power comes great responsibility')
            ->add_options(array(
                'member_of_managment_board' => 'Członek zarządu',
                'president' => 'Prezes',
            )),
        ));
}
//removing color scheme
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
