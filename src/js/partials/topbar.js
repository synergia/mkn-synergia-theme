function initTopbar() {
    $('.topbarWrapper').scrollupbar({
        enterViewport: function() {
            $('.topbarWrapper').addClass('topbarWrapper--visible');
        },
        fullyEnterViewport: function() {
            $('#last-event').text('fullyEnterViewport');
        },
        exitViewport: function() {
            $('#last-event').text('exitViewport');
        },
        partiallyExitViewport: function() {
            $('#last-event').text('partiallyExitViewport');
        }
    });
}
    initTopbar();

if ($(window).width() < 750) {
    $.scrollupbar.destroy('.topbarWrapper');
}

$(window).scroll(function(event) {
    // didScroll = true;
    var st = $(this).scrollTop();
    // Gdy jesteśmy na samej górze, to pokazyjemy całe logo
    if (st === 0) {
        $('.topbarWrapper').removeClass('topbarWrapper--visible');
    }
});
