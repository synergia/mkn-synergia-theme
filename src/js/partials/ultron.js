var tu = 1;
var firstRun = false;
var ultronFileLocation = "http://"+window.location.hostname+"/ultron/data.json";
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
        url: ultronFileLocation,
        cache: false,
        success: function(data) {
            var latest = latestData(data);
            if (firstRun === false) {
                $('.state').html(isOpen(latest.state));
                firstRun = true;
                console.log(latest);
            }
            console.log(latest);
            $('.desc').fadeOut(0, function() {
                var tajm = Math.round(new Date().getTime() / 1000);
                if (tajm - latest.time < 60) {
                    $('.desc').html((tajm - latest.time) + "s ago");
                } else if (tajm - latest.time < 3600) {
                    $minutes = parseInt((tajm - latest.time) / 60);
                    $('.desc').html($minutes + "m ago");
                } else {
                    $hours = parseInt((tajm - latest.time) / 3600);
                    $minutes = parseInt((tajm - latest.time) / 60) - $hours * 60;
                    $('.desc').html($hours + "h " + $minutes + "m ago");
                }
                $('.state').html(isOpen(latest.state));
            });
            $('.desc').fadeIn(0);

            setTimeout(function() {
                update_time();
            }, tu * 1000);
        },
        error: function(e, xhr) {
            console.error("err");
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
function latestData(data) {
    return data.slice(-1)[0];
}
