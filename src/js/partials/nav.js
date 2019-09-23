$(document).ready(function(){
    // $("#nav-mobile").html($("#nav-main").html());
    $("#nav-trigger .navicon-button").click(function(){
      console.info('Burger clicked');
        if ($("#nav ul").hasClass("nav__menu--expanded")) {
            $("#nav ul").removeClass("nav__menu--expanded").slideUp(250);
            $(this).removeClass("open");
        } else {
            $("#nav ul").addClass("nav__menu--expanded").slideDown(250);
            $(this).addClass("open");
        }
    });
});
