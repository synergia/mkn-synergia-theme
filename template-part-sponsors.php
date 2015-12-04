<?php
// Wyświetla logotypy zawarte w linki naszych sponsorów i partnerów //

// Najpierw wskazujemy z jakimi argumentami chcemy pozyskać wpisy
$partnership_args = array(
    'post_type' => 'sponsorowane ',
    'category_name' => 'wspolpraca',
);
$sponsors_args = array(
    'post_type' => 'sponsorowane ',
    'category_name' => 'sponsorzy',
);
// Tu pobieramy do zmiennych z bazy te wszystkie wpisy
$partnerships = new WP_Query($partnership_args);
$sponsors = new WP_Query($sponsors_args);

// Wyświetla obrazek w linku
function show_links($items) {
  if ($items->have_posts()) {
      while ($items->have_posts()) {
          $items->the_post();?>
              <a href="<?php the_title();?>">
                <?php the_post_thumbnail('medium');?>
              </a>
<?php }
  } else {
      echo 'Nic a nic';
  }
}

// Następnie wywołujemy tę funkcję w HTMLu
?>
    <div class="sponsors-container">
        <h2>Sponsorzy</h2>
        <?php show_links($sponsors); ?>
    </div>

    <div class="partnership-container">
        <h2>Współpraca</h2>
        <?php show_links($partnerships); ?>
    </div>
