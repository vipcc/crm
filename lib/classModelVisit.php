<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModelManager.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelVisit extends ModelItem {

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {
        $this->data = array( 'dt' => DateConvert($param['dt'], 'db'), "manager" => $param['manager'] );
        $this->sql = "select visit.id, DATE_FORMAT(visit.dt,'%d.%m.%Y') as dt, d.name as doctor, p.name as phone, s.name as special, c.name as clinic, d.email, st.color from `visit`"
            . " left join doctor as d on d.id = visit.doctor"
            . " left join doctor_contact as contact on contact.pid = d.id"
            . " left join phone as p on p.id = contact.contact_id"
            . " left join special as s on s.id = d.special"
            . " left join clinic as c on c.id = visit.clinic"
            . " left join manager_work as w on w.manager=visit.manager"
            . " left join status as st on st.table='manager' and st.status=w.done"
            . " where visit.state = 1 and visit.dt = :dt and visit.manager = :manager"
            . " group by visit.id order by visit.dt";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------

    public function getVisitData($id)
    {
        $this->sql = "select id, manager, doctor, DATE_FORMAT(dt,'%d.%m.%Y') as dt, clinic, expens, comment, DATE_FORMAT(dt_plan,'%d.%m.%Y') as dt_plan, status from visit where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "manager" => $row['manager'],
                "doctor" => $row['doctor'],
                "dt" => $row['dt'],
                "clinic" => $row['clinic'],
                "expens" => $row['expens'],
                "comment" => $row['comment'],
                "dt_plan" => $row['dt_plan'],
                "status" => $row['status']
            );
        }

        return $obj;
    }
//---------------------------------------------------------------------------------------------------------------

    public function addItem($param) {

        $this->id = 0;

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt']));
        if ($date)
            $dt = DateConvert($param['dt'], 'db');
        else
            $dt = DateConvert(date("d.m.Y"), 'db');

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_plan']));
        if ($date)
            $dt_plan = DateConvert($param['dt_plan'], 'db');
        else
            $dt_plan = NULL;

        $expens = (is_numeric(trim($param['expens']))) ? $param['expens'] : 0;

        $this->data = array( 'manager' => $param['manager'],
            'dt' => $dt,
            'doctor' => $param['doctor'],
            'clinic' => $param['clinic'],
            'expens' => $expens,
            'comment' => $param['comment'],
            'dt_plan' => $dt_plan
        );

        $this->sql = "INSERT INTO visit (manager, dt, doctor, clinic, expens, comment, dt_plan) VALUES (:manager, :dt, :doctor, :clinic, :expens, :comment, :dt_plan)";
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();
            $this->pdo->commit();

            $this->setVisitCount($dt, $param['manager']);
            $success = 1;

            $this->msg = "Визит успешно дабвлен";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $this->id,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

//---------------------------------------------------------------------------------------------------------------
    public function saveItem($param)
    {

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt']));
        if ($date)
            $dt = DateConvert($param['dt'], 'db');
        else
            $dt = DateConvert(date("d.m.Y"), 'db');

        $date = DateTime::createFromFormat('d.m.Y', trim($param['dt_plan']));
        if ($date)
            $dt_plan = DateConvert($param['dt_plan'], 'db');
        else
            $dt_plan = NULL;

        $expens = (is_numeric(trim($param['expens']))) ? $param['expens'] : 0;

        $this->data = array( 'manager' => $param['manager'],
            'id' => $param['id'],
            'dt' => $dt,
            'doctor' => $param['doctor'],
            'clinic' => $param['clinic'],
            'expens' => $expens,
            'comment' => $param['comment'],
            'dt_plan' => $dt_plan
        );


        $this->sql = "update visit set dt =:dt, manager = :manager, doctor = :doctor, clinic = :clinic, "
                . " expens = :expens, comment = :comment, dt_plan = :dt_plan where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $success = 1;

            $this->msg = "Менеджер успешно сохранен";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

//---------------------------------------------------------------------------------------------------------------
    public function deleteItem($param)
    {

        $this->data = array('id' => $param['id']);

        $this->sql = "delete from visit where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();

            $visit_data = $this->getVisitData($param['id']);

            $stmt->execute($this->data);
            $this->pdo->commit();



            $this->setVisitCount(DateConvert($visit_data['dt'], 'db'), $visit_data['manager']);

            $this->id = 0;

            $this->msg = "Визит удален";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $this->id = 1;

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $this->id,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }


//---------------------------------------------------------------------------------------------------------------
    public function confirm($param)
    {

        $this->data = array( 'manager' => $param['manager'], 'dt' => DateConvert($param['dt'], 'db') );


        $this->sql = "update visit set status = 1 where manager = :manager and dt = :dt ";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $success = 1;

            $this->msg = "Визит утвержден";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }


//---------------------------------------------------------------------------------------------------------------
    public function deconfirm($param)
    {

        $this->data = array( 'manager' => $param['manager'], 'dt' => DateConvert($param['dt'], 'db') );


        $this->sql = "update visit set status = 0 where manager = :manager and dt = :dt ";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $success = 1;

            $this->msg = "Визит утвержден";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

//---------------------------------------------------------------------------------------------------------------


    private function setVisitCount($dt, $manager) {

        $obj = new ModelManager($this->ini);
        $manager_data = $obj->getManagerData($manager);
        $plan = $manager_data['plan'];
        $count = $this->getVisitCount($dt, $manager);
        if($plan > $count)
            $done = 0;
        else
            $done = 1;

        $this->data = array( 'manager' => $manager,
            'dt' => $dt
        );

        $this->sql = "delete from manager_work where manager = :manager and dt = :dt";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);


        $this->data['plan'] = $plan;
        $this->data['visits'] = $count;
        $this->data['done'] = $done;

        $this->sql = "INSERT INTO manager_work (manager, dt, plan, visits, done) VALUES (:manager, :dt, :plan, :visits, :done )";
        $stmt = $this->pdo->prepare($this->sql);

        try {

            $stmt->execute($this->data);

            $success = 1;

            $this->msg = "Визит успешно дабвлен";

        } catch (PDOException $e) {

            $success = 0;

            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

//---------------------------------------------------------------------------------------------------------------

    public function getVisitCount($dt, $manager)
    {

        $this->data = array( 'manager' => $manager, 'dt' => $dt );
        $this->sql = "select count(id) as count from visit where dt = :dt and manager = :manager";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $obj = $stmt->fetchObject();

        return $obj->count;

    }




}