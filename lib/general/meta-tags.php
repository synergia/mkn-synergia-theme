<?php

function header_meta_tags()
{   // Favicon //
    // Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size
    echo '<link rel="icon" href="'.get_template_directory_uri().'/build/img/favicon.png" />'."\n";

    // Apple stuff //
    // Touch Icons - iOS and Android 2.1+ 180x180 pixels in size
    echo '<link rel="apple-touch-icon-precomposed" href="'.get_template_directory_uri().'/build/img/apple-touch-icon-precomposed.png">'."\n";
    echo '<link rel="apple-touch-icon" href="'.get_template_directory_uri().'/build/img/safari_60.png">'."\n";
    echo '<link rel="apple-touch-icon" sizes="76x76" href="'.get_template_directory_uri().'/build/img/safari_76.png">'."\n";
    echo '<link rel="apple-touch-icon" sizes="120x120" href="'.get_template_directory_uri().'/build/img/safari_120.png">'."\n";
    echo '<link rel="apple-touch-icon" sizes="152x152" href="'.get_template_directory_uri().'/build/img/safari_152.png">'."\n";
    echo '<link rel="apple-touch-startup-image" href="'.get_template_directory_uri().'/build/img/apple-touch-icon-precomposed.png">'."\n";
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
// https://adactio.com/journal/9881
function opengraph()
{
    global $post;
    global $wp;
    $current_url = home_url(add_query_arg(array(),$wp->request));

    if (is_single() || is_page() && !is_front_page()) {
        if (has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
        } else {
            $img_src[0] = get_template_directory_uri().'/build/img/main-og-img.png';
        }
        $description = my_excerpt($post->post_content, $post->post_excerpt);
        $description = strip_tags($description);
        $description = str_replace('"', "'", $description);
        ?>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" value="@MKNMSynergia" />
    <meta name="twitter:title" property="og:title" content="<?php echo the_title(); ?>"/>
    <meta name="twitter:description" property="og:description" content="<?php echo $description; ?>"/>
    <meta property="og:type" content="article"/>
    <meta name="twitter:url" property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
    <meta name="twitter:image" property="og:image" content="<?php echo $img_src[0]; ?>"/>

<?php

    } else if (is_front_page()){ ?>
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:site" value="@MKNMSynergia" />
      <meta name="twitter:title" property="og:title" content="<?php echo get_bloginfo('name'); ?>"/>
      <meta name="twitter:description" property="og:description" content="<?php echo get_bloginfo('description'); ?>"/>
      <meta property="og:type" content="website"/>
      <meta name="twitter:url" property="og:url" content="<?php echo get_bloginfo('url'); ?>"/>
      <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
      <meta name="twitter:image" property="og:image" content="<?php echo get_template_directory_uri().'/build/img/main-og-img.png'; ?>"/>
<?php
    } elseif (is_author()) {
        global $wp_query;
        $current_member = $wp_query->get_queried_object();

?>
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:site" value="@MKNMSynergia" />
      <meta name="twitter:title" property="og:title" content="<?php echo $current_member->display_name; ?>"/>
      <meta name="twitter:description" property="og:description" content="<?php echo show_membership_status($current_member); ?>"/>
      <meta property="og:type" content="website"/>
      <meta name="twitter:url" property="og:url" content="<?php echo $current_url; ?>"/>
      <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>"/>
      <meta name="twitter:image" property="og:image" content="<?php echo get_member_avatar_url($current_member) ?>"/>
      <?php if($current_member->twitter_profile) {
          echo '<meta name="twitter:creator" content="'.$current_member->twitter_profile.'" />';
      } ?>
<?php

    }
}
add_action('wp_head', 'opengraph', 5);

// This will ensure that the proper doctype is added to our HTML.
// Without this code, most platforms would simply skip over our webpage,
// and the tags we are about to add would never get parsed.
function doctype_opengraph($output)
{
    return $output.'
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"
    itemscope itemtype="http://schema.org/EducationalOrganization"';
}
add_filter('language_attributes', 'doctype_opengraph');

 ?>
