<?php
/*
* Template Name: Login Page
*/
// http://codepen.io/keithpickering/pen/ibtEa
?>
<?php get_header(); ?>
<?php $login  = (isset($_GET['l']) ) ? $_GET['l'] : 0; ?>
<?php
if ( $login === "failed" ) { ?>
  <div class="flag note note-error">
    <div class="flag-image note-icon">
      <i class="icon-cancel"></i>
    </div>
    <div class="flag-body note-text">
      Niepoprawny email lub hasło. Być może, wszystko masz źle.
    </div>
    <a href="#" class="note-close">
      <i class="icon-cancel"></i>
    </a>
  </div>

<?php
} elseif ( $login === "empty" ) {
    echo '';
} elseif ( $login === "false" ) { ?>
  <div class="flag note note-info">
    <div class="flag-image note-icon">
      <i class="icon-info"></i>
    </div>
    <div class="flag-body note-text">
      Wylogowałeś się z sukcesem.
    </div>
    <a href="#" class="note-close">
      <i class="icon-cancel"></i>
    </a>
  </div>
  <?php
}
?>

    <div id="login-form">
      <a href="<?php echo get_option('siteurl') ?>"><h3></h3></a>
      <fieldset>
        <?php synergia_login_form(  ); ?>
        <!-- <a href="<?php echo wp_lostpassword_url(); ?>">Lost</a> -->
      </fieldset>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
