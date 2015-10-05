<?php get_header(); ?>

	<?php get_template_part('template-part', 'topnav'); ?>

		<!-- start content container -->

		<div class="project-container">

			<?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="center-cropped">
                    <header>
                        <div class="meta-stuff">
                            <?php the_project_status(get_the_ID()); ?>
                            <time><?php the_date(); ?></time>
                        </div>
				            <h1 class="project-title"><?php the_title(); ?></h1>
                    </header>
					<?php the_post_thumbnail('full'); ?>
				</div>
				<div class="authors gl">
					<?php get_template_part('template-part', 'authors');?>
				</div>
            <div class="project-content"><?php the_content(); ?></div>
				<?php wp_link_pages(); ?>
			<?php endwhile; ?>
		<?php else: ?>

		<?php get_404_template(); ?>

		<?php endif; ?>

		</div>

		<!-- end content container -->

		<?php get_footer(); ?>
