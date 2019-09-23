<?php
// Zamieniamy szortkod galerii na slider //
// http://wordpress.stackexchange.com/questions/75111/change-wordpress-gallery-shortcode-to-slider
// https://gist.github.com/hullen/5443218
function grab_ids_from_gallery(){
	global $post;

	$post_content = $post->post_content;
	preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
	$images_id = explode(",", $ids[1]);

	return $images_id;
}

remove_shortcode( 'gallery' );
    function gallery_filter( $atts, $content = null ) {

  extract(shortcode_atts(array('gallery_name' => ''), $args));
    $args = array(
        'post_type'   => 'attachment',
        'posts_per_page' => -1,
        'post_parent' => $post->ID,
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'post_mime_type' => 'image'

        );
$output .= "<div id='slider' class='swipe'><div class='swipe-wrap'>";

  $attachments = get_posts( $args );
  $grabids = grab_ids_from_gallery();

    if ( $attachments )
    {
        foreach ( $attachments as $attachment )
        {
            if ( in_array( $attachment->ID, $grabids ) ) {
                 $output .= "<div><img class='slide' src='".wp_get_attachment_url( $attachment->ID )."' /></div>";
            }
        }
             $output .= " </div><div class='swipe__nav swipe__prev'><i class='icon-left-open-big'></i></div>
                          <div class='swipe__nav swipe__next'><i class='icon-right-open-big'></i></div></div>";
  }
  return $output;

  }

  add_shortcode( 'gallery' , 'gallery_filter' );

 ?>
