/**
 * Created by plks on 2016-03-09.
 */

$('document').ready(function () {
    var tags = Array('robots', 'scifi', 'sci_fi', 'robot', 'electronics', 'code');
    $.get('http://api.giphy.com/v1/gifs/random', {
        'api_key': 'dc6zaTOxFJmzC',
        'tag': tags[Math.floor(Math.random() * tags.length)]
    }, function (data) {
        //console.log('data ' + data.url);
        $('.gif').html('<img src="' + data.data.image_original_url + '" height="100%" width="100%"></img>');
    });

});

