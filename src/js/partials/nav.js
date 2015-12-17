$(document).ready(function(){
    $("#nav-mobile").html($("#nav-main").html());
    $("#nav-trigger .navicon-button").click(function(){
      console.info('Burger clicked');
        if ($("nav#nav-mobile ul").hasClass("expanded")) {
            $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
            $(this).removeClass("open");
        } else {
            $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
            $(this).addClass("open");
        }
    });
});
