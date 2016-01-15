MKNM "Synergia" Theme
=====================
[![devDependency Status](https://david-dm.org/synergia/mknm-synergia-theme/dev-status.svg)](https://david-dm.org/synergia/mknm-synergia-theme#info=devDependencies)

Strona internetowa naszego koła naukowego zawsze była ważnym miejscem do eksponowania naszych projektów, sukcesów i wydarzeń. Nadchodzące zmiany spowodują, że strona zostanie wyjątkowym instrumentem do przedstawienia swojego projektu.


### Jak zainstalować

#### Tam
Po aktywacji motywu należy:

 - Zainstalować wtyczki `Co-Authors Plus`, `WP Users Media` oraz `Github Updater`. Motyw jest najściślej powiązany z Co-Authors Plus. Github Updater jest potrzebny do aktualizacji motywu bezpośrednio z Githuba.
 - Wyłączyć Gravatars w `Ustawienia->Dyskusja`

#### Tu
Wszystko, co wyżej oraz zainstalować zależności:

       $ npm install && bower install

Zbudować dla dalszego rozwoju:

       $ gulp dev

Zbudować dla produkcji:

       $ gulp prod

Usunąć folder `build`:

       $ gulp clean


----------

### 1.4.0 "Carrie Fisher"

![](http://cs628419.vk.me/v628419187/48151/3R20Q-CTUPI.jpg)

* Leniwe ładowanie obrazków
* Dodając galerię, tworzy się slajder
* Refaktoryzacja
* Dodano wkładki w ustawieniach
* Dodano licznik w ustawieniach do następnej aktualizacji liczby projektów
* Dodano wyświetlanie projektów realizowanych
* Dodano autoładowanie projektów podczas skrolowania
* Przy pierwszej instalacji tworzone są automatycznie strony i menu
* Zamiast listy projektów wyświetlane są karty. Rozwiązuje to problem ekscerpcji
* Zakładka "Github" nie będzie się wyświetlać, jeśli członek nie dodał link w profilu
* Zaimplementowano "Główny Zamysł"
* Strona członków wyświetla liczbę ukończonych i realizowanych projektów
* Nowe domyślne obrazki tytułowe
* Teraz można włączyć lub wyłączyć wyświetlanie autora wpisu
* Drobne ulepszenia i poprawki


### 1.3.0 "Alicia Vikander"

![](http://cs627324.vk.me/v627324187/22aa6/i2a2C9psvMI.jpg)

* Dodano płynne skrolowanie
* Nowa strona logowania
* Filtr dla rozpoczętych projektów i ukończonych
* Osobne foldery dla plików i media projektów
* Poprawiono mnóstwo błędów

### 1.2.0 "Emily Blunt"

![](http://cs627828.vk.me/v627828187/26705/3vdCCbSW5t8.jpg)

* Poprawiono tutuł każdej strony
* Dodano favicon i specyficzne ikony dla iOS
* Usunięto sekcję z komentarzami
* Dodano opengraph i twitter cards

### 1.1.0 "Eva Green"

![](http://cs629530.vk.me/v629530187/14ec7/HCZCLdK_B3c.jpg)

* Dodano możliwość wyświetlania baneru rekrutacyjnego #20
* Tło dla mniejszych obrazków rozjaśniono #13
* Poprawiono wygląd boxu z dodawaniem dodatkowych plików do projektu #9
* Linki współpracy i sponsorów ustawiono w dwie kolumny #8
* Naprawiono wyświetlanie archiwum #4
* Naprawiono wyświetlanie w prawidłowej kolejności członków i zarząd #3
* Refaktoryzacja ustawień #2
* Dodano pole dla Google Analytics

### 1.0.1 "Emma Stone"

![](http://cs629530.vk.me/v629530187/14eba/-vi4bzQQlUI.jpg)

*   Nowy wygląd kart projektów na głównej
*   Nowe przyciski z ripple efektem
*   Nowa strona projektu: przydzielanie członków do projektu, status projektu, linki na githuba, stronę internetową i fanpage projektu, specjalny przycisk do wrzucenia dodatkowych plików, podświetlanie składni
* Nowy wygląd aktualności
*   Nowy wygląd listy członków
*   Sekcja aktualnych członków wyświetla wyłącznie członków, którzy już zaangażowali się w przynajmniej jeden projekt.
*   Konto członka: wyświetlanie linków do serwisów społecznościowych, obrazek profilowy, lista projektów
*   Specjalne role

### Wykorzystane narzędzia, frameworki oraz pomysły

*   [sass](http://sass-lang.com/) - preprocessor
*   [mq](https://github.com/sass-mq/sass-mq) - Media Queries with superpowers
*   [GridLayout](https://ghinda.net/gridlayout/) - Lightweight grid system for advanced horizontal and vertical responsive web app layouts, with support for older browsers.
*   [Github.js](http://akshaykumar6.github.io/github-js/) - Easy way to feature open source contributions on your website or portfolio.
*   [Prism.js](http://prismjs.com/index.html) - Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.
*   [Normalize.css](http://Normalize.css) - A modern, HTML5-ready alternative to CSS resets
*   [burger](http://codepen.io/bennettfeely/pen/twbyA)
*   [Material Buttons ](http://codepen.io/jreece/pen/myeJBN)
*   [Transformer Tabs, minimal JS ](http://codepen.io/Merri/pen/FAtDq)
*   [Ikony "Entypo"](http://www.entypo.com/)
*   [Animate.css](http://daneden.github.io/animate.css/) -  Just-add-water CSS animations
*   [Gulp](http://gulpjs.com/) - Automate and enhance your workflow
*   [bLazy.js](http://dinbror.dk/blog/blazy/) - A lazy load image script
*   [Swipe](https://github.com/thebird/Swipe) -  Swipe is the most accurate touch slider.
*   [Dropy2](http://codepen.io/Tombek/pen/OPvpLe) -  A Simple SCSS & jQuery dropdown
