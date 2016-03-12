function loadGithub() {
    // Pobiera url z hrefa
    var profileUrl = $('a[data-github]').attr('href');
    // Odpowiednio obcina go do username
    var username = profileUrl.substr(19);
    // Dodaje username do url zapytania
    var requri = 'https://api.github.com/users/' + username;
    // Sprawdza, czy tooltip pusty, by nie generować nowych zapytań
    // i nie dodawać po raz kolejny dane do tooltipa
    if ($('[data-github] .tooltip').is(':empty')) {
        requestJSON(requri, function(json) {
            if (json.message === "Nie znaleziono" || username === '') {
                $('[data-github] .tooltip').html("<h2>Brak informacji</h2>");
            } else {
                username = json.login;
                var profileurl = json.html_url;
                var reposnum = json.public_repos;
                var aviurl = json.avatar_url;


                var outhtml = '<div class="gh">' +
                    '<h4 class="gh__name"><a class="link" href="' + profileurl + '"><img class="gh__avatar" src="' + aviurl + '">@' + username + '</a></h4>';
                outhtml = outhtml + '<span class="gh__repos">Repozytoriów: ' + reposnum + '</span><hr/></div>';
                $('[data-github] .tooltip').append(outhtml);

            } // end else statement
        }); // end requestJSON Ajax call
    }

    function requestJSON(url, callback) {
        $.ajax({
            url: url,
            complete: function(xhr) {
                callback.call(null, xhr.responseJSON);
            }
        });
    }
}
