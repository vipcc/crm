<?php

require_once('../config/config.php');            // initialise settings


class ModelPage {
    protected $pdo;
    protected $sql;
    protected $data;
    protected $result;


    public function __construct($ini) {
        // Database connection
        $host = $ini['mysql']['host'];
        $db = $ini['mysql']['db'];
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, $ini['mysql']['user'], $ini['mysql']['pass'], $opt);

        $this->sql = "";
        $this->data = array();
    }
//---------------------------------------------------------------------------------------------------------------
    public function getTabProfile($param) {

        $this->data = array( 'group_id' => $_SESSION['_GID'], 'page_id' => $param['page'], 'tab' => $param['tab'] );
        $this->sql = 'select * from tabs where gid = :group_id and page_id = :page_id and ind = :tab';

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        foreach ($stmt as $row) {
            list($name, $tab) = explode("_", $row['name']);          //  get iyem name
            $class_name = ucfirst($name);                            // get class name

            $obj = array( "success" => 'true',
                "name" => $row['name'],
                "title" => $row['title'],
                "div" => $row['div'],
                "ind" => $row['ind'],
                "tbl" => $row['tbl'],
                "toolbar" => $row['toolbar'],
                "class_name" => $class_name,
                "name"   => $name
            );
        }

        return $obj;

    }
}