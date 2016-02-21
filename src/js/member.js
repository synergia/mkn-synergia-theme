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

// Oblicza o ile pixeli przesunąć kartę
function pixelsToCenter(block) {
    var viewCenterX = Math.floor(window.innerWidth / 2);
    var viewCenterY = Math.floor(window.innerHeight / 2);
    var offset = block.offset();
    return {
        x: function() {
            return viewCenterX - Math.floor(offset.left + block.outerWidth() / 2);
        },
        y: function() {
            return viewCenterY - Math.floor(offset.top + block.outerHeight() / 2);

        }
    };
}

(function() {
    'strict use';
    var ajax_url1 = jQuery('.global').attr('data-ajax-url');
    var membercard;

    $('.link--name').on('click', changePage);
    $('.membercard__close').on('click', changePage);

    $(window).on('popstate', changePage);


    function changePage(event) {
        var prevUrl = window.location.href;

        // Dodaje dane w odpowiednie miejsce
        var addData = function(data) {
            membercard.find('.membercard__fullProfile').append(data);
        };

        if (event.type === 'click') {
            event.preventDefault();
            console.log(event.type);

            membercard = $(this).parents('.membercard');

            var id = membercard.attr('data-id');
            var url = membercard.find('.link--name').attr('href');

            changeUrl(url);
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
            membercard.children('membercard__fullProfile').addClass('visible');


            console.log("Changing state:", animationState.value());
        } else {

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
            url: ajax_url1,
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
