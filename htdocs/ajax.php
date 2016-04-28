<?php

if(session_id() == "")
{
    session_start();
}

include_once '../config/config.php';            // initialise settings

$class = $_POST['class'];               //get class
$method = $_POST['method'];               // get method
$param = $_POST['param'];                   // get param

$file = "class" . $_POST['class'] . ".php";               // include file

include_once LibPrefix .  "$file";

$obj = new $class($ini);
$_RESULT = $obj->$method($param);

echo json_encode($_RESULT);
