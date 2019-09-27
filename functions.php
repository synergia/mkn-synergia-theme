<?php
// Info o motywie //
    $theme = wp_get_theme();
    $logo = get_template_directory_uri() . '/build/img/logo.png';
    $version = $theme->get('Version');
    $theme_name = $theme->get('Name');
    $codename = 'Jessica Alba';
    $codeimg = 'http://cs633618.vk.me/v633618187/1a842/cNH0Mgb-jHU.jpg';


// Dodatkowe style i skrypty dla panelu. Odpowiedzialne za otwieranie okna
// z mediami
// http://stackoverflow.com/a/26103160/1589989
if (is_admin()) {
    function enqueue_admin()
    {
        $mode = get_user_option('media_library_mode', get_current_user_id()) ? get_user_option('media_library_mode', get_current_user_id()) : 'grid';
        $modes = array('grid', 'list');
        if (isset($_GET['mode']) && in_array($_GET['mode'], $modes)) {
            $mode = $_GET['mode'];
            update_user_option(get_current_user_id(), 'media_library_mode', $mode);
        }
        if (!empty($_SERVER['PHP_SELF']) && 'upload.php' === basename($_SERVER['PHP_SELF']) && 'grid' !== $mode) {
            wp_dequeue_script('media');
        }
        wp_enqueue_media();
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
    }
    add_action('admin_enqueue_scripts', 'enqueue_admin');
}

remove_filter('template_redirect','redirect_canonical');

// Rejestrujemu menu //

register_nav_menus(
    array(
        'main_menu' => 'Topbar',
    )
);

// Dodatkowe funkcje porozrzucane po plikach //
// Ustawienia motywu
include 'lib/options/options.php';
// Projekt
include 'lib/projects/post-type.php';
include 'lib/projects/project.php';
include 'lib/projects/attachments.php';
include 'lib/projects/utils.php';
// Posts
include 'lib/posts/post.php';
include 'lib/posts/utils.php';
include 'lib/posts/ajax.php';
// Członkowie
include 'lib/members/profile.php';
include 'lib/members/capabilities.php';
include 'lib/members/utils.php';
include 'lib/members/ajax.php';
// Sponsorzy
include 'lib/sponsors/post-type.php';
include 'lib/sponsors/utils.php';
// Ogólne
include 'lib/general/removes.php';
include 'lib/general/utils.php';
include 'lib/general/meta-tags.php';
include 'lib/general/slider.php';
include 'lib/general/lazy.php';
include 'lib/general/dashboard.php';
include 'lib/general/setup.php';
include 'lib/general/walker.php';
include 'lib/general/humans.php';
// Login
include 'lib/login/login.php';
// ULTRON
include 'lib/ultron/ultron.php';


// Synergiczne style //

    function synergia_theme_stylesheets()
    {
        global $version, $snrg_settings;
        $style_path = get_template_directory_uri().'/build/style';

        wp_register_style('Titillium', 'https://fonts.googleapis.com/css?family=Titillium+Web:400,400italic,300,700&subset=latin,latin-ext');
        wp_register_style('Titillium900', 'https://fonts.googleapis.com/css?family=Titillium+Web:900&subset=latin');
        wp_register_style('PTMono', 'https://fonts.googleapis.com/css?family=PT+Mono');
        wp_register_style('main', $style_path.'/main.css', array(), $version, 'all');
        wp_register_style('prism', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/themes/prism-okaidia.css', array(), $version, 'all');
        wp_enqueue_style('main');
        wp_enqueue_style('Titillium');
        wp_enqueue_style('Titillium900');
        if (is_singular('project') || is_single()) {
            wp_enqueue_style('prism');
        }
        // if (is_page('recruitment')) {
            wp_enqueue_style('PTMono');
        // }
    }
    add_action('wp_enqueue_scripts', 'synergia_theme_stylesheets');

// Synergiczne style dla admin panelu //
add_action('admin_init','synergia_admin_styles');
function synergia_admin_styles() {
  global $version;
  wp_enqueue_style( 'admin', get_template_directory_uri() . '/build/style/admin.css', array(), $version, 'all');
}

// Synergiczne skrypty //

function js() {
  global $version, $snrg_settings;
  $js_path = get_template_directory_uri().'/build/js';
  $google_map_key = 'AIzaSyD6ovUl5OZwwEa_MzTArrazVuvVtCMH-B8';

    wp_register_script('prism', 'https://cdnjs.cloudflare.com/ajax/libs/prism/1.17.1/prism.min.js', $version, true);
    wp_register_script('glide', 'https://cdn.jsdelivr.net/npm/@glidejs/glide', $version, true);
    wp_register_script('main', $js_path.'/main.min.js', array('jquery'), $version, true);
    wp_register_script('swipe', 'https://cdnjs.cloudflare.com/ajax/libs/swipejs/2.2.13/swipe.min.js', array('jquery'), $version, true);
    wp_register_script('blazy', 'https://cdnjs.cloudflare.com/ajax/libs/blazy/1.8.2/blazy.min.js', array('jquery'), $version, true);
    wp_register_script('404', $js_path.'/404.min.js', array('jquery'), $version, true);
    wp_register_script('map', 'https://maps.googleapis.com/maps/api/js?key='.$google_map_key, false);
    wp_register_script('map_settings',$js_path.'/map.min.js', array('jquery'), $version, true);

    if(!is_404()){
        wp_enqueue_script('blazy');
        wp_enqueue_script('swipe');
        wp_enqueue_script('glide');
        wp_enqueue_script('main');
    }
    if(is_404()){
        wp_enqueue_script('404');
    }

    if(is_page('about')) {
        wp_enqueue_script('map');
        wp_enqueue_script('map_settings');
    }

    if (is_singular('project') || is_single()) {
        wp_enqueue_script('prism');
    }
}
add_action('wp_footer', 'js');

// Dodajemy wsparcie linków RSS //

add_theme_support('automatic-feed-links');

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}