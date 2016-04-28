<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelCall.php');            // include ModelCall functions
require_once('../lib/classModelDoctor.php');            // include ModelDoctor functions



class ViewCall extends ViewItem {

    public function enableButtons () {
        $this->buttons['add'] = 0;
        $this->buttons['save'] = 1;
        $this->buttons['delete'] = 0;
        $this->buttons['done'] = 0;

        return $this->buttons;
    }

    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $call = new ModelCall($this->ini);
        $doctor = new ModelDoctor($this->ini);

        $this->smarty->assign("data", $call->getItemData($param['id']));

        $this->smarty->assign("doctors", $doctor->getList());

        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editCall.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_call_dialog",
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