<?php
// Info o motywie //
    $theme = wp_get_theme();
    $version = $theme->get('Version');
    $theme_name = $theme->get('Name');
    $codename = 'Carrie Fisher';
    $codeimg = 'http://cs628419.vk.me/v628419187/48151/3R20Q-CTUPI.jpg';

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

// Dodatkowe funkcje porozrzucane po plikach //
// Ustawienia motywu
include 'lib/options/theme-options.php';
// Projekt
include 'lib/projects/post-type.php';
include 'lib/projects/project.php';
include 'lib/projects/attachments.php';
include 'lib/projects/utils.php';
// Członkowie
include 'lib/members/profile.php';
include 'lib/members/capabilities.php';
include 'lib/members/utils.php';
// Sponsorzy
include 'lib/sponsors/post-type.php';
include 'lib/sponsors/utils.php';
// Ogólne
include 'lib/general/removes.php';
include 'lib/general/utils.php';
include 'lib/general/meta-tags.php';
include 'lib/general/slider.php';
include 'lib/general/lazy.php';
// Login
include 'lib/login/login.php';


// Synergiczne style //

    function synergia_theme_stylesheets()
    {
        global $version, $snrg_settings;

        wp_register_style('Titillium', 'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,700&subset=latin,latin-ext');
        wp_register_style('Titillium900', 'https://fonts.googleapis.com/css?family=Titillium+Web:900&subset=latin');
        wp_register_style('main', get_template_directory_uri().'/build/style/main.css', array(), $version, 'all');
        wp_register_style('github', get_template_directory_uri().'/build/style/github.css', array(), $version, 'all');
        wp_register_style('prism', get_template_directory_uri().'/build/style/prism-okaidia.css', array(), $version, 'all');
        wp_enqueue_style('main');
        wp_enqueue_style('Titillium');
        // Dla rekrutacji potrzebna jest ciężka czcionka
        if ($snrg_settings['recruitment']) {
            wp_enqueue_style('Titillium900');
        }
        if (is_author()) {
            wp_enqueue_style('github');
        }
        if (is_singular('project')) {
            wp_enqueue_style('prism');
        }
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

    wp_register_script('underscore', get_template_directory_uri().'/build/js/underscore.min.js', '1.6.0', true);
    wp_register_script('github.js', get_template_directory_uri().'/build/js/github.min.js', '0.1.3', true);
    wp_register_script('prism', get_template_directory_uri().'/build/js/prism.min.js', '', true);
    wp_register_script('main', get_template_directory_uri().'/build/js/main.min.js', array('jquery'), $version, true);
    wp_register_script('swipe', get_template_directory_uri().'/build/js/swipe.min.js', array('jquery'), $version, true);
    wp_register_script('blazy', get_template_directory_uri().'/build/js/blazy.min.js', array('jquery'), $version, true);
    // wp_register_script('cookie', get_template_directory_uri().'/build/js/js-cookie.min.js', '', true);
    if (is_author()) {
        wp_enqueue_script('underscore');
        wp_enqueue_script('github.js');
    }
    if (is_singular('project')) {
        wp_enqueue_script('prism');
    }
    // if ($snrg_settings['recruitment']) {
    //     wp_enqueue_script('cookie');
    // }
    wp_enqueue_script('swipe');
    wp_enqueue_script('blazy');
    wp_enqueue_script('main');
}
add_action('wp_footer', 'js');

// Pozostałości po bootstrapie -- do usunięcia //

// require_once 'lib/wp_bootstrap_navwalker.php';

// Rejestrujemu menu //

register_nav_menus(
    array(
        'main_menu' => 'Main Menu',
    )
);

// Rejestrujemy sidebar //

register_sidebar(
    array(
        'name' => 'Left Sidebar',
        'id' => 'left-sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    )
);

// Dodajemy wsparcie linków RSS //

add_theme_support('automatic-feed-links');
