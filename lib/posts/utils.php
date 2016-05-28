<?php

// Remove category support from posts
function myprefix_unregister_tags()
{
    unregister_taxonomy_for_object_type('category', 'post');
}
add_action('init', 'myprefix_unregister_tags');

function show_tags($css_class)
{
    $tags = get_the_tags();
    if ($tags) {
        foreach ($tags as $tag) {
            $tag_link = get_tag_link($tag->term_id);
            $html .= "<a href='{$tag_link}' title='Zobacz wszystkie wpisy z tagiem: {$tag->name}' class='{$tag->slug} {$css_class} link link--tag '>";
            $html .= "#{$tag->name}</a>";
        }
        echo $html;
    }
}
// generate tag cloud
function My_TagCloud($params = array()) {

	extract(shortcode_atts(array(
		'orderby' => 'name',		// sort by name or count
		'order' => 'ASC',		// in ASCending or DESCending order
		'number' => '',			// limit the number of tags
		'wrapper' => '',		// a tag wrapped around tag links, e.g. li
		'sizeclass' => 'tagSize-',	// the tag class name
		'sizemin' => 1,			// the smallest number applied to the tag class
		'sizemax' => 5			// the largest number applied to the tab class
	), $params));
    // initialize
$ret = '';
$min = 9999999; $max = 0;
// fetch all WordPress tags
	$tags = get_tags(array('orderby' => $orderby, 'order' => $order, 'number' => $number));
    // get minimum and maximum number tag counts
	foreach ($tags as $tag) {
		$min = min($min, $tag->count);
		$max = max($max, $tag->count);
	}
    // generate tag list
    	foreach ($tags as $tag) {
    		$url = get_tag_link($tag->term_id);
            if ($max > $min) {
    			$class = $sizeclass . floor((($tag->count - $min) / ($max - $min)) * ($sizemax - $sizemin) + $sizemin);
    		}
    		else {
    			$class = $sizeclass;
    		}
            $ret .= ($wrapper ? '<'.$wrapper.' class="tagWrapper">' : '') . '<a href="'.$url.'" class="'.$class.' link">'.$tag->name.'</a>' .
			($wrapper ? '</'.$wrapper.'>' : '');

    	}
        return str_replace(get_bloginfo('url'), '', $ret);
}
// enable [tagcloud] shortcode
add_shortcode('tagcloud', 'My_TagCloud');
