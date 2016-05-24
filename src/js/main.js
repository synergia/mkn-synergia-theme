// main.js //
// Wszystko wrzucamy tu

//= ../../bower_components/scroll-up-bar/src/scroll-up-bar.js

////= ../../bower_components/df-visible/jquery.visible.js

jQuery(function($) {

    //= partials/dropdown.js

    //= partials/excerpt.js

    //= partials/image-wrapper.js

    //= partials/notifications.js

    //= partials/recruitment.js

    //// = partials/show-nicknames.js

    //= partials/nav.js

    //= partials/tooltip.js

    //= partials/github.js

    //= partials/lastfm.js

    //= partials/smooth-scroll.js

    $(document).ready(function() {
        //= partials/lazy.js

        ////= member.js

        //= partials/name-trimmer.js

        //= partials/load-more.js

        //= partials/topbar.js

        //= partials/tabs.js

        //= partials/counter.js

        //= partials/odmiana.js

        //= partials/footer.js

        //= partials/hero.js

        //= partials/modal.js

        //= partials/slider.js

    });

    // Prezes zawsze na pierwszym miejscu //
    $('.membercard#president').insertBefore('#current_members .cardsWrapper div:eq(0)');

    // Dodaje do <a> klasę "link"
    $('.project__content a').addClass('link');

});
