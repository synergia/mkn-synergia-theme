<div class="membercard" <?php if(is_president($current_member)) echo "id='president'" ?>
    data-id="<?php echo $current_member->ID; ?>">

    <div class="membercard__avatar">
        <?php echo show_avatar($current_member, 'avatar')?>
    </div>
    <div class="membercard__info">
        <h5 class="membercard__name noWrap">
            <?php echo get_member_name($current_member); ?>
        </h5>
        <div class="membercard__status">
            <?php show_membership_status($current_member); ?>
        </div>
        <div class="membercard__fullProfile"></div>
    </div>

    <div class="membercard__counter">
        <div class="counter" id="finished">
            <a class="link" href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>">
                <?php echo get_number_of_projects($current_member, 'finished');?>
            </a>
            <span class="counter__label">Projekty ukończone</span>
        </div>
        <div class="counter" id="in_progress">
            <a class="link" href="<?php echo get_author_posts_url( $current_member->ID, $current_member->user_nicename ); ?>">
                <?php echo get_number_of_projects($current_member, 'in_progress') ?>
            </a>
            <span class="counter__label">Projekty realizowane</span>
        </div>
    </div>
    <!--The hidden stuff -->
        <div class="profile">

        </div>
</div>
