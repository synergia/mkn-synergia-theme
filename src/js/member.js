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
    var ajax_url1 = jQuery('.global').attr('data-ajax-url');
    var membercard;

    $('.link--name').on('click', changePage);
    $('.membercard__close').on('click', changePage);

    $(window).on('popstate', changePage);


    function changePage(event) {
        var prevUrl = window.location.href;

        // Dodaje dane w odpowiednie miejsce
        var addData = function(data) {
            membercard.find('.membercard__socialLinks').append(data);
        };

        if (event.type === 'click') {
            event.preventDefault();
            console.log(event.type);

            membercard = $(this).parents('.membercard');
            var id = membercard.attr('data-id');
            var url = membercard.find('.link--name').attr('href');

            changeUrl(url);
            request({
                action: 'social_links',
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
            $('.membercard').not(membercard).addClass('hidden');
            $('.global').addClass('global--full');

            membercard.addClass('membercard--full');
            membercard.children('.membercard__close').addClass('membercard__close--visible');
            membercard.children('.membercard__info').addClass('membercard__info--full');
            membercard.find('.membercard__name').addClass('membercard__name--full');
            console.log("Changing state:", animationState.value());
        } else {
            $('.membercard').not(membercard).removeClass('hidden');
            $('.global').removeClass('global--full');

            membercard.removeClass('membercard--full');
            membercard.children('.membercard__close').removeClass('membercard__close--visible');
            membercard.children('.membercard__info').removeClass('membercard__info--full');
            membercard.find('.membercard__name').removeClass('membercard__name--full');
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
