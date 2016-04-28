<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelVisit.php');            // include ModelVisit functions
require_once('../lib/classModelManager.php');            // include ModelManager functions
require_once('../lib/classModelDoctor.php');            // include ModelDoctor functions

class ViewVisit extends ViewItem {

    //-----------------------------------------------------------------------------------------

    public function showToolbarData($param) {

        $this->smarty->assign("gid", $_SESSION['_GID']);
        $model = new Model($this->ini);
        $manager_id = $model->getFieldId("manager", "user", $_SESSION['_UID']);
        $this->smarty->assign("manager_id", $manager_id);

        $manager = new ModelManager($this->ini);
        $this->smarty->assign("managers", $manager->getList());

        $this->html = $this->smarty->fetch(TplPrefix . 'toolbar/visit_data.tpl');

        $this->result = array(
            "success" => 'true',
            "div"   => 'visit_filtr_data',
            "html" => $this->html
        );
        return $this->result;
    }


    //-----------------------------------------------------------------------------------------

    public function showAddDialog($param) {
        $model = new Model($this->ini);
        $manager = new ModelManager($this->ini);
        $doctor = new ModelDoctor($this->ini);
Debug("shoa add dialog Visit", "first");
        $this->smarty->assign("clinics", $model->getClinicList());
        $this->smarty->assign("managers", $manager->getList());
        Debug("shoa add dialog Visit", "second");
        $this->smarty->assign("doctors", $doctor->getList(0));
        Debug("shoa add dialog Visit", "third");

        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editVisit.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_visit_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $model = new Model($this->ini);
        $visit = new ModelVisit($this->ini);
        $manager = new ModelManager($this->ini);
        $doctor = new ModelDoctor($this->ini);

        $this->smarty->assign("data", $visit->getVisitData($param['id']));
        Debug("shoa add dialog Visit", "first");
        $this->smarty->assign("clinics", $model->getClinicList());
        $this->smarty->assign("managers", $manager->getList());
        Debug("shoa add dialog Visit", "second");
        $this->smarty->assign("doctors", $doctor->getList(0));
        Debug("shoa add dialog Visit", "third");
        if($_SESSION['_UID'] == 102)
            $finish_btn = 1;
        else
            $finish_btn = 0;

        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editVisit.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_visit_dialog",
            "finish_btn"    => $finish_btn,
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showDeleteDialog($param) {

        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/deleteVisit.tpl');


        $this->result = array(
            "success" => 'true',
            "dialog_id" => "delete_visit_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function btnStatus($param) {

        $model = new Model($this->ini);
        $acl = $model->getACL($_SESSION['_GID'], $param);

        $visit = new ModelVisit($this->ini);
        $data = $visit->getVisitData($param['id']);
        if($data['status'] == 0) {

            Debug("btnStatus:", $acl);
            $this->result = array(
                "success" => 'true',
                "btn_add" => $acl['btn_add'],
                "btn_save" => $acl['btn_save'],
                "btn_del" => $acl['btn_del'],
                "confirm" => $acl['confirm'],
                "deconfirm" => 0,
                "id"    =>  $param['id']
            );

        } else {
            $deconfirm = ($acl['confirm'] == 1) ? 1 : 0;
            $this->result = array(
                "success" => 'true',
                "btn_add" => 1,
                "btn_save" => 0,
                "btn_del" => 0,
                "confirm" => 0,
                "deconfirm" => $deconfirm,
                "id"    =>  $param['id']
            );
        }
        return $this->result;
    }


}