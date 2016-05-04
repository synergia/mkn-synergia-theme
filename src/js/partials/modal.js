// Tak w ogóle, to okno modalne należy oddzielić od
// SPONSORÓW i WSPÓŁPRACY, zrobić niezależnym elementem

(function() {
    $('.brand').each(function(index) {
        if ($(this).data('brand-desc').length < 1) {
            $(this).find('.brand__more').remove();
        }
    });

    $('.brand__more').bind("click", function(e) {
        e.preventDefault();
        var brand = $(this).parents('.brand');
        var brandName = brand.data('brand-name');
        var brandLink = brand.data('brand-link');
        var brandDesc = brand.data('brand-desc');
        var brandLogo = brand.find('.brand__logo').attr('src');
        console.log(brand, brandName, brandLink, brandDesc, brandLogo);

        $('.modal__title').html(brandName);
        $('.modal__content a').html(brandLink).attr('href', brandLink);
        $('.modal__content p').html(brandDesc);
        $('.modal__content p').html(brandDesc);
        $('.modal__image').attr('src', brandLogo);

        $("html").addClass("doNotScroll");
        $('.modal').addClass('visible');
    });

    //On clicking the modal background
    $('[data-modal-close]').bind("click", function(e) {
        $('.modal').removeClass('visible');
        $("html").removeClass("doNotScroll");
    });

})();
