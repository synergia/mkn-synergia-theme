$(document).ready(function() {

    $('.blog-list-archive li ul').hide();
    $('.archive-list > li > h2').click(function(){
        $(this).parent().addClass('selected');
        $(this).parent().children('ul').slideDown(250);
        $(this).parent().siblings().children('ul').slideUp(250);
        $(this).parent().siblings().removeClass('selected');
    });
});
