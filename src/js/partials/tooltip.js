(function() {
    // Żeby tooltip nie klikał
    $('.tooltip').on('click', function(e) {
        e.preventDefault();
    });

    $('[data-github]').hover(function(e) {
        loadGithub();
        $('.tooltip').addClass('tooltip--active');
    }, function(e) {
        $('.tooltip').removeClass('tooltip--active');

    });
})();
