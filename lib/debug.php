<?php

function Debug ($data) {

    $file = fopen(LogPrefix . "debug.log", "a+");
    fwrite($file, print_r($data, true) ."\n");
    fclose($file);

}
