<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelDoctor.php');            // include ModelDoctor functions
require_once('../lib/classModelManager.php');            // include ModelManager functions

class ViewDoctor extends ViewItem {


    //-----------------------------------------------------------------------------------------

    public function showToolbarData($param) {

        Debug('doctor toolbar param ',  $param);
        $this->smarty->assign("gid", $_SESSION['_GID']);
        $model = new Model($this->ini);
        $manager_id = $model->getFieldId("manager", "user", $_SESSION['_UID']);
        $this->smarty->assign("manager_id", $manager_id);

        $manager = new ModelManager($this->ini);
        $this->smarty->assign("managers", $manager->getList());

        $this->html = $this->smarty->fetch(TplPrefix . 'toolbar/doctor_data.tpl');

        $this->result = array(
            "success" => 'true',
            "div"   => 'doctor_filtr_data',
            "ind" => $param['ind'],
            "html" => $this->html
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showAddDialog($param) {

        $model = new Model($this->ini);
        $manager = new ModelManager($this->ini);

        $this->smarty->assign("specials", $model->getSpecialList());
        $this->smarty->assign("clinics", $model->getClinicList());
        $contact_list = $this->ExtendContacts(array(), 3);
        $this->smarty->assign("contact_list", $contact_list);
        $this->smarty->assign("managers", $manager->getList());
        $manager_id = $model->getFieldId("manager", "user", $_SESSION['_UID']);
        $this->smarty->assign("data", array("status" => $param['status'], "manager" => $manager_id));
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editDoctor.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_doctor_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $model = new Model($this->ini);
        $doctor = new ModelDoctor($this->ini);
        $manager = new ModelManager($this->ini);

        $this->smarty->assign("data", $doctor->getItemData($param['id']));

        Debug('doctor edit dialog param ',  $param);
        $this->smarty->assign("specials", $model->getSpecialList());
        $this->smarty->assign("clinics", $model->getClinicList());
        $this->smarty->assign("managers", $manager->getList());

      //  $this->smarty->assign("manager", $manager->getList());

        $contact_list = $model->getContactList('doctor_contact', $param['id']);
        $contact_list = $this->ExtendContacts($contact_list, 3);
        $this->smarty->assign("contact_list", $contact_list);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editDoctor.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_doctor_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showDeleteDialog($param) {

        $doctor = new ModelDoctor($this->ini);
        $obj = $doctor->getItemData($param['id']);

        $this->smarty->assign("name", $obj['name']);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/deleteDoctor.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "delete_doctor_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }



}