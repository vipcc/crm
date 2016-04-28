<?php

include_once '../lib/Model/manager.php';

//-----------------------------------------------------------------------------------------
function ShowAddDialog($pdo, $smarty, $param) {

    $smarty->assign("managers", getManagerList($pdo));
   // $smarty->assign("doctors", getDoctorList($pdo));
  //  $smarty->assign("clinics", getClinicList($pdo));

    $html = $smarty->fetch(TplPrefix . 'dialog/editVisit.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_visit_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function ShowEditDialog($pdo, $smarty, $param) {


    $smarty->assign("data", GetManagerData($pdo, $param['id']));
    $smarty->assign("regions", getRegionList($pdo));
    $contact_list = getContactList($pdo, 'manager_contact', $param['id']);
    $contact_list = ExtendContacts($contact_list, 3);
    $smarty->assign("contact_list", $contact_list);

    $html = $smarty->fetch(TplPrefix . 'dialog/editVisit.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_visit_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function ShowDeleteDialog($pdo, $smarty, $param) {

    $smarty->assign("name",  GetManagerFieldData($pdo, $param['id'], "name"));

    $html = $smarty->fetch(TplPrefix . 'dialog/deleteVisit.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "delete_visit_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function GetMainTableData($pdo, $smarty, $param) {

    Debug("in GetMainTableData", "start");
    $smarty->assign("manager_list", GetManagerList($pdo));
    $html = $smarty->fetch(TplPrefix . 'tables/visit_data.tpl');

    $_RESULT = array(
        "success" => 'true',
        "html"  => $html,
    );
    return $_RESULT;
}

//----------------------------------------------------------------------------------------
