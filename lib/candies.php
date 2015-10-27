<?php
////////////////////////////////////////////////////////////////////
// Add Title Parameters
////////////////////////////////////////////////////////////////////

if(!function_exists('synergia_wp_title')) {

    function synergia_wp_title( $title, $sep ) { // Taken from Twenty Twelve 1.0
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'synergia' ), max( $paged, $page ) );

        return $title;
    }
    add_filter( 'wp_title', 'synergia_wp_title', 10, 2 );

}


////////////////////////////////////////////////////////////////////
// Favicon
////////////////////////////////////////////////////////////////////
function blog_favicon() {
echo '<link rel="icon" type="image/png" href="'.get_template_directory_uri() . '/img/fav.png" />';
}
add_action('wp_head', 'blog_favicon');

////////////////////////////////////////////////////////////////////
// Custom excerpt ellipses, custom length
///////////////////////////////////////////////////////////////////
function custom_excerpt_more($more) {
return '';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function new_excerpt_length($length) {
return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

////////////////////////////////////////////////////////////////////
// Dynamic Copy Year
////////////////////////////////////////////////////////////////////
function comicpress_copyright() {
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
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}

////////////////////////////////////////////////////////////////////
// Remove version
////////////////////////////////////////////////////////////////////
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

////////////////////////////////////////////////////////////////////
// Polskie komentarze od adpawl
////////////////////////////////////////////////////////////////////
function odmiana($in,$lp,$lm1,$lm2) {
 if ($in==1) return $lp;
 elseif (($in%10>1) && ($in%10<5) && !(($in%100>=10) && ($in%100<=21))) return $lm1;
return $lm2;
};


function wpse31443_author_has_custom_post_type( $post_author, $post_type ) {
    global $wp_post_types; // If nonexistent post type found return
    if ( array_intersect((array)$post_type, array_keys($wp_post_types))
        != (array)$post_type ) return false;

    static $posts = NULL; // Cache the query internally
    if ( !$posts ) {
        global $wpdb;

        $sql = "SELECT `post_type`, `post_author`, COUNT(*) AS `post_count`".
            " FROM {$wpdb->posts}".
            " WHERE `post_type` NOT IN ('revision', 'nav_menu_item')".
            " AND `post_status` IN ('publish', 'pending')".
            " GROUP BY `post_type`, `post_author`";

        $posts = $wpdb->get_results( $sql );
    }

    foreach( $posts as $post ) {
        if ( $post->post_author == $post_author
            and in_array( $post->post_type, (array)$post_type )
            and $post->post_count ) return true;
    }

    return false;
}

// Pousuwać nieptrzebne emoji //
function disable_wp_emojicons() {

  // all actions related to emojis
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

  // filter to remove TinyMCE emojis
  add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
}
// add_action( 'init', 'disable_wp_emojicons' );

?>
