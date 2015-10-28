<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="gl">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="gl-sm-9 gl-cell dmbs-main">

        <?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                            <div class="post-header">
                            <?php if ( has_post_thumbnail() ) : ?>
                            <h2 class="page-header"><?php the_title() ;?></h2>
                                <?php the_post_thumbnail('full'); ?>
                                <div class="clear"></div>
                            <?php else: ?>
                            <h2 class="page-header-no-thumb"><?php the_title() ;?></h2>
        <?php endif; ?>

                            </div>
            <?php the_content(); ?>

            <?php wp_link_pages(); ?>

        <?php endwhile; ?>
        <?php else: ?>

            <?php get_404_template(); ?>

        <?php endif; ?>

    </div>
</div>
<!-- end content container -->

<?php get_footer(); ?>
