var tu = 1;
var firstRun = false;
console.log('ultron');

$.ajaxSetup({
    beforeSend: function(xhr) {
        if (xhr.overrideMimeType) {
            xhr.overrideMimeType("application/json");
        }
    }
});

function update_time() {
    $.ajax({
        dataType: "json",
        type: "GET",
        url: "./ultron/data.json",
        cache: false,
        success: function(data) {
            if (firstRun === false) {
                $('.state').html(isOpen(data.state));
                firstRun = true;
                console.log(data);
            }
            console.log(data);
            $('.desc').fadeOut(0, function() {
                var tajm = Math.round(new Date().getTime() / 1000);
                if (tajm - data.time < 60) {
                    $('.desc').html((tajm - data.time) + "s ago");
                } else if (tajm - data.time < 3600) {
                    $minutes = parseInt((tajm - data.time) / 60);
                    $('.desc').html($minutes + "m ago");
                } else {
                    $hours = parseInt((tajm - data.time) / 3600);
                    $minutes = parseInt((tajm - data.time) / 60) - $hours * 60;
                    $('.desc').html($hours + "h " + $minutes + "m ago");
                }
                $('.state').html(isOpen(data.state));
            });
            $('.desc').fadeIn(0);

            setTimeout(function() {
                update_time();
            }, tu * 1000);
        },
        error: function(e, xhr) {
            setTimeout(function() {
                update_time();
            }, tu * 1000);

        }
    });
}
update_time();

function isOpen(data) {
    if(data === "1"){
        return "Otwarte";
    } else {
        return "Zamknięte";
    }
}
