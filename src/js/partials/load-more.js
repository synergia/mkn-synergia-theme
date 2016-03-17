(function() {
var ajax_url = $('.global').attr('data-ajax-url');
var post_offset = 0;

$('#load_more').on('click', loadMore);

function loadMore() {
    console.log('Clicked load_more');
    post_offset = parseInt(post_offset) + 6;
    $.ajax({
      url: ajax_url,
      type: 'POST',
      data: {
        action: 'load_posts',
        post_offset: post_offset,
      },
      success: function(data) {
        $('#posts .cardsWrapper').append(data);
        console.info('Ajax: Loaded more posts');
        bLazy.revalidate();
        cardExcerpt();
      }
    });
}
})();
