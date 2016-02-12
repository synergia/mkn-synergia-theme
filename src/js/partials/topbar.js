// Hide Header on on scroll down
// http://jsfiddle.net/mariusc23/s6mLJ/31/
var didScroll;
var lastScrollTop = 0;
var delta = 5;
var navbarHeight = $('.topbar').outerHeight();

$(window).scroll(function(event) {
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 250);

function hasScrolled() {
    var st = $(this).scrollTop();
    console.log(st, $(window).height(), $(document).height());

    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
        return;

    // If they scrolled down and are past the navbar, add class .nav-up.
    // This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {
        // Scroll Down
        $('.topbarWrapper').removeClass('topbarWrapper--visible').addClass('topbarWrapper--hidden');

    } else {
        // Scroll Up
        if (st + $(window).height() < $(document).height()) {
            $('.topbarWrapper').removeClass('topbarWrapper--hidden').addClass('topbarWrapper--visible');

            // Gdy jesteśmy na samej górze, to pokazyjemy całe logo
            if(st === 0) {
                $('.topbarWrapper').removeClass('topbarWrapper--visible');
            }
        }
    }

    lastScrollTop = st;
}
