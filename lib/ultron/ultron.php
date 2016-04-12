<?php

// nie najlepszy kod, co pisałem
function ultron_state()
{
    $ultron_data = ultron_get_data();
    $ultron_state = $ultron_data[0];

    return $ultron_state;
}

// add_action('wp', 'ultron_state');


function ultron_get_data()
{
    $fh = fopen('../ultron/ultron.data', 'r');
    $ultron_data = array();

    while ($line = fgets($fh)) {
        array_push($ultron_data, $line);
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
