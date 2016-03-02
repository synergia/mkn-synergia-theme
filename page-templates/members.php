<?php
/*
Template Name: Członkowie
*/
get_header();

get_template_part('template-part', 'topbar');

$members = get_members_with_projects();
$ex_members = get_ex_members();
?>

<!-- start compensator -->
<div class="compensator">
    <div class="memberOverlay">
        <div class="container">
            <div class="memberWrapper" data-current-member="">

            </div>
        </div>
    </div>
    <ul class="tabsMenu">
        <li id="tabsReset" class="tabsMenu__item tabsMenu__item--current">
            <a class="link link--tab" href="#current_members">Aktualni</a>
        </li>
        <li class="tabsMenu__item">
            <a class="link link--tab" href="#ex_members">Byli</a>
        </li>
    </ul>
<?php

if (!empty($members)) {
    ?>
        <div class="tab">
            <div id="current_members" class="tab__content">
                <div class="cardsWrapper">
            <?php
                // AKTUALNI //
              // loop trough each member
              foreach ($members as $member) {
                  $current_member = get_userdata($member->ID);
                  if (has_finished_projects($current_member)) {
                      include locate_template('template-part-membercard.php');
                  }
              }
    ?>
                </div>
            </div>
            <div id="ex_members" class="tab__content">
                <div class="cardsWrapper">
            <?php
                // BYLI //
              // loop trough each member
              foreach ($ex_members as $ex_member) {
                  $current_member = get_userdata($ex_member->ID);
                  include locate_template('template-part-membercard.php');
              }
    ?>
                </div>
            </div>
        </div>
        <?php

} else {
    echo 'Coś tu jest źle';
}
?>
</div>
<?php get_footer(); ?>
