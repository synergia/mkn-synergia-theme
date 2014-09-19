<?php get_header(); ?>

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
