<div class="membercard"
    data-id="<?php echo $current_member->ID; ?>"
    data-uname="<?php echo $current_member->user_nicename; ?>">

    <div class="membercard__close">
        <i class="icon-cancel"></i>
    </div>
    <div class="membercard__avatar">
        <?php echo show_avatar($current_member)?>
    </div>
    <div class="membercard__info">
        <h5 class="membercard__name noWrap">
            <?php echo get_member_name($current_member); ?>
        </h5>
        <div class="membercard__status">
            <?php show_membership_status($current_member); ?>
        </div>
        <div class="membercard__socialLinks"></div>
    </div>

    <div class="membercard__counter">
        <div class="counter">
            <a class="link" href="">
                <?php echo get_number_of_projects($current_member, 'finished');?>
            </a>
            <span class="counter__label">Projekty ukończone</span>
        </div>
        <div class="counter">
            <a class="link" href="">
                <?php echo get_number_of_projects($current_member, 'in_progress') ?>
            </a>
            <span class="counter__label">Projekty realizowane</span>
        </div>
    </div>
</div>
