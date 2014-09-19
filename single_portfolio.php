<?php get_header(); ?>

<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

	<div id="content">

	<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

			<div class="postsingle" id="post-<?php the_ID(); ?>">
				
				<div class="boxsingle" style="display:none;">						
					<?php the_post_thumbnail('portfolio-big'); ?>				
				</div>
			
				<h2><?php the_title(); ?></h2>
				
				<div class="entry">
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					
					<a class="homelink" title="<?php echo bloginfo('blog_name'); ?>" href="<?php echo get_option('home'); ?>/"> &larr; Powrót </a>
					
				</div>

			</div>
			
<?php 
if (get_option('bb_comments')) {
	 echo "";
} else {
	 echo comments_template();
}
?>			

		<?php endwhile; ?>

		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>

	</div>



<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>
