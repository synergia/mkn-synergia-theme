<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->

    <div class="project-content">

        <?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="center-cropped">
                            <?php the_post_thumbnail('full'); ?>
		</div>
			                            <?php the_title() ;?>

            <?php the_content(); ?>

            <?php wp_link_pages(); ?>

        <?php endwhile; ?>
        <?php else: ?>

            <?php get_404_template(); ?>

        <?php endif; ?>

    </div>

<!-- end content container -->

<?php get_footer(); ?>
