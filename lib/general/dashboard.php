<?php

// Widżet pokazujący wersję //
add_action('wp_dashboard_setup', 'version_widget');
function version_widget()
{
    global $wp_meta_boxes;
    wp_add_dashboard_widget('synergia_version_widget', 'Aktualna wersja', 'synergia_version');
    wp_add_dashboard_widget('show_member_summary_widget', 'Witaj w MKNM "Synergia"', 'show_member_summary','dashboard', 'side', 'high');
}
function synergia_version() {
    global $version, $codename, $codeimg;
    echo '<div class="version_baner">';
    echo '<img src="'.$codeimg.'">';
    echo '<h2><span class="version">'.$version.'</span> "'.$codename.'"</h2></div>';
}

// Widżet  //
function show_member_summary() {
  $current_member = wp_get_current_user();
  ?>
  <div id="col-container" class="summary_wrap">
    <div id="col-left">
      <div class="col-wrap">
        <div class="buttons-wrap">
          <a class="button-primary button-big" href="<?php echo get_site_url(); ?>/wp-admin/post-new.php?post_type=project" title="<?php esc_attr_e( 'Dodaj nowy projekt' ); ?>"><?php esc_attr_e( 'Dodaj projekt' ); ?></a>
          <a class="button-primary button-big" href="<?php echo get_site_url(); ?>/wp-admin/post-new.php" title="<?php esc_attr_e( 'Dodaj nowy wpis' ); ?>"><?php esc_attr_e( 'Dodaj wpis' ); ?></a>
        </div>
      </div>
    </div>
    <div id="col-right">
      <div class="col-wrap">
        <a href="<?php echo get_site_url(); ?>/wp-admin/profile.php">
          <img src="<?php echo $current_member->image; ?>"/>
        </a>
        <h1><?php echo $current_member->display_name;?></h1>
        <a href="<?php echo get_site_url();?>/wp-admin/edit.php?post_type=project">
        Projekty: <b><?php echo $current_member->number_of_finished_projects;?></b>
        (<?php echo $current_member->number_of_in_progress_projects;?>)</a>
      </div>
    </div>
  </div>
  <?php
}
