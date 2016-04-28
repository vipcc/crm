<?php


class ViewPage {
    protected $smarty;
    protected $html;
    protected $result;
    protected $ini;
    protected $name;
    protected $id;



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
     * Show Page - set session variable @page
     *
     * @param {@page_id, @page_name}
     */
    function ChangePage($param) {

        if(session_id() == "")
        {
            session_start();
        }

        $_SESSION['_PAGE_ID'] = $param['page_id'];
        $_SESSION['_PAGE_NAME'] = $param['page_name'];

        $_RESULT = array(
            "success" => 'true'
        );
        return $_RESULT;

    }




    //---------------------------------------------------------------------



    public function ExtendContacts($contact_list, $count) {
        $num = $count - count($contact_list);

        for ($i = 0; $i < $num; $i++)
            array_push($contact_list, array("tp" => 1, "name" => ''));

        return $contact_list;
    }


}