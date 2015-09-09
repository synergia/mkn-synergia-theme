    <div class="wspolpraca-left gl-cell gl-sm-12">
        <h3>Współpraca</h3>


<?php
    $args = array(
        'post_type' => 'sponsorowane ',
        'category_name' => 'wspolpraca',
    );
    $products = new WP_Query($args);
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            ?>
            <div class="wspolpraca">
                <a href="<?php the_title();
            ?>">
				<?php the_post_thumbnail('full');
            ?>
                </a>
            </div>
<?php

        }
    } else {
        echo 'Nic a nic';
    }
  ?>
    </div>
<div class="sponsorowane-left gl-cell gl-sm-12">
        <h3>Sponsorzy</h3>

<?php
    $args = array(
        'post_type' => 'sponsorowane ',
        'category_name' => 'sponsorzy',
    );
    $products = new WP_Query($args);
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            ?>
            <div class="sponsorowane">
                <a href="<?php the_title();
            ?>">
				<?php the_post_thumbnail('full');
            ?>
                </a>
            </div>
<?php

        }
    } else {
        echo 'Nic a nic';
    }
  ?>
    </div>
