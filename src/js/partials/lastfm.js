function loadLastfm() {
    // Pobiera url z hrefa
    var profileUrl = $('a[data-lastfm]').attr('href');
    // Odpowiednio obcina go do username
    var username = profileUrl.substr(27);
    var baseUrl = 'http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks';
    var api_key = '299020c062c481f083ecd0276c315e3a';

    var requestUrl = baseUrl + '&user=' + username + '&api_key=' + api_key + '&format=json';
    console.log(username);
    if ($('[data-lastfm] .tooltip').is(':empty')) {
        $.getJSON(requestUrl, function(data) {
            var artist = data.recenttracks.track[0].artist["#text"];
            var song = data.recenttracks.track[0]["name"];
            var cover = data.recenttracks.track[0].image[3]["#text"];
            if (cover === "") {
                cover = "http://img2-ak.lst.fm/i/u/174s/4128a6eb29f94943c9d206c08e625904.png";
            }
            var outhtml = '<div class="lf"><img class="lf__cover" src="' + cover + '"/><div class="lf__trackInfo"><span class="lf__artist">' + artist + '</span><span class="lf__song">' + song + '</span></div></div>';
            $('[data-lastfm] .tooltip').append(outhtml);
        });
    }
}
