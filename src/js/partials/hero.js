(function() {
    $(".hero__middleTitle").one('animationend webkitAnimationEnd oAnimationEnd oanimationend MSAnimationEnd',
    function() {
        $(this).removeClass('hero__middleTitle--animation');
    });
    $(".hero__leftTitle").one('animationend webkitAnimationEnd oAnimationEnd oanimationend MSAnimationEnd',
    function() {
        $(this).removeClass('hero__leftTitle--animation');
    });
    $(".hero__rightTitle").one('animationend webkitAnimationEnd oAnimationEnd oanimationend MSAnimationEnd',
    function() {
        $(this).removeClass('hero__rightTitle--animation');
    });


    $('.hero__left').hover(function() {
        $('.hero__middle').addClass('hero__middle--collapsedL');
        $('.hero__middleTitle').addClass('hero__middleTitle--opacity80');
        $(this).addClass('hero__left--mvR');
    }, function() {
        $('.hero__middle').removeClass('hero__middle--collapsedL');
        $('.hero__middleTitle').removeClass('hero__middleTitle--opacity80');
        $(this).removeClass('hero__left--mvR');
    });
    $('.hero__right').hover(function() {
        $('.hero__middle').addClass('hero__middle--collapsedR');
        $('.hero__middleTitle').addClass('hero__middleTitle--opacity80');
        $(this).addClass('hero__right--mvL');

    }, function() {
        $('.hero__middle').removeClass('hero__middle--collapsedR');
        $('.hero__middleTitle').removeClass('hero__middleTitle--opacity80');
        $(this).removeClass('hero__right--mvL');

    });
})();
