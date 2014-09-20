<?php
/*
Template Name: Członkowie
*/
?>

<?php get_header(); ?>
	<div id="content">
        <div id="tabs-container">
            <ul class="tabs-menu">
                <li class="current"><a href="#tab-1">Aktualni członkowie</a></li>
                <li><a href="#tab-2">Byli członkowie</a></li>
                <li><a href="#tab-3">Kandydaci</a></li>
                
            </ul>
            <div class="tab">        
                <div id="tab-1" class="tab-content">
                    <?php echo do_shortcode("[table id=1 /]"); ?>
                </div>
                <div id="tab-2" class="tab-content">
                    <div class="special-div-for-grzegorz">
                        <div class="clip-circle"></div>
                        <div class="about-grzegorz">
                            <h2>Grzegorz Hajdukiewicz</h2>
                            <p>Założyciel i pierwszy przewodniczący MKN "Synergia"</p>
                        </div>
                    </div>
                    <?php echo do_shortcode("[table id=2 /]"); ?>
                </div>
                <div id="tab-3" class="tab-content">
                    <?php echo do_shortcode("[table id=3 /]"); ?>
                </div>                
            </div>
            </div>
    </div>

<script>
    $(document).ready(function() {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});</script>
<?php get_sidebar('standard'); ?>
<?php get_footer(); ?>
