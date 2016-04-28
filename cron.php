<?php


// read config.ini
$ini = file_exists ("config/config.ini") ? parse_ini_file("config/config.ini", true) : 0;
if($ini == 0)
    throw new Exception('config.ini  not found', 1);

// Database connection
$host = $ini['calls']['host'];
$db = $ini['calls']['db'];
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo_calls = new PDO($dsn, $ini['calls']['user'], $ini['calls']['pass'], $opt);

$host = $ini['mysql']['host'];
$db = $ini['mysql']['db'];
$dsn = "mysql:host=$host;dbname=$db;charset=utf8";
$opt = array(
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo_crm = new PDO($dsn, $ini['mysql']['user'], $ini['mysql']['pass'], $opt);


    $start_id = checkNewCalls($pdo_calls, $pdo_crm);

    if( $start_id > 0) {
        getCalls($pdo_calls, $pdo_crm, $start_id);
    }


##############################################################################################
function checkNewCalls($pdo_calls, $pdo_crm)
{
    $stmt1 = $pdo_calls->prepare("SELECT max(ID) as max FROM calls WHERE toCID = '2020300'");
    $stmt1->execute();
    foreach ($stmt1 as $row1) {
            $id = $row1['max'];
    }

    $stmt2 = $pdo_crm->prepare("SELECT max(pid) as max FROM calls");
    $stmt2->execute();
    foreach ($stmt2 as $row2) {
        $pid = $row2['max'];
        if(!$pid)
            $pid = 1;
    }

    if( $id > $pid)
        return $pid;
    else
        return 0;

}

function getCalls($pdo_calls, $pdo_crm, $id)
{
    $stmt1 = $pdo_calls->prepare("SELECT * from calls WHERE toCID = '2020300' and id > " . $id);
    $stmt1->execute();
    foreach ($stmt1 as $row) {

        $data = array( 'pid' => $row['ID'],
            'callerCID' => $row['callerCID'],
            'toCID' => $row['toCID'],
            'event' => $row['event'],
            'call_date' => $row['call_date'],
            'filename' => $row['filename']
        );
        $sql = "INSERT INTO calls (pid, callerCID, toCID, event, call_date, filename) VALUES (:pid, :callerCID, :toCID, :event, :call_date, :filename)";
        $stmt2 = $pdo_crm->prepare($sql);
        $stmt2->execute($data);
        $id = $pdo_crm->lastInsertId();
        if($id > 0) {
            $data = array( 'name' => "call");
            $sql = "INSERT INTO refresh (name) VALUES (:name)";
            $stmt3 = $pdo_crm->prepare($sql);
            $stmt3->execute($data);
        }
    }

}


