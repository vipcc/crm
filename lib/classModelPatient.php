<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelPatient extends ModelItem {
    protected $ini;
    protected $pdo;
    protected $sql;
    protected $data;
    protected $status;
    protected $result;


    public function getMainList($param) {

        $this->data = array( "status" => $param['ind'] );

        if(is_numeric($param['doctor'])) {
            if($param['doctor'] > 0) {
                $doctor_sql = " and patient.doctor = :doctor";
                $this->data['doctor'] = $param['doctor'];
            } else {
                $doctor_sql = "";
            }
        }

        $this->sql = ' select distinct patient.id, patient.name, patient.dt_plan, d.name as doctor '
            . ' from patient '
            . ' left join doctor as d on d.id=patient.doctor '
            . ' where patient.state=1 ' . $doctor_sql . ' and patient.status = :status'
            . ' group by patient.name ';

        $stmt = $this->pdo->prepare($this->sql);
      //  $stmt->bindParam(':status', $param['ind'], PDO::PARAM_INT);
        $stmt->execute($this->data);
        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------
    public function getSearchList($keyword)
    {
        $rec = array();
        $this->sql = "select doctor, name as value from patient where name LIKE CONCAT('%', :keyword, '%')";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            array_push ($rec, $row);

        }

        return $rec;

    }


    //---------------------------------------------------------------------------------------------------------------

    public function getItemData($id)
    {
        $this->sql = "select id, name, doctor, DATE_FORMAT(dt_plan,'%d.%m.%Y') as dt_plan, diagnosis,"
                    . " DATE_FORMAT(dt_consultion,'%d.%m.%Y') as dt_consultion, mo_id, comment from patient where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "doctor" => $row['doctor'],
                "dt_plan" => $row['dt_plan'],
                "diagnosis" => $row['diagnosis'],
                "dt_consultion" => $row['dt_consultion'],
                "mo_id" => $row['mo_id'],
                "comment" => $row['comment']
            );
        }

        return $obj;
    }

    //---------------------------------------------------------------------------------------------
    public function checkPatient($name)
    {
        $this->data = array( 'name' => $name );
        $this->sql = "select * from patient where name = :name";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);


        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "doctor" => $row['doctor'],
                "dt_plan" => $row['dt_plan'],
                "diagnosis" => $row['diagnosis'],
                "dt_consultion" => $row['dt_consultion'],
                "mo_id" => $row['mo_id'],
                "comment" => $row['comment']
            );
        }

        if($row['id'] > 0 and $row['state'] == 0) {
            $this->sql = "update patient set state = 1 where id = :id";
            $stmt = $this->pdo->prepare($this->sql);
            $stmt->bindParam(':id', $obj->id, PDO::PARAM_INT);
            $stmt->execute();
            return 0;
        } else {
            return $obj;
        }

    }


//------------------------------------------------------------------------------------------------------------
    public function addItem($param) {
        $this->id = 0;

        $obj = $this->checkPatient(trim($param['name']));
        if( $obj != 0 ) {
            $_RESULT = array(
                "success" => 1,
                "id" => $obj->id,
                "msg"  => "Пациент " . $param['name'] . " уже есть в базе. Он направлен " .  $obj->dt
            );
            return $_RESULT;

        }

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_plan']));
        if ($date)
            $dt = DateConvert($param['dt_plan'], 'db');
        else
            $dt = DateConvert(date("d.m.Y"), 'db');

        $mo_id = (is_numeric($param['mo_id'])) ? $param['mo_id'] : 0;

        $this->data = array( 'name' => trim($param['name']),
            'doctor' => $param['doctor'],
            'dt_plan' => $dt,
            'diagnosis' => $param['diagnosis'],
            'comment' => $param['comment']
        );
        $this->sql = "INSERT INTO patient (name, doctor, dt_plan, diagnosis, comment) VALUES "
                    . " (:name, :doctor, :dt_plan, :diagnosis, :comment)";
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();

            $this->pdo->commit();

            $this->msg = "Пациент успешно дабвлен";

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

    //------------------------------------------------------------------------------------------------------------
    public function saveItem($param)
    {
        $id = 0;

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_plan']));
        if ($date)
            $dt = DateConvert($param['dt_plan'], 'db');
        else
            $dt = DateConvert(date("d.m.Y"), 'db');

        $mo_id = (is_numeric($param['mo_id'])) ? $param['mo_id'] : 0;


        $this->data = array('id' => $param['id'],
            'name' => trim($param['name']),
            'doctor' => $param['doctor'],
            'dt_plan' => $dt,
            'mo_id' =>  $mo_id,
            'diagnosis' => $param['diagnosis'],
            'comment' => $param['comment']
        );

        $this->sql = "update patient set name = :name, doctor = :doctor, dt_plan = :dt_plan, mo_id = :mo_id, diagnosis = :diagnosis, "
            . " comment = :comment where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();

            $this->msg = "Пациент успешно сохранен";

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
        $this->sql = "update patient set state=0 where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $this->msg = "Пациент удален";

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

    public function setStatus($id, $status)
    {

        $this->data = array('id' => $id,
            'status' => $status
        );

        $this->sql = "update patient set status = :status where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();

            $this->msg = "Пациент успешно сохранен";

        } catch (PDOException $e) {
            $this->pdo->rollBack();

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $id,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }



}