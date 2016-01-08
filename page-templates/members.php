<?php
/*
Template Name: Członkowie
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="content-wrapper">
  <div class="gl">
    <div class="gl-sm-9 gl-cell">

<?php
$members = get_members_with_projects();
$ex_members = get_ex_members();
// Get the results
// Check for results
if (!empty($members)) { ?>
  <div class="tabs">
    <input id="tab-1" name="tabset-1" type="radio" hidden checked/>
    <input id="tab-2" name="tabset-1" type="radio" hidden />
    <input id="tab-3" name="tabset-1" type="radio" hidden />
    <nav class="tabs-nav" role="navigation">
      <ul>
        <li><label for="tab-1">Aktualni</label></li>
        <li><label for="tab-2">Zarząd</label></li>
        <li><label for="tab-3">Byli</label></li>
      </ul>
    </nav>
    <div class="tab">
      <ul class="member-list">
<?php
  // loop trough each member
  foreach ($members as $member) {
    $current_member = get_userdata($member->ID);
    if (has_finished_projects($current_member)) {?>
        <li>
          <div class="gl">
            <div class="gl-cell gl-md-1 gl-align-middle avatar-image"><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo show_avatar($current_member)?></a></div>
            <div class="gl-cell gl-lg-5 gl-md-6 gl-align-middle name"><h3><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo $current_member->display_name; ?></a></h3></div>
            <div class="gl-cell gl-lg-2 gl-md-3 gl-align-middle links"><?php social_links($current_member); ?></div>
            <div class="gl-cell gl-lg-4 gl-md-1 gl-align-middle count">Projektów: <strong><?php echo get_number_of_projects($current_member, 'finished'); ?></strong></div>
            <div class="gl-cell gl-lg-4 gl-md-1 gl-align-middle count">R: <strong><?php echo get_number_of_projects($current_member, 'in_progress') ?></strong></div>
          </div>
        </li>
<?php }
 }?>
      </ul>
    </div>
    <div class="tab">
      <ul id="management_board" class="member-list">
<?php
  foreach ($members as $management_board_member) {
    // get all the user's data
    $current_member = get_userdata($management_board_member->ID);
    $administrator = in_array( 'administrator', (array) $current_member->roles );
    if($current_member->president) { ?>
        <li id="admin">
          <div class="gl">
            <div class="gl-cell gl-sm-1  gl-align-middle avatar-image"><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo show_avatar($current_member)?></a></div>
            <div class="gl-cell gl-sm-5 gl-align-middle name"><h3><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo $current_member->display_name; ?></a></h3></div>
            <div class="gl-cell gl-sm-2  gl-align-middle links"><?php social_links($current_member); ?></div>
            <div class="gl-cell gl-sm-4  gl-align-middle memberboard-info">Prezes MKNM "Synergia"</div>
          </div>
        </li>
  <? } else if ($current_member->member_of_managment_board){ ?>
        <li>
          <div class="gl">
            <div class="gl-cell gl-sm-1  gl-align-middle avatar-image"><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo show_avatar($current_member)?></a></div>
            <div class="gl-cell gl-sm-5 gl-align-middle name"><h3><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo $current_member->display_name; ?></a></h3></div>
            <div class="gl-cell gl-sm-2  gl-align-middle links"><?php social_links($current_member); ?></div>
            <div class="gl-cell gl-sm-4  gl-align-middle memberboard-info">Członek zarządu MKNM "Synergia"</div>
          </div>
        </li>
  <? }
  } ?>
    </ul>
  </div>
  <div class="tab">
    <ul class="member-list">
<?php
  foreach ($ex_members as $ex_member) {
    $current_member = get_userdata($ex_member->ID); ?>
      <li>
        <div class="gl">
          <div class="gl-cell gl-md-1 gl-align-middle avatar-image"><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo show_avatar($current_member)?></a></div>
          <div class="gl-cell gl-lg-5 gl-md-6 gl-align-middle name"><h3><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo $current_member->display_name; ?></a></h3></div>
          <div class="gl-cell gl-lg-2 gl-md-3 gl-align-middle links"><?php social_links($current_member); ?></div>
          <div class="gl-cell gl-lg-4 gl-md-1 gl-align-middle count"><strong><?php echo $current_member->project_count; ?></strong></div>
        </div>
      </li>
<?php } ?>
    </ul>
  </div>
</div>
<?php
} else {
    echo 'No authors found';
}
?>
    </div>
    <!-- gl9 END -->
  </div><!-- gl END -->
</div>
<?php //get_template_part('template-part', 'sponsors'); ?>

<?php get_footer(); ?>
