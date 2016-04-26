   function cardExcerpt() {
    $(".card__excerpt").text(function(index, currentText) {
      return currentText.substr(0, 140) + '\u2026';
    });
  }
  cardExcerpt();
