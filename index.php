<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="row dmbs-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="col-sm-<?php synergia_main_content_width(); ?> dmbs-main">

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
                        <img src="<?php bloginfo('template_directory'); ?>/img/default.jpg"/>
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
                            <div class="post-header-on-blog">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Poczytaj o %s', 'synergia' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                                    <div id="ln" class="thumb-on-blog col-sm-5">
                                        <?php if (has_post_thumbnail()) { ?>
                                        <?the_post_thumbnail('medium  ');
                                        } else { ?>
                                        <img src="<?php bloginfo('template_directory'); ?>/img/default.jpg"/><?php  } ?>
                                        <?php if( has_tag() ) : ?>
                                            <div class="tags"><span class="glyphicon glyphicon-tags"></span>
                                            <?php the_tags(""," &middot; "); ?> </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                    <div class="col-sm-7 teaser">
                                        <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Poczytaj o %s', 'synergia' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                                            <h2 class="page-header-on-blog "><?php the_title(); ?></h2>
                                        </a>
                                        <?php the_excerpt(); ?>
                                        <?php get_template_part('template-part', 'postmeta'); ?>

                                    </div>
                           </div>

                            <?php wp_link_pages(); ?>

                       </div>

                     <?php  endif; ?>

                <?php endwhile; ?>
                <?php posts_nav_link(); ?>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>

   </div>

   <?php //get the right sidebar ?>
   <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>

