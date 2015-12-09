<?php

/////////////////////////////////////////////////////////////////////
// Add Synergia Theme Options to the Appearance Menu and Admin Bar
////////////////////////////////////////////////////////////////////

    function snrg_theme_options_menu() {
        add_theme_page(
            'Synergopcje',
            'Synergopcje',
            'manage_options',
            'synergia-theme-options',
            'synergia_theme_options' );
    }
    add_action( 'admin_menu', 'snrg_theme_options_menu' );

    add_action( 'admin_bar_menu', 'toolbar_link_to_snrg_options', 999 );

    function toolbar_link_to_snrg_options( $wp_admin_bar ) {
        $args = array(
            'id'    => 'synergia_theme_options',
            'title' => 'Synergopcje',
            'href'  => home_url() . '/wp-admin/themes.php?page=synergia-theme-options',
            'meta'  => array( 'class' => 'synergia-theme-options' ),
            'parent' => 'site-name'
        );
        $wp_admin_bar->add_node( $args );
    }


////////////////////////////////////////////////////////////////////
// Register our settings options (the options we want to use)
////////////////////////////////////////////////////////////////////

    $snrg_options = array(
       'recruitment' => false,
//        'right_sidebar_width' => 3,
        'archiwum' => '',
        'more_projects' => '',
        'google_anal' => '',
        'recruitment_image_1' => '',
        'recruitment_image_2' => '',
        'recruitment_image_3' => ''
    );

//    $snrg_sidebar_sizes = array(
//        '1' => array (
//            'value' => '1',
//            'label' => '1'
//        ),
//    );

    function snrg_register_settings() {
        register_setting( 'snrg_theme_options', 'snrg_options', 'snrg_validate_options' );
    }

    add_action ('admin_init', 'snrg_register_settings');
    $snrg_settings = get_option( 'snrg_options', $snrg_options );


////////////////////////////////////////////////////////////////////
// Validate Options
////////////////////////////////////////////////////////////////////

    function snrg_validate_options( $input ) {

        global $snrg_options;

        $settings = get_option( 'snrg_options', $snrg_options );
        if ( ! isset( $input['recruitment'] ) ) {
                    $input['recruitment'] = null;
                } else {
                    $input['recruitment'] = ( $input['recruitment'] == 1 ? 1 : 0 );
                }
        $input['archiwum'] = wp_filter_nohtml_kses( $input['archiwum'] );
        $input['more_projects'] = wp_filter_nohtml_kses( $input['more_projects'] );
        $input['recruitment_image_1'] = wp_filter_nohtml_kses( $input['recruitment_image_1'] );
        $input['recruitment_image_2'] = wp_filter_nohtml_kses( $input['recruitment_image_2'] );
        $input['recruitment_image_3'] = wp_filter_nohtml_kses( $input['recruitment_image_3'] );
//        $input['google_anal'] = wp_filter_nohtml_kses( $input['google_anal'] );

        return $input;
    }

////////////////////////////////////////////////////////////////////
// Display Options Page
////////////////////////////////////////////////////////////////////

    function synergia_theme_options() {

        if ( !current_user_can( 'manage_options' ) )  {
            wp_die('You do not have sufficient permissions to access this page.');
        }
        if ( ! isset( $_REQUEST['settings-updated'] ) ){
            $_REQUEST['settings-updated'] = false;
        }
        if ( false !== $_REQUEST['settings-updated'] ){
            echo '<div class="updated"><p>Ustawienia zostały zapisane !</p></div>';
        }
        //get our global options
        global $snrg_options, $version, $codename;

        //get our logo
        $logo = get_template_directory_uri() . '/build/img/logo.png'; ?>

        <div class="wrap options_wrap">

            <header>
                <img src="<?php echo $logo;?>"/>
                <span><?php echo $version.' "'.$codename.'"'; ?></span>
            </header>

            <form action="options.php" method="post">

                <?php
                    $settings = get_option( 'snrg_options', $snrg_options );
                    settings_fields( 'snrg_theme_options' );
                ?>

                <table cellpadding='10'>
                  <h3>Rekrutacja</h3>
                  <tr valign="top"><th scope="row">Rekrutacja</th>
                    <td>
                      <input type="checkbox" id="recruitment" name="snrg_options[recruitment]" value="1" <?php checked( true, $settings['recruitment'] ); ?> />
                      <label for="recruitment">Zaznacz, jeśli trwa rekrutacja</label>
                    </td>
                  </tr>
                  <tr valign="top"><th scope="row">Obrazki rekrutacyjne</th>
                    <td>
                      <input type="text" id="recruitment_image_1" name="snrg_options[recruitment_image_1]" value="<?php esc_attr_e($settings['recruitment_image_1']); ?>" />
                      <input id = "upload_image_button" type = "button" class="button button-primary button-large" value="Wybierz">
                      <p class="description">Pamiętaj, by wybrać jak największy rozmiar</p>
                    </td>
                    <td>
                      <input type="text" id="recruitment_image_2" name="snrg_options[recruitment_image_2]" value="<?php esc_attr_e($settings['recruitment_image_2']); ?>" />
                      <input id = "upload_image_button" type = "button" class="button button-primary button-large" value="Wybierz">
                    </td>
                    <td>
                      <input type="text" id="recruitment_image_3" name="snrg_options[recruitment_image_3]" value="<?php esc_attr_e($settings['recruitment_image_3']); ?>" />
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
                      <tr valign="top"><th scope="row">Link do Archiwum</th>
                        <td>
                            <input type="text" id="archiwum" name="snrg_options[archiwum]" value="<?php esc_attr_e($settings['archiwum']); ?>" />
                        </td>
                    </tr>
                      <tr valign="top"><th scope="row">Link do projektów</th>
                        <td>
                            <input type="text" id="more_projects" name="snrg_options[more_projects]" value="<?php esc_attr_e($settings['more_projects']); ?>" />
                        </td>
                    </tr>
                    <tr valign="top"><th scope="row">Google Analytics</th>
                        <td>
                            <textarea name="snrg_options[google_anal]" id="google_anal"><?php echo $settings['google_anal']; ?></textarea>
                            <p class="description">Kod śledzący Google Analytics</p>
                        </td>
                    </tr>
                </table>
    <?php submit_button(); ?>
            </form>
        </div>
<?php
}
?>
