<?php
/**
 * code exception
 * 1 - filesystem
 * 2 - db
 * 3 - other
 *
 */


function special_handler($exception) {
// write to log
    $file = fopen(LogPrefix . "logfile.log", "a+");
    fwrite($file, $exception->getMessage() ."\n");
    fclose($file);

    switch ($exception->getCode()) {
        case '1':

            break;

    }

// show message for user
    echo "Обнаружена ошибка сервера. Обратитесь к администратору. ".
        " Приносим свои извинения.";

}