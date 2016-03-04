//Skraca imiona, by nie wychodziły za bloki
$('.membercard__name a').each(function(index) {
  var length = $(this).html().length;
  if (length > 17) {
    var name = $(this).text();
    $(this).parent().addClass('membercard__name--tooLong');
    // console.log(name);
    var trimmed_name = name.charAt(0) + ". " + name.substr(name.indexOf(' ') + 1);
    // console.log(trimmed_name);
    $(this).text(trimmed_name);
  }
});
