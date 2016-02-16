var ajax_url1 = jQuery('.global').attr('data-ajax-url');

$('.link--name').click(function(e) {
    var membercard = $(this).parents('.membercard');
    var id = membercard.attr('data-id');
    e.preventDefault();

    $('.membercard').not(membercard).addClass('hidden');

    $.ajax({
        url: ajax_url1,
        type: 'POST',
        data: {
            action: 'social_links',
            id: id,
        },
        success: function(data) {
            membercard.children('.ikonki').append(data);

            console.log(data);
            bLazy.revalidate();
        },
        error: function(errorThrown) {
            console.log(errorThrown);
        }
    });
});
