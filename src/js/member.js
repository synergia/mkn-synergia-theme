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
    var memberWrapper = $('.memberWrapper');

    $('.link--name').on('click', changePage);
    $(window).on('popstate', changePage);

    function changePage(event) {
        var prevUrl = window.location.href;
        // KLIK //
        if (event.type === 'click') {
            event.preventDefault();
            console.log(event.type);

            membercard = $(this).parents('.membercard');
            var id = membercard.attr('data-id');
            var memberUrl = membercard.find('.link--name').attr('href');
            changeUrl(memberUrl);
            memberWrapper.addClass('hidden');

            // zapobiega powtórnemu ładowaniu tego samego członka
            if (memberWrapper.attr('data-current-member') !== id) {
                request({
                    action: 'load_member_page',
                    id: id
                }, addData);
                changeAttrId(id);
                animateTransition();

            }else {
                animateMemberPage();
                animateTransition();
            }
            // TĘDY-SIĘDY //
        } else if (event.type === 'popstate') {
            console.log(event.type);

            animateTransition();
            changeUrl(prevUrl);
        }
    }

    function animateTransition() {
        if (animationState.value()) {
            $('.memberOverlay').addClass('memberOverlay--visible')
                .one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
                    function(e) {
                        // $('.violetWrapper').addClass('violetWrapper--fullHeight');
                        // $('.violetWrapper').removeClass('violetWrapper--fullHeight');

                    });
            console.log("Changing state:", animationState.value());
        } else {
            $('.memberOverlay').removeClass('memberOverlay--visible');
            console.log("Changing state:", animationState.value());
        }
        animationState.change();
        console.log("State changed to:", animationState.value());
    }
    function animateMemberPage() {
        // if (animationState.value()) {
            memberWrapper.removeClass('hidden');
        // }
    }

    function changeUrl(url) {
        if (url != window.location) {
            //add the new page to the window.history
            window.history.pushState({
                path: url
            }, '', url);
        }
    }
    // Dodaje dane w odpowiednie miejsce
    var addData = function(data) {
        // jeśli już coś jest, to usuwa
        if (memberWrapper.children().length > 1) {
            memberWrapper.empty();
        }
        memberWrapper.removeClass('hidden');

        memberWrapper.append(data);
    };

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
                console.error(errorThrown);
            }
        });
    }

    function changeAttrId(id) {
        document.getElementsByClassName('memberWrapper')[0].setAttribute('data-current-member', id);
    }
})();
