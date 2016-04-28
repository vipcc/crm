<?php

include_once '../lib/Model/patient.php';

//-----------------------------------------------------------------------------------------
function ShowAddDialog($pdo, $smarty, $param) {

    $smarty->assign("specials", GetSpecialList($pdo));
    $smarty->assign("clinics", GetClinicList($pdo));

    $smarty->assign("data", array("status" => $param['status']));

    $html = $smarty->fetch(TplPrefix . 'dialog/editPatient.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_patient_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function ShowEditDialog($pdo, $smarty, $param) {
    Debug("showedit dialog", $param);

    $smarty->assign("data", GetPatientData($pdo, $param['id']));
    $smarty->assign("specials", GetSpecialList($pdo));
    $smarty->assign("clinics", GetClinicList($pdo));


    $smarty->assign("contact_list", $contact_list);
    Debug("showedit dialog", "prefetch");
    $html = $smarty->fetch(TplPrefix . 'dialog/editPatient.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_patient_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function ShowDeleteDialog($pdo, $smarty, $param) {

    $smarty->assign("name",  GetPatientFieldData($pdo, $param['id'], "name"));

    $html = $smarty->fetch(TplPrefix . 'dialog/deletePatient.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "delete_patient_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function GetMainTableData($pdo, $smarty, $param) {

    Debug("Patient GetMainTableData", GetPatientList($pdo, $param));
    $smarty->assign("records", GetPatientList($pdo, $param));
    $smarty->assign("status", $param['status']);
    $html = $smarty->fetch(TplPrefix . 'tables/patient_data.tpl');

    $_RESULT = array(
        "success" => 'true',
        "html"  => $html,
    );
    return $_RESULT;
}

//----------------------------------------------------------------------------------------

function ExtendContacts($contact_list, $count) {
    $num = $count - count($contact_list);
    Debug("extend contacts", "num:" . $num);
    for($i=0; $i < $num; $i++)
        array_push ( $contact_list, array("tp" => 1, "name" => '' ));

    Debug("extend contacts", $contact_list);
    return $contact_list;
}