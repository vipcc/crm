<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelReminder.php');            // include ModelReminder functions


class ViewReminder extends ViewItem {



    //-----------------------------------------------------------------------------------------

    public function showAddDialog($param) {

        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editReminder.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_reminder_dialog",
            "html" => $this->html,
        );
        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $reminder = new ModelReminder($this->ini);

        $this->smarty->assign("data", $reminder->getItemData($param['id']));

        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editReminder.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_reminder_dialog",
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

}