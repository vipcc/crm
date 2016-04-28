<?php

function AddPatient($pdo, $param)
{
    $id = 0;
    Debug("add patient receive param:", $param);
    $phones =  $param['phones'];

    $data = array( 'name' => $param['name'],
    'special' => $param['special'],
    'clinic' => $param['clinic'],
    'status' => $param['status'],
    'email' => $param['email'],
    'card' => $param['card'],
    'percent' => $param['percent'],
    'comment' => $param['comment']
    );
    $sql = "INSERT INTO patient (name, special, clinic, email, card, percent, status, comment) VALUES (:name, :special, :clinic, :email, :card, :percent, :status, :comment)";
    $stmt = $pdo->prepare($sql);
    Debug("add patient receive param:", $sql);
    try {
        $pdo->beginTransaction();

        $stmt->execute($data);
        $id = $pdo->lastInsertId();

        AddPhones($pdo, "patient", $id, $phones);

        $pdo->commit();
        Debug("add patient:", "commit");
        $msg = "Врач успешно дабвлен";

    } catch (PDOException $e) {
        $pdo->rollBack();
        Debug("add patient:", "rollback");
        $msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
    }

    $_RESULT = array(
        "success" => 1,
"id" => $id,
"msg"  => $msg
);
return $_RESULT;
}

//------------------------------------------------------------------------------------------
function EditPatient($pdo, $param)
{
    $id = 0;

    $phones =  $param['phones'];

    $data = array( 'id' => $param['id'],
            'name' => $param['name'],
            'special' => $param['special'],
            'status' => $param['status'],
            'clinic' => $param['clinic'],
            'email' => $param['email'],
            'card' => $param['card'],
            'percent' => $param['percent'],
            'comment' => $param['comment']
    );
    $sql = "update patient set name = :name, special = :special, clinic = :clinic,  email = :email, card = :card, percent = :percent, status = :status, comment = :comment where id = :id";
Debug("update patient", $sql);
    $stmt = $pdo->prepare($sql);

    try {
        $pdo->beginTransaction();
        $stmt->execute($data);

        UpdatePhones($pdo, "patient", $param['id'], $phones);
        Debug("update patient", $phones);
        $pdo->commit();
        $msg = "Врач успешно сохранен";

    } catch (PDOException $e) {
        $pdo->rollBack();
        $msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
    }

    $_RESULT = array(
        "success" => 1,
        "id" => $param['id'],
        "msg"  => $msg
    );

    return $_RESULT;
}

//------------------------------------------------------------------------------------------
function DeletePatient($pdo, $param)
{

    $data = array( 'id' => $param['id'] );
    $sql = "update patient set state=0 where id = :id";
Debug("delete patient", $sql . " id:" . $id);
    $stmt = $pdo->prepare($sql);

    try {
        $pdo->beginTransaction();
        $stmt->execute($data);

        $pdo->commit();
        $msg = "Врач удален";

    } catch (PDOException $e) {
        $pdo->rollBack();
        $msg = "Произошла ошибка. Проверьте правильность введенных данных или обратитесь в службу техподдержки.";
    }

    $_RESULT = array(
        "success" => 1,
        "id" => 0,
        "msg"  => $msg
    );
    return $_RESULT;
}

//------------------------------------------------------------------------------------------
function GetPatientList($pdo, $param)
{

    $sql = ' select distinct patient.id, patient.name, patient.dt_plan, m.name as manager '
         . ' from patient '
         . ' left join manager as m on m.id=patient.manager '
         . ' where patient.state=1 and patient.status = :status'
         . ' group by patient.name ';
    Debug("GetPatientList",$sql . " - " . $param['status']);
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':status', $param['status'], PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetchAll();

    return $records;
}

//------------------------------------------------------------------------------------------

function GetPatientData($pdo, $id)
{

    $sql = 'select * from patient where id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    foreach ($stmt as $row) {
        $obj = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "clinic" => $row['clinic'],
            "special" => $row['special'],
            "card" => $row['card'],
            "email" => $row['email'],
            "percent" => $row['percent'],
            "status" => $row['status'],
            "comment" => $row['comment']
        );
    }


Debug("manager data", $obj);

return $obj;
}
//------------------------------------------------------------------------------------------

function GetPatientFieldData($pdo, $id, $field)
{
Debug("in GetPatientData","start");
    $sql = 'select ' . $field . ' from patient where id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $obj = $stmt->fetchObject();

    return $obj->$field;
}
//---------------------------------------------------------------------------------------------
function GetClinicList($pdo)
{
    Debug("in GetManagerList","start");
    $sql = 'select clinic.id, clinic.name, c.name as city from clinic '
            . ' left join city as c on c.id=clinic.city '
            . ' where clinic.state=1 order by clinic.name';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();

    return $records;
}
//------------------------------------------------------------------------------------------
function GetSpecialList($pdo)
{
    Debug("in GetManagerList","start");
    $sql = 'select id, name from special where state=1 order by name';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();

    return $records;
}

