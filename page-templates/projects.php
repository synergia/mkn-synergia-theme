<?php
/*
Template Name: Projekty
*/
?>

<?php get_header(); ?>
<?php get_template_part('template-part', 'topnav'); ?>

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
<div class="content-wrapper" id="projects" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div class="tabs">
    <input id="tab-1" name="tabset-1" type="radio" hidden checked/>
    <input id="tab-2" name="tabset-1" type="radio" hidden />
    <input id="tab-3" name="tabset-1" type="radio" hidden />
    <nav class="tabs-nav" role="navigation">
      <ul>
        <li><label for="tab-1">Pomysły</label></li>
        <li><label for="tab-2">Realizowane</label></li>
        <li><label for="tab-3">Ukończone</label></li>
      </ul>
    </nav>

  <?php // Pomysły ?>
  <div class="tab">
    <div class="gl portfolio-content">
      <?php project_card($ideas_query); ?>
    </div>
  </div>

  <?php // W trakcie realizacji ?>
  <div class="tab">
    <div class="gl portfolio-content">
      <?php project_card($in_progress_query); ?>
    </div>
  </div>

  <?php // Ukończone ?>
    <div class="tab">
      <div id="finished_projects"
        data-projects-status="finished"
        data-total-finished-projects="<?php echo $done_query->found_posts ?>"
      class="gl portfolio-content">
        <?php project_card($done_query); ?>
      </div>
    </div>
  </div>
</div>
<?php wp_reset_query();     // Restore global post data stomped by the_post(). ?>


<?php get_footer(); ?>
