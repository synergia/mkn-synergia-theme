// http://codepen.io/jakubtursky/pen/vEwZop
	$.fn.jQuerySimpleCounter = function( options ) {
	    var settings = $.extend({
	        start:  0,
	        end:    100,
	        easing: 'swing',
	        duration: 400,
	        complete: ''
	    }, options );

	    var thisElement = $(this);

	    $({count: settings.start}).animate({count: settings.end}, {
			duration: settings.duration,
			easing: settings.easing,
			step: function() {
				var mathCount = Math.ceil(this.count);
				thisElement.children('.counters__count').text(mathCount);
			},
			complete: settings.complete
		});
	};

// var finishedNumber = $('#finished').data('finished');
// console.log(finishedNumber);
// $('#finished').jQuerySimpleCounter({end: finishedNumber, duration: 3000});
// $('#number2').jQuerySimpleCounter({end: 55,duration: 3000});
// $('#number3').jQuerySimpleCounter({end: 359,duration: 2000});
// $('#number4').jQuerySimpleCounter({end: 246,duration: 2500});
