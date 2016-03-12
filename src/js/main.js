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

  //// = partials/show-nicknames.js

  //= partials/nav.js

  //= partials/slider.js

  // przez to gnwo nie działa .on()
  ////= partials/smooth-scrolling.js

  //= partials/404.js

  //= partials/tooltip.js

  //= partials/github.js


  $(document).ready(function() {
    //= partials/lazy.js

    ////= member.js

    //= partials/infinite-scroll.js

    //= partials/topbar.js

    //= partials/tabs.js

  });

  // Prezes zawsze na pierwszym miejscu //
  $('.membercard#president').insertBefore('#current_members .cardsWrapper div:eq(0)');

  // Dodaje do <a> klasę "link"
  $('.project__content a').addClass('link');

});
