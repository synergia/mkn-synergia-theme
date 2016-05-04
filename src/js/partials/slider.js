(function() {
    Slider = $('#slider').Swipe({
      auto: 0,
      continuous: true,
    }).data('Swipe');
    if (Slider) {
      $('.swipe__next').on('click', Slider.next);
      $('.swipe__prev').on('click', Slider.prev);
    }

})();
