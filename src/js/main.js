// main.js //
// Wszystko wrzucamy tu

jQuery(function($) {

  //= partials/dropdown-download.js

  //= partials/dropdown.js

  //= partials/excerpt.js

  //= partials/image-wrapper.js

  //= partials/name-trimmer.js

  //= partials/notifications.js

  //= partials/recruitment.js

  //= partials/ripple-effect.js

  //= partials/show-nicknames.js

  //= partials/tabs.js

  //= partials/transition.js

  //= partials/nav.js

  //= partials/slider.js


  $(document).ready(function() {

    //= partials/lazy.js

    //= partials/infinite-scroll.js

  });
  // Prezes zawsze na pierwszym miejscu //
  $('#management_board li#admin').insertBefore('#management_board li:eq(0)');
});
