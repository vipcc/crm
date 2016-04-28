<?php
if(session_id() == "")
{
    session_start();
}

include_once '../config/config.php';            // initialise settings
include_once '../config/startup.php';            // initialise settings
include_once '../lib/functions.php';


$data = array();

if( isset( $_GET['files'] ) ){
    $error = false;
    $files = array();

    $uploaddir = '../upload/';

    // переместим файлы из временной директории в указанную
    foreach( $_FILES as $file ){
        if( move_uploaded_file( $file['tmp_name'], $uploaddir . basename($file['name']) ) ){
            $files[] = realpath( $uploaddir . $file['name'] );
            importFin($pdo, realpath( $uploaddir . $file['name'] ));
        }
        else{
            $error = true;
        }
    }

    $data = $error ? array('error' => 'Ошибка загрузки файлов.') : array('files' => $files );

    echo json_encode( $data );
}
