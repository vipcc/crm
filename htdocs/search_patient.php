<?php


if(session_id() == "")
{
    session_start();
}

include_once '../config/config.php';            // initialise settings



include_once LibPrefix .  "classModelPatient.php";

$patient = new ModelPatient($ini);
$_RESULT = $patient->getSearchList($_GET['term']);

echo json_encode($_RESULT);
