// Animacje dla banera rekrutacji //
$('label.button').on('click', function() {
  $('.fb').addClass('animated fadeInUp');
  $('.date .icon-container').addClass('animated slideInLeft');
  $('.date span').addClass('animated slideInLeft');
  $('.location .icon-container').addClass('animated slideInRight');
  $('.location span').addClass('animated slideInRight');

});
$('#close_banner').on('click', function() {
  $('.fb').removeClass('animated fadeInUp');
  $('.date .icon-container').removeClass('animated slideInLeft');
  $('.date span').removeClass('animated slideInLeft');
  $('.location .icon-container').removeClass('animated slideInRight');
  $('.location span').removeClass('animated slideInRight');
});

// http://stackoverflow.com/questions/24070627/create-dropdown-banner-when-user-first-visits-website
// Pozwalają otwierać baner tylko przy pierwszej wizycie

// cookie-js
