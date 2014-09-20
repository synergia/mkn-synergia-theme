<?php get_header(); ?>

<<<<<<< HEAD
<?php get_template_part('template-part', 'head'); ?>

<?php get_template_part('template-part', 'topnav'); ?>

    <!-- start content container -->
    <div class="row dmbs-content">

        <?php //left sidebar ?>
        <?php get_sidebar( 'left' ); ?>

        <div class="col-md-<?php devdmbootstrap3_main_content_width(); ?> dmbs-main">
         <h1><?php _e('Sorry This Page Does Not Exist!','devdmbootstrap3'); ?></h1>
        </div>

        <?php //get the right sidebar ?>
        <?php get_sidebar( 'right' ); ?>

    </div>
    <!-- end content container -->

<?php get_footer(); ?>
=======
<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

	<div id="content">

			<div class="postsingle" id="post-<?php the_ID(); ?>">
			
				<h1>Whoops, can't found this page!</h1>
				
				<div class="entry">
					<p>Sorry, we can't find what you're looking for.</p>
					
				</div>

			</div>


	</div>



<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>
>>>>>>> 938bfb5e6792896f1272c09c3564f2a286fb3231
