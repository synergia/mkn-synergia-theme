<?php
/*
Template Name: Rekrutacja
*/
?>

<?php get_header(); ?>
<? if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div id="recruitment" class="recruitment" data-bg="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true)[0];?>">
    <div class="recruitment__grad">
        <h1 class="recruitment__title">//MKNM_"SYNERGIA"</h1>
        <section class="recruitment__info">
            //REKRUTACJA2016<br />
            //21.11.16 20:00<br />
            //C-13 2.17
        </section>
        <section class="recruitment__links">
            <a class="link--footer link" href="/projects">//Projekty</a>
            <a class="link--footer link" href="/about">//O_nas</a>
        </section>
    </div>

</div>
<?php wp_link_pages(); ?>
<?php endwhile; ?>
<?php else: ?>

<?php get_404_template(); ?>

<?php endif; ?>
<?php get_footer(); ?>
