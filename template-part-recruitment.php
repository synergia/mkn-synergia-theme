<?php global $snrg_settings; ?>
<?php // Randomowy obrazek // ?>
<?php $recruitment_image_number = rand(1, 3); ?>
<?php $recruitment_image = $snrg_settings['recruitment_image_'.$recruitment_image_number]; ?>

<div class="modal">
  <input id="modal" type="checkbox" name="modal" tabindex="1">
  <label for="modal" am-button="raised">
    <span class="recruit-text">Rekrutacja</span>
    <i class="icon icon-user-add"></i>
  </label>
  <div class="modal__overlay" style="background-image: url('<?php echo $recruitment_image ?>');">
    <label id="close_banner" for="modal"><i class="icon icon-close"></i></label>
    <div class="modal__box">
      <h2>Modal Title</h2>
      <p>Modal Content</p>
    </div>
  </div>
</div>
