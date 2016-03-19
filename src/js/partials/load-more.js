(function() {
    var ajax_url = $('.global').attr('data-ajax-url');
    var post_offset = 0;
    var incNumber = 6; // ilość postów do załadowania

    var projects = (function(setProjects) {
        var loaded;
        var total;
        return {
            incLoaded: function() {
                loaded = loaded + incNumber;
            },
            getLoaded: function() {
                return loaded;
            },
            setLoaded: function(setProjects) {
                loaded = setProjects;
            },
            setTotal: function(setProjects) {
                total = setProjects;
            },
            getTotal: function() {
                return total;
            }
        };
    })();

    $('#load_more_posts').on('click', loadMore);
    $('#load_more').on('click', loadProjects);

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
                console.info('Ajax: OK');
                bLazy.revalidate();
                cardExcerpt();
            }
        });
    }

    function loadProjects() {
        var thisParent = $(this).parent();
        // ustawia całkowitą liczbę danych projektów
        projects.setTotal(thisParent.attr('data-total'));
        // jeśli jeszcze nie pobierano ajaxem projektów, to ustawia wartość
        // równą już wyświetlonych
        if (!projects.getLoaded()) {
            projects.setLoaded(thisParent.find('.card').length);
            console.log('Already:', projects.getLoaded());
        }
        var projects_status = thisParent.attr('data-projects-status');
        post_offset = parseInt(post_offset) + incNumber;

        if (projects.getTotal() > projects.getLoaded()) {
            $(this).html('<div class="spinner"></div>');
            $.ajax({
                url: ajax_url,
                type: 'POST',
                data: {
                    action: 'load_projects',
                    post_offset: post_offset,
                    projects_status: projects_status,
                },
                success: function(data) {
                    thisParent.children('.cardsWrapper').append(data);
                    bLazy.revalidate();
                    cardExcerpt();
                    $('#load_more').html('Zobacz starsze');
                    projects.incLoaded();
                    console.info('Ajax: Loaded more %s projects: %d/%d', projects_status, projects.getLoaded(), projects.getTotal());
                }
            });
        } else {
            return false;
        }
    }

})();
