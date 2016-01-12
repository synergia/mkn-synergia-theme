<?php get_header(); ?>

	<?php get_template_part('template-part', 'topnav'); ?>

		<!-- start content container -->
<div class="content-wrapper">
	<div class="project-container">

			<?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<div class="center-cropped">
                    <header>
                        <div class="meta-stuff">
                            <time><?php the_date(); ?></time>
                        </div>
				            <h1 class="project-title"><?php the_title(); ?></h1>
                    </header>
										<?php if ( has_post_thumbnail() ) { ?>
											<img class="blazy"
													 alt="<?php the_title(); ?>"
													 src="<?php bloginfo('template_directory'); ?>/build/img/full.png"
													 data-src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true)[0];?>"
													 data-src-small="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'card_image', true)[0];?>"/>

										<?php } else { ?><img class="blazy" src="<?php bloginfo('template_directory'); ?>/build/img/full.png"										data-src="<?php bloginfo('template_directory'); ?>/build/img/full.png"
										data-src-small="<?php bloginfo('template_directory'); ?>/build/img/card.png"/><?php } ?>
				</div>
            <div class="project-content"><?php the_content(); ?></div>
				<?php wp_link_pages(); ?>
			<?php endwhile; ?>
		<?php else: ?>

		<?php get_404_template(); ?>

		<?php endif; ?>

		</div>
</div>
		<!-- end content container -->

		<?php get_footer(); ?>
