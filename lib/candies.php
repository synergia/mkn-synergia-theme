<?php

////////////////////////////////////////////////////////////////////
// Add Title Parameters
////////////////////////////////////////////////////////////////////

if (!function_exists('synergia_wp_title')) {
    function synergia_wp_title($title, $sep)
    { // Taken from Twenty Twelve 1.0
        global $paged, $page;

        if (is_feed()) {
            return $title;
        }

        // Add the site name.
        $title .= get_bloginfo('name');

        // Add the site description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            $title = "$title $sep $site_description";
        }

        // Add a page number if necessary.
        if ($paged >= 2 || $page >= 2) {
            $title = "$title $sep ".sprintf(__('Page %s', 'synergia'), max($paged, $page));
        }

        return $title;
    }
    add_filter('wp_title', 'synergia_wp_title', 10, 2);
}

function synergia_icons()
{   // Favicon //
    // Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size
    echo '<link rel="icon" href="'.get_template_directory_uri().'/img/favicon.png" />';
    // Apple stuff //
    // Touch Icons - iOS and Android 2.1+ 180x180 pixels in size
    echo '<link rel="apple-touch-icon-precomposed" href="'.get_template_directory_uri().'/img/apple-touch-icon-precomposed.png">';
    echo '<link rel="apple-touch-icon" href="'.get_template_directory_uri().'/img/safari_60.png">';
    echo '<link rel="apple-touch-icon" sizes="76x76" href="'.get_template_directory_uri().'/img/safari_76.png">';
    echo '<link rel="apple-touch-icon" sizes="120x120" href="'.get_template_directory_uri().'/img/safari_120.png">';
    echo '<link rel="apple-touch-icon" sizes="152x152" href="'.get_template_directory_uri().'/img/safari_152.png">';
    // MS stuff //
    // For IE 9 and below. ICO should be 32x32 pixels in size
    echo '<!--[if IE]><link rel="shortcut icon" href="'.get_template_directory_uri().'/img/favicon.ico"><![endif]-->';
}
add_action('wp_head', 'synergia_icons');

////////////////////////////////////////////////////////////////////
// Custom excerpt ellipses, custom length
///////////////////////////////////////////////////////////////////
function custom_excerpt_more($more)
{
    return '';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function new_excerpt_length($length)
{
    return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

////////////////////////////////////////////////////////////////////
// Dynamic Copy Year
////////////////////////////////////////////////////////////////////
function comicpress_copyright()
{
    global $wpdb;
    $copyright_dates = $wpdb->get_results("
SELECT
YEAR(min(post_date_gmt)) AS firstdate,
YEAR(max(post_date_gmt)) AS lastdate
FROM
$wpdb->posts
WHERE
post_status = 'publish'
");
    $output = '';
    if ($copyright_dates) {
        $copyright = '&copy; '.$copyright_dates[0]->firstdate;
        if ($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
            $copyright .= '-'.$copyright_dates[0]->lastdate;
        }
        $output = $copyright;
    }

    return $output;
}

////////////////////////////////////////////////////////////////////
// Remove version
////////////////////////////////////////////////////////////////////
function wpbeginner_remove_version()
{
    return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

// Remove post formats support //
// Usuwa różne niepotrzebne formaty postów typu linki, wideo itd.
add_action('after_setup_theme', 'remove_post_formats', 11);
function remove_post_formats()
{
    remove_theme_support('post-formats');
}
// Wyłącza wyświetlanie komentarzy w menu //
function remove_commnets_from_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_commnets_from_menu');
