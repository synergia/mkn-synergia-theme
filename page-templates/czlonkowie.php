<?php
/*
Template Name: Członkowie
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="gl">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>
    <div class="gl-sm-9 gl-cell">

<?php
$members = get_members_with_projects();
// Get the results
// Check for results
if (!empty($members)) { ?>
        <div class="tabs">
          <input id="tab-1" name="tabset-1" type="radio" hidden checked/>
          <input id="tab-2" name="tabset-1" type="radio" hidden />
          <nav class="tabs-nav" role="navigation">
            <ul>
              <li><label for="tab-1">Członkowie</label></li>
              <li><label for="tab-2">Zarząd</label></li>
            </ul>
          </nav>
          <div class="tab">
            <ul class="member-list">
<?php
    // loop trough each member
    foreach ($members as $member)
    {
        ?>
        <li>
            <?php show_avatar(get_userdata($member->ID))?>
        </li>
<?php } ?>
    </ul></div>
                <div class="tab">
                <?php

foreach (get_management_board() as $management_board_member)
    {
        // get all the user's data
        $current_member = get_userdata($management_board_member->ID);
        if($current_member->president == true) {
            echo '<li>Prezes'.$current_member->user_nicename.'</li>';
        }else{
        echo '<li>'.$current_member->user_nicename.'</li>';
        }
    }

     ?>
                </div>
<?php
} else {
    echo 'No authors found';
}

        ?>
    </div>
</div>
</div>


<?php get_footer(); ?>
