<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelPayment extends ModelItem {

//---------------------------------------------------------------------------------------------------------------
    public function getMainList($param)
    {

        $this->sql = "select payment.id, d.name as doctor, DATE_FORMAT(payment.dt,'%d.%m.%Y') as dt, payment.sum, s.color from `payment`"
            . " left join patient as p on p.id = payment.patient"
            . " left join doctor as d on d.id = p.doctor"
            . " left join status as s on s.table = 'payment' and s.status=payment.status"
            . " where payment.status = 0"
            . " order by payment.dt";

        Debug("payment main list ", $this->sql);
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($data);

        $this->records = $stmt->fetchAll();

        return $this->records;

    }

//---------------------------------------------------------------------------------------------------------------

    public function getItemData($id)
    {
        $this->sql = "select  DATE_FORMAT(payment.dt,'%d.%m.%Y') as dt, payment.sum, d.name as doctor"
                     . " from payment "
                     . " left join patient as p on p.id=payment.patient"
                     . " left join doctor as d on d.id=p.doctor"
                     . " where payment.id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "doctor" => $row['doctor'],
                "dt" => $row['dt'],
                "sum" => $row['sum']
            );
        }


        return $obj;
    }
//---------------------------------------------------------------------------------------------------------------

    public function confirm($param)
    {

        $this->data = array( 'id' => $param['id'] );

        $this->sql = "update payment set status = 1 where id = :id";
Debug("update: " . $this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $success = 1;
            Debug("commit", "ok");
            $this->msg = "Напоминание завершено";

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

        $this->sql = "delete from payment where id = :id";
        Debug("delete: " . $this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            $this->id = 0;
            Debug("commit", "ok");
            $this->msg = "Напоминание о выплате удалено";

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