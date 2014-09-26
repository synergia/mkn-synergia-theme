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
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('full'); ?>
                                <div class="clear"></div>
                            <?php endif; ?>
                                <?php get_template_part('template-part', 'postmeta'); ?>

                            </div>
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>
                            <?php comments_template(); ?>

                        </div>
                    <?php
                    // list of posts
                    else : ?>
                       <div <?php post_class(); ?>>

                            <h2 class="page-header">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'synergia' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>

                            <?php if ( has_post_thumbnail() ) : ?>
                               <?php the_post_thumbnail(); ?>
                                <div class="clear"></div>
                            <?php endif; ?>
                            <?php the_content(); ?>
                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>
                            <?php  if ( comments_open() ) : ?>
                                   <div class="clear"></div>
                                  <p class="text-right">
                                      <a class="btn btn-success" href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Leave a Comment','synergia'), __('One Comment','synergia'), '%' . __(' Comments','synergia') );?> <span class="glyphicon glyphicon-comment"></span></a>
                                  </p>
                            <?php endif; ?>
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

