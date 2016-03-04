var tabs = (function() {
    var currentTab;
    return {
        init: function() {
            // pobieramy href
            currentTab = $('.tabsMenu__item--current .link--tab').attr('href');
            // href jest jednocześnie id odpowiedniego tabu, który wyświetlamy
            $(currentTab).addClass('tab__content--visible');
            // ładujemy obrazki
            bLazy.load($(".blazy", currentTab), true);
            console.info('Tabs initiated:', currentTab);
        },
        reset: function() {
            // Z tym #tabsReset, to taki hack. Wykorzystywany dlatego, że
            // po kliknięciu chowają się wszystkie taby, oprócz tej z odpowiednim id
            currentTab = $('#tabsReset .link--tab').attr('href');
            $(currentTab).removeClass("tab__content--hidden").addClass("tab__content--visible");
            console.info('Tabs initiated:', currentTab);
        }
    };
})();
tabs.init();

$(".global").on('click', '.link--tab', function(event) {
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
