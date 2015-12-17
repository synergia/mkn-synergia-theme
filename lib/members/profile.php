<?php
// Modyfikacje powiązane z kontem członka //

add_action('personal_options_update', 'save_profile_settings');
add_action('edit_user_profile_update', 'save_profile_settings');

// Zapis ustawień
function save_profile_settings($user_id){
    update_user_meta($user_id, 'facebook_profile', sanitize_text_field($_POST['facebook_profile']));
    update_user_meta($user_id, 'twitter_profile', sanitize_text_field($_POST['twitter_profile']));
    update_user_meta($user_id, 'github_profile', sanitize_text_field($_POST['github_profile']));
    update_user_meta($user_id, 'member_of_managment_board', $_POST['member_of_managment_board']);
    update_user_meta($user_id, 'president', $_POST['president']);
    update_user_meta($user_id, 'show_mail', $_POST['show_mail']);
    update_user_meta($user_id, 'image', $_POST[ 'image' ]);
    update_user_meta($user_id, 'cv', $_POST[ 'cv' ]);
}

//removing color scheme
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

// Checkbox dla prezesa
add_action('show_user_profile', 'management_board');
add_action('edit_user_profile', 'management_board');

function management_board($user)
{
    global $user_ID;
    if ($user_ID) {
        if (current_user_can('level_10')) {
            //administrator
?>
<h3>Obierz zarząd</h3>
	<table class="form-table">
		<tr>
			<th><label>Obierz prezesa</label></th>
			<td>
        <label>
				    <input type="checkbox" name="president" id="president" value="yes" checked="<?php if (esc_attr(get_the_author_meta('president', $user->ID)) == true) {echo 'true';}?>" />Zaznacz, jeśli jest prezesem
        </label>
			</td>
    </tr>
    <tr>
      <th><label>Obierz członka zarządu</label></th>
      <td>
        <label>
          <input type="checkbox" name="member_of_managment_board" id="member_of_managment_board" value="yes" checked="<?php if (esc_attr(get_the_author_meta('member_of_managment_board', $user->ID)) == true) {echo 'true';}?>" />
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

// Dodatkowe pola dla linków do mediów socjalnych //

add_action('show_user_profile', 'add_extra_social_links');
add_action('edit_user_profile', 'add_extra_social_links');

function add_extra_social_links($user)
{
    ?>
    <h3>Strony społecznościowe</h3>
    <table class="form-table">
      <tr>
        <th><label>Wyświetlaj pocztę</label></th>
        <td>
          <label>
            <input type="checkbox" name="show_mail" id="show_mail" value="yes" <?php if (esc_attr(get_the_author_meta('show_mail', $user->ID)) == true) { echo 'checked';}?> />
            Zaznacz, jeśli chcesz, by mail był wyświetlany
          </label>
        </td>
      </tr>
      <tr>
        <th><label for="github_profile">Github Profile URL</label></th>
        <td><input type="text" name="github_profile" value="<?php echo esc_attr(get_the_author_meta('github_profile', $user->ID));?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th><label for="twitter_profile">Twitter Profile URL</label></th>
        <td><input type="text" name="twitter_profile" value="<?php echo esc_attr(get_the_author_meta('twitter_profile', $user->ID));?>" class="regular-text" /></td>
      </tr>
      <tr>
        <th><label for="facebook_profile">Facebook Profile URL</label></th>
        <td><input type="text" name="facebook_profile" value="<?php echo esc_attr(get_the_author_meta('facebook_profile', $user->ID));?>" class="regular-text" /></td>
      </tr>
    </table>
<?php
}

// Dodaje CV //
add_action('show_user_profile', 'add_cv_link');
add_action('edit_user_profile', 'add_cv_link');
function add_cv_link($user)
{
    ?>
    <h3>Dodaj swoje CV</h3>
    <table class="form-table">
      <tr>
        <th><label for="cv">Curriculum Vitae</label></th>
        <td><input type="text" name="cv" value="<?php echo esc_attr(get_the_author_meta('cv', $user->ID));?>" class="regular-text" /></td>
      </tr>
    </table>
<?php
}
// Wsparcie dla obrazków profilowych //
add_action('show_user_profile', 'my_show_extra_profile_fields');
add_action('edit_user_profile', 'my_show_extra_profile_fields');

function my_show_extra_profile_fields($user)
{
    ?>
	<h3>Zdjęcie profilowe</h3>
	<table class="form-table fh-profile-upload-options">
    <tr>
      <th>
				<label for="image">Zdjęcie profilowe</label>
			</th>
			<td>
      <?php if (get_the_author_meta('image', $user->ID)) {?>
				<img class="user-preview-image" src="<?php echo esc_attr(get_the_author_meta('image', $user->ID));?>">
      <?php } ?>
				<input type="text" name="image" id="image" value="<?php echo esc_attr(get_the_author_meta('image', $user->ID));?>" class="regular-text" />
				<input type='button' class="button-primary" value="Upload Image" id="upload_image_button"/><br />
				<span class="description">Wrzuć zdjęcie profilowe.</span>
			</td>
		</tr>
	</table>

	<script type="text/javascript">
  var $ =jQuery.noConflict();
  $(document).ready(function() {
  // UPLOADING //
      var file_frame;
      $('#upload_image_button').live('click', function(podcast) {

          podcast.preventDefault();

          // If the media frame already exists, reopen it.
          if (file_frame) {
              file_frame.open();
              return;
          }

          // Create the media frame.
          file_frame = wp.media.frames.file_frame = wp.media({
              title: $(this).data('uploader_title'),
              button: {
                  text: $(this).data('uploader_button_text'),
              },
              multiple: false // Set to true to allow multiple files to be selected
          });

          // When a file is selected, run a callback.
          file_frame.on('select', function(){
              // We set multiple to false so only get one image from the uploader
              attachment = file_frame.state().get('selection').first().toJSON();

              var title = attachment.title;
              //var filename = attachment.filename;
              var url = attachment.url;

              $('#image').attr("value", url);
          });

          // Finally, open the modal
          file_frame.open();
      });
  });
  </script>

<?php
}
