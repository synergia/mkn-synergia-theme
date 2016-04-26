//Skraca imiona, by nie wychodziły za bloki
$('.membercard__name a').each(function(index) {
    var a = $(this);
    if (a.html().length > 17) {
        var name = a.text();
        // console.log(name);
        var trimmed_name = name.charAt(0) + ". " + name.substr(name.indexOf(' ') + 1);
        // console.log(trimmed_name);
        a.text(trimmed_name);
        if (a.html().length > 17) {
            a.parent().addClass('membercard__name--tooLong');
        }
    }
});

$('.membercardSmall__name a').each(function(index) {
    var length = $(this).html().length;
    if (length > 14) {
        var name = $(this).text();
        // console.log(name);
        var trimmed_name = name.charAt(0) + ". " + name.substr(name.indexOf(' ') + 1);
        // console.log(trimmed_name);
        $(this).text(trimmed_name);
    }
});
