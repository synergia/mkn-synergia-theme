<?php get_header(); ?>
<?php get_template_part('template-part', 'topbar');

global $wp_query;
$current_member = $wp_query->get_queried_object();
 ?>
<div class="compensator">
      <?php include locate_template('template-part-member.php'); ?>
</div>
<?php get_footer(); ?>
