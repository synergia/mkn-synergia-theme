(function() {
    var ajax_url = $('.global').attr('data-ajax-url');
    var post_offset = 0;

    $('#load_more_posts').on('click', loadMore);

    function loadMore() {
        console.log('Clicked load_more');
        $(this).html('<div class="spinner"></div>');
        post_offset = parseInt(post_offset) + 6;
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: {
                action: 'load_posts',
                post_offset: post_offset,
            },
            success: function(data) {
                $('#load_more_posts').html('Zobacz starsze');
                $('#posts .cardsWrapper').append(data);
                console.info('Ajax: Loaded more posts');
                bLazy.revalidate();
                cardExcerpt();
            }
        });
    }
})();
