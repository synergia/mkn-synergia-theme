<?php
// ================REKRUTACJA================= //

function snrg_enable_recruitment_callback() {
  global $recruitment_options;
?>
<label>
  <input type='checkbox' id="" name='snrg_recruitment_page_option[enable_recruitment]' value='1' <?php if ( 1 == $recruitment_options['enable_recruitment'] ) echo 'checked="checked"'; ?> />
  Zaznacz, jeśli trwa rekrutacja
</label>
<?php }

function snrg_upload_recruitment_images_callback($args) {
  global $recruitment_options;

  ?>
  <script>
  var $ =jQuery.noConflict();
  $(document).ready(function() {
    // UPLOADING //
    var file_frame, some_input;
    $('#upload_image_button').live('click', function(podcast) {
      podcast.preventDefault();
      some_input = $(this).prev();
      // If the media frame already exists, reopen it.
      if (file_frame) {
        file_frame.open();
        return;
      }
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
        var url = attachment.url;
        $(some_input).attr("value", url);
        console.log(some_input);
      });
      // Finally, open the modal
      file_frame.open();
    });
  });
  </script>
  <input type="text" id="recruitment_image_1" name="snrg_recruitment_page_option[upload_recruitment_image_1]" value="<?php esc_attr_e($recruitment_options['upload_recruitment_image_1']); ?>" />
                      <input id = "upload_image_button" type = "button" class="button button-primary button-large" value="Wybierz">
                      <p class="description">Pamiętaj, by wybrać jak największy rozmiar</p>
  <?php
}


// ================OGÓLNE===================== //

function snrg_fb_link_callback() {
  global $general_options;
    echo '<input type="text" id="fb_link_id" name="snrg_general_page_option[fb_link]" value="' . $general_options['fb_link']. '"></input>';
}
function snrg_twitter_link_callback() {
  global $general_options;
    echo '<input type="text" id="twitter_link_id" name="snrg_general_page_option[twitter_link]" value="' . $general_options['twitter_link']. '"></input>';
}
function snrg_github_link_callback() {
  global $general_options;
    echo '<input type="text" id="github_link_id" name="snrg_general_page_option[github_link]" value="' . $general_options['github_link']. '"></input>';
}
function snrg_g_anal_callback() {
  global $general_options;
  ?>
  <textarea name="snrg_general_page_option[g_anal]" id="google_anal"><?php echo $general_options['g_anal']; ?></textarea>
  <p class="description">Kod śledzący Google Analytics</p>
  <?php
}
