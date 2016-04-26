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
            // Skrolujemy do góry, by pokazać topbar
            $('html').scrollTop(0);

            console.log(event.type);
            membercard = $(this).parents('.membercard');
            var id = membercard.attr('data-id');
            var memberUrl = membercard.find('.link--name').attr('href');
            changeUrl(memberUrl);
            animateMemberPage('hide');

            // zapobiega powtórnemu ładowaniu tego samego członka
            if (memberWrapper.attr('data-current-member') !== id) {
                request({
                    action: 'load_member_page',
                    id: id
                }, addData);
                changeAttrId(id);
                animateOverlay();

            } else {
                animateMemberPage('show');
                animateOverlay();
            }
            // TĘDY-SIĘDY //
        } else if (event.type === 'popstate') {
            console.log(event.type);
            animateOverlay();
            changeUrl(prevUrl);
            tabs.reset();
        }
    }

    function animateOverlay() {
        if (animationState.value()) {
            $('.memberOverlay').addClass('memberOverlay--visible');
            $('html').css({'overflow': 'hidden'});
            $.scrollupbar.destroy('.topbarWrapper');

            console.log("Changing state:", animationState.value());
        } else {
            initTopbar();
            $('.memberOverlay').removeClass('memberOverlay--visible');
            $('html').css({'overflow': 'auto'});

            console.log("Changing state:", animationState.value());
        }
        animationState.change();
        console.log("State changed to:", animationState.value());
    }

    function animateMemberPage(state) {
        if (state === 'show') {
            memberWrapper.removeClass('hidden');
        } else if (state === 'hide') {
            memberWrapper.addClass('hidden');
        }
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
        animateMemberPage('show');
        memberWrapper.append(data);
        tabs.init();
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
        memberWrapper[0].setAttribute('data-current-member', id);
    }

    $('.memberOverlay').on('scroll', function () {
        $('html').scrollTop($(this).scrollTop());
    });
})();
