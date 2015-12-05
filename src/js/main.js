jQuery(function($) {
  //BURGER//////////////////////////////
  $("button").click(function() { //
    $(this).toggleClass("close"); //
  }); //
  //////////////////////////////////////
  $(function() {
    // Touch ripple effect on buttons
    $('.button:not(.button.disabled)').on('click',

      function(e) {

        /*!
        SVG version for ripple effect via Jonathan Cutrell (gently modified)
        http://webdesign.tutsplus.com/tutorials/recreating-the-touch-ripple-effect-as-seen-on-google-design--cms-21655
        */

        var x = e.pageX;
        var y = e.pageY;
        var clickY = y - $(this).offset().top;
        var clickX = x - $(this).offset().left;
        var box = this;

        var setX = parseInt(clickX);
        var setY = parseInt(clickY);
        var ripple = '<svg class="ink"><circle cx="' + setX + '" cy="' + setY + '" r="' + 0 + '"></circle></svg>';

        $(this).find('.ink').remove();
        $(this).append(ripple);

        var c = $(box).find('circle');
        c.animate({
          'r': $(box).outerWidth()
        }, {
          duration: 333,
          step: function(val) {
            c.attr('r', val);
          },
          complete: function() {
            c.fadeOut('fast');
          }
        });

        return true;

      });

  });
});

/* ========================================================================
 * Bootstrap: transition.js v3.2.0
 * http://getbootstrap.com/javascript/#transitions
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


jQuery(function($) {
  'use strict';

  // CSS TRANSITION SUPPORT (Shoutout: http://www.modernizr.com/)
  // ============================================================

  function transitionEnd() {
    var el = document.createElement('bootstrap');

    var transEndEventNames = {
      WebkitTransition: 'webkitTransitionEnd',
      MozTransition: 'transitionend',
      OTransition: 'oTransitionEnd otransitionend',
      transition: 'transitionend'
    };

    for (var name in transEndEventNames) {
      if (el.style[name] !== undefined) {
        return {
          end: transEndEventNames[name]
        };
      }
    }

    return false; // explicit for ie8 (  ._.)
  }

  // http://blog.alexmaccaw.com/css-transitions
  $.fn.emulateTransitionEnd = function(duration) {
    var called = false;
    var $el = this;
    $(this).one('bsTransitionEnd', function() {
      called = true;
    });
    var callback = function() {
      if (!called) $($el).trigger($.support.transition.end);
    };
    setTimeout(callback, duration);
    return this;
  };

  $(function() {
    $.support.transition = transitionEnd();

    if (!$.support.transition) return;

    $.event.special.bsTransitionEnd = {
      bindType: $.support.transition.end,
      delegateType: $.support.transition.end,
      handle: function(e) {
        if ($(e.target).is(this)) return e.handleObj.handler.apply(this, arguments);
      }
    };
  });

});

/* ========================================================================
 * Bootstrap: collapse.js v3.2.0
 * http://getbootstrap.com/javascript/#collapse
 * ========================================================================
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


jQuery(function($) {
  'use strict';

  // COLLAPSE PUBLIC CLASS DEFINITION
  // ================================

  var Collapse = function(element, options) {
    this.$element = $(element);
    this.options = $.extend({}, Collapse.DEFAULTS, options);
    this.transitioning = null;

    if (this.options.parent) this.$parent = $(this.options.parent);
    if (this.options.toggle) this.toggle();
  };

  Collapse.VERSION = '3.2.0';

  Collapse.DEFAULTS = {
    toggle: true
  };

  Collapse.prototype.dimension = function() {
    var hasWidth = this.$element.hasClass('width');
    return hasWidth ? 'width' : 'height';
  };

  Collapse.prototype.show = function() {
    if (this.transitioning || this.$element.hasClass('in')) return;

    var startEvent = $.Event('show.bs.collapse');
    this.$element.trigger(startEvent);
    if (startEvent.isDefaultPrevented()) return;

    var actives = this.$parent && this.$parent.find('> .panel > .in');

    if (actives && actives.length) {
      var hasData = actives.data('bs.collapse');
      if (hasData && hasData.transitioning) return;
      Plugin.call(actives, 'hide');
      // hasData || actives.data('bs.collapse', null)
    }

    var dimension = this.dimension();

    this.$element
      .removeClass('collapse')
      .addClass('collapsing')[dimension](0);

    this.transitioning = 1;

    var complete = function() {
      this.$element
        .removeClass('collapsing')
        .addClass('collapse in')[dimension]('');
      this.transitioning = 0;
      this.$element
        .trigger('shown.bs.collapse');
    };

    if (!$.support.transition) return complete.call(this);

    var scrollSize = $.camelCase(['scroll', dimension].join('-'));

    this.$element
      .one('bsTransitionEnd', $.proxy(complete, this))
      .emulateTransitionEnd(350)[dimension](this.$element[0][scrollSize]);
  };

  Collapse.prototype.hide = function() {
    if (this.transitioning || !this.$element.hasClass('in')) return;

    var startEvent = $.Event('hide.bs.collapse');
    this.$element.trigger(startEvent);
    if (startEvent.isDefaultPrevented()) return;

    var dimension = this.dimension();

    this.$element[dimension](this.$element[dimension]())[0].offsetHeight

    this.$element
      .addClass('collapsing')
      .removeClass('collapse')
      .removeClass('in');

    this.transitioning = 1;

    var complete = function() {
      this.transitioning = 0;
      this.$element
        .trigger('hidden.bs.collapse')
        .removeClass('collapsing')
        .addClass('collapse');
    };

    if (!$.support.transition) return complete.call(this);

    this.$element[dimension](0)
      .one('bsTransitionEnd', $.proxy(complete, this))
      .emulateTransitionEnd(350);
  };

  Collapse.prototype.toggle = function() {
    this[this.$element.hasClass('in') ? 'hide' : 'show']();
  };


  // COLLAPSE PLUGIN DEFINITION
  // ==========================

  function Plugin(option) {
    return this.each(function() {
      var $this = $(this);
      var data = $this.data('bs.collapse');
      var options = $.extend({}, Collapse.DEFAULTS, $this.data(), typeof option == 'object' && option);

      if (!data && options.toggle && option == 'show') option = !option;
      if (!data) $this.data('bs.collapse', (data = new Collapse(this, options)));
      if (typeof option == 'string') data[option]();
    });
  }
  var old = $.fn.collapse;

  $.fn.collapse = Plugin;
  $.fn.collapse.Constructor = Collapse;


  // COLLAPSE NO CONFLICT
  // ====================

  $.fn.collapse.noConflict = function() {
    $.fn.collapse = old;
    return this;
  };


  // COLLAPSE DATA-API
  // =================

  $(document).on('click.bs.collapse.data-api', '[data-toggle="collapse"]', function(e) {
    var href;
    var $this = $(this);
    var target = $this.attr('data-target') || e.preventDefault() || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''); // strip for ie7
    var $target = $(target);
    var data = $target.data('bs.collapse');
    var option = data ? 'toggle' : $this.data();
    var parent = $this.attr('data-parent');
    var $parent = parent && $(parent);

    if (!data || !data.transitioning) {
      if ($parent) $parent.find('[data-toggle="collapse"][data-parent="' + parent + '"]').not($this).addClass('collapsed');
      $this[$target.hasClass('in') ? 'addClass' : 'removeClass']('collapsed');
    }

    Plugin.call($target, option);
  });

  //TABS
  $(function() {
    // set active radio to address bar
    $(document).on('click', '.tabs .tabs-nav label', function() {
      var hash = '#' + $(this).attr('for');
      window.history.replaceState('', '', hash);
    });
    // select active radio based on hash
    $(document.location.hash).prop('checked', true);
  });
});

// Pobieranie nicków z url i wyświetlanie ich koło ikon społecznościowych
// oraz wykorzystanie username'u githuba do wyświetlenia ostatnie aktywności
jQuery(function($) {
  $('.userinfo a').each(function(index) {
    var profile = $(this).attr('href');
    var github_profile = profile.substr(19);
    if (profile.indexOf('github') > -1) {
      $('a[data-github]').append(github_profile);
      Github.onlyuserActivity({
        username: github_profile,
        selector: ".github",
        limit: 10
      });
    }
    if (profile.indexOf('twitter') > -1) {
      $('a[data-twitter]').append(profile.substr(20));
    }
    if (profile.indexOf('facebook') > -1) {
      $('a[data-facebook]').append(profile.substr(25));
    }
  });

});
// Github.onlyuserActivity({
//   username: "synergia",
//   selector: ".github_s",
//   limit: 5
// });
jQuery(function($) {
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
          if (currentText.substr(currentText.length - 3) != '...')
            return currentText.substr(0, 150) + '...';
        });
      } else if (($(this).height() < (min - 1) * 3) && ($(this).height() > min)) {
        te = $(this).parent().parent().children('.excerpt');
        $(te).text(function(index, currentText) {
          return currentText.substr(0, 80) + '...';
        });
      } else {
        te = $(this).parent().parent().children('.excerpt');
        $(this).text(function(index, currentText) {
          if ((currentText.substr(currentText.length - 3) != '...') && (currentText.length > 120))
            return currentText.substr(0, 120) + '...';
        });
        te.css("display", "none");
      }
    });
  }
  acts();
  $(window).resize(acts);
});

jQuery(".card .excerpt").text(function(index, currentText) {
  return currentText.substr(0, 140) + '...';
});

//Skraca imiona, by nie wychodziły za bloki
jQuery(function($) {
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
});
// Pakuje mniejsze obrazki bez podpisu w <figure> //
// Jeśli obrazek ma tytuł, tym się zajmuje php funkcja w project-functions.php
jQuery(function($) {
  $('.project-content p').each(function(index) {
    var some_img = $(this).find('img');
    var width = some_img.width();
    if (width < 980) {
      some_img.wrap("<figure></figure>");
    }
  });
});

// Dropdown download button //

// http://codepen.io/georgehastings/pen/vptdb
jQuery(function($) {

  $(".dropdown").on("click", function(event) {
    $(this).toggleClass("flip");
    event.stopPropagation();
  });
  $(document).on("click", function(event) {
    $(".dropdown").removeClass("flip");
  });
});

// Prezes zawsze na pierwszym miejscu //
// Pozwalają otwierać baner tylko przy pierwszej wizycie
// http://stackoverflow.com/questions/24070627/create-dropdown-banner-when-user-first-visits-website
jQuery(function($) {
  $('#management_board li#admin').insertBefore('#management_board li:eq(0)');
});

// Animacje dla banera rekrutacji //
jQuery(function($) {
  $('label.button').on('click', function() {
    $('.fb').addClass('animated fadeInUp');
    $('.date .icon-container').addClass('animated slideInLeft');
    $('.date span').addClass('animated slideInLeft');
    $('.location .icon-container').addClass('animated slideInRight');
    $('.location span').addClass('animated slideInRight');

  });
  $('#close_banner').on('click', function() {
    $('.fb').removeClass('animated fadeInUp');
    $('.date .icon-container').removeClass('animated slideInLeft');
    $('.date span').removeClass('animated slideInLeft');
    $('.location .icon-container').removeClass('animated slideInRight');
    $('.location span').removeClass('animated slideInRight');
  });
});

// Notyfikacje, powiadomienia //
jQuery(function($) {
  $(".note-close").click(function() {
    $(this).parent()
      .animate({
        opacity: 0
      }, 250, function() {
        $(this)
          .animate({
            marginBottom: 0
          }, 250)
          .children()
          .animate({
            padding: 0
          }, 250)
          .wrapInner("<div />")
          .children()
          .slideUp(250, function() {
            $(this).closest(".note").remove();
          });
      });
  });
});
// Płynne skrolowanie //
// https://css-tricks.com/snippets/jquery/smooth-scrolling/#comment-197181

jQuery(function($) {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
