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

    <div class="col-sm-<?php synergia_main_content_width(); ?> dmbs-main">

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
        
            <div class="col-sm-6 kafelek">
                <div class="portfolio">
                    <a href="<?php the_permalink(); ?>">
                        <?php if (has_post_thumbnail()) {
                    $thumb_id  = get_post_thumbnail_id();
                    $thumb_url = wp_get_attachment_image_src($thumb_id, 'medium', true); ?>
            <div class="portfolio-image" style="background-image: url(<?php echo $thumb_url[0]; ?>);">
            <?php } else { //jeśli obrazku nie ma, to wykorzystujemy defaultowy?>
            <div class="portfolio-image" style="background-image: url(<?php bloginfo('template_directory'); ?>/img/def-thumb.jpg);">
            <?php } ?>
                </div>
                        <h2 class="portfolio-title"><?php the_title(); ?></h2>
                    </a>
                    <div id="lnn">
                    <?php the_excerpt(); ?>
                    </div>
                </div>  
            </div>  
        <?php
                }
            }
            else { echo 'Trzeba z kimś współpracować...'; } ?>
        <script>
jQuery("#lnn p").text(function(index, currentText) {
    return currentText.substr(0, 118)+ '...';
});
</script>

    </div>

    <?php //get the right sidebar ?>
    <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>
