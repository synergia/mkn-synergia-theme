<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
    <div class="gl">
        <?php //left sidebar ?>
        <?php get_sidebar( 'left' ); ?>

        <div class="gl-md-9 gl-cell">
            <div class="gl portfolio-content">

        <?php    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
            $args = array(
                'post_type'              => array('projekt'),
                'post_per_page' => 10,
                'paged'         => $paged
                    );
            $query = new WP_Query( $args );

            global $wp_query;
            // Put default query object in a temp variable
            $tmp_query = $wp_query;
            // Now wipe it out completely
            $wp_query = null;
            // Re-populate the global with our custom query
            $wp_query = $query;

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>

            <div class="gl-md-6 gl-cell left">
                <div class="card">
                    <div class="image">
                        <?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium'); } else { ?> <img src="<?php bloginfo('template_directory'); ?>/img/def-thumb.jpg" /> <?php } ?>
                            <h2 class="title"><?php the_title(); ?></h2>
                    </div>
                    <div class="content">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="action">
                        <a am-button href="<?php the_permalink(); ?>">Czytaj dalej</a>
                    </div>
                </div>
            </div>
               <?php endwhile; ?>
            </div>

            <div class="gl">
                <p class="gl-sm-6 gl-cell"><?php previous_posts_link('<i class="icon-left-open-big"></i> Siędy');?></p>
                <p class="text-right gl-cell gl-sm-6"><?php next_posts_link( 'Tędy  <i class="icon-right-open-big"></i>', $query->max_num_pages ); ?></p>
            </div>
            <?php wp_reset_postdata();

        else :
            // no post found code
        endif;

        // Restore original query object
        $wp_query = null;
        $wp_query = $tmp_query;
                ?>

<script> jQuery(".card .content").text(function(index, currentText) {return currentText.substr(0, 118)+ '...'; });</script>

    </div>

    </div>
<!-- end content container -->

<?php get_footer(); ?>
