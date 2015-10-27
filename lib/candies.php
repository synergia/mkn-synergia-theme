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

function header_meta_tags()
{   // Favicon //
    // Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size
    echo '<link rel="icon" href="'.get_template_directory_uri().'/img/favicon.png" />'."\n";

    // Apple stuff //
    // Touch Icons - iOS and Android 2.1+ 180x180 pixels in size
    echo '<link rel="apple-touch-icon-precomposed" href="'.get_template_directory_uri().'/img/apple-touch-icon-precomposed.png">'."\n";
    echo '<link rel="apple-touch-icon" href="'.get_template_directory_uri().'/img/safari_60.png">'."\n";
    echo '<link rel="apple-touch-icon" sizes="76x76" href="'.get_template_directory_uri().'/img/safari_76.png">'."\n";
    echo '<link rel="apple-touch-icon" sizes="120x120" href="'.get_template_directory_uri().'/img/safari_120.png">'."\n";
    echo '<link rel="apple-touch-icon" sizes="152x152" href="'.get_template_directory_uri().'/img/safari_152.png">'."\n";
    echo '<link rel="apple-touch-startup-image" href="'.get_template_directory_uri().'/img/apple-touch-icon-precomposed.png">'."\n";
    // Nazwa aplikacji
    echo '<meta name="apple-mobile-web-app-title" content="'.get_bloginfo('name').'">'."\n";
    // Wygląd statusbaru
    echo '<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">'."\n";
    // Enables or disables automatic detection of possible phone numbers in a webpage in Safari on iOS.
    echo '<meta name="format-detection" content="telephone=no">'."\n";

    // MS stuff //
    // For IE 9 and below. ICO should be 32x32 pixels in size
    echo '<!--[if IE]><link rel="shortcut icon" href="'.get_template_directory_uri().'/img/favicon.ico"><![endif]-->'."\n";

    // Android stuff //
    echo '<meta name="application-name" content="'.get_bloginfo('name').'">'."\n";
    // Kolor nagłówka
    echo '<meta name="theme-color" content="#6c4892">'."\n";
}
add_action('wp_head', 'header_meta_tags');

// OpenGraph //
// http://www.paulund.co.uk/add-facebook-open-graph-tags-to-wordpress
function opengraph() {
    global $post;

    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
        } else {
            $img_src = get_template_directory_uri().'/img/defaulth.png';
        }
        $description = my_excerpt( $post->post_content, $post->post_excerpt );
      		$description = strip_tags($description);
      		$description = str_replace("\"", "'", $description);
        ?>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" value="@MKNMSynergia" />
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $description; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
    <meta property="og:image" content="<?php echo $img_src[0]; ?>"/>

<?php
    } else {
        return;
    }
}
add_action('wp_head', 'opengraph', 5);

// This will ensure that the proper doctype is added to our HTML.
// Without this code, most platforms would simply skip over our webpage,
// and the tags we are about to add would never get parsed.
function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');

function my_excerpt($text, $excerpt){

    if ($excerpt) return $excerpt;

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 25);
    $excerpt_more = apply_filters('excerpt_more', '...');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }
    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}

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
