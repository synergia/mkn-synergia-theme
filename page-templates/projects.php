<?php
/*
Template Name: Projekty
*/
?>

<?php get_header(); ?>
<?php get_template_part('template-part', 'topbar'); ?>

<?php
// http://www.advancedcustomfields.com/resources/query-posts-custom-fields/
// args
$ideas = array(
    'numberposts' => -1,
    'post_type' => 'project',
    'meta_key' => 'project_status',
    'meta_value' => 'Pomysł',
);
$in_progress = array(
    'numberposts' => -1,
    'post_type' => 'project',
    'meta_key' => 'project_status',
    'meta_value' => 'W trakcie realizacji',
);
$done = array(
    'numberposts' => -1,
    'post_type' => 'project',
  'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'project_status',
            'value' => 'Ukończony',
        ),
        array(
            'key' => 'project_status',
            'value' => 'W ciągłym doskonaleniu',
        ),
    ),
);

// queries
$ideas_query = new WP_Query($ideas);
$in_progress_query = new WP_Query($in_progress);
$done_query = new WP_Query($done);

?>
<div class="compensator" id="projects" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>">
    <ul class="tabsMenu">
        <li id="tabsReset" class="tabsMenu__item">
            <a class="link link--tab" href="#ideas_projects">Pomysły</a>
        </li>
        <li class="tabsMenu__item tabsMenu__item--current">
            <a class="link link--tab" href="#in_progress_projects">Realizowane</a>
        </li>
        <li class="tabsMenu__item">
            <a class="link link--tab" href="#finished_projects">Ukończone</a>
        </li>
    </ul>
  <div class="tab">
  <?php // Pomysły ?>
    <div class="tab__content" id="ideas_projects"
      data-projects-status="ideas"
      data-total-ideas-projects="<?php echo $ideas_query->found_posts ?>">
        <div class="cardsWrapper">
            <?php project_card($ideas_query); ?>
        </div>
    </div>

  <?php // W trakcie realizacji ?>
    <div class="tab__content" id="in_progress_projects"
      data-projects-status="in_progress"
      data-total-in-progress-projects="<?php echo $in_progress_query->found_posts ?>">
        <div class="cardsWrapper">
            <?php project_card($in_progress_query); ?>
        </div>
    </div>

  <?php // Ukończone ?>
      <div class="tab__content" id="finished_projects"
        data-projects-status="finished"
        data-total-finished-projects="<?php echo $done_query->found_posts ?>">
            <div class="cardsWrapper">
                <?php project_card($done_query); ?>
            </div>
      </div>
  </div>
  <div class="loader">
    <span id="bubblingG_1"></span>
    <span id="bubblingG_2"></span>
    <span id="bubblingG_3"></span>
  </div>
</div>
<?php wp_reset_query();     // Restore global post data stomped by the_post(). ?>


<?php get_footer(); ?>
