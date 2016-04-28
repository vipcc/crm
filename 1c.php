<?php

// read config.ini
$ini = file_exists ("config/config.ini") ? parse_ini_file("config/config.ini", true) : 0;
if($ini == 0)
    throw new Exception('config.ini  not found', 1);

// Database connection
$host = $ini['mysql']['host'];
$db = $ini['mysql']['db'];
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo_crm = new PDO($dsn, $ini['mysql']['user'], $ini['mysql']['pass'], $opt);


$records = simplexml_load_file($ini['1c']['path'] . "/day.xml");

for($i = 0, $count = count($records->ID); $i < $count; $i++) {

    $dt = dtYearLongFormat($records->Dat[$i]);
    $mo_id = $records->ID[$i] * 1;
    $sum = $records->SUM[$i] * 1;

    $service = checkPayment($pdo_crm, $dt, $mo_id, $sum);

    if( $service <= 0) {
        addPayment($pdo_crm, $dt, $mo_id, $sum);
    }

    $dt = '';
    $mo_id = 0;
    $sum = 0;

}

##############################################################################################
function checkPayment($pdo,  $dt, $mo_id, $sum)
{
    $dat = array( 'dt' => DateConvert($dt, 'db'),
                'mo_id' => $mo_id,
                'sum'   => $sum
    );

    echo $dt . " --- " . $mo_id . " --- " . $sum;

        $stmt = $pdo->prepare("SELECT id FROM payment WHERE mo_id = :mo_id and dt = :dt and sum = :sum");
    echo "SELECT id FROM payment WHERE mo_id = :mo_id and dt = :dt and sum = :sum";
    print_r($dat);
    echo "#####################################\r\n";
    $stmt->execute($dat);
    $obj = $stmt->fetchObject();

    return $obj->id;

}

function checkPatient($pdo, $mo_id )
{
    $dat = array( 'mo_id' => $mo_id );

    $stmt = $pdo->prepare("SELECT id FROM patient WHERE state=1 and mo_id = :mo_id ");

    $stmt->execute($dat);
    $obj = $stmt->fetchObject();

    return $obj->id;

}

function addPayment($pdo,  $dt, $mo_id, $sum)
{

    $patient = checkPatient($pdo, $mo_id);

    if($patient) {
        $data = array( 'dt' => DateConvert($dt, 'db'),
            'mo_id' => $mo_id,
            'patient'   => $patient,
            'sum'   => $sum
        );


        try {
            $pdo->beginTransaction();

            $sql = "INSERT INTO payment (dt, patient, mo_id, sum) VALUES (:dt, :patient, :mo_id, :sum)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);

            $sql = "update patient set status=2, dt_consultion = :dt where id = $patient";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam (":dt", DateConvert($dt, 'db'), PDO::PARAM_STR);
            $stmt->execute();

            $pdo->commit();
echo "COMMIT";

        } catch (PDOException $e) {
            $pdo->rollBack();
            echo $e;
        }
    }

}

function DateConvert ($dt, $to) {

    $date=date_create($dt);

    if($to == "db")
        return date_format($date,"Y-m-d");
    else
        return date_format($date,"d.m.Y");

}

function dtYearLongFormat($str) {
    list($d, $m, $y) = explode(".", $str);
    return $d . "." . $m . "." . "20" . $y;
}