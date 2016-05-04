<?php

// add_action('wp', 'ultron_state');
function ultron_get_state()
{
    $ultron_data = ultron_get_data();
    echo $ultron_data[1];
    echo $ultron_data[0];
    if ($ultron_data[1] == "True") {
        return array('Zamknięte', $ultron_data[0]);
    } else {
        return array('Otwarte', $ultron_data[0]);
    }
}

function ultron_get_data()
{
    $fh = fopen('../ultron/ultron.data', 'r');
    $ultron_data = array();

    while (feof($fh) !== true) {
        $ultron_data[] = fgets($fh);
    }
    fclose($fh);

    return $ultron_data;
}

function ultron_get_modified_date()
{
    $filename = '../ultron/ultron.data';
    if (file_exists($filename)) {
        return filemtime($filename);
    } else {
        echo "Zła ścieżka";
    }
}

function ultron_get_ping() {
    $ping = ultron_get_modified_date() - ultron_state();
    return $ping;
}
