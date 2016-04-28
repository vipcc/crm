<?php

include_once '../lib/Model/doctor.php';

//-----------------------------------------------------------------------------------------
function ShowAddDialog($pdo, $smarty, $param) {

    $smarty->assign("specials", GetSpecialList($pdo));
    $smarty->assign("clinics", GetClinicList($pdo));
    $contact_list = ExtendContacts(array(), 3);
    $smarty->assign("contact_list", $contact_list);
    $smarty->assign("data", array("status" => $param['status']));

    $html = $smarty->fetch(TplPrefix . 'dialog/editDoctor.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_doctor_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function ShowEditDialog($pdo, $smarty, $param) {
    Debug("showedit dialog", $param);

    $smarty->assign("data", GetDoctorData($pdo, $param['id']));
    $smarty->assign("specials", GetSpecialList($pdo));
    $smarty->assign("clinics", GetClinicList($pdo));

    $contact_list = getContactList($pdo, 'doctor_contact', $param['id']);
    $contact_list = ExtendContacts($contact_list, 3);
    $smarty->assign("contact_list", $contact_list);
    Debug("showedit dialog", "prefetch");
    $html = $smarty->fetch(TplPrefix . 'dialog/editDoctor.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_doctor_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function ShowDeleteDialog($pdo, $smarty, $param) {

    $smarty->assign("name",  GetDoctorFieldData($pdo, $param['id'], "name"));

    $html = $smarty->fetch(TplPrefix . 'dialog/deleteDoctor.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "delete_doctor_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function GetMainTableData($pdo, $smarty, $param) {

    Debug("Doctor GetMainTableData", GetDoctorList($pdo, $param));
    $smarty->assign("records", GetDoctorList($pdo, $param));
    $smarty->assign("status", $param['status']);
    $html = $smarty->fetch(TplPrefix . 'tables/doctor_data.tpl');

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