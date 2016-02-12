  function acts() {
    var te;
    var min = $('.post-list-item-content h2').height();
    $('.post-list-item .post-list-item-content h2').each(function() {
      if ($(this).height() < min)
        min = $(this).height();
    });

    $('.post-list-item-content h2').each(function() {
      if ($(this).height() == min) {
        te = $(this).parent().parent().children('.excerpt');
        $(te).text(function(index, currentText) {
          if (currentText.substr(currentText.length - 3) != '\u2026')
            return currentText.substr(0, 150) + '\u2026';
        });
      } else if (($(this).height() < (min - 1) * 3) && ($(this).height() > min)) {
        te = $(this).parent().parent().children('.excerpt');
        $(te).text(function(index, currentText) {
          return currentText.substr(0, 80) + '\u2026';
        });
      } else {
        te = $(this).parent().parent().children('.excerpt');
        $(this).text(function(index, currentText) {
          if ((currentText.substr(currentText.length - 3) != '\u2026') && (currentText.length > 120))
            return currentText.substr(0, 120) + '\u2026';
        });
        te.css("display", "none");
      }
    });
  }
  acts();
  $(window).resize(acts);

   function cardExcerpt() {
    $(".card__excerpt").text(function(index, currentText) {
      return currentText.substr(0, 140) + '\u2026';
    });
  }
  cardExcerpt();
