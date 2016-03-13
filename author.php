<?php get_header(); ?>
<?php get_template_part('parts/topbar');


global $wp_query;
$current_member = $wp_query->get_queried_object();
 ?>
<div class="compensator">
      <?php include locate_template('parts/member.php'); ?>
</div>
<?php get_footer(); ?>
