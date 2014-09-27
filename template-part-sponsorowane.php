    <div class="sponsorowane-left col-sm-12">


<?php
    $args = array(
      'post_type' => 'sponsorowane '
    );
    $products = new WP_Query( $args );
    if( $products->have_posts() ) {
      while( $products->have_posts() ) {
        $products->the_post();
        ?>
            <div class="sponsorowane">
                <a href="<?php the_title(); ?>">
				<?php the_post_thumbnail('full'); ?>
                </a>
            </div>
<?php
      }
    }
    else {
      echo 'Nic a nic';
    }
  ?>
    </div>
