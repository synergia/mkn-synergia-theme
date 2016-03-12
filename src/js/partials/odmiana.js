(function() {
    // https://marcin.laber.pl/2014/09/odmiana-liczebnikow-w-javascript/
    var num = function(value, numerals, wovalue) {
        var t0 = value % 10,
            t1 = value % 100,
            vo = [];
        if (wovalue !== true)
            vo.push(value);
        if (value === 1 && numerals[1])
            vo.push(numerals[1]);
        else if ((value === 0 || (t0 >= 0 && t0 <= 1) || (t0 >= 5 && t0 <= 9) || (t1 > 10 && t1 < 20)) && numerals[0])
            vo.push(numerals[0]);
        else if (((t1 < 10 || t1 > 20) && t0 >= 2 && t0 <= 4) && numerals[2])
            vo.push(numerals[2]);
        return vo[1];
    };

    $('.counter').each(function(index) {
        var status = $(this).attr('id');
        var count = parseInt($(this).children('a').html());
        console.log(count, status);
        if (status === 'finished') {
            $(this).find('.counter__label').html(num(count, ["Projektów ukończonych", "Projekt ukończony", "Projekty ukończone"]));
        } else {
            $(this).find('.counter__label').html(num(count, ["Projektów realizowanych", "Projekt realizowany", "Projekty realizowane"]));
        }
    });

})();
