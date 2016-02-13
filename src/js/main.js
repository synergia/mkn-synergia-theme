// main.js //
// Wszystko wrzucamy tu

//= ../../bower_components/scroll-up-bar/src/scroll-up-bar.js

jQuery(function($) {

  //= partials/dropdown.js

  //= partials/excerpt.js

  //= partials/image-wrapper.js

  //= partials/name-trimmer.js

  //= partials/notifications.js

  //= partials/recruitment.js

  //= partials/show-nicknames.js

  //= partials/tabs.js

  //= partials/transition.js

  //= partials/nav.js

  //= partials/slider.js

  //= partials/smooth-scrolling.js

  //= partials/404.js

  $(document).ready(function() {

    //= partials/lazy.js

    //= partials/infinite-scroll.js

    //= partials/topbar.js
  });

  // Prezes zawsze na pierwszym miejscu //
  $('#management_board li#admin').insertBefore('#management_board li:eq(0)');

  // Dodaje do <a> klasę "link"
  $('.project__content a').addClass('link');

});
