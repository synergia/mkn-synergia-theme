<?php

// Usunięcie wsparcia dla różnych niepotrzebnych rzeczy //

// Usuwa Updraft z adminbaru //
define('UPDRAFTPLUS_ADMINBAR_DISABLE', true);

function remove_admin_bar_wordpress()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
} add_action('wp_before_admin_bar_render', 'remove_admin_bar_wordpress');

// Usuwa style .recentcomments //
// http://beerpla.net/2010/01/31/how-to-remove-inline-hardcoded-recent-comments-sidebar-widget-style-from-your-wordpress-theme/
add_action('widgets_init', 'remove_recent_comments_style');
function remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

// Usuwa wsparcie dla emoji //
function remove_emoji()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    // Remove from TinyMCE
    add_filter('tiny_mce_plugins', 'remove_tinymce_emoji');
}
add_action('init', 'remove_emoji');
// Filter out the tinymce emoji plugin.

function remove_tinymce_emoji($plugins)
{
    if (!is_array($plugins)) {
        return array();
    }

    return array_diff($plugins, array('wpemoji'));
}

function remove_version()
{
    return '';
}
add_filter('the_generator', 'remove_version');

// Remove post formats support //
// Usuwa różne niepotrzebne formaty postów typu linki, wideo itd.
add_action('after_setup_theme', 'remove_post_formats', 11);
function remove_post_formats()
{
    remove_theme_support('post-formats');
}
add_filter('enable_post_format_ui', '__return_false');

// Wyłącza niepotrzebne pozycje w menu //

add_action('admin_bar_menu', 'remove_some_nodes_from_admin_top_bar_menu', 999);
function remove_some_nodes_from_admin_top_bar_menu($wp_admin_bar)
{
    $wp_admin_bar->remove_menu('customize');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('link-add');
}

function remove_comments_and_links_from_menu()
{
    remove_menu_page('edit-comments.php');
    remove_menu_page('link-manager.php');
    if (!is_admin()) {
        remove_menu_page('tools.php');
    }
    global $submenu;
    unset($submenu['themes.php'][6]); // Customize
    remove_submenu_page('themes.php', 'theme-editor.php');
}
add_action('admin_menu', 'remove_comments_and_links_from_menu', 999);

// Usuwa zbędne widżety z kokpitu //
function remove_dashboard_widgets()
{
    global $wp_meta_boxes;

    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    remove_action('welcome_panel', 'wp_welcome_panel');
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// Usuwa plik Windows Live Writer //
remove_action('wp_head', 'wlwmanifest_link');

// Usuwa wp-embed.min.js //
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );


 // Dequeue jQuery migrate script in WordPress //
 // Mogą nie działać niektóre wtyczki //

function isa_remove_jquery_migrate( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.11.3' );
    }
}
add_filter( 'wp_default_scripts', 'isa_remove_jquery_migrate' );
