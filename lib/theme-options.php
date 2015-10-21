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
// Add admin.css enqueue
////////////////////////////////////////////////////////////////////

    function synergia_theme_style() {
        wp_enqueue_style('synergia-theme', get_template_directory_uri() . '/css/admin.css');
    }
    add_action('admin_enqueue_scripts', 'synergia_theme_style');



////////////////////////////////////////////////////////////////////
// Register our settings options (the options we want to use)
////////////////////////////////////////////////////////////////////

    $snrg_options = array(
       'recruitment' => false,
//        'right_sidebar_width' => 3,
        'archiwum' => '',
        'google_anal' => ''
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
        $logo = get_template_directory_uri() . '/img/logo.png'; ?>

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
                  <tr valign="top"><th scope="row">Rekrutacja</th>
                    <td>
                      <input type="checkbox" id="recruitment" name="snrg_options[recruitment]" value="1" <?php checked( true, $settings['recruitment'] ); ?> />
                      <label for="recruitment">Zaznacz, jeśli trwa rekrutacja</label>
                    </td>
                  </tr>
                    <tr valign="top"><th scope="row">Link do Archiwum</th>
                        <td>
                            <input type="text" id="archiwum" name="snrg_options[archiwum]" value="<?php esc_attr_e($settings['archiwum']); ?>" />
                        </td>
                    </tr>
                    <tr valign="top"><th scope="row">Google Analytics</th>
                        <td>
                            <textarea name="snrg_options[google_anal]" id="google_anal"><?php echo $settings['google_anal']; ?></textarea>
                            <p class="description">Kod śledzący Google Analytics</p>                        </td>
                    </tr>
                </table>
    <?php submit_button(); ?>
            </form>
        </div>
<?php
}
?>
