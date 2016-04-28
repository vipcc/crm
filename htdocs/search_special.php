<?php


if(session_id() == "")
{
    session_start();
}

include_once '../config/config.php';            // initialise settings



include_once LibPrefix .  "classModel.php";

$model = new Model($ini);
$_RESULT = $model->getSearchSpecial($_GET['term']);

echo json_encode($_RESULT);
