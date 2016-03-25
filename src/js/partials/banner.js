(function() {
    $('.banner__left').hover(function() {
        $('.banner__middle').addClass('banner__middle--collapsedL');
        $(this).addClass('banner__left--mvR');
    }, function() {
        $('.banner__middle').removeClass('banner__middle--collapsedL');
        $(this).removeClass('banner__left--mvR');
    });
    $('.banner__right').hover(function() {
        $('.banner__middle').addClass('banner__middle--collapsedR');
        $(this).addClass('banner__right--mvL');

    }, function() {
        $('.banner__middle').removeClass('banner__middle--collapsedR');
        $(this).removeClass('banner__right--mvL');

    });
})();
