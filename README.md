MKNM "Synergia" Theme
=====================
[![devDependency Status](https://david-dm.org/synergia/mknm-synergia-theme/dev-status.svg)](https://david-dm.org/synergia/mknm-synergia-theme#info=devDependencies)

Strona internetowa naszego koła naukowego zawsze była ważnym miejscem do eksponowania naszych projektów, sukcesów i wydarzeń. Nadchodzące zmiany spowodują, że strona zostanie wyjątkowym instrumentem do przedstawienia swojego projektu.


### Jak zainstalować

#### Tam
Po aktywacji motywu należy:

 - Zainstalować wtyczki `Co-Authors Plus`, `WP Users Media`, `Carbon Fields` oraz `Github Updater`. Github Updater jest potrzebny do aktualizacji motywu bezpośrednio z Githuba.
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

### Wykorzystane narzędzia, frameworki oraz pomysły

*   [sass](http://sass-lang.com/) - preprocessor
*   [mq](https://github.com/sass-mq/sass-mq) - Media Queries with superpowers
*   [Prism.js](http://prismjs.com/index.html) - Prism is a lightweight, extensible syntax highlighter, built with modern web standards in mind.
*   [Normalize.css](http://Normalize.css) - A modern, HTML5-ready alternative to CSS resets
*   [burger](http://codepen.io/bennettfeely/pen/twbyA)
*   [Transformer Tabs, minimal JS ](http://codepen.io/Merri/pen/FAtDq)
*   [Ikony "Entypo"](http://www.entypo.com/)
*   [Gulp](http://gulpjs.com/) - Automate and enhance your workflow
*   [bLazy.js](http://dinbror.dk/blog/blazy/) - A lazy load image script
*   [Swipe](https://github.com/thebird/Swipe) -  Swipe is the most accurate touch slider.
*   [Dropy2](http://codepen.io/Tombek/pen/OPvpLe) -  A Simple SCSS & jQuery dropdown
*   [Carbon Fields](http://carbonfields.net/) -  Elegant WordPress custom fields for developers
