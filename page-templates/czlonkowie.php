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
              <ul>
<?php
    // loop trough each member
    foreach ($members as $member)
    {
        // get all the user's data
        $member_info = get_userdata($member->ID);
        echo '<li>'.$member_info->user_nicename.'</li>';
    } ?>
    </ul></div>
<?php
} else {
    echo 'No authors found';
}

        ?>
    </div>
</div>
</div>


<?php get_footer(); ?>
