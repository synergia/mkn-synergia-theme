(function($) {
    var updateTime = 5;
    var ultronFileLocation = "http://" + window.location.hostname + "/ultron/data.json";
    var ustate = document.getElementById('state');
    var utime = document.getElementById('time');

if(document.body.classList.contains('page-template-lab') === true) {
    // Pierwszy request
    requestJSON();
    window.setInterval(function(){
        console.info('Interval request...');
        requestJSON();
    }, updateTime * 1000);
}


    function requestJSON() {
        $.ajaxSetup({
            beforeSend: function(xhr) {
                if (xhr.overrideMimeType) {
                    xhr.overrideMimeType("application/json");
                }
            }
        });

        $.ajax({
            dataType: "json",
            type: "GET",
            url: ultronFileLocation,
            cache: false,
            success: function(data) {
                console.info("Latest", latestData(data));
                setState(latestData(data));
                setTime(calcTime(latestData(data)));
            },
            error: function(e, xhr) {
                console.error("err");
                return e;
            }
        });
    }

    function setState(latest) {
        ustate.innerHTML = isOpenText(latest.state);
    }

    function setTime(time) {
        utime.innerHTML = time;
    }

    function calcTime(latest) {
        var time = Math.round(new Date().getTime() / 1000);
        var min = parseInt((time - latest.time) / 60);
        var hours = parseInt((time - latest.time) / 3600);
        if (time - latest.time < 60) {
            return (time - latest.time) + "s temu";
        } else if (time - latest.time < 3600) {
            return min + "m temu";
        } else {
            min = min - hours * 60;
            return hours + "g " + min + "m temu";
        }
    }

    function isOpenText(data) {
        if (data === "1") {
            return "Otwarte";
        } else {
            return "Zamknięte";
        }
    }

    function latestData(data) {
        return data.slice(-1)[0];
    }
})(jQuery);
