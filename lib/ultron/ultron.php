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
?>
