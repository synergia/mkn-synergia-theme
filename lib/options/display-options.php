<?php

function synergia_theme_options() {
  //get our global options
  global $snrg_options_array, $version, $codename, $logo;

    if ( !current_user_can( 'manage_options' ) )  {
        wp_die('O nie-nie! Tu zaglądać nie warto!');
    }
    if ( ! isset( $_REQUEST['settings-updated'] ) ){
        $_REQUEST['settings-updated'] = false;
    }
    if ( false !== $_REQUEST['settings-updated'] ){
        echo '<div class="updated"><p>Ustawienia zostały zapisane !</p></div>';
    }
?>
  <div class="wrap options_wrap">
    <header>
      <img src="<?php echo $logo;?>"/>
      <span><?php echo $version.' "'.$codename.'"'; ?></span>
    </header>
    <?php $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general'; ?>

    <h2 class="nav-tab-wrapper">
      <a href="?page=synergoptions&tab=general" class="nav-tab <?php echo $active_tab == 'general' ? 'nav-tab-active' : ''; ?>">Ogólne</a>
      <a href="?page=synergoptions&tab=recruitment" class="nav-tab <?php echo $active_tab == 'recruitment' ? 'nav-tab-active' : ''; ?>">Rekrutacja</a>
    </h2>
    <form action="options.php" method="post">
      <?php
      if( $active_tab == 'general' ) {
        // Ogólne //
        include 'sections/general.php';
        submit_button();


      } else if( $active_tab == 'recruitment' ) {
        include 'sections/recruitment.php';
        submit_button();

      }?>
    </form>
  </div>
<?php
}
?>
