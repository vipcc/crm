<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelManager extends ModelItem
{

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {

        $this->data = array();

        if(is_numeric($param['region'])) {
            if($param['region'] > 0) {
                $region_sql = " and manager.region = :region";
                $this->data['region'] = $param['region'];
            } else {
                $region_sql = "";
            }
        }

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt']));
        if ($date) {
            $dt_sql = " and w.dt = :dt";
            $this->data['dt'] = DateConvert($param['dt'], 'db');
        } else {
            $dt_sql = "";
        }

        $this->sql = "select manager.id, u.name, r.name as region, count(distinct d.id) as doctor, w.plan, w.visits, st.color from `manager`"
            . "  left join users as u on u.id = manager.user"
            . "  left join region as r on r.id = manager.region"
            . "  left join doctor as d on d.manager = manager.id"
            . "  left join manager_work as w on w.manager = manager.id " . $dt_sql
            . "  left join status as st on st.table='manager' and st.status=w.done"
            . "  where manager.state = 1 " . $region_sql
            . "  group by u.name"
            . "  order by u.name";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);
        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------
    public function getList()
    {

        $this->sql = 'select manager.id, u.name from `manager`'
            . ' left join users as u on u.id = manager.user'
            . ' where manager.state = 1'
            . ' order by u.name';

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute();
        $this->records = $stmt->fetchAll();

        return $this->records;

    }


//
    public function getManagerData($id)
    {
        $this->sql = "select * from manager where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "user" => $row['user'],
                "region" => $row['region'],
                "email" => $row['email'],
                "plan" => $row['plan']
            );
        }

        return $obj;
    }

//------------------------------------------------------------------------------------------------------------
    public function addItem($param)
    {
        $this->id = 0;

        $phones = $param['phones'];

        $this->data = array('user' => $param['user'],
            'region' => $param['region'],
            'email' => $param['email'],
            'plan' => $param['plan']
        );
        $this->sql = "INSERT INTO manager (user, region, email, plan) VALUES (:user, :region, :email, :plan)";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();

            $model = new Model($this->ini);

            $model->AddPhones("manager", $this->id, $phones);

            $this->pdo->commit();

            $this->msg = "Менеджер успешно дабвлен";

        } catch (PDOException $e) {
            $this->pdo->rollBack();

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $this->id,
            "msg" => $this->msg
        );
        return $_RESULT;
    }

    public function saveItem($param)
    {
        $id = 0;

        $phones =  $param['phones'];

        $this->data = array(
            'id' => $param['id'],
            'region' => $param['region'],
            'email' => $param['email'],
            'plan' => $param['plan']
        );
        $this->sql = "update manager set region = :region, email = :email, plan = :plan where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $model = new Model($this->ini);
            $model->UpdatePhones("manager", $param['id'], $phones);

            $this->pdo->commit();

            $this->msg = "Менеджер успешно сохранен";

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
        $this->sql = "update manager set state=0 where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $this->msg = "Менеджер удален";

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

//------------------------------------------------------------------------------------------
}

