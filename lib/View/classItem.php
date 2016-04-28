<?php

//require_once('../config/config.php');            // initialise settings


class ViewItem {
    protected $smarty;
    protected $html;
    protected $result;


    public function __construct($pdo, $smarty) {
        //      $this->pdo = $pdo;
        $this->smarty = $smarty;
        $this->html = "";
        //  $DbItem = new DbItem();
    }

    public function showAddDialog($dialog_id, $tpl) {
        //   $this->smarty->assign("specials", GetSpecialList($pdo));
        //   $smarty->assign("clinics", GetClinicList($pdo));
        //   $contact_list = ExtendContacts(array(), 3);
        $this->smarty->assign("contact_list", $contact_list);
        //   $this->smarty->assign("data", array("status" => $param['status']));

        $this->html = $this->smarty->fetch(TplPrefix . $tpl);

        $this->result = array(
            "success" => 'true',
            "dialog_id" => $dialog_id,
            "html" => $this->html,
        );
        return $this->result;
    }
}