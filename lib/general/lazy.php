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

    $img_replace = $img_match[1] . 'src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src' . substr($img_match[2], 3) . $img_match[3];

    $img_replace = preg_replace('/class\s*=\s*"/i', 'class="blazy ', $img_replace);

    $img_replace .= '<noscript>' . $img_match[0] . '</noscript>';
    return $img_replace;
}
