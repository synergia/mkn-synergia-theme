// Zwraca stan animacji. Jeśli true, to animacja zostanie odpalona
var animationState = (function() {
    var value = true;
    return {
        change: function() {
            value = !value;
        },
        value: function() {
            return value;
        }
    };
})();

(function() {
    'strict use';
    var ajax_url = jQuery('.global').attr('data-ajax-url');
    var membercard;

    $('.link--name').on('click', changePage);
    $('.membercard__close').on('click', changePage);
    $(window).on('popstate', changePage);

    function changePage(event) {
        var prevUrl = window.location.href;

        // Dodaje dane w odpowiednie miejsce
        var addData = function(data) {
            if ($('.memberWrapper').children().length < 1) {
                $('.memberWrapper').append(data);
            } else {
                $('.memberWrapper').children().detach().remove();
                $('.memberWrapper').append(data);
            }
        };

        if (event.type === 'click') {
            event.preventDefault();
            console.log(event.type);

            membercard = $(this).parents('.membercard');
            var id = membercard.attr('data-id');
            var memberUrl = membercard.find('.link--name').attr('href');

            changeUrl(memberUrl);

            request({
                action: 'load_member_page',
                id: id
            }, addData);

            animateMembercard(membercard);

        } else if (event.type === 'popstate') {
            console.log(event.type);

            animateMembercard(membercard);
            changeUrl(prevUrl);
        }
    }

    function animateMembercard(membercard) {
        if (animationState.value()) {
            $('.memberOverlay').addClass('memberOverlay--visible');
                // .one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                //     function(e) {
                //
                //     });
            console.log("Changing state:", animationState.value());
        } else {
            $('.memberOverlay').removeClass('memberOverlay--visible');
            console.log("Changing state:", animationState.value());
        }
        animationState.change();
        console.log("State changed to:", animationState.value());

    }

    function changeUrl(url) {
        if (url != window.location) {
            //add the new page to the window.history
            window.history.pushState({
                path: url
            }, '', url);
        }
    }

    function request(requestingData, addData) {
        $.ajax({
            url: ajax_url,
            type: 'POST',
            data: requestingData,
            success: function(data) {
                addData(data);
                console.log('Data loaded');
                bLazy.revalidate();
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        });
    }
})();
