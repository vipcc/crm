<?php

require_once('../config/config.php');            // initialise settings


class ModelItem {
    protected $pdo;
    protected $ini;
    protected $sql;
    protected $data;
    protected $result;
    protected $id;
    protected $msg;


    public function __construct($ini) {
        $this->ini = $ini;

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

    public function checkRefresh($param)
    {
        $this->sql = "select id from refresh where name = :name and tm > DATE_SUB(NOW(), INTERVAL 2 SECOND)";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':name', $param['name'], PDO::PARAM_INT);
        $stmt->execute();

        $obj = $stmt->fetchObject();

        if($obj->id > 0)
            return 1;
        else
            return 0;

    }
//---------------------------------------------------------------------------------------------------------------

    public function getFieldId($table, $field, $value)
    {
        $this->data = array( 'value' => $value );

        $this->sql = "select id from $table where $field = :value";

        $stmt = $this->pdo->prepare($this->sql);

        $stmt->execute($this->data);
        $obj = $stmt->fetchObject();

        return $obj->id;
    }


}