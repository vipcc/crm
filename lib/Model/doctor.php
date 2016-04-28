<?php

function AddDoctor($pdo, $param)
{
    $id = 0;
    Debug("add doctor receive param:", $param);
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
    $sql = "INSERT INTO doctor (name, special, clinic, email, card, percent, status, comment) VALUES (:name, :special, :clinic, :email, :card, :percent, :status, :comment)";
    $stmt = $pdo->prepare($sql);
    Debug("add doctor receive param:", $sql);
    try {
        $pdo->beginTransaction();

        $stmt->execute($data);
        $id = $pdo->lastInsertId();

        AddPhones($pdo, "doctor", $id, $phones);

        $pdo->commit();
        Debug("add doctor:", "commit");
        $msg = "Врач успешно дабвлен";

    } catch (PDOException $e) {
        $pdo->rollBack();
        Debug("add doctor:", "rollback");
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
function EditDoctor($pdo, $param)
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
    $sql = "update doctor set name = :name, special = :special, clinic = :clinic,  email = :email, card = :card, percent = :percent, status = :status, comment = :comment where id = :id";
Debug("update doctor", $sql);
    $stmt = $pdo->prepare($sql);

    try {
        $pdo->beginTransaction();
        $stmt->execute($data);

        UpdatePhones($pdo, "doctor", $param['id'], $phones);
        Debug("update doctor", $phones);
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
function DeleteDoctor($pdo, $param)
{

    $data = array( 'id' => $param['id'] );
    $sql = "update doctor set state=0 where id = :id";
Debug("delete doctor", $sql . " id:" . $id);
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
function GetDoctorList($pdo, $param)
{

    $sql = ' select distinct doctor.id, doctor.name, s.name as special, p.name as phone, c.name as clinic, doctor.email '
         . ' from doctor '
         . ' left join special as s on s.id=doctor.special '
         . ' left join clinic as c on c.id=doctor.clinic '
         . ' left join doctor_contact as contact on contact.pid=doctor.id '
         . ' left join phone as p on p.id=contact.contact_id '
         . ' where doctor.state=1 and doctor.status = :status'
         . ' group by doctor.name ';
    Debug("GetDoctorList",$sql . " - " . $param['status']);
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':status', $param['status'], PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetchAll();

    return $records;
}

//------------------------------------------------------------------------------------------

function GetDoctorData($pdo, $id)
{

    $sql = 'select * from doctor where id = :id';
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

function GetDoctorFieldData($pdo, $id, $field)
{
Debug("in GetDoctorData","start");
    $sql = 'select ' . $field . ' from doctor where id = :id';
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

