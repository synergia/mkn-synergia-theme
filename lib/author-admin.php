<?php
//USER

//removing color scheme
remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

// Checkbox dla prezesa
add_action('show_user_profile', 'prezes');

function prezes($user){
	if(current_user_can('administrator')) { ?>
	<table class="form-table">
		<tr>
			<th><label>Obierz prezesa</label></th>
			<td>
				<input type="checkbox" name="prezes" id="prezes" value="yes" <?php if (esc_attr( get_the_author_meta( "prezes", $user->ID )) == true) echo "checked"; ?> />
				<label>Zaznacz, jeśli jest prezesem</label>
			</td>

		</tr>
	</table>
<?php }
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
	update_user_meta( $user_id, 'prezes', $_POST['prezes'] );


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


// Zapisuje ilość projektów do meta użytkownika
function post_count($user_id, $count) {
        update_user_meta($user_id, 'post_count', $count );
    }
?>
