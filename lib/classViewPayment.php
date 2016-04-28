<?php

require_once('../lib/classViewItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelPayment.php');            // include Payment functions
require_once('../lib/classModelDoctor.php');            // include Doctor functions
require_once('../lib/classModelPatient.php');            // include patient functions

class ViewPayment extends ViewItem {



    //-----------------------------------------------------------------------------------------

    public function showEditDialog($param) {

        $payment = new ModelPayment($this->ini);
        $doctor = new ModelDoctor($this->ini);

        $this->smarty->assign("data", $payment->getItemData($param['id']));
        $this->smarty->assign("doctors", $doctor->getList());

        $this->html = $this->smarty->fetch(TplPrefix . 'dialog/editPayment.tpl');

        $this->result = array(
            "success" => 'true',
            "dialog_id" => "add_payment_dialog",
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