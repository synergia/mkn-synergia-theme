<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>
<!-- end content container -->
<div class="content-wrapper">
	<div class="gl">
		<div class="post-list">
			<?php	while ( have_posts() ) : the_post(); ?>
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
		// End the loop.
		endwhile;
              ?>
          </div>
		            <div class="gl">
                <p class="gl-sm-6 gl-cell"><?php previous_posts_link('<i class="icon-left-open-big"></i> Siędy');?></p>
                <p class="text-right gl-cell gl-sm-6"><?php next_posts_link( 'Tędy  <i class="icon-right-open-big"></i>', $query->max_num_pages ); ?></p>
            </div>
	</div>

		<?php wp_reset_postdata(); ?>
</div>
<?php get_footer(); ?>
