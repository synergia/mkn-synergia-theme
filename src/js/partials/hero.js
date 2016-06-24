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
        $('.hero__middleImg').addClass('hero__middleImg--opacity60');
        $('.hero__middleTitle').addClass('hero__middleTitle--opacity0');
        $(this).addClass('hero__left--mvR');
    }, function() {
        $('.hero__middle').removeClass('hero__middle--collapsedL');
        $('.hero__middleImg').removeClass('hero__middleImg--opacity60');
        $('.hero__middleTitle').removeClass('hero__middleTitle--opacity0');
        $(this).removeClass('hero__left--mvR');
    });
    $('.hero__right').hover(function() {
        $('.hero__middle').addClass('hero__middle--collapsedR');
        $('.hero__middleImg').addClass('hero__middleImg--opacity60');
        $('.hero__middleTitle').addClass('hero__middleTitle--opacity0');
        $(this).addClass('hero__right--mvL');

    }, function() {
        $('.hero__middle').removeClass('hero__middle--collapsedR');
        $('.hero__middleImg').removeClass('hero__middleImg--opacity60');
        $('.hero__middleTitle').removeClass('hero__middleTitle--opacity0');
        $(this).removeClass('hero__right--mvL');

    });

    var height = $(window).height();
    var width = $(window).width();
    console.log(height);
    if(width<750) {
        var heroMiddleImg = document.getElementsByClassName('hero__middleImg')[0];
        var heroMiddle = document.getElementsByClassName('hero__middle')[0];
        console.log(heroMiddleImg);
        heroMiddleImg.height= height;
    }
})();
