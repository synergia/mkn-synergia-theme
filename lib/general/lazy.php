<?php
// https://www.elegantthemes.com/blog/tips-tricks/how-to-add-lazy-loading-to-wordpress
// Szuka obrazków <img>
function filter_lazyload($content) {
    return preg_replace_callback('/(<\s*img[^>]+)(src\s*=\s*"[^"]+")([^>]+>)/i', 'preg_lazyload', $content);
}
add_filter('the_content', 'filter_lazyload');

// When called, this function will search through content and find all of the images.
// It will then pass these images along to the preg_lazyload function which we will
// talk through below. Next, we use the “the_content” filter to automatically filter
// through all of our post’s content when a post is rendered. This is not the most
// performant way to accomplish this, but it works quite well. Each time a post is
// rendered, all images will be filtered out and run through “preg_lazyload”.

function preg_lazyload($img_match) {

    $img_replace = $img_match[1] . 'class="blazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src' . substr($img_match[2], 3) . $img_match[3];

    $img_replace = preg_replace('/class\s*=\s*"/i', 'class="blazy ', $img_replace);

    $img_replace .= '<noscript>' . $img_match[0] . '</noscript>';
    return $img_replace;
}

// Infinite Scroll //
function load_projects(){

     $post_offset = $_POST['post_offset'];
     $projects_status = $_POST['projects_status'];

     $ideas = array(
         'numberposts' => -1,
         'post_type' => 'project',
         'meta_key' => 'project_status',
         'meta_value' => 'Pomysł',
         'offset' => $post_offset
     );
     $in_progress = array(
         'numberposts' => -1,
         'post_type' => 'project',
         'meta_key' => 'project_status',
         'meta_value' => 'W trakcie realizacji',
         'offset' => $post_offset
     );
     $finished = array(
       'numberposts' => -1,
       'post_type' => 'project',
       'meta_query' => array(
         'relation' => 'OR',
         array(
           'key' => 'project_status',
           'value' => 'Ukończony',
         ),
         array(
           'key' => 'project_status',
           'value' => 'W ciągłym doskonaleniu',
         ),
       ),
       'offset' => $post_offset
     );
     if($projects_status == 'ideas') {
     $projects = new WP_Query($ideas);
   } else if ($projects_status == 'in_progress') {
     $projects = new WP_Query($in_progress);
   } else if ($projects_status == 'finished') {
     $projects = new WP_Query($finished);
   }
     project_card($projects);
     die();
}

add_action('wp_ajax_load_projects', 'load_projects');           // for logged in user
add_action('wp_ajax_nopriv_load_projects', 'load_projects');
