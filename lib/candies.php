<?php

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function wpdocs_theme_name_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name


    // Add the blog description for the home/front page.
    if ( ( is_home() || is_front_page() ) ) {
        $title .= get_bloginfo( 'name', 'display' );
    }

    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }
    return $title;
}
add_filter( 'wp_title', 'wpdocs_theme_name_wp_title', 10, 2 );

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
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'large');
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
add_filter( 'enable_post_format_ui', '__return_false' );
// Wyłącza wyświetlanie komentarzy i odnośników w menu //
function remove_comments_and_links_from_menu()
{
    remove_menu_page('edit-comments.php');
    remove_menu_page('link-manager.php');
}
add_action('admin_menu', 'remove_comments_and_links_from_menu');

// Usuwa style .recentcomments //
// http://beerpla.net/2010/01/31/how-to-remove-inline-hardcoded-recent-comments-sidebar-widget-style-from-your-wordpress-theme/
add_action('widgets_init', 'remove_recent_comments_style');
function remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
}

// Usuwa wsparcie dla emoji //
function remove_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'remove_tinymce_emoji' );
}
add_action( 'init', 'remove_emoji' );
// Filter out the tinymce emoji plugin.

function remove_tinymce_emoji( $plugins ) {
	if ( ! is_array( $plugins ) ) {
		return array();
	}
	return array_diff( $plugins, array( 'wpemoji' ) );
}

// Inline style dla REKRUTACJI //
function enqueue_inline_styles() {
  global $snrg_settings;
  $recruitment_image = $snrg_settings['recruitment_image_'.rand(1, 3)];
  if ($snrg_settings['recruitment']) {
  	echo '<style>.modal-background {
      background-image: linear-gradient(rgba(0, 0, 0, 0.35), rgba(0, 0, 0, 0.35)),
      url('.$recruitment_image.') !important;}</style>
  	';
  }
}
add_action( 'wp_print_styles', 'enqueue_inline_styles',8 );

function synergia_footer_admin () {
echo 'Made with &hearts; in Wrocław by <a href="https://twitter.com/stsdc" target="_blank"> Stanisław</a>, powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> </p>';
}
add_filter('admin_footer_text', 'synergia_footer_admin');
