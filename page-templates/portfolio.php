<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="gl dmbs-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="gl-sm-<?php synergia_main_content_width(); ?> gl-cell dmbs-main">

    <?php    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
$args = array(
    'post_type'              => 'post',
	'category_name'          => 'portfolio',
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
            <div class="gl-sm-6 gl-cell kafelek">
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
   <?php endwhile; ?>
    <div class="nav-links">
        <p class="gl-sm-6 gl-cell"><?php previous_posts_link('&laquo; Siędy');?></p>
        <p class="right gl-cell gl-sm-6"><?php next_posts_link( 'Tędy &raquo;', $query->max_num_pages ); ?></p>
    </div>
    <?php wp_reset_postdata();

else :
    // no post found code
endif;

// Restore original query object
$wp_query = null;
$wp_query = $tmp_query;
        ?>

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
