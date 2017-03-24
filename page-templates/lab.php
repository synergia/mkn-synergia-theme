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
    get_ultron_body();
    // read_json_and_push(0, 88888);
    // write_all_the_shit(0);
    get_footer();
    exit();

} else {
    write_all_the_shit($_SERVER['HTTP_ESP8266_DATA']);
}


?>
