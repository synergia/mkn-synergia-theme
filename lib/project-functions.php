<?php
// http://www.sitepoint.com/guide-to-wordpress-custom-write-panels/
//This initializes the write panel.
add_action('admin_init','linki_meta_init');

function linki_meta_init() {
    // Dodaje meta boxy do określonego typu postów
    add_meta_box('linki_meta','Linki','linki_meta', 'project', 'side', 'default' );
    add_meta_box('project_status_box', 'Stan Projektu', 'project_status', 'project', 'side' , 'default');
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
  include(get_template_directory() . '/lib/meta.php');
  wp_nonce_field('my_meta_noncename', __FILE__);
  // create a custom nonce for submit
  // verification later
  echo '';
}


//The function below checks the
//authentication via the nonce, and saves
//it to the database.
function save_meta($post_id) {
  if (!current_user_can('edit_posts', $post_id)) {
    return $post_id;
  }
  // The array of accepted fields for Project
    $accepted_fields['project'] = array(
      'github',
      'facebook',
      'web'
    );
    $post_type_id = $_POST['post_type'];

  //We loop through the list of fields,
  //and save 'em!
    if (is_array($accepted_fields[$post_type_id]) || is_object($accepted_fields[$post_type_id])){

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
    }
    // Zapisuje stan projektu
        if(isset($_POST["project_status_options"])){
         //UPDATE:
        $project_status = $_POST['project_status_options'];
        //END OF UPDATE

        update_post_meta($post_id, 'project_status', $project_status);
        //print_r($_POST);
    }
  return $post_id;
}
add_action( 'save_post', 'save_meta', 3, 1 );

function project_status($post){
    // http://stackoverflow.com/a/29182258
    $project_status = get_post_meta($post->ID, 'project_status', true); //true ensures you get just one value instead of an array
    ?>
    <label>Stan projektu :  </label>

    <select name="project_status_options" id="project_status_options">
      <option value="Pomysł" <?php selected( $project_status, 'Pomysł' ); ?>>Pomysł</option>
      <option value="W trakcie realizacji" <?php selected( $project_status, 'W trakcie realizacji' ); ?>>W trakcie realizacji</option>
      <option value="Ukończony" <?php selected( $project_status, 'Ukończony' ); ?>>Ukończony</option>
      <option value="W ciągłym doskonaleniu" <?php selected( $project_status, 'W ciągłym doskonaleniu' ); ?>>W ciągłym doskonaleniu</option>
    </select>
    <?php
}

add_theme_support('post-thumbnails');

// Hook into the 'init' action
add_action( 'init', 'sponsorowane', 0 );

// Obrazki dla portfolio
add_image_size( 'medium', 355, 300, true );

//
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="button pagination"';
}

// Ubiera obrazki w figure //
// Tylko gdy obrazek ma tytuł jakiś, inaczej działa js, który wrzuca sam obrazek
// w <figure>
add_filter('img_caption_shortcode', 'img_caption_shortcode_filter',10,3);
function img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) ) {
        return $val;
      }
    $capid = '';
    if ( $id ) {
        $id = esc_attr($id);
        $capid = 'id="figcaption_'. $id . '" ';
    }
    return do_shortcode( $content ) . '<figure>'.$content.'
    <figcaption ' . $capid
    . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

// Ta funkcja wstawia <figure> od razu w edytorze. Niech tu na wszelki wypadek
// zostanie
// https://css-tricks.com/snippets/wordpress/insert-images-with-figurefigcaption/

// add_filter( 'image_send_to_editor', 'html5_insert_image', 10, 9 );
function html5_insert_image($html, $id, $caption, $title, $align, $url) {
  // $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
  $html5 = "<figure id='$id'>";
  $html5 .= "<img src='$url' alt='$title' />";
  $html5 .= "</figure>";
  return $html5;
}

// Wzucanie wszystkich embed do diva
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}

function the_project_status($project_ID) {
    $project_status = get_post_meta($project_ID, "project_status", true);
    if($project_status){
        echo '<span>Stan: '.$project_status.'</span>';
    }else {
        echo '<span>Stan: Nieznany</span>';
    }
}

function the_project_links($project_ID) {
    $web = get_post_meta($project_ID, "web", true);
    $facebook = get_post_meta($project_ID, "facebook", true);
    $github = get_post_meta($project_ID, "github", true);
    if( $web || $facebook || $github) {
        echo '<div class="project-links">';
        if($web){
            echo '<a href="'.get_post_meta($project_ID, "web", true).'"><i class="icon icon-link"></i></a>';
        }
        if($facebook) {
            echo '<a href="'.get_post_meta($project_ID, "facebook", true).'"><i class="icon icon-facebook"></i></a>';
        }    if($github) {
            echo '<a href="'.get_post_meta($project_ID, "github", true).'"><i class="icon icon-github"></i></a>';
        }
        echo '</div>';
    }
}

function download_button ($project_ID) {
    $files = get_post_meta($project_ID,'files',true);
    if($files){
 ?>
    <div id="dropdown" class="download-files-container">
        <button class="button raised">Pobierz pliki <i class="icon icon-down-open-big"></i></button>
        <ul>
<?php
    if ( is_array($files) ) {
        foreach( $files as $file ) {
            if ( isset( $file['url'] ) || isset( $file['title'] ) ) {
                echo '<li><a href="'.$file["url"].'">'.$file["title"].'</a></li>';
            }
        }
    }
    ?>
        </ul>
    </div>
<?php
    }
}
// Przypomina, by zainstalować wtyczki //
function remind_install_dependencies() {
  if ( !is_plugin_active( 'co-authors-plus/co-authors-plus.php' ) ) {
    echo '<div class="error"> <p>Należy zainstalować wtyczkę Co-Authors Plus</p></div>';
  }
  if ( !is_plugin_active( 'wp-users-media/index.php' ) ) {
    echo '<div class="error"> <p>Należy zainstalować wtyczkę WP Users Media</p></div>';
  }
}
add_action( 'admin_notices', 'remind_install_dependencies' );
