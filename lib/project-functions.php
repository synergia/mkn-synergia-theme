<?php
// http://www.sitepoint.com/guide-to-wordpress-custom-write-panels/
//This initializes the write panel.
add_action('admin_init','linki_meta_init');

function linki_meta_init() {
  //This adds our CSS file,
//  so our write panels look pretty.
  wp_enqueue_style(
    'meta',
    get_template_directory_uri() . '/css/admin.css'
  );

  //This method is the one that actually adds the
  //write panel, named 'Book Information' to the
  //post type 'books'
  add_meta_box(
    'linki_meta',
    'Linki',
    'linki_meta',
    'project',
    'side',
    'default'
  );
}
// The function below links the panel
// to the custom fields
// ---------------------------------
function linki_meta() {
    global $post;

    //zmienne
    $github = get_post_meta($post->ID,'github',TRUE);
    $facebook = get_post_meta($post->ID,'facebook',TRUE);
    $web = get_post_meta($post->ID,'web',TRUE);

  //Call the write panel HTML
  include(get_template_directory() . '/meta.php');
  wp_nonce_field('my_meta_noncename', __FILE__);
  // create a custom nonce for submit
  // verification later
  echo '';
}


//The function below checks the
//authentication via the nonce, and saves
//it to the database.
function my_meta_save($post_id) {
  if (!current_user_can('edit_posts', $post_id)) {
    return $post_id;
  }
  // The array of accepted fields for Books
    $accepted_fields['project'] = array(
      'github',
      'facebook',
      'web'
    );
    $post_type_id = $_POST['post_type'];

  //We loop through the list of fields,
  //and save 'em!
  foreach($accepted_fields[$post_type_id] as $key){
    // Set it to a variable, so it's
    // easier to deal with.
    $custom_field = $_POST[$key];

    //If no data is entered
    if(is_null($custom_field)) {

      //delete the field. No point saving it.
      delete_post_meta($post_id, $key);

      // If it is set (there was already data),
      // and the new data isn't empty, update it.
    }
    elseif(isset($custom_field)
&& !is_null($custom_field))
    {
      // update
     update_post_meta($post_id,$key,$custom_field);

      //Just add the data.
    } else {
      // Add?
      add_post_meta($post_id, $key,
        $custom_field, TRUE);
    }
  }
  return $post_id;
}
add_action( 'save_post', 'my_meta_save', 3, 1 );
add_theme_support('post-thumbnails');

// Hook into the 'init' action
add_action( 'init', 'sponsorowane', 0 );

// Obrazki dla portfolio
add_image_size( 'medium', 355, 300, true );

//
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'am-button';
}

add_filter('img_caption_shortcode', 'img_caption_shortcode_filter',10,3);

/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 *
 * @return text HTML content describing embedded figure
 **/
function img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
        return $val;

    $capid = '';
    if ( $id ) {
        $id = esc_attr($id);
        $capid = 'id="figcaption_'. $id . '" ';
        $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }

    return '<figure ' . $id . '>'
    . do_shortcode( $content ) . '<figcaption ' . $capid
    . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}
// Wzucanie wszystkich embed do diva
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}

add_filter( 'oembed_result', 'hide_youtube_related_videos', 10, 3);
 function hide_youtube_related_videos($data, $url, $args = array()) {
 $data = preg_replace('/(youtube\.com.*)(\?feature=oembed)(.*)/', '$1?' . apply_filters("hyrv_extra_querystring_parameters", "wmode=transparent&amp;color=blue&amp;") . 'rel=0$3', $data);
 return $data;
 }
?>
