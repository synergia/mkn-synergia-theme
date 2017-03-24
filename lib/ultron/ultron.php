<?php

function check_header($name, $value = false) {
    if(!isset($_SERVER[$name])) {
        return false;
    }
    if($value && $_SERVER[$name] != $value) {
        return false;
    }
    return true;
}

function get_ultron_body()
{
    ?>
    <div class="state">

    </div>
    <div class="desc">

    </div>
    <?php
}

function read_json_and_push($state, $time) {
    $filename = './ultron/data.json';
    $not_json = json_decode(file_get_contents($filename), false );
    if (!is_array ($not_json)) {
        $not_json = [];
    }

    // $new_record['state'] = $state;
    // $new_record['time'] = $time;
    $new_record = array(
        "state" => $state,
        "time" => $time
    );
    array_push( $not_json, $new_record );
    $json = json_encode($not_json);
    // print_r ($json);

    return $json;
}

function write_all_the_shit ($esp_data) {
    $json = read_json_and_push($esp_data, time());
    $filename = './ultron/data.json';
    $file = fopen($filename, 'w');
    fwrite($file, $json);
    fclose($file);
    echo 'OK';
}

function isESP ($esp_data) {
    if(check_header('HTTP_USER_AGENT', 'ESP8266-IoT') OR isset($esp_data) OR check_header('HTTP_ESP8266_AUTH_KEY', 'e9b4dbb90c565d901b086169e77c8eaf')) {
        return true;
    }
}


?>
