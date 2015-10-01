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
    {   $current_member = get_userdata($member->ID);
        ?>
        <li>
            <div class="gl">
                <div class="gl-cell gl-sm-1  gl-align-middle"><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php show_avatar($current_member)?></a></div>
                <div class="gl-cell gl-sm-5 gl-align-middle name"><h3><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo $current_member->display_name; ?></a></h3></div>
                <div class="gl-cell gl-sm-2  gl-align-middle links"><?php social_links($current_member); ?></div>
                <div class="gl-cell gl-sm-4  gl-align-middle count"><strong><?php echo $current_member->project_count; ?></strong></div>
            </div>
        </li>
<?php } ?>
    </ul></div>
                <div class="tab">
                    <ul class="member-list">

                <?php

foreach ($members as $management_board_member)
    {
        // get all the user's data
        $administrator = in_array( 'administrator', (array) $current_member->roles );
        $current_member = get_userdata($management_board_member->ID);
        if($current_member->president == true) { ?>
        <li>
            <div class="gl">
                <div class="gl-cell gl-sm-1  gl-align-middle"><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php show_avatar($current_member)?></a></div>
                <div class="gl-cell gl-sm-5 gl-align-middle name"><h3><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo $current_member->display_name; ?></a></h3></div>
                <div class="gl-cell gl-sm-2  gl-align-middle links"><?php social_links($current_member); ?></div>
                <div class="gl-cell gl-sm-4  gl-align-middle memberboard-info">Prezes MKNM "Synergia"</div>

            </div>
        </li>
     <? }else if ($administrator){ ?>
        <li>
            <div class="gl">
                <div class="gl-cell gl-sm-1  gl-align-middle"><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php show_avatar($current_member)?></a></div>
                <div class="gl-cell gl-sm-5 gl-align-middle name"><h3><a href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>"><?php echo $current_member->display_name; ?></a></h3></div>
                <div class="gl-cell gl-sm-2  gl-align-middle links"><?php social_links($current_member); ?></div>
                <div class="gl-cell gl-sm-4  gl-align-middle memberboard-info">Członek zarządu MKNM "Synergia"</div>
            </div>
        </li>
     <? }
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
