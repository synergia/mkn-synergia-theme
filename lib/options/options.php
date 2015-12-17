<?php
include 'callbacks.php';
include 'display.php';

add_action('admin_menu', 'snrg_options_add_to_menu');
function snrg_options_add_to_menu()
{
    /* Base Menu */
    add_menu_page(
    'Synergopcje',
    'Synergopcje',
    'manage_options',
    'synergoptions',
    'snrg_options_display');
}

add_action('admin_init', 'snrg_options');
function snrg_options()
{

// ================OGÓLNE===================== //
// =========================================== //
add_settings_section(
    'snrg_general_page',
    'Ogólne',
    false,
    'snrg_general_page_option'
);

    add_settings_field(
    'archive_link',
    'Link do archiwum',
    'snrg_archive_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'projects_link',
    'Link do projektów',
    'snrg_projects_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'fb_link',
    'Link do fanpage\'a',
    'snrg_fb_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'twitter_link',
    'Link do Twittera',
    'snrg_twitter_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'github_link',
    'Link do Githuba',
    'snrg_github_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'g_anal',
    'Google Analytics',
    'snrg_g_anal_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);

// ================REKRUTACJA================= //
// =========================================== //
add_settings_section(
    'snrg_recruitment_page',
    'Rekrutacja (na razie nie działa)',
    false,
    'snrg_recruitment_page_option'
);

    add_settings_field(
    'enable_recruitment',
    'Włącz rekrutację',
    'snrg_enable_recruitment_callback',
    'snrg_recruitment_page_option',
    'snrg_recruitment_page'
);
    add_settings_field(
    'upload_recruitment_image_1',
    'Dodaj obrazek',
    'snrg_upload_recruitment_images_callback',
    'snrg_recruitment_page_option',
    'snrg_recruitment_page'
  );

register_setting('snrg_general_page_option', 'snrg_general_page_option');
register_setting('snrg_recruitment_page_option', 'snrg_recruitment_page_option');
}

$general_options = get_option('snrg_general_page_option');
$recruitment_options = get_option('snrg_recruitment_page_option');
