  $('.modalButton').bind("click", function(e) {
      e.preventDefault();
      $("html").addClass("doNotScroll");
      $('.modal').addClass('visible');
  });

  //On clicking the modal background
  $('[data-modal-close]').bind("click", function(e) {
      $('.modal').removeClass('visible');
      $("html").removeClass("doNotScroll");
  });
