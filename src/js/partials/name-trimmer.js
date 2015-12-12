//Skraca imiona, by nie wychodziły za bloki
$('.co-author h3 a').each(function(index) {
  var length = $(this).html().length;
  if (length > 13) {
    var name = $(this).text();
    // console.log(name);
    var trimmed_name = name.charAt(0) + ". " + name.substr(name.indexOf(' ') + 1);
    // console.log(trimmed_name);
    $(this).text(trimmed_name);
  }
});
