<?php

//require_once('../config/config.php');            // initialise settings



class ViewItem {
    protected $smarty;
    protected $html;
    protected $result;
    protected $ini;
    protected $name;
    protected $total;
    protected $id;
    public $buttons;


    public function __construct($ini) {
        $this->ini = $ini;
        //  Smarty initialise
        require_once '../lib/smarty/libs/Smarty.class.php';
        $this->smarty = new Smarty();

        $this->smarty->setTemplateDir(TplPrefix);
        $this->smarty->setCompileDir('../tmp/smarty/templates_c');
        $this->smarty->setCacheDir('../tmp/smarty/cache');
        $this->smarty->setConfigDir('../lib/smarty/configs');
        $this->smarty->assign("TplPrefix",TplPrefix);

        $this->html = "";
    }


    /**
     * Show Main table
     *
     * @name string
     */
    public function showMainTable($param) {

        $this->name = $param['name'];
        $obj_name = "Model" . ucfirst($this->name);

        require_once('../lib/class' . $obj_name . ".php");
        $model = new $obj_name($this->ini);              // new ModelManager
        $tpl = "tables/" . $this->name . "_data.tpl";

        $records = $model->getMainList($param);
        $this->total = count($records);
        $this->smarty->assign("records", $records);

    //    $this->buttons = $this->enableButtons();
    //    $this->smarty->assign("buttons", $buttons);

        $this->html = $this->smarty->fetch(TplPrefix . $tpl);

        $this->result = array(
            "success" => 'true',
            "ind" => $param['ind'],
            "div" => "div_" . $this->name . "_main_table",
            "btn_add" => $this->name . "-showAddDialog",
            "btn_edit" => $this->name . "-showEditDialog",
            "btn_read" => $this->name . "-showReadDialog",
            "btn_delete" => $this->name . "-showDeleteDialog",
            "span_total" =>  $this->name . "-total",
            "total" =>  $this->total,
            "html" => $this->html
        );

        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function btnStatus($param) {

        $model = new Model($this->ini);
        $acl = $model->getACL($_SESSION['_GID'], $param);

        $this->result = array(
            "success" => 'true',
            "btn_add" => $acl['btn_add'],
            "btn_save" => $acl['btn_save'],
            "btn_del" => $acl['btn_del'],
            "confirm" => $acl['confirm'],
            "deconfirm" => $acl['deconfirm'],
            "id"    => $param['id']
        );

        return $this->result;
    }

    //-----------------------------------------------------------------------------------------

    public function editStatus($param) {

        $model = new Model($this->ini);
        $acl = $model->getEditACL($_SESSION['_GID'], $param);

        return $this->result;
    }

    //---------------------------------------------------------------------

    public function ExtendContacts($contact_list, $count) {

        $num = $count - count($contact_list);
        for ($i = 0; $i < $num; $i++)
            array_push($contact_list, array("tp" => 1, "name" => ''));

        return $contact_list;
    }


}