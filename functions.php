<?php
// Info o motywie //
    $theme = wp_get_theme();
    $version = $theme->get('Version');
    $theme_name = $theme->get('Name');
    $codename = 'Emma Stone';

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

// Dodatkowe fukcje porozrzucane po plikach //
include 'lib/theme-options.php';
include 'lib/post-types.php';
include 'lib/author-functions.php';
include 'lib/project-functions.php';
include 'lib/candies.php';
include 'lib/additional_attachments.php';

// Szortkody //

    include 'lib/shortcodes.php';

// Synergiczne style //

    function synergia_theme_stylesheets()
    {
        global $version;
        wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,700&subset=latin,latin-ext');
        wp_register_style('main', get_template_directory_uri().'/css/main.css', array(), $version, 'all');
        wp_register_style('github', get_template_directory_uri().'/css/github.css', array(), $version, 'all');
        wp_register_style('prism', get_template_directory_uri().'/css/prism.css', array(), $version, 'all');
        wp_register_style('prism', get_template_directory_uri().'/css/prism.css', array(), $version, 'all');
        wp_enqueue_style('main');
        wp_enqueue_style('googleFonts');
        if (is_author()) {
            wp_enqueue_style('github');
        }
        if (is_singular('project')) {
            wp_enqueue_style('prism');
        }
    }
    add_action('wp_enqueue_scripts', 'synergia_theme_stylesheets');

// Synergiczne skrypty //

function js()
{
  global $snrg_settings;

    wp_register_script('underscore', get_template_directory_uri().'/js/underscore.min.js', '1.6.0', true);
    wp_register_script('github.js', get_template_directory_uri().'/js/github.min.js', '0.1.3', true);
    wp_register_script('prism', get_template_directory_uri().'/js/prism.js', '', true);
    wp_register_script('cookie', get_template_directory_uri().'/js/js.cookie-2.0.4.min.js', '', true);
    if (is_author()) {
        wp_enqueue_script('underscore');
        wp_enqueue_script('github.js');
    }
    if (is_singular('project')) {
        wp_enqueue_script('prism');
    }
    if ($snrg_settings['recruitment']) {
        wp_enqueue_script('cookie');
    }
    wp_enqueue_script('js', get_template_directory_uri().'/js/js.js', array('jquery'), $version, true);
}
add_action('wp_footer', 'js');

// Pozostałości po bootstrapie -- do usunięcia //

require_once 'lib/wp_bootstrap_navwalker.php';
require_once 'lib/bootstrap-custom-menu-widget.php';

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
