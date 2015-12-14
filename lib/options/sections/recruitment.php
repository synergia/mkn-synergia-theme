<?php
$snrg_option = get_option( 'snrg_options_array', $snrg_options_array );
settings_fields( 'snrg_theme_options' );
?>
<table cellpadding='10'>
  <h3>Rekrutacja</h3>
  <tr valign="top"><th scope="row">Rekrutacja</th>
    <td>
      <input type="checkbox" id="recruitment" name="snrg_options_array[recruitment]" value="1" <?php checked(true, $snrg_option['recruitment']); ?> />
      <label for="recruitment">Zaznacz, jeśli trwa rekrutacja</label>
    </td>
  </tr>
  <tr valign="top"><th scope="row">Obrazki rekrutacyjne</th>
    <td>
      <input type="text" id="recruitment_image_1" name="snrg_options_array[recruitment_image_1]" value="<?php esc_attr_e($snrg_option['recruitment_image_1']); ?>" />
      <input id = "upload_image_button" type = "button" class="button button-primary button-large" value="Wybierz">
      <p class="description">Pamiętaj, by wybrać jak największy rozmiar</p>
    </td>
    <td>
      <input type="text" id="recruitment_image_2" name="snrg_options_array[recruitment_image_2]" value="<?php esc_attr_e($snrg_option['recruitment_image_2']); ?>" />
      <input id = "upload_image_button" type = "button" class="button button-primary button-large" value="Wybierz">
    </td>
    <td>
      <input type="text" id="recruitment_image_3" name="snrg_options_array[recruitment_image_3]" value="<?php esc_attr_e($snrg_option['recruitment_image_3']); ?>" />
      <input id = "upload_image_button" type = "button" class="button button-primary button-large" value="Wybierz">
    </td>
  </tr>
  <script>
  var $ =jQuery.noConflict();
  $(document).ready(function() {
  // UPLOADING //
      var file_frame;
      var some_input;
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
</table>
