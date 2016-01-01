<?php
/*
Template Name: Archiwum
*/
?>
<?php
function get_posts_by_years() {
  global $wpdb;
  $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date)
  FROM $wpdb->posts WHERE post_status = 'publish'
  AND post_type = 'post' ORDER BY post_date DESC");
  return $years;
}

function get_posts_by_months($year) {
  global $wpdb;
  $months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date)
  FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'
  AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");
  return $months;
}

function show_nested_archive() {
  foreach(get_posts_by_years() as $year) {
    echo '<li class="gl-cell gl-sm-6 gl-md-3 gl-lg-2"><h2>'.$year.'</h2>';
    echo '<ul class="archive-sub-menu">';
    foreach(get_posts_by_months($year) as $month) {
      echo '<li><a href="'.get_month_link($year, $month).'">';
      echo date( 'F', mktime(0, 0, 0, $month) ).'</a>';
      echo '</li>';
    }
    echo '</ul>';
    echo '</li>';
   }
}
 ?>


<?php get_header(); ?>
<?php get_template_part('template-part', 'topnav'); ?>
<div class="content-wrapper">
  <div class="gl">
    <div class="gl-cell">
      <ul class="gl archive-list">
        <?php show_nested_archive(); ?>
      </ul>
    </div>
  </div>
</div>

<?php get_footer(); ?>
