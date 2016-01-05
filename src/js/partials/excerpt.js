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
          if (currentText.substr(currentText.length - 3) != '&hellip;')
            return currentText.substr(0, 150) + '&hellip;';
        });
      } else if (($(this).height() < (min - 1) * 3) && ($(this).height() > min)) {
        te = $(this).parent().parent().children('.excerpt');
        $(te).text(function(index, currentText) {
          return currentText.substr(0, 80) + '&hellip;';
        });
      } else {
        te = $(this).parent().parent().children('.excerpt');
        $(this).text(function(index, currentText) {
          if ((currentText.substr(currentText.length - 3) != '&hellip;') && (currentText.length > 120))
            return currentText.substr(0, 120) + '&hellip;';
        });
        te.css("display", "none");
      }
    });
  }
  acts();
  $(window).resize(acts);


$(".card .excerpt").text(function(index, currentText) {
  return currentText.substr(0, 140) + '&hellip;';
});
