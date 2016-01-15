// Pobieranie nicków z url i wyświetlanie ich koło ikon społecznościowych
// oraz wykorzystanie username'u githuba do wyświetlenia ostatnie aktywności
$('.userinfo a').each(function(index) {
  var profile = $(this).attr('href');
  var github_profile = profile.substr(19);
  if (profile.indexOf('github') > -1) {
    $('a[data-github]').append(github_profile);
    Github.onlyuserActivity({
      username: github_profile,
      selector: ".github",
      limit: 10
    });
  }
  if (profile.indexOf('twitter') > -1) {
    $('a[data-twitter]').append(profile.substr(20));
  }
  if (profile.indexOf('facebook') > -1) {
    $('a[data-facebook]').append(profile.substr(25));
  }
});

// Github.onlyuserActivity({
//   username: "synergia",
//   selector: ".github_s",
//   limit: 5
// });
