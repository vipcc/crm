<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelDoctor.php');            // include ModelManager functions
require_once('../lib/classModelPatient.php');            // include ModelPatient functions

class ViewPatient extends ViewItem {


    //-----------------------------------------------------------------------------------------

    //-----------------------------------------------------------------------------------------

    public function showToolbarData($param) {

        $this->smarty->assign("gid", $_SESSION['_GID']);

        $doctor = new ModelDoctor($this->ini);
        $this->smarty->assign("doctors", $doctor->getList());

        $this->html = $this->smarty->fetch(TplPrefix . 'toolbar/patient_data.tpl');

        $this->result = array(
            "success" => 'true',
            "div"   => 'patient_filtr_data',
            "html" => $this->html
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showAddDialog($param) {

        $doctor = new ModelDoctor($this->ini);

        $this->smarty->assign("doctors", $doctor->getList());
        Debug('DOCTORS list', $doctor->getList());
        $this->smarty->assign("data", array("status" => $param['status']));
        $this->smarty->assign("mo_id_read", 1);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editPatient.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_patient_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $doctor = new ModelDoctor($this->ini);
        $patient = new ModelPatient($this->ini);

        $this->smarty->assign("data", $patient->getItemData($param['id']));
        Debug('patient edit dialog param ',  $param);
        $this->smarty->assign("doctors", $doctor->getList());
        if($_SESSION['_GID'] == 102 || $_SESSION['_GID'] == 105)
            $this->smarty->assign("mo_id_read", 0);
        else
            $this->smarty->assign("mo_id_read", 1);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editPatient.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_patient_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showDeleteDialog($param) {

        $patient = new ModelPatient($this->ini);
        $obj = $patient->getItemData($param['id']);

        $this->smarty->assign("name", $obj['name']);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/deletePatient.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "delete_patient_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }


}