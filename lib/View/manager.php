<?php

include_once '../lib/Model/manager.php';

//-----------------------------------------------------------------------------------------
function ShowAddDialog($pdo, $smarty, $param) {

    $smarty->assign("regions", getRegionList($pdo));
    $contact_list = ExtendContacts(array(), 3);
    $smarty->assign("contact_list", $contact_list);
    $html = $smarty->fetch(TplPrefix . 'dialog/editManager.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_manager_dialog",
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

    $html = $smarty->fetch(TplPrefix . 'dialog/editManager.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_manager_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function ShowDeleteDialog($pdo, $smarty, $param) {

    $smarty->assign("name",  GetManagerFieldData($pdo, $param['id'], "name"));

    $html = $smarty->fetch(TplPrefix . 'dialog/deleteManager.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "delete_manager_dialog",
        "html"  => $html,
    );
    return $_RESULT;
}

//-----------------------------------------------------------------------------------------
function GetMainTableData($pdo, $smarty, $param) {

    Debug("in GetMainTableData", "start");
    $smarty->assign("manager_list", GetManagerList($pdo));
    $html = $smarty->fetch(TplPrefix . 'tables/manager_data.tpl');

    $_RESULT = array(
        "success" => 'true',
        "dialog_id"  => "add_manager_dialog",
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