<?php

////////////////////////////////////////////////////////////////////
// Theme Information
////////////////////////////////////////////////////////////////////
    $themename = "Synergia";
    $developer_uri = "http://vk.com/stsdc";
    $shortname = "sy";
    $version = '0.2.8';
////////////////////////////////////////////////////////////////////
// include Theme-options.php for Admin Theme settings
////////////////////////////////////////////////////////////////////

   include 'theme-options.php';

////////////////////////////////////////////////////////////////////
// Include shortcodes.php for Bootstrap Shortcodes
////////////////////////////////////////////////////////////////////

    include 'shortcodes.php';

////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////
    function synergia_theme_stylesheets()
    {
        global $version;
        wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), $version, 'all' );
        wp_enqueue_style( 'main');
        //wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), array(), '1', 'all' );
    }
    add_action('wp_enqueue_scripts', 'synergia_theme_stylesheets');

//Editor Style
add_editor_style('css/editor-style.css');

////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////
    function synergia_theme_js()
    {
        global $version;
        wp_enqueue_script('js', get_template_directory_uri() . '/js/js.js',array( 'jquery' ),$version,true );
    }
    add_action('wp_enqueue_scripts', 'synergia_theme_js');

////////////////////////////////////////////////////////////////////
// Add Title Parameters
////////////////////////////////////////////////////////////////////

if(!function_exists('synergia_wp_title')) {

    function synergia_wp_title( $title, $sep ) { // Taken from Twenty Twelve 1.0
        global $paged, $page;

        if ( is_feed() )
            return $title;

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 )
            $title = "$title $sep " . sprintf( __( 'Page %s', 'synergia' ), max( $paged, $page ) );

        return $title;
    }
    add_filter( 'wp_title', 'synergia_wp_title', 10, 2 );

}


////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker include custom menu widget to use walkerclass
////////////////////////////////////////////////////////////////////

    require_once('lib/wp_bootstrap_navwalker.php');
    require_once('lib/bootstrap-custom-menu-widget.php');

////////////////////////////////////////////////////////////////////
// Register Menus
////////////////////////////////////////////////////////////////////

        register_nav_menus(
            array(
                'main_menu' => 'Main Menu',
                'footer_menu' => 'Footer Menu'
            )
        );

////////////////////////////////////////////////////////////////////
// Register the Sidebar(s)
////////////////////////////////////////////////////////////////////

        register_sidebar(
            array(
            'name' => 'Right Sidebar',
            'id' => 'right-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar(
            array(
            'name' => 'Left Sidebar',
            'id' => 'left-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

////////////////////////////////////////////////////////////////////
// Register hook and action to set Main content area col-md- width based on sidebar declarations
////////////////////////////////////////////////////////////////////

add_action( 'synergia_main_content_width_hook', 'synergia_main_content_width_columns');

function synergia_main_content_width_columns () {

    global $dm_settings;

    $columns = '12';

    if ($dm_settings['right_sidebar'] != 0) {
        $columns = $columns - $dm_settings['right_sidebar_width'];
    }

    if ($dm_settings['left_sidebar'] != 0) {
        $columns = $columns - $dm_settings['left_sidebar_width'];
    }

    echo $columns;
}

function synergia_main_content_width() {
    do_action('synergia_main_content_width_hook');
}

////////////////////////////////////////////////////////////////////
// Adds RSS feed links to for posts and comments.
////////////////////////////////////////////////////////////////////

    add_theme_support( 'automatic-feed-links' );


////////////////////////////////////////////////////////////////////
// Set Content Width
////////////////////////////////////////////////////////////////////

if ( ! isset( $content_width ) ) $content_width = 800;

////////////////////////////////////////////////////////////////////
// Favicon
////////////////////////////////////////////////////////////////////
function blog_favicon() {
echo '<link rel="icon" type="image/png" href="'.get_template_directory_uri() . '/img/fav.png" />';
}
add_action('wp_head', 'blog_favicon');

////////////////////////////////////////////////////////////////////
// Custom excerpt ellipses, custom length
///////////////////////////////////////////////////////////////////
function custom_excerpt_more($more) {
return '';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function new_excerpt_length($length) {
return 25;
}
add_filter('excerpt_length', 'new_excerpt_length');

////////////////////////////////////////////////////////////////////
// Dynamic Copy Year
////////////////////////////////////////////////////////////////////
function comicpress_copyright() {
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
if($copyright_dates) {
$copyright = "&copy; " . $copyright_dates[0]->firstdate;
if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
$copyright .= '-' . $copyright_dates[0]->lastdate;
}
$output = $copyright;
}
return $output;
}

////////////////////////////////////////////////////////////////////
// Remove version
////////////////////////////////////////////////////////////////////
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');

////////////////////////////////////////////////////////////////////
// Polskie komentarze od adpawl
////////////////////////////////////////////////////////////////////
function odmiana($in,$lp,$lm1,$lm2) {
 if ($in==1) return $lp;
 elseif (($in%10>1) && ($in%10<5) && !(($in%100>=10) && ($in%100<=21))) return $lm1;
return $lm2;
};
////////////////////////////////////////////////////////////////////
// Linki sponsorowane
////////////////////////////////////////////////////////////////////
function sponsorowane() {

	$labels = array(
		'name'                => _x( 'Linki sponsorowane', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Link sponsorowany', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Linki sponsorowane', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'Wszystkie linki', 'text_domain' ),
		'view_item'           => __( 'Zobacz link', 'text_domain' ),
		'add_new_item'        => __( 'Dodaj nowy link sponsorowany', 'text_domain' ),
		'add_new'             => __( 'Dodaj jeszcze jeden', 'text_domain' ),
		'edit_item'           => __( 'Edytuj link', 'text_domain' ),
		'update_item'         => __( 'Zaktualizuj link', 'text_domain' ),
		'search_items'        => __( 'szukaj link', 'text_domain' ),
		'not_found'           => __( 'Nie znaleziono', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'sponsorowane', 'text_domain' ),
		'description'         => __( 'Linki sponsorowane', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
        'taxonomies'          => array( 'category'),
        'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
        'menu_icon'           => 'dashicons-format-links',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'sponsorowane', $args );
}

// Register Custom Post Type
function projects() {

	$labels = array(
		'name'                => _x( 'Projekty', 'Post Type General Name', 'projects' ),
		'singular_name'       => _x( 'Projekt', 'Post Type Singular Name', 'projects' ),
		'menu_name'           => __( 'Projekty', 'projects' ),
		'name_admin_bar'      => __( 'Projekt', 'projects' ),
		'parent_item_colon'   => __( 'Parent Item:', 'projects' ),
		'all_items'           => __( 'Wszystkie projekty', 'projects' ),
		'add_new_item'        => __( 'Dodaj nowy projekt', 'projects' ),
		'add_new'             => __( 'Dodaj nowy', 'projects' ),
		'new_item'            => __( 'Nowy projekt', 'projects' ),
		'edit_item'           => __( 'Edytuj projekt', 'projects' ),
		'update_item'         => __( 'Zaktualizuj projekt', 'projects' ),
		'view_item'           => __( 'Zobacz projekt', 'projects' ),
		'search_items'        => __( 'Szukaj projektów', 'projects' ),
		'not_found'           => __( 'Nie ma takiego', 'projects' ),
		'not_found_in_trash'  => __( 'Nawet w koszu nie ma', 'projects' ),
	);
	$rewrite = array(
		'slug'                => 'projekt',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Projekt', 'projects' ),
		'description'         => __( 'Projekty Synergii', 'projects' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-carrot',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'projekt',
		'rewrite'             => $rewrite,
        'capability'     => __('project'),
        'map_meta_cap'        => true,
	);
	register_post_type( 'projekt', $args );
    flush_rewrite_rules();
}
add_action( 'init', 'projects', 0 );

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
    'projekt',
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
  if (!current_user_can('edit_post', $post_id)) {
    return $post_id;
  }
  // The array of accepted fields for Books
    $accepted_fields['projekt'] = array(
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
//USER

//removing color scheme
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

//custom fields
add_action( 'show_user_profile', 'add_extra_social_links' );
add_action( 'edit_user_profile', 'add_extra_social_links' );

function add_extra_social_links( $user )
{
    ?>
        <h3>Strony społecznościowe</h3>

        <table class="form-table">
            <tr>
                <th><label for="facebook_profile">Github Profile</label></th>
                <td><input type="text" name="github_profile" value="<?php echo esc_attr(get_the_author_meta( 'github_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="twitter_profile">Twitter Profile</label></th>
                <td><input type="text" name="twitter_profile" value="<?php echo esc_attr(get_the_author_meta( 'twitter_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="google_profile">Facebook Profile</label></th>
                <td><input type="text" name="facebook_profile" value="<?php echo esc_attr(get_the_author_meta( 'facebook_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
        </table>
    <?php
}
add_action( 'personal_options_update', 'save_extra_social_links' );
add_action( 'edit_user_profile_update', 'save_extra_social_links' );

function save_extra_social_links( $user_id )
{
    update_user_meta( $user_id,'facebook_profile', sanitize_text_field( $_POST['facebook_profile'] ) );
    update_user_meta( $user_id,'twitter_profile', sanitize_text_field( $_POST['twitter_profile'] ) );
    update_user_meta( $user_id,'github_profile', sanitize_text_field( $_POST['github_profile'] ) );
}

/* Adding Image Upload Fields */
// http://www.flyinghippo.com/blog/adding-custom-fields-uploading-images-wordpress-users/
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user )
{
?>

	<h3>Profile Images</h3>

	<table class="form-table fh-profile-upload-options">
		<tr>
			<th>
				<label for="image">Main Profile Image</label>
			</th>

			<td>
                <?php if(get_the_author_meta( 'image', $user->ID )) { ?>
				<img class="user-preview-image" src="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>">
                <?php } ?>
				<input type="text" name="image" id="image" value="<?php echo esc_attr( get_the_author_meta( 'image', $user->ID ) ); ?>" class="regular-text" />
				<input type='button' class="button-primary" value="Upload Image" id="uploadimage"/><br />

				<span class="description">Please upload an image for your profile.</span>
			</td>
		</tr>

		<tr>
			<th>
				<label for="image">Sidebar Profile Image</label>
			</th>

			<td>
                <?php if(get_the_author_meta( 'sidebarimage', $user->ID )) { ?>
				<img class="user-preview-image" src="<?php echo esc_attr( get_the_author_meta( 'sidebarimage', $user->ID ) ); ?>">
                <?php } ?>
				<input type="text" name="sidebarimage" id="sidebarimage" value="<?php echo esc_attr( get_the_author_meta( 'sidebarimage', $user->ID ) ); ?>" class="regular-text" />
				<input type='button' class="button-primary" value="Upload Image" id="sidebarUploadimage"/><br />

				<span class="description">Please upload an image for the sidebar.</span>
			</td>
		</tr>
	</table>

	<script type="text/javascript">
		(function( $ ) {
			$( '#uploadimage' ).on( 'click', function() {
				tb_show('test', 'media-upload.php?type=image&TB_iframe=1');

				window.send_to_editor = function( html )
				{
					imgurl = $( 'img',html ).attr( 'src' );
					$( '#image' ).val(imgurl);
					tb_remove();
				}

				return false;
			});

			$( 'input#sidebarUploadimage' ).on('click', function() {
				tb_show('', 'media-upload.php?type=image&TB_iframe=true');

				window.send_to_editor = function( html )
				{
					imgurl = $( 'img', html ).attr( 'src' );
					$( '#sidebarimage' ).val(imgurl);
					tb_remove();
				}

				return false;
			});
		})(jQuery);
	</script>

<?php
}

add_action( 'admin_enqueue_scripts', 'enqueue_admin' );

function enqueue_admin()
{
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_style('thickbox');

	wp_enqueue_script('media-upload');
}

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
{
		return false;
	}

update_user_meta( $user_id, 'image', $_POST[ 'image' ] );
	update_user_meta( $user_id, 'sidebarimage', $_POST[ 'sidebarimage' ] );
}

// http://wordpress.stackexchange.com/questions/28005/after-adding-add-role-to-functions-php-and-creating-a-user-can-not-login-into-a
add_role( synergia_member, __('Członek Synergii'), array( 'delete_posts',
                          'delete_private_posts'=> true,
                          'edit_private_posts'=> true,
                          'read_private_posts'=> true,
                          'edit_comment'=> false,
                          'publish_posts'=> true,
                          'edit_published_posts'=> true,
                          'edit_posts'=> true,
                          'upload_files'=> true,
                          'manage_links'=> true,
        ));
// http://wordpress.stackexchange.com/questions/14553/allow-member-to-have-access-to-custom-post-type-only-permission-to-only-edit-th
$wp_roles->add_cap( 'Członek Synergii', 'project' );
$role =& get_role('synergia_member');
$role->add_cap('read');
$role->add_cap('project');
