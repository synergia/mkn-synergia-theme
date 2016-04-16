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
          <div class="brand"
               data-brand-name="<?php the_title(); ?>"
               data-brand-link="<?php echo carbon_get_post_meta(get_the_ID(), 'crb_sponsor_link'); ?>"
               data-brand-desc="<?php echo wp_filter_nohtml_kses(get_the_content()); ?>">
              <div class="brand__controls">
                  <div class="brand__more">
                      <a title="Dowiedz się więcej" href='' class="link link--social" target="_blank">
                          <i class="icon-dot-3"></i>
                      </a>
                  </div>
                  <div class="brand__link">
                      <a title="Odwiedź stronę" href='' class="link link--social" target="_blank">
                          <i class="icon-link"></i>
                      </a>
                  </div>
              </div>
              <img class="brand__logo blazy" alt=""
              src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
              data-src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'sponsor_logo', true)[0];?>" />
          </div>
<?php }
  } else {
      echo 'Nic a nic';
  }
}

// Następnie wywołujemy tę funkcję w HTMLu
?>

<section class="modal">
    <div class="modal__overlay" data-modal-close></div>
	<div class="modal__body">
		<div class="modal__topbar">
            <h4 class="modal__title">Modal Popup</h4>
            <span class="modal__close" data-modal-close><i class="icon-cancel"></i></span>
        </div>
		<div class="modal__container">
            <img class="modal__image" src="" />
            <div class="modal__content">
                <p class="noMargins">

                </p>
                <a class="link" href=""></a>

            </div>
        </div>

</section>

    <section class="orgs">
        <h4 class="orgs__title">Sponsorzy</h4>
        <div class="cardsWrapper">
            <?php show_links($sponsors); ?>
        </div>
    </section>

    <section class="orgs">
        <h4 class="orgs__title">Współpraca</h4>
        <div class="cardsWrapper">
            <?php show_links($partnerships); ?>
        </div>
    </section>
