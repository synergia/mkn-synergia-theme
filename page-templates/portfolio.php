<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="row dmbs-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="col-md-<?php synergia_main_content_width(); ?> dmbs-main">

               <?php $args = array(
    'post_type'              => 'post',
	'category_name'          => 'portfolio',
	'pagination'             => true,
	'posts_per_page'         => '10',
                );
            $products = new WP_Query( $args );
            if( $products->have_posts() ) {
                while( $products->have_posts() ) {
                    $products->the_post(); ?>
        
            <div class="col-md-6 no-right-padding">
                <div class="portfolio">
                    <a href="<?php the_permalink(); ?>">
				    <?php the_post_thumbnail("full"); ?>
                        <h2 class="portfolio-title"><?php the_title(); ?></h2>
                    </a>
                    <div id="ln">
                    <?php the_excerpt(); ?>
                    </div>
                </div>  
            </div>  
        <?php
                }
            }
            else { echo 'Trzeba z kimś współpracować...'; } ?>



    </div>

    <?php //get the right sidebar ?>
    <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>
