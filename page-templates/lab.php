<?php
/*
Template Name: Lab
*/
?>
<?php
if(!isESP($_SERVER['HTTP_ESP8266_DATA'])) {
    //header($_SERVER["SERVER_PROTOCOL"].' 403 Forbidden', true, 403);
    get_header();
    get_template_part('parts/topbar');
    ?>
    <div class="ultron">
        <div id="state" class="ultron__state"></div>
        <div id="time" class="ultron__time"></div>
    </div>

    <?php
    // read_json_and_push(0, 88888);
    // write_all_the_shit(0);
    get_footer();
    exit();

} else {
    write_all_the_shit($_SERVER['HTTP_ESP8266_DATA']);
}


?>
