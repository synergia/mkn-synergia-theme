(function() {
    // animacja ze zmieniającym się gradientem obciąża CPU,
    // więc włączam ją tylko, gdy użytkownik dosroluje do końca strony
    $(window).scroll(function () {
       if ($(window).scrollTop() >= $(document).height() - $(window).height() - 500) {
          $('.footer-wrapper').addClass('footer-wrapper--animate');
      } else {
          $('.footer-wrapper').removeClass('footer-wrapper--animate');
      }
    });
})();
