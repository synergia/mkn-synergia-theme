(function() {
    // Żeby tooltip nie klikał
    $('.tooltip').on('click', function(e) {
        e.preventDefault();
    });

    $('[data-github]').hover(function(e) {
        loadGithub();
        $(this).children('.tooltip').addClass('tooltip--active');
    }, function(e) {
        $(this).children('.tooltip').removeClass('tooltip--active');
    });

    $('[data-lastfm]').hover(function(e) {
        loadLastfm();
        $(this).children('.tooltip').addClass('tooltip--active');
    }, function(e) {
        $(this).children('.tooltip').removeClass('tooltip--active');
    });
})();
