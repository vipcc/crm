<?php

require_once('../lib/classModelItem.php');            // include parent class
require_once('../lib/classModel.php');            // include Model functions


class ModelAdmin extends ModelItem
{

//---------------------------------------------------------------------------------------------------------------


//---------------------------------------------------------------------------------------------------------------
/*
    public function getGroupList()
    {

        $this->sql = 'select id, name from `groups`'
            . ' order by name';

        $stmt = $this->pdo->prepare($this->sql);

        $stmt->execute();
        $this->records = $stmt->fetchAll();
        Debug("users (" . $this->sql .")" , $this->records);
        return $this->records;

    }*/

//---------------------------------------------------------------------------------------------------------------
    public function getGroupMembers($gid)
    {

        $this->sql = 'select id, name, login from `users`'
            . ' where state = 1 and gid = :gid'
            . ' order by name';

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':gid', $gid, PDO::PARAM_INT);

        $stmt->execute();
        $this->records = $stmt->fetchAll();
        Debug("group memembers (" . $this->sql . " gid:" . $gid, $this->records);
        return $this->records;

    }


    //---------------------------------------------------------------------------------------------------------------

    public function getUserData($id)
    {
        $this->sql = "select name, login, gid from users where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "name" => $row['name'],
                "login" => $row['login'],
                "gid" => $row['gid']
            );
        }

        return $obj;
    }

    //---------------------------------------------------------------------------------------------------------------

    public function getClinicData($id)
    {
        $this->sql = "select * from clinic where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "region" => $row['region']
            );
        }

        Debug("clinic data", $obj);

        return $obj;
    }
    //---------------------------------------------------------------------------------------------------------------

    public function getSpecialData($id)
    {
        $this->sql = "select * from special where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name']
            );
        }

        return $obj;
    }
//------------------------------------------------------------------------------------------------------------
    public function addUser($param)
    {
        $model = new Model($this->ini);
        $this->id = $model->checkUser(trim($param['name']), trim($param['login']));
        Debug("add user", $this->id);
        if( $this->id > 0 ) {
            $_RESULT = array(
                "success" => 1,
                "id"    => $this->id,
                "msg" => "Такая запись уже существует"
            );
            return $_RESULT;
        }


        $this->data = array( 'name' => trim($param['name']), 'login' => $param['login'], 'gid' => $param['gid'] );

        $this->sql = "INSERT INTO users (name, login, gid) VALUES (:name, :login, :gid)";
        $stmt = $this->pdo->prepare($this->sql);
        Debug("Admin add clinic",$this->sql);
        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();

            $this->pdo->commit();
            Debug("add item", "commit");
            $this->msg = "Запись успешно дабвлена";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            Debug("add item", "rollback");
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $this->id,
            "msg" => $this->msg
        );
        return $_RESULT;
    }
//------------------------------------------------------------------------------------------------------------
    public function addClinic($param)
    {
        $model = new Model($this->ini);
        $this->id = $model->checkClinic(trim($param['name']), $param['region']);

        if( $this->id > 0 ) {
            $_RESULT = array(
                "success" => 1,
                "id"    => $this->id,
                "msg" => "Такая запись уже существует"
            );
            return $_RESULT;
        }

        $this->data = array( 'name' => trim($param['name']), 'region' => $param['region'] );

        $this->sql = "INSERT INTO clinic (name, region) VALUES (:name, :region)";
        $stmt = $this->pdo->prepare($this->sql);
        Debug("Admin add clinic",$this->sql);
        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();

            $this->pdo->commit();
            Debug("add item", "commit");
            $this->msg = "Запись успешно дабвлена";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            Debug("add item", "rollback");
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $this->id,
            "msg" => $this->msg
        );
        return $_RESULT;
    }

//------------------------------------------------------------------------------------------------------------
    public function addSpecial($param)
    {
        $model = new Model($this->ini);
        $this->id = $model->checkSpecial(trim($param['name']));

        if( $this->id > 0 ) {
            $_RESULT = array(
                "success" => 1,
                "id"    => $this->id,
                "msg" => "Такая запись уже существует"
            );
            return $_RESULT;
        }

        $this->data = array( 'name' => trim($param['name']) );

        $this->sql = "INSERT INTO special (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);
            $this->id = $this->pdo->lastInsertId();

            $this->pdo->commit();
            Debug("add item", "commit");
            $this->msg = "Запись успешно дабвлена";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            Debug("add item", "rollback");
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $this->id,
            "msg" => $this->msg
        );
        return $_RESULT;
    }

//------------------------------------------------------------------------------------------------------------------------
    public function saveItem($param)
    {
        $id = 0;

        $phones =  $param['phones'];
        Debug('save manager param:', $param);
        $this->data = array( 'id' => $param['id'],
            'name' => $param['name'],
            'region' => $param['region'],
            'email' => $param['email'],
            'plan' => $param['plan']
        );
        $this->sql = "update manager set name = :name, region = :region, email = :email, plan = :plan where id = :id";
Debug($this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $model = new Model($this->ini);
            $model->UpdatePhones("manager", $param['id'], $phones);

            $this->pdo->commit();
            Debug('manager save item', 'commit');
            $this->msg = "Менеджер успешно сохранен";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            Debug('manager save item', 'rollback');
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

//------------------------------------------------------------------------------------------------------------------------
    public function saveClinic($param)
    {

        $this->data = array( 'id' => $param['id'],
                            'name' => trim($param['name']),
                            'region' => $param['region'] );

        $this->sql = "update clinic set name = :name, region = :region where id = :id";
        Debug($this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();
            Debug('manager save item', 'commit');
            $this->msg = "Запись успешно сохранена";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            Debug('manager save item', 'rollback');
            $this->msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
        }

        $_RESULT = array(
            "success" => 1,
            "id" => $param['id'],
            "msg"  => $this->msg
        );
        return $_RESULT;
    }

//------------------------------------------------------------------------------------------------------------------------
    public function saveSpecial($param)
    {

        $this->data = array( 'id' => $param['id'], 'name' => trim($param['name']) );

        $this->sql = "update special set name = :name where id = :id";

        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();

            $this->msg = "Запись успешно сохранена";

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
//------------------------------------------------------------------------------------------------------------------------
    public function saveUser($param)
    {


        $this->data = array( 'id' => $param['id'], 'name' => trim($param['name']), 'login' => $param['login'], 'gid' => $param['gid'] );


        $this->sql = "update users set name = :name, login = :login, gid = :gid where id = :id";
        $stmt = $this->pdo->prepare($this->sql);
        Debug($this->sql, $this->data);
        try {
            $this->pdo->beginTransaction();

            $stmt->execute($this->data);

            $this->pdo->commit();
            Debug("add item", "commit");
            $this->msg = "Запись успешно дабвлена";

        } catch (PDOException $e) {
            $this->pdo->rollBack();
            Debug('manager save item', 'rollback');
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
//------------------------------------------------------------------------------------------------------------------------
    public function deleteClinic($param)
    {
        $this->data = array( 'id' => $param['id'] );

        $this->sql = "update clinic set state=0 where id = :id";
        Debug($this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();

            $this->msg = "Запись успешно удалена";

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

    //------------------------------------------------------------------------------------------------------------------------
    public function deleteSpecial($param)
    {
        $this->data = array( 'id' => $param['id'] );

        $this->sql = "update special set state=0 where id = :id";
        Debug($this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();

            $this->msg = "Запись успешно удалена";

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

//------------------------------------------------------------------------------------------------------------------------
    public function deleteUser($param)
    {
        $this->data = array( 'id' => $param['id'] );

        $this->sql = "update users set state=0 where id = :id";
        Debug($this->sql, $this->data);
        $stmt = $this->pdo->prepare($this->sql);

        try {
            $this->pdo->beginTransaction();
            $stmt->execute($this->data);

            $this->pdo->commit();

            $this->msg = "Запись успешно удалена";

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

//-----------------------------------------------------------------------------------


}

