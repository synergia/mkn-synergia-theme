<?php
/*
Template Name: Lab
*/
?>
<?php
if(!check_header('HTTP_USER_AGENT', 'ESP8266-IoT') OR !isset($_SERVER['HTTP_ESP8266_DATA']) OR !check_header('HTTP_ESP8266_AUTH_KEY', 'e9b4dbb90c565d901b086169e77c8eaf')) {
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
