<?php
// http://www.sitepoint.com/guide-to-wordpress-custom-write-panels/
//This initializes the write panel.
add_action('admin_init','links_init');

function links_init() {
    // Dodaje meta boxy do określonego typu postów
    add_meta_box('links','Linki','links', 'project', 'side', 'default' );
    add_meta_box('project_status_box', 'Stan Projektu', 'project_status', 'project', 'side' , 'default');
}
// The function below links the panel
// to the custom fields
// ---------------------------------
function links() {
    global $post;

    //zmienne
    $github = get_post_meta($post->ID,'github',TRUE);
    $facebook = get_post_meta($post->ID,'facebook',TRUE);
    $web = get_post_meta($post->ID,'web',TRUE);

  //Call the write panel HTML
  include(get_template_directory() . '/lib/projects/links.php');
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
        elseif(isset($custom_field) && !is_null($custom_field))
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

// Obrazki dla portfolio
add_image_size( 'card_image', 355, 300, true );
?>
