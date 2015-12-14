<?php
// Rejestracja menu i url //
function snrg_options_menu() {
  add_theme_page(
    'Synergopcje',
    'Synergopcje',
    'manage_options',
    'synergoptions',
    'synergia_theme_options'
  );
}
add_action('admin_menu', 'snrg_options_menu');

// Adminbar //
function adminbar_link_to_snrg_options($wp_admin_bar) {
  $args = array(
    'id' => 'synergia_theme_options',
    'title' => 'Synergopcje',
    'href' => home_url().'/wp-admin/themes.php?page=synergoptions',
    'meta' => array('class' => 'synergoptions'),
    'parent' => 'site-name',
    );
  $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'adminbar_link_to_snrg_options', 999);

// OPCJE //
$snrg_options_array = array(
  'recruitment' => false,
//       'right_sidebar_width' => 3,
  'archiwum' => '',
  'more_projects' => '',
  'google_anal' => '',
  'recruitment_image_1' => '',
  'recruitment_image_2' => '',
  'recruitment_image_3' => '',
  );
  $snrg_option_global = get_option( 'snrg_options_array', $snrg_options_array );
//    $snrg_sidebar_sizes = array(
//        '1' => array (
//            'value' => '1',
//            'label' => '1'
//        ),
//    );

function snrg_register_settings() {
  register_setting( 'snrg_theme_options', 'snrg_options_array', 'snrg_validate_options' );
}
add_action ('admin_init', 'snrg_register_settings');

// Walidacja opcji //
function snrg_validate_options( $input ) {
  global $snrg_options_array;
  $snrg_option = get_option( 'snrg_options_array', $snrg_options_array );
  if ( ! isset( $input['recruitment'] ) ) {
    $input['recruitment'] = null;
  } else {
    $input['recruitment'] = ( $input['recruitment'] == 1 ? 1 : 0 );
  }
  $input['archiwum'] = wp_filter_nohtml_kses( $input['archiwum'] );
  $input['more_projects'] = wp_filter_nohtml_kses( $input['more_projects'] );
  $input['recruitment_image_1'] = wp_filter_nohtml_kses( $input['recruitment_image_1'] );
  $input['recruitment_image_2'] = wp_filter_nohtml_kses( $input['recruitment_image_2'] );
  $input['recruitment_image_3'] = wp_filter_nohtml_kses( $input['recruitment_image_3'] );
//        $input['google_anal'] = wp_filter_nohtml_kses( $input['google_anal'] );

        return $input;
    }
include 'display-options.php';
