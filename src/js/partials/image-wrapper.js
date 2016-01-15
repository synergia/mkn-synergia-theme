// Pakuje mniejsze obrazki bez podpisu w <figure> //
// Jeśli obrazek ma tytuł, tym się zajmuje php funkcja w project-functions.php
$('.project-content p').each(function(index) {
  var some_img = $(this).find('img');
  var width = some_img.width();
  if (width < 980) {
    some_img.wrap("<figure></figure>");
  }
});
