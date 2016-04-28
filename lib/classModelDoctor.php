<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelDoctor extends ModelItem {
    protected $ini;
    protected $pdo;
    protected $sql;
    protected $data;
    protected $status;
    protected $result;


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
//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param) {

        $this->data = array( "status" => $param['ind'] );

        if(is_numeric($param['manager'])) {
            if($param['manager'] > 0) {
                $doctor_sql = " and doctor.manager = :manager";
                $this->data['manager'] = $param['manager'];
            } else {
                $doctor_sql = "";
            }

        }

        $this->sql = ' select distinct doctor.id, doctor.name, s.name as special, p.name as phone, c.name as clinic, doctor.email '
            . ' from doctor '
            . ' left join special as s on s.id=doctor.special '
            . ' left join clinic as c on c.id=doctor.clinic '
            . ' left join doctor_contact as contact on contact.pid=doctor.id '
            . ' left join phone as p on p.id=contact.contact_id '
            . ' where doctor.state=1 ' . $doctor_sql . ' and doctor.status = :status'
            . ' group by doctor.name ';

        $stmt = $this->pdo->prepare($this->sql);
    //    $stmt->bindParam(':status', $param['ind'], PDO::PARAM_INT);
        $stmt->execute($this->data);
        $this->records = $stmt->fetchAll();

        return $this->records;

    }
//---------------------------------------------------------------------------------------------------------------
    public function getList($ind = 0) {

        if($ind > 0) {
            $this->sql = 'select distinct doctor.id, doctor.name, s.name as special, c.name as clinic, p.name as phone, doctor.email'
                . ' from doctor'
                . ' left join special as s on s.id=doctor.special'
                . ' left join clinic as c on c.id=doctor.clinic'
                . ' left join doctor_contact as lnk on lnk.pid=doctor.id'
                . ' left join phone as p on p.id=lnk.contact_id'
                . ' where doctor.state=1 and doctor.status = :status'
                . ' group by doctor.name ';
        } else {
            $this->sql = 'select distinct doctor.id, doctor.name, s.name as special, c.name as clinic, p.name as phone, doctor.email'
                . ' from doctor'
                . ' left join special as s on s.id=doctor.special'
                . ' left join clinic as c on c.id=doctor.clinic'
                . ' left join doctor_contact as lnk on lnk.pid=doctor.id'
                . ' left join phone as p on p.id=lnk.contact_id'
                . ' where doctor.state=1 '
                . ' group by doctor.name ';
        }
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':status', $ind, PDO::PARAM_INT);
        $stmt->execute();
        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------
    public function getManagerList($manager) {

            $this->sql = 'select distinct doctor.id, doctor.name, s.name as special, c.name as clinic, p.name as phone, doctor.email'
                . ' from doctor'
                . ' left join special as s on s.id=doctor.special'
                . ' left join clinic as c on c.id=doctor.clinic'
                . ' left join doctor_contact as lnk on lnk.pid=doctor.id'
                . ' left join phone as p on p.id=lnk.contact_id'
                . ' where doctor.state=1 and doctor.manager = :manager'
                . ' group by doctor.name ';

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':manager', $manager, PDO::PARAM_INT);
        $stmt->execute();
        $this->records = $stmt->fetchAll();

        return $this->records;

    }

    //---------------------------------------------------------------------------------------------------------------

    public function getItemData($id)
    {
        $this->sql = "select doctor.id, doctor.name, doctor.manager, c.name as clinic, s.name as special, doctor.card,"
                    . " doctor.email, doctor.status, doctor.comment from doctor "
                    . " left join clinic as c on c.id = doctor.clinic"
                    . " left join special as s on s.id = doctor.special"
                    . " where doctor.id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "manager" => $row['manager'],
                "clinic" => $row['clinic'],
                "special" => $row['special'],
                "card" => $row['card'],
                "email" => $row['email'],
                "status" => $row['status'],
                "comment" => $row['comment']
            );
        }

        return $obj;
    }

//------------------------------------------------------------------------------------------------------------
    public function addItem($param) {
        $this->id = 0;
        $model = new Model($this->ini);

        $phones =  $param['phones'];

        $special = $model->checkDictSpecial(trim($param['special']));
        $clinic = $model->checkDictClinic(trim($param['clinic']));

        $this->data = array( 'name' => $param['name'],
            'special' => $special,
            'clinic' => $clinic,
            'manager' => $param['manager'],
            'status' => $param['status'],
            'email' => $param['email'],
            'card' => $param['card'],
            'comment' => $param['comment']
        );
        $this->sql = "INSERT INTO doctor (name, special, clinic, manager, email, card, status, comment) VALUES (:name, :special, :clinic, :manager, :email, :card, :status, :comment)";
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();

            $model->AddPhones("doctor", $this->id, $phones);

            $this->pdo->commit();

            $this->msg = "Врач успешно дабвлен";

        } catch (PDOException $e) {
            $this->pdo->rollBack();

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $this->id,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

    public function saveItem($param)
    {
        $id = 0;
        $model = new Model($this->ini);

        $phones =  $param['phones'];

        $special = $model->checkDictSpecial(trim($param['special']));
        $clinic = $model->checkDictClinic(trim($param['clinic']));


        $this->data = array('id' => $param['id'],
            'name' => $param['name'],
            'special' => $special,
            'status' => $param['status'],
            'clinic' => $clinic,
            'email' => $param['email'],
            'card' => $param['card'],
            'comment' => $param['comment']
        );

        $this->sql = "update doctor set name = :name, special = :special, clinic = :clinic,  email = :email, "
                    . " card = :card, status = :status, comment = :comment where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $model->UpdatePhones("doctor", $param['id'], $phones);

            $this->pdo->commit();

            $this->msg = "Врач успешно сохранен";

        } catch (PDOException $e) {
            $this->pdo->rollBack();

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

//------------------------------------------------------------------------------------------
    public function deleteItem($param)
    {

        $this->data = array( 'id' => $param['id'] );
        $this->sql = "update doctor set state=0 where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $this->msg = "Врач удален";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => 0,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }



}