<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelAdmin.php');            // include Model functions
require_once('../lib/classModelManager.php');            // include Model functions

class ViewAdmin extends ViewItem {


    public function showMainTable($param) {

        $this->name = $param['name'];
        $tpl = "tables/" . $this->name . "_data.tpl";
        $this->html = $this->smarty->fetch(TplPrefix . $tpl);

        $this->result = array(
            "success" => 'true',
            "ind" => $param['ind'],
            "div" => "div_" . $this->name . "_main_table",
            "btn_edit" => $this->name . "-showEditDialog",
            "btn_delete" => $this->name . "-showDeleteDialog",
            "html" => $this->html,
        );

        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showList($param) {
        Debug("showList", $param);
        list($tmp, $table) = explode("_", $param['select_id']);
        $method = "get" . ucfirst($table) . "List";
        $model = new Model($this->ini);
        Debug("show list", "obj created, method:" . $method);
        $this->smarty->assign("records", $model->$method());
        Debug("show list", "tpl:" . 'list/' . $table . ".tpl");
        $this->html = $this->smarty->fetch(TplPrefix . 'list/' . $table . ".tpl");

        $this->result = array(
            "success" => 'true',
            "div" => "admin_" . $table . "_dialog",
            "span" => "admin_" . $table . "_list",
            "select_id" =>   $param['select_id'],
            "id"    =>  $param['id'],
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showAdminManagerDialog() {
        Debug("AdmManaDialog", "START");
        $model_admin = new ModelAdmin($this->ini);
        $this->smarty->assign("managers", $model_admin->getGroupMembers('103'));
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/adminManager.tpl');
        Debug("AdmManaDialog", "END");
        $this->result = array(
            "success" => 'true',
            "dialog_id" => "admin_manager_dialog",
            "buttons" => "dialog_dict_buttons",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showAdminCallDialog() {
        Debug("AdmCallDialog", "START");
        $model_admin = new ModelAdmin($this->ini);
        $this->smarty->assign("calls", $model_admin->getGroupMembers('105'));
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/adminCall.tpl');
        Debug("AdmCallDialog", "END");
        $this->result = array(
            "success" => 'true',
            "dialog_id" => "admin_call_dialog",
            "buttons" => "dialog_dict_buttons",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showAdminProjectDialog($param) {
        Debug("AdmProjectDialog", "START");
        $model_admin = new ModelAdmin($this->ini);
        $this->smarty->assign("projects", $model_admin->getGroupMembers('102'));
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/adminProject.tpl');
        Debug("AdmProjectDialog", "END");
        $this->result = array(
            "success" => 'true',
            "dialog_id" => "admin_project_dialog",
            "buttons" => "dialog_dict_buttons",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showAdminUserDialog($param) {

        $model_admin = new Model($this->ini);
        $this->smarty->assign("users", $model_admin->getUserList());
        $this->smarty->assign("groups", $model_admin->getGroupList());
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/adminUser.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "admin_user_dialog",
            "buttons" => "dialog_dict_buttons",
            "html" => $this->html,
        );
        return $this->result;
    }


    //-----------------------------------------------------------------------------------------

    public function showAdminClinicDialog($param) {
        $model = new Model($this->ini);
        $this->smarty->assign("clinics", $model->getClinicList());
        $this->smarty->assign("regions", $model->getRegionList());
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/adminClinic.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "admin_clinic_dialog",
            "buttons" => "dialog_dict_buttons",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showAdminSpecialDialog($param) {
        $model = new Model($this->ini);
        $this->smarty->assign("specials", $model->getSpecialList());
        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/adminSpecial.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "admin_special_dialog",
            "buttons" => "dialog_dict_buttons",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $model = new Model($this->ini);
        $manager = new ModelManager($this->ini);

        $this->smarty->assign("data", $manager->getManagerData($param['id']));
        $this->smarty->assign("regions", $model->getRegionList());
        $contact_list = $model->getContactList('manager_contact', $param['id']);
        $contact_list = $this->ExtendContacts($contact_list, 3);
        $this->smarty->assign("contact_list", $contact_list);
        $this->html = $this->smarty->fetch(TplPrefix . $param['tpl']);

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "admin_manager_dialog",
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

    //--------------------------------------------------------------------------------- --------

    public function showItemData($param) {

        list($tmp, $table) = explode("_", $param['select_id']);
        Debug("ItemData:", "get" . ucfirst($table) . "Data");
        $method = "get" . ucfirst($table) . "Data";
        $model = new ModelAdmin($this->ini);

        $this->result =  $model->$method($param['id']);
        $this->result["method"] = "set" . ucfirst($table) . "Data";
        return $this->result;
    }



}