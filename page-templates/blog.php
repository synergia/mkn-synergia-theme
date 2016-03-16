<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php get_template_part('parts/topbar');
 ?>

<div class="compensator">
			<?php
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$args = array (
					'pagination'             => true,
					'posts_per_page'         => '5',
					'paged' 				 => $paged
				);
            $query = new WP_Query( $args );

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                include locate_template('parts/blog-entry.php');

                  endwhile;
              ?>
		<?php wp_reset_postdata();

        else :
            echo "Brak wpisów";
        endif;

                ?>
</div>
<?php get_footer(); ?>
