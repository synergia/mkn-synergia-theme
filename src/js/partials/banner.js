(function() {
    $('.banner__left').hover(function() {
        $('.banner__middle').addClass('banner__middle--collapsedL');
        $('.banner__middleTitle').addClass('banner__middleTitle--opacity80');
        $(this).addClass('banner__left--mvR');
    }, function() {
        $('.banner__middle').removeClass('banner__middle--collapsedL');
        $('.banner__middleTitle').removeClass('banner__middleTitle--opacity80');
        $(this).removeClass('banner__left--mvR');
    });
    $('.banner__right').hover(function() {
        $('.banner__middle').addClass('banner__middle--collapsedR');
        $('.banner__middleTitle').addClass('banner__middleTitle--opacity80');
        $(this).addClass('banner__right--mvL');

    }, function() {
        $('.banner__middle').removeClass('banner__middle--collapsedR');
        $('.banner__middleTitle').removeClass('banner__middleTitle--opacity80');
        $(this).removeClass('banner__right--mvL');

    });
})();
