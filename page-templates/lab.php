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
    get_footer();
    exit();

} else {
    $filename = './ultron/data.json';

    $file = fopen($filename, 'w');
    $text = '{"state":"'.$_SERVER['HTTP_ESP8266_DATA'].'","time":"'.time().'"}';
    fwrite($file, $text);
    fclose($file);
    echo 'OK';
}
?>
