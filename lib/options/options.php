<?php
include 'callbacks.php';
include 'display.php';

add_action('admin_menu', 'snrg_options_add_to_menu');
function snrg_options_add_to_menu()
{
    /* Base Menu */
    add_theme_page(
    'Synergopcje',
    'Synergopcje',
    'manage_options',
    'synergoptions',
    'snrg_options_display');
}
// Adminbar //
function adminbar_link_to_snrg_options($wp_admin_bar) {
  $args = array(
    'id' => 'snrg_options_display',
    'title' => 'Synergopcje',
    'href' => home_url().'/wp-admin/themes.php?page=synergoptions',
    'meta' => array('class' => 'synergoptions'),
    'parent' => 'site-name',
    );
  $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'adminbar_link_to_snrg_options', 999);
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

register_setting('snrg_general_page_option', 'snrg_general_page_option', 'snrg_validate_options');
register_setting('snrg_recruitment_page_option', 'snrg_recruitment_page_option', 'snrg_validate_options');
}

$general_options = get_option('snrg_general_page_option');
$recruitment_options = get_option('snrg_recruitment_page_option');

function snrg_validate_options( $input ) {
  global $recruitment_options;
  if ( ! isset( $recruitment_options['enable_recruitment'] ) ) {
    $recruitment_options['enable_recruitment'] = null;
  } else {
    $recruitment_options['enable_recruitment'] = ( $recruitment_options['enable_recruitment'] == 1 ? 1 : 0 );
  }
  $input['archive_link'] = wp_filter_nohtml_kses( $input['archive_link'] );
  $input['projects_link'] = wp_filter_nohtml_kses( $input['projects_link'] );
  $input['fb_link'] = wp_filter_nohtml_kses( $input['fb_link'] );
  $input['twitter_link'] = wp_filter_nohtml_kses( $input['twitter_link'] );
  $input['github_link'] = wp_filter_nohtml_kses( $input['github_link'] );
  $input['upload_recruitment_image_1'] = wp_filter_nohtml_kses( $input['upload_recruitment_image_1'] );
  return $input;
}
// Wyświetla info o aktualizacji danych członków //
function update_members_meta_page() {
  $timestamp = wp_next_scheduled('update_members_meta');
  echo '<h2>Następna aktualizacja: '.date("Y-m-d H:i:s", $timestamp).'</h2>';
}
