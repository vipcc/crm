<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelManager.php');            // include Model functions

class ViewManager extends ViewItem {



    //-----------------------------------------------------------------------------------------

    public function showAddDialog($param) {
        $model = new Model($this->ini);

        $this->smarty->assign("users", $model->getUsersForManager());
        $this->smarty->assign("regions", $model->getRegionList());
        $contact_list = $this->ExtendContacts(array(), 3);
        $this->smarty->assign("contact_list", $contact_list);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editManager.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_manager_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $model = new Model($this->ini);
        $manager = new ModelManager($this->ini);

        $data = $manager->getManagerData($param['id']);
        $this->smarty->assign("data", $data);
        $this->smarty->assign("users", $model->getUserList(0,$data['user']));
        $this->smarty->assign("regions", $model->getRegionList());
        $contact_list = $model->getContactList('manager_contact', $param['id']);
        $contact_list = $this->ExtendContacts($contact_list, 3);
        $this->smarty->assign("contact_list", $contact_list);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editManager.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_manager_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showDeleteDialog($param) {

        $manager = new ModelManager($this->ini);
        $obj = $manager->getManagerData($param['id']);

        $this->smarty->assign("name", $obj['name']);
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/deleteManager.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "delete_manager_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }



}