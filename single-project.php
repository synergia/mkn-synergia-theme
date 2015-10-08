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
                            <?php the_project_links(get_the_ID()); ?>
                        </div>
				            <h1 class="project-title"><?php the_title(); ?></h1>
                    </header>
					<?php the_post_thumbnail('full'); ?>
				</div>
					<?php get_template_part('template-part', 'authors');?>
                <div class="project-content"><?php the_content(); ?>

                        <div id="dropdown" class="download-files-container">
      <button am-button="raised">Pobierz pliki <i class="icon icon-down-open-big"></i></button>
      <ul>
        <li><a href="#">My Profile or not my profile or maybe something</a></li>
        <li><a href="#">Friend Requests</a></li>
        <li><a href="#">Account Settings</a></li>
      </ul>
    </div>


            </div>
				<?php wp_link_pages(); ?>
			<?php endwhile; ?>
		<?php else: ?>

		<?php get_404_template(); ?>

		<?php endif; ?>

		</div>

		<!-- end content container -->

		<?php get_footer(); ?>
