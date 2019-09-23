// Based on plks code

jQuery(document).ready(function() {
    var tags = Array('robots', 'scifi', 'sci_fi', 'robot', 'electronics', 'code');
    var error404 = document.getElementsByClassName('error404')[0];
    jQuery.get('http://api.giphy.com/v1/gifs/random', {
        'api_key': 'dc6zaTOxFJmzC',
        'tag': tags[Math.floor(Math.random() * tags.length)]
    }, function(data) {
        error404.style.backgroundImage = 'url(' + data.data.image_original_url + ')';
    });

    jQuery('.error404__back').click(function(e) {
        //if it was the first page
        if(history.length === 1){
            window.location = "http://synergia.pwr.wroc.pl";
        } else {
            history.back();
        }    });
});
