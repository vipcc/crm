<?php

function AddVisit($pdo, $param)
{
    $id = 0;

    $data = array( 'manager' => $param['manager'],
            'doctor' => $param['doctor'],
            'clinic' => $param['clinic'],
            'dt' => DateConvert ($param['dt'], 'db'),
            'expens' => $param['expens'],
            'comment' => $param['comment'],
            'dt_plan' => DateConvert ($param['dt_plan'], 'db')
    );
    $sql = "INSERT INTO visit (manager, doctor, clinic, dt, expens, comment, dt_plan) VALUES (:manager, :doctor, :clinic, :dt, :expens, :comment, :dt_plan )";
    $stmt = $pdo->prepare($sql);

    try {
        $pdo->beginTransaction();

        Debug("visit data", $data);
        $stmt->execute($data);
        $id = $pdo->lastInsertId();

        $pdo->commit();
        $msg = "Визит успешно дабвлен";

    } catch (PDOException $e) {
        $pdo->rollBack();
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
function EditVisit($pdo, $param)
{
$id = 0;

$phones =  $param['phones'];

$data = array( 'id' => $param['id'],
'name' => $param['name'],
'region' => $param['region'],
'email' => $param['email'],
'plan' => $param['plan']
);
$sql = "update manager set name = :name, region = :region, email = :email, plan = :plan where id = :id";

$stmt = $pdo->prepare($sql);

try {
$pdo->beginTransaction();
$stmt->execute($data);

UpdatePhones($pdo, "manager", $param['id'], $phones);

$pdo->commit();
$msg = "Менеджер успешно сохранен";

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
function DeleteManager($pdo, $param)
{

$data = array( 'id' => $param['id'] );
$sql = "update manager set state=0 where id = :id";

$stmt = $pdo->prepare($sql);

try {
$pdo->beginTransaction();
$stmt->execute($data);

$pdo->commit();
$msg = "Менеджер удален";

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
function GetVisitList($pdo)
{
    Debug("in GetManagerList","start");
    $sql = 'select visit.id, .name, r.name as region from `manager`'
        . ' left join region as r on r.id = manager.region'
        . ' where manager.state = 1'
        . ' order by manager.name';

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll();

return $records;
}

//------------------------------------------------------------------------------------------

function GetVisitData($pdo, $id)
{
Debug("in GetManagerData","start");
$sql = 'select * from visit where id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

foreach ($stmt as $row) {
$obj = array(
"id" => $row['id'],
"name" => $row['name'],
"region" => $row['region'],
"email" => $row['email'],
"plan" => $row['plan']
);
}


Debug("manager data", $obj);

return $obj;
}
//------------------------------------------------------------------------------------------

function GetManagerFieldData($pdo, $id, $field)
{
Debug("in GetManagerData","start");
$sql = 'select ' . $field . ' from manager where id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$obj = $stmt->fetchObject();

return $obj->$field;
}
//---------------------------------------------------------------------------------------------