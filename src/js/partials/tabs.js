var current = $('.tabsMenu__item--current .link--tab').attr('href');
$(current).addClass('tab__content--visible');
bLazy.load($(".blazy", current), true);

$(".tabsMenu a").click(function(event) {
    // wyłącza domyślne przejście na adres linku
    event.preventDefault();
    // dodaje klasę do <li>
    $(this).parent().addClass("tabsMenu__item--current");
    // usuwa klasę z <li>
    $(this).parent().siblings().removeClass("tabsMenu__item--current");
    // pobieramy id z hrefu
    var tab = $(this).attr("href");
    // jeśli blok nie ma takiego id, to chowamy go
    $(".tab__content").not(tab).addClass("tab__content--hidden").removeClass("tab__content--visible");
    // a jeśli ma, to pokazujemy
    $(tab).removeClass("tab__content--hidden").addClass("tab__content--visible");
    // ładujemy obrazki w bloku z odpowiednim id
    bLazy.load($(".blazy", tab), true);
});
