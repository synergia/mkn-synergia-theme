<?php
//USER
//global $user_ID;
//removing color scheme
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// Checkbox dla prezesa
add_action('show_user_profile', 'management_board');
add_action('edit_user_profile', 'management_board');

function management_board($user){
    global $user_ID;
	if($user_ID)
    {
        if( current_user_can('level_10'))  //administrator
        {?>
<h3>Obierz zarząd</h3>
	<table class="form-table">
		<tr>
			<th><label>Obierz prezesa</label></th>
			<td>
                <label>
				    <input type="checkbox" name="president" id="president" value="yes" <?php if (esc_attr( get_the_author_meta( "president", $user->ID )) == true) echo "checked"; ?> />
				Zaznacz, jeśli jest prezesem
                </label>
			</td>
        </tr>
        <tr>
            <th><label>Obierz członka zarządu</label></th>
            <td>
                <label>
				    <input type="checkbox" name="member_of_managment_board" id="member_of_managment_board" value="yes" <?php if (esc_attr( get_the_author_meta( "member_of_managment_board", $user->ID )) == true) echo "checked"; ?> />
				Zaznacz, jeśli jest członkiem zarządu
                </label>
			</td>
		</tr>
	</table>
<script>
    //Jeśli zaznaczono prezesa, to nie ma potrzeby w drugim checkboxie
    jQuery('#president').change(function () {
        if (jQuery(this).attr("checked")) {
            jQuery('#member_of_managment_board').attr('disabled', true);
        } else {
            jQuery('#member_of_managment_board').attr('disabled', false);
        }
    });
</script>
<?php
        }
    }
}

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
	update_user_meta( $user_id, 'member_of_managment_board', $_POST['member_of_managment_board'] );
	update_user_meta( $user_id, 'president', $_POST['president'] );
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

				<span class="description">Wrzuć zdjęcie profilowe.</span>
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

add_filter( 'map_meta_cap', 'my_map_meta_cap', 10, 4 );

function my_map_meta_cap( $caps, $cap, $user_id, $args ) {

	/* If editing, deleting, or reading a project, get the post and post type object. */
	if ( 'edit_project' == $cap || 'delete_project' == $cap || 'read_project' == $cap ) {
		$post = get_post( $args[0] );
		$post_type = get_post_type_object( $post->post_type );

		/* Set an empty array for the caps. */
		$caps = array();
	}

	/* If editing a project, assign the required capability. */
	if ( 'edit_project' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->edit_posts;
		else
			$caps[] = $post_type->cap->edit_others_posts;
	}

	/* If deleting a project, assign the required capability. */
	elseif ( 'delete_project' == $cap ) {
		if ( $user_id == $post->post_author )
			$caps[] = $post_type->cap->delete_posts;
		else
			$caps[] = $post_type->cap->delete_others_posts;
	}

	/* If reading a private project, assign the required capability. */
	elseif ( 'read_project' == $cap ) {

		if ( 'private' != $post->post_status )
			$caps[] = 'read';
		elseif ( $user_id == $post->post_author )
			$caps[] = 'read';
		else
			$caps[] = $post_type->cap->read_private_posts;
	}

	/* Return the capabilities required by the user. */
	return $caps;
}

function add_synergia_member_and_delete_other_roles() {
    // możliwości dla 'project'
    $project_capabilities = array(
        'delete_projects' =>true,
        'delete_published_projects' => true,
        'edit_projects' => true,
        'edit_others_projects' => true,
        'edit_others_posts' => true, //potrzebne do wyświetlania bloku z wypadającą listą współautorów
        'edit_published_projects' => true,
        'publish_projects' => true,
        'read' => true,
        'upload_files' => true,
        'edit_posts'=>true, //potrzebne do wyświetlania innych członków w wypadającej liście
        );

    add_role( 'synergia_member', __('Członek Synergii'), $project_capabilities);

    add_role( 'ex_synergia_member', __('Były członek Synergii'), array(
        'delete_projects' =>false,
        'delete_published_projects' => false,
        'edit_projects' => true,
        'edit_others_projects' => true,
        'edit_others_posts' => true,
        'edit_published_projects' => true,
        'publish_projects' => false,
        'read' => true,
        'upload_files' => false,
        ));

    remove_role( 'editor' );
    remove_role( 'contributor' );
    remove_role( 'author' );
    remove_role( 'subscriber' );
//    remove_role( 'synergia_member' );
    $synergia_member = get_role( 'synergia_member' );

//    foreach(){} dlaczegoś nie zadziałał :(
//    bez tego nie wyświetlają się projekty w admince
//    dla administratora
    $administrator = get_role( 'administrator' );
    $administrator->add_cap( 'delete_projects' );
    $administrator->add_cap( 'delete_published_projects' );
    $administrator->add_cap( 'delete_others_projects' );
    $administrator->add_cap( 'edit_projects' );
    $administrator->add_cap( 'edit_others_projects' );
    $administrator->add_cap( 'edit_published_projects' );
    $administrator->add_cap( 'publish_projects' );
}
    add_action('after_switch_theme', 'add_synergia_member_and_delete_other_roles');


// Zapisuje ilość projektów do meta użytkownika
function post_count($user_id, $count) {
        update_user_meta($user_id, 'post_count', $count );
    }
    add_action('publish_post', 'post_count');
    add_action('save_post', 'post_count');
    add_action('post_updated', 'post_count');
    add_action('delete_post', 'post_count');
    add_action('after_switch_theme', 'post_count');


function get_members_with_projects() {

// https://tommcfarlin.com/wp_user_query-multiple-roles/
// prepare arguments
    $synergia_member_args = array (
        'role'           => 'synergia_member',
        'order'          => 'ASC',
        'orderby'        => 'post_count',
        'meta_query'     => array(
            array(
                'key'       => 'post_count',
                'compare'   => '>',
                'type'      => 'NUMERIC',
                'value'     => '0',
            ),
        ),
    );

    $administrator_args = array (
        'role'           => 'administrator',
        'order'          => 'ASC',
        'orderby'        => 'post_count',
        'meta_query'     => array(
            array(
                'key'       => 'post_count',
                'compare'   => '>',
                'type'      => 'NUMERIC',
                'value'     => '0',
            ),
        ),
    );
// Create the WP_User_Query object
    $administrator_query = new WP_User_Query($administrator_args);
    $synergia_member_query = new WP_User_Query($synergia_member_args);

    $administrators = $administrator_query->get_results();
    $synergia_members = $synergia_member_query->get_results();

    return array_merge( $administrators, $synergia_members );
}
function get_management_board() {
        $management_board_args = array (
	'role'           => 'administrator',
);
    $management_board_query = new WP_User_Query($management_board_args);
    $management_board_members = $management_board_query->get_results();
    return $management_board_members;
}
?>
