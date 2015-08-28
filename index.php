<!--Design Stanisław Dac-->

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="gl dmbs-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="gl-sm-<?php synergia_main_content_width(); ?> gl-cell dmbs-main">

            <?php // theloop
                if ( have_posts() ) : while ( have_posts() ) : the_post();

                    // single post
                    if ( is_single() ) : ?>

                        <div <?php post_class(); ?>>
                            <div class="post-header">

                            <h2 class="page-header"><?php the_title() ;?></h2>
                                    <?php if( has_tag() ) : ?>
                                    <div class="tags"><span class="glyphicon glyphicon-tags"></span>
                                        <?php the_tags(""," &middot; "); ?> </div>
                                    <?php endif; ?>
                            <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('full');
                        } else { ?>
                        <img src="<?php bloginfo('template_directory'); ?>/img/defaulth.png"/>
                        <?php  } ?>
                                <div class="clear"></div>

                                <?php get_template_part('template-part', 'postmeta'); ?>

                            </div>
                            <?php the_content(); ?>
                            <center><img src="<?php echo get_template_directory_uri(); ?>/img/chip.png"/></center>
                            <?php wp_link_pages(); ?>
                            <?php comments_template(); ?>

                        </div>
                    <?php
                    // list of posts
                    else : ?>
                        <div <?php post_class(); ?>>
                            <div class="post-header-on-blog gl">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Poczytaj o %s', 'synergia' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                                          <?php if (has_post_thumbnail()) {
                    $thumb_id  = get_post_thumbnail_id();
                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true); ?>
            <div id="ln" class="thumb-on-blog gl-sm-5 gl-cell" style="background-image: url(<?php echo $thumb_url[0]; ?>);">
            <?php } else { //jeśli obrazku nie ma, to wykorzystujemy defaultowy?>
            <div id="ln" class="thumb-on-blog gl-sm-5 gl-cell" style="background-image: url(<?php bloginfo('template_directory'); ?>/img/default.png);">
            <?php } ?>
                                </div>
                                </a>
                                    <div class="gl-sm-7 gl-cell teaser">
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Poczytaj o %s', 'synergia' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                                            <h2 class="page-header-on-blog "><?php the_title(); ?></h2>
                                        </a>
                                        <?php the_excerpt(); ?>
                                        <?php get_template_part('template-part', 'postmeta'); ?>

                                    </div>
                           </div>

                            <?php wp_link_pages(); ?>

                       </div>
        <script>
jQuery(".teaser > p").text(function(index, currentText) {
    return currentText.substr(0, 160)+ '...';
});
</script>
                     <?php  endif; ?>

                <?php endwhile; ?>
                <div class="nav-links gl">
        <p class="gl-sm-6 gl-cell"><?php previous_posts_link('&laquo; Siędy');?></p>
        <p class="right gl-sm-6 gl-cell"><?php next_posts_link( 'Tędy &raquo;', $query->max_num_pages ); ?></p>
    </div>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>

   </div>

   <?php //get the right sidebar ?>
   <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>

