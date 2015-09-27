<?php
/*
Template Name: Członkowie
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="gl">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>
    <div class="gl-sm-9 gl-cell">

		<?php  $blogusers = get_users('orderby=display_name&role=synergia_member');
 foreach ($blogusers as $user) {
	 if(wpse31443_author_has_custom_post_type($user->ID, 'project')){
		     echo $user->display_name;
	 }
  } ?>
    </div>
</div>


<?php get_footer(); ?>
