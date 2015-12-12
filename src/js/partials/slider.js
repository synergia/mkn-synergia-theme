$(document).ready(function() {
  Slider = $('#slider').Swipe({
    auto: 0,
    continuous: true,
  }).data('Swipe');
  $('.next').on('click', Slider.next);
  $('.prev').on('click', Slider.prev);
});
