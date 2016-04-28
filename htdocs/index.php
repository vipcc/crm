<?php

if(session_id() == "")
{
    session_start();
}

include_once '../config/startup.php';            // initialise settings

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelDoctor.php');            // include ModelDoctor functions
require_once('../lib/classModelManager.php');            // include ModelManager functions




$smarty->assign("appTitle","CRM");

if(isset($_SESSION['_GID']))
{
    $pages = getPages($pdo);        // $pages[1] - main page,  $pages[0] - page list, $page[2] - page id
 //   Debug("index pages:", $pages);
    $smarty->assign("menu", $pages['records']);

    // if page_id isn't set (not switch page), then use from DB
    if($_SESSION['_PAGE_ID'] == 0) {
        $_SESSION['_PAGE_ID'] = $pages['page_id'];
        $_SESSION['_PAGE_NAME'] = $pages['main'];
    }

    $smarty->assign("selected", $_SESSION['_PAGE_ID']);
    $tabs = getTabs($pdo, $_SESSION['_PAGE_ID']);
    $smarty->assign("tabs", $tabs);
  //  Debug("index tabs:", $tabs);

    # determine what function use , what library include
 //   include_once '../lib/Model/' . $_SESSION['_PAGE_NAME'] . '.php';
 //   include_once '../lib/View/' . $_SESSION['_PAGE_NAME'] . '.php';


    $smarty->assign("gid", $_SESSION['_GID']);
    $model = new Model($ini);
    $manager_id = $model->getFieldId("manager", "user", $_SESSION['_UID']);
    $smarty->assign("manager_id", $manager_id);

    $smarty->assign("regions", $model->getRegionList());


    $manager = new ModelManager($ini);
    $smarty->assign("managers", $manager->getList());

    $doctor = new ModelDoctor($ini);
        $smarty->assign("doctors", $doctor->getManagerList($manager_id));

    $smarty->assign("specials", $model->getSpecialList());
    $smarty->assign("clinics", $model->getClinicList());



 //   $func = "Get" . ucfirst($_SESSION['_PAGE_NAME']) . "List";
 //   $smarty->assign("records", $func($pdo, array("status" => 0)));

    $smarty->assign("today", date('d.m.Y'));
    $smarty->assign("page", "tabs/" . $_SESSION['_PAGE_NAME'] . ".tpl");
    $html = $smarty->fetch(TplPrefix . 'main.tpl');
}
else
{
    $html = $smarty->fetch(TplPrefix . 'login.tpl');
}

echo $html;