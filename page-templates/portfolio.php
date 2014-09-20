<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>

<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<?php global $post; $pageid = $post->ID; ?>

	<div id="content">
<?php $args = array(
                'post_type' => 'post',
                'category_name' => 'portfolio'
                );
            $products = new WP_Query( $args );
            if( $products->have_posts() ) {
                while( $products->have_posts() ) {
                    $products->the_post(); ?>
        
            <div class="single-club col-md-3">
                <a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail("medium"); ?>
                </a>
                <?php the_excerpt(); ?>
            </div>  
        <?php
                }
            }
            else { echo 'Trzeba z kimś współpracować...'; } ?>
	</div>


<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>
