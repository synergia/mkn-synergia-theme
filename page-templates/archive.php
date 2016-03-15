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
  AND post_type IN ('project', 'post') ORDER BY post_date DESC");
  return $years;
}

function get_posts_by_months($year) {
  global $wpdb;
  $months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date)
  FROM $wpdb->posts WHERE post_status = 'publish' AND post_type IN ('project', 'post')
  AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");
  return $months;
}

function show_nested_archive() {
  foreach(get_posts_by_years() as $year) {
    echo '<div class="gl-cell gl-md-4 gl-lg-3 left">';
    echo '<dl class="dropy archive-year"><dt class="dropy__title"><h2>'.$year.'<i class="icon-down-open-mini"></i></h2></dt>';
    echo '<dd class="dropy__content"><ul>';
    foreach(get_posts_by_months($year) as $month) {
      echo '<li><a href="'.get_month_link($year, $month).'">';
      echo date( 'F', mktime(0, 0, 0, $month) ).'</a>';
      echo '</li>';
    }
    echo '</ul></dd><input type="hidden" name="first"></dl>';
    echo '</div>';
   }
}
 ?>


<?php get_header(); ?>
<?php get_template_part('parts/topbar');
 ?>
<div class="compensator">
  <div class="gl archive-list">
    <?php show_nested_archive(); ?>
  </div>
</div>

<?php get_footer(); ?>
