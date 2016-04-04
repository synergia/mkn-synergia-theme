<?php
/*
Template Name: O nas
*/
?>
<?php get_header(); ?>
<?php get_template_part('parts/topbar');
 ?>

<div class="compensator">
	<div class="about">

<?php // theloop
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<header class="about__header loading">
            <div class="about__overimage">
			<?php if ( has_post_thumbnail() ) { ?>
				<img class="about__featuredimg blazy"
					alt="<?php the_title(); ?>"
					src="<?php bloginfo('template_directory'); ?>/build/img/full.png"
					data-src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true)[0];?>"
					data-src-small="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'card_image', true)[0];?>"/>

			<?php } else { ?>
				<img class="blazy"
					src="<?php bloginfo('template_directory'); ?>/build/img/full.png"										data-src="<?php bloginfo('template_directory'); ?>/build/img/full.png"
					data-src-small="<?php bloginfo('template_directory'); ?>/build/img/card.png"/><?php } ?>
            </div>
		</header>
        <section class="counters">
            <div class="counters__counter">
                <span class="counters__count">23</span>
                <!-- <div class="counters__divider"></div> -->
                <span class="counters__label">Ukończonych projektów</span>
            </div>
            <div class="counters__counter">
                <span class="counters__count">23</span>
                <!-- <div class="counters__divider"></div> -->
                <span class="counters__label">Realizowanych projektów</span>
            </div>
            <div class="counters__counter">
                <span class="counters__count">345</span>
                <!-- <div class="counters__divider"></div> -->
                <span class="counters__label">Członków koła</span>
            </div>
            <div class="counters__counter">
                <span class="counters__count">4</span>
                <!-- <div class="counters__divider"></div> -->
                <span class="counters__label">Edycje RoboDrift</span>
            </div>
        </section>
		<div class="project__content"><?php the_content(); ?></div>
		<?php wp_link_pages(); ?>
	<?php endwhile; ?>
<?php else: ?>

<?php get_404_template(); ?>

<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
