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
            <a href="?page=synergoptions&tab=snrg_recruitment_page" class="nav-tab <?php echo $active_tab == 'snrg_recruitment_page' ? 'nav-tab-active' : ''; ?>">Rekrutacja</a>
        </h2>


        <form method="post" action="options.php">

            <?php
            if( $active_tab == 'snrg_general_page' ) {
                settings_fields( 'snrg_general_page_option' );
                do_settings_sections( 'snrg_general_page_option' );
            } else if( $active_tab == 'snrg_recruitment_page' ) {
                settings_fields( 'snrg_recruitment_page_option' );
                do_settings_sections( 'snrg_recruitment_page_option' );

            }
            ?>
            <?php submit_button(); ?>
        </form>

    </div>
<?php
}
