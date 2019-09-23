<?php


function wpdocs_theme_name_wp_title($title, $sep)
{
    if (is_feed()) {
        return $title;
    }

    global $page, $paged;

    // Add the blog name


    // Add the blog description for the home/front page.
    if ((is_home() || is_front_page())) {
        $title .= get_bloginfo('name', 'display');
    }

    // Add a page number if necessary:
    if (($paged >= 2 || $page >= 2) && !is_404()) {
        $title .= " $sep ".sprintf(__('Strona %s', '_s'), max($paged, $page));
    }

    return $title;
}
add_filter('wp_title', 'wpdocs_theme_name_wp_title', 10, 2);

function synergia_footer_admin()
{
    echo 'Made with &hearts; in Wrocław by <a href="https://twitter.com/stsdc" target="_blank"> Stanisław</a>, powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> </p>';
}
add_filter('admin_footer_text', 'synergia_footer_admin');


// Przypomina, by zainstalować wtyczki //
function remind_to_do() {
  if ( !is_plugin_active( 'co-authors-plus/co-authors-plus.php' ) ) {
    echo '<div class="error"> <p>Należy zainstalować wtyczkę Co-Authors Plus</p></div>';
  }
  if ( !is_plugin_active( 'wp-users-media/index.php' ) ) {
    echo '<div class="error"> <p>Należy zainstalować wtyczkę WP Users Media</p></div>';
  }
  if ( !is_plugin_active( 'custom-upload-dir/custom_upload_dir.php' ) ) {
    echo '<div class="error"> <p>Należy zainstalować wtyczkę Custom Upload Dir</p></div>';
  }

  $current_member = wp_get_current_user();
  if(!get_member_avatar_url($current_member)) {
    echo '<div class="error"> <p>Dodaj zdjęcie profilowe!</p><img src="'.get_template_directory_uri().'/build/img/b.jpg"/></div>';
  }
}
add_action( 'admin_notices', 'remind_to_do' );

// Dynamiczna zmiania roku //
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

// Zaawansowana ekscerpcja //

function my_excerpt($text, $excerpt)
{
    if ($excerpt) {
        return $excerpt;
    }

    $text = strip_shortcodes($text);

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 25);
    $excerpt_more = apply_filters('excerpt_more', '...');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if (count($words) > $excerpt_length) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text.$excerpt_more;
    } else {
        $text = implode(' ', $words);
    }

    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}
// Zmienia Posts na Blog //
function change_post_menu_label() {
    global $menu;
    $menu[5][0] = 'Blog';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );

// Wyświetla także projekty w archiwum //
function namespace_add_custom_types( $query ) {
  if ( is_admin() || ! $query->is_main_query() )
        return;
  if(is_category() || is_tag() || is_archive() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'project'
		));
	  return $query;
	}
}
add_filter( 'pre_get_posts', 'namespace_add_custom_types' );

// Dodaje style dla paginacji //
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn btn--pagination"';
}
