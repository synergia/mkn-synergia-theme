<?php
function snrg_options_display() {
  global $version, $codename, $logo;
?>
    <div class="wrap options_wrap">
        <div id="icon-themes" class="icon32"></div>
        <header>
          <img src="<?php echo $logo;?>"/>
          <span><?php echo $version.' "'.$codename.'"'; ?></span>
        </header>
        <?php settings_errors(); ?>

        <?php
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'snrg_general_page';
        ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=synergoptions&tab=snrg_general_page" class="nav-tab <?php echo $active_tab == 'snrg_general_page' ? 'nav-tab-active' : ''; ?>">Ogólne</a>
            <a href="?page=synergoptions&tab=snrg_banner_page" class="nav-tab <?php echo $active_tab == 'snrg_banner_page' ? 'nav-tab-active' : ''; ?>">Baner</a>
            <a href="?page=synergoptions&tab=snrg_about_page" class="nav-tab <?php echo $active_tab == 'snrg_about_page' ? 'nav-tab-active' : ''; ?>">O nas</a>
            <a href="?page=synergoptions&tab=update_members_meta_page" class="nav-tab <?php echo $active_tab == 'update_members_meta_page' ? 'nav-tab-active' : ''; ?>">Aktualizacja danych członków</a>
        </h2>
        <!-- $elapsed = wp_next_scheduled( 'update_users_meta' );
        $hours = floor($elapsed / 3600);
        $minutes = floor(($elapsed / 60) % 60);
        $seconds = $elapsed % 60;
        echo "Zaplanowana aktualizacja danych użytkowników. Pozostało $hours:$minutes:$seconds"; -->

            <?php
            if( $active_tab == 'snrg_general_page' ) {
                echo '<form method="post" action="options.php">';
                settings_fields( 'snrg_general_page_option' );
                do_settings_sections( 'snrg_general_page_option' );
                submit_button();
                echo '</form>';
            } else if( $active_tab == 'snrg_banner_page' ) {
                echo '<form method="post" action="options.php">';
                settings_fields( 'snrg_banner_page_option' );
                do_settings_sections( 'snrg_banner_page_option' );
                submit_button();
                echo '</form>';
            } elseif ($active_tab == 'snrg_about_page') {
              echo '<form method="post" action="options.php">';
              settings_fields( 'snrg_about_page_option' );
              do_settings_sections( 'snrg_about_page_option' );
              submit_button();
              echo '</form>';
          }elseif ($active_tab == 'update_members_meta_page') {
            update_members_meta_page();
        }
            ?>

    </div>
<?php
}
