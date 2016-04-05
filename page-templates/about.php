<?php
/*
Template Name: O nas
*/
?>
<?php get_header(); ?>
<?php get_template_part('parts/topbar'); ?>
<?php
$done = array(
    'numberposts' => -1,
    'post_type' => 'project',
  'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'project_status',
            'value' => 'Ukończony',
        ),
        array(
            'key' => 'project_status',
            'value' => 'W ciągłym doskonaleniu',
        ),
    ),
);
$in_progress = array(
    'numberposts' => -1,
    'post_type' => 'project',
    'meta_key' => 'project_status',
    'meta_value' => 'W trakcie realizacji',
);
$done_query = new WP_Query($done);
$in_progress_query = new WP_Query($in_progress);

$total_members = count(get_members_with_projects());

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
            <div class="counters__counter" id="finished">
                <span class="counters__count" data-finished="<?php echo $done_query->found_posts ?>"></span>
                <span class="counters__label">Ukończonych projektów</span>
            </div>
            <div class="counters__counter" id="in-progress">
                <span class="counters__count" data-in-progress="<?php echo $in_progress_query->found_posts ?>"></span>
                <span class="counters__label">Realizowanych projektów</span>
            </div>
            <div class="counters__counter" id="members">
                <span class="counters__count" data-members="<?php echo $total_members ?>"></span>
                <span class="counters__label">Członków koła</span>
            </div>
            <div class="counters__counter" id="robodrift">
                <span class="counters__count" data-robodrift="4"></span>
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
