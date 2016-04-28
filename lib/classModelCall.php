<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions
require_once('../lib/classModelPatient.php');            // include ModelPatient functions


class ModelCall extends ModelItem {

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {

        $this->data = array( 'dt' => DateConvert($param['dt'], 'db'));
        $this->sql = "select calls.id, calls.pid, calls.name, calls.callerCID, calls.event, DATE_FORMAT(calls.call_date,'%H:%i:%s') as time, u.name as operator, s.color as color from `calls` "
                . " left join users as u on u.id = calls.operator"
                . " left join status as s on s.table = 'calls' and s.status=calls.status"
                . " where DATE_FORMAT(calls.call_date,'%Y-%m-%d') = :dt "
                . " order by pid";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------

    public function getItemData($id)
    {
        $this->sql = "select calls.id, calls.pid, calls.callerCID, calls.name, calls.doctor, calls.patient_name, calls.event, DATE_FORMAT(calls.call_date,'%H:%i:%s') as time, calls.comment from calls where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "manager" => $row['manager'],
                "patient" => $row['patient'],
                "doctor" => $row['doctor'],
                "patient_name" => $row['patient_name'],
                "time" => $row['time'],
                "callerCID" => $row['callerCID'],
                "comment" => $row['comment']

            );
        }

        return $obj;
    }
//---------------------------------------------------------------------------------------------------------------

    public function saveItem($param)
    {

        $this->data = array(
            'id' => $param['id'],
            'doctor' => $param['doctor'],
            'name' => $param['name'],
            'patient_name' => $param['patient_name'],
            "operator"  =>  $_SESSION['_UID'],
            'comment' => $param['comment']
        );


        $this->sql = "update calls set name = :name, patient_name = :patient_name, doctor = :doctor, operator = :operator,"
                . " comment = :comment, status = 1 where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->checkPatient($param);

            $this->pdo->commit();
            $success = 1;

            $this->msg = "777Информация о звонке успешно сохранена";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;

            $this->msg = "555Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }


    public function checkPatient($param)
    {

        $model = new Model($this->ini);
        $patient = new ModelPatient($this->ini);

        $patient_id = $model->getFieldId('patient', 'name', $param['patient_name']);

        if($patient_id > 0) {

            $patient->setStatus($patient_id, 1);
        } else {
                $param['name'] = $param['patient_name'];

                $result = $patient->addItem($param);
                $patient->setStatus($result['id'], 1);
        }

        return $patient_id;
    }





}