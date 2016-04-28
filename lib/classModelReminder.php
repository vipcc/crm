<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelReminder extends ModelItem {

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {
        $this->data = array( 'dt' => DateConvert($param['dt'], 'db'), 'uid' => $_SESSION['_UID'] );
        $this->sql = "select id, DATE_FORMAT(dt,'%d.%m.%Y') as dt, name, phone, comment from `reminder_call`"
            . " where status = 0 and uid = :uid and dt = :dt"
            . " order by name";

        Debug("reminder " . $this->sql,$this->data);
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------

    public function getItemData($id)
    {
        $this->sql = "select id, DATE_FORMAT(dt,'%d.%m.%Y') as dt, name, phone, comment from `reminder_call` where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "dt" => $row['dt'],
                "phone" => $row['phone'],
                "comment" => $row['comment']
            );
        }

        Debug("reminder data", $obj);

        return $obj;
    }
//---------------------------------------------------------------------------------------------------------------

    public function addItem($param) {
        $this->id = 0;

        $this->data = array( 'name' => $param['name'],
            'dt' => DateConvert($param['dt'], 'db'),
            'phone' => $param['phone'],
            'uid' => $_SESSION['_UID'],
            'comment' => $param['comment']
        );
        $this->sql = "INSERT INTO reminder_call (uid, name, dt, phone, comment) VALUES (:uid, :name, :dt, :phone, :comment)";
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();;
            $this->pdo->commit();
            $success = 1;
            Debug("add item", "commit");
            $this->msg = "Напоминание успешно дабвлено";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;
            Debug("add item", "rollback");
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $this->id,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }


    public function saveItem($param)
    {

        $this->data = array( 'id' => $param['id'],
            'name' => $param['name'],
            'dt' => DateConvert($param['dt'], 'db'),
            'phone' => $param['phone'],
            'comment' => $param['comment']
        );


        $this->sql = "update `reminder_call` set dt =:dt, name = :name, phone = :phone, "
                . " comment = :comment where id = :id";
Debug("update: " . $this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $success = 1;
            Debug("commit", "ok");
            $this->msg = "Напоминание успешно сохранено";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;
            Debug("rollback", $e);
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

    public function confirm($param)
    {

        $this->data = array( 'id' => $param['id'] );


        $this->sql = "update `reminder_call` set status = 1 where id = :id";
        Debug("finish: " . $this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $success = 1;
            Debug("commit", "ok");
            $this->msg = "Напоминание успешно завершено";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $success = 0;
            Debug("rollback", $e);
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }


    public function deleteItem($param)
    {

        $this->data = array('id' => $param['id']);

        $this->sql = "delete from `reminder_call` where id = :id";
        Debug("delete: " . $this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $this->id = 0;
            Debug("commit", "ok");
            $this->msg = "Напоминание удалено";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            $this->id = 1;
            Debug("rollback", $e);
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => $success,
            "id" => $this->id,
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

}