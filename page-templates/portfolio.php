<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<?php global $post; $pageid = $post->ID; ?>

	<div id="content">
	
	
<?php if (have_posts()) : ?>
     <?php query_posts("category_name=$bb_portfolio_cat&posts_per_page=1000"); ?>
        <?php while (have_posts()) : the_post(); ?>


			<div class="post" id="post-<?php the_ID(); ?>">
				
				<div class="box">
				
				<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
					<?php the_post_thumbnail('portfolio-thumb'); ?>
					</a>
				
				</div>
			
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				
				<div class="entry">
					<p><?php echo substr(strip_tags($post->post_content), 0, 120); ?>... <a href="<?php the_permalink(); ?>">
					Zobacz więcej</a></p>
				</div>

			</div>

		<?php endwhile; ?>

		<!-- if you set portfolio.php as the homepage via wp-admin the pagintaion doesnt't work. -->
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&larr; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &rarr;') ?></div>
		</div>

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		

	<?php endif; ?>
	<?php wp_reset_query(); ?>
	</div>


<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>
