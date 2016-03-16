<?php

// Remove category support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('category', 'post');
}
add_action('init', 'myprefix_unregister_tags');

function show_tags($css_class) {
    $tags = get_tags();
foreach ( $tags as $tag ) {
	$tag_link = get_tag_link( $tag->term_id );

	$html .= "<a href='{$tag_link}' title='Zobacz wszystkie wpisy z tagiem: {$tag->name}' class='{$tag->slug} {$css_class} link link--tag '>";
	$html .= "#{$tag->name}</a>";
}
echo $html;
}
