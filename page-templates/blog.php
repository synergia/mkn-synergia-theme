<?php
/*
Template Name: Blog
*/
?>


<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>
<!-- end content container -->

	<div class="gl">
        <?php //get_sidebar( 'left' ); ?>

            <div class="post-list">
            <?php
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				$args = array (
					'pagination'             => true,
					'posts_per_page'         => '5',
					'paged' => $paged
				);
            $query = new WP_Query( $args );

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
								<div class="post-list-item ">
									<div class="thumb">
										<a rel="bookmark" href="<?php the_permalink(); ?>">
											<time><?php echo get_the_date(); ?></time>
										</a>
										<?php the_post_thumbnail("thumbnail"); ?>
									</div>
									<div class="post-list-item-content">
										<a rel="bookmark" href="<?php the_permalink(); ?>">
											<h2><?php the_title(); ?></h2>
										</a>
										<div class="excerpt">
											<?php the_excerpt(); ?>
										</div>
									</div>
								</div>
            <?php
                  endwhile;
              ?>
          </div>
		            <div class="gl">
                <p class="gl-sm-6 gl-cell"><?php previous_posts_link('<i class="icon-left-open-big"></i> Siędy');?></p>
                <p class="text-right gl-cell gl-sm-6"><?php next_posts_link( 'Tędy  <i class="icon-right-open-big"></i>', $query->max_num_pages ); ?></p>
            </div>
	</div>

		<?php wp_reset_postdata();

        else :
            echo "Nic a nic";
        endif;

                ?>
								<?php //get_template_part('template-part', 'sponsors'); ?>

<?php get_footer(); ?>
