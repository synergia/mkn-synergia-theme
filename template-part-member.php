<?php

// Ukończone i w trakcie realizacji projekty //
$finished_projects = new WP_Query(project_args_per_user($current_member, 'finished'));
$in_progress_projects = new WP_Query(project_args_per_user($current_member, 'in_progress')); ?>

<div class="memberInfo">
    <div class="violetWrapper">
        <div class="memberInfo__avatar">
            <?php echo show_avatar($current_member); ?>
        </div>
        <div class="memberInfo__nameWrapper">
            <div class="memberInfo__name"><?php echo $current_member->display_name; ?></div>
            <span class="memberInfo__social"><?php social_links($current_member); ?></span>
        </div>
    </div>
    <div class="whiteWrapper">
        <span class="memberInfo__status"><?php show_membership_status($current_member); ?></span>

    </div>
</div>




<ul class="tabsMenu">
    <li class="tabsMenu__item tabsMenu__item--current">
        <a class="link link--tab" href="#finished">Ukończone (<?php echo get_number_of_projects($current_member, 'finished'); ?>)</a>
    </li>
    <li class="tabsMenu__item">
        <a class="link link--tab" href="#in_progress">Realizowane (<?php echo get_number_of_projects($current_member, 'in_progress'); ?>)</a>
    </li>
</ul>

<div class="tab">
    <div id="finished" class="tab__content">
        <div class="cardsWrapper">
                    <?php
         if ($finished_projects->have_posts()) {
             project_card($finished_projects);
         } else {
             echo '<p class="no-projects">Brak ukończonych projektów</p>';
         }
        ?><!-- UKOŃCZONE END -->
        </div>
    </div>
    <div id="in_progress" class="tab__content">
        <?php
            if ($in_progress_projects->have_posts()) {
                project_card($in_progress_projects);
            } else {
                echo '<p class="no-projects">Brak realizowanych projektów</p>';
            }
          ?>
    </div>
</div>
