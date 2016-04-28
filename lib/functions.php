<?php

function Debug ($msg, $data) {

    $file = fopen(LogPrefix . "debug.log", "a+");
    fwrite($file, date("H:i:s") ." [" . $msg . "]\n");
    fwrite($file, print_r($data, true) ."\n");
    fwrite($file, "------------------------------------------------------------\n");
    fclose($file);

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
//-----------------------------------------------------------------------

function getGroupList($pdo)
{

    $data = $pdo->query('SELECT id, name FROM groups')->fetchAll(PDO::FETCH_KEY_PAIR);

    return $data;
}

//-------------------------------------------------------------------------------------

function getRegionList($pdo)
{
    $records = array();

    $stmt = $pdo->prepare('SELECT * FROM region WHERE state = 1 order by name');
    $stmt->execute();
    foreach ($stmt as $row)
    {
        array_push ( $records, $row );
    }

    return $records;
}

//-------------------------------------------------------------------------------------

function getContactList($pdo, $table, $pid)
{
    $records = array();
    $sql = 'select phone.tp, phone.name from `phone` '
            . ' left join ' . $table . ' as m on m.contact_id = phone.id '
            . ' where m.pid = :pid';
    $stmt = $pdo->prepare($sql);
    $param = array('pid' => $pid);

    $stmt->execute($param);
    foreach ($stmt as $row)
    {
        array_push ( $records, $row );
    }

    return $records;
}

//-------------------------------------------------------------------------------------

function getPages($pdo)
{
    $records = array();

    $stmt = $pdo->prepare('SELECT page_id,main,name,title FROM pages WHERE gid = :group_id order by page_id');

    $stmt->execute(array('group_id' => $_SESSION['_GID']));

    foreach ($stmt as $row)
    {
        if($row['main'] == '1') {
            $page = $row['name'];
            $page_id = $row['page_id'];
        }
        array_push ( $records, array($row['page_id'], $row['title'], $row['name']) );
    }

    $data = array("records" => $records,
        "main" => $page,
        "page_id" => $page_id );

    return $data;
}

//-------------------------------------------------------------------------------------

function getTabs($pdo, $page_id)
{
    $records = array();

    $stmt = $pdo->prepare('SELECT * FROM tabs WHERE page_id = :page_id and gid = :group_id order by ind');

    $stmt->execute(array('page_id' => $page_id, 'group_id' => $_SESSION['_GID']));
    foreach ($stmt as $row)
    {
        array_push ( $records, $row );
    }

    return $records;
}

//-------------------------------------------------------------------------------------

function get_groups($user) {
    // Active Directory server
    $ldap_host = "10.2.10.10";

    // Active Directory DN, base path for our querying user
    $ldap_dn = "OU=users,OU=TV,DC=tv,DC=net";

    // Active Directory user for querying
    $query_user = "user@TVNEWS.NET";
    $password = "";

    // Connect to AD
    $ldap = ldap_connect($ldap_host) or die("Could not connect to LDAP");
    ldap_bind($ldap,$query_user,$password) or die("Could not bind to LDAP");

    // Search AD
    $results = ldap_search($ldap,$ldap_dn,"(samaccountname=$user)",array("memberof","primarygroupid"));
    $entries = ldap_get_entries($ldap, $results);

    // No information found, bad user
    if($entries['count'] == 0) return false;

    // Get groups and primary group token
    $output = $entries[0]['memberof'];
    $token = $entries[0]['primarygroupid'][0];

    // Remove extraneous first entry
    array_shift($output);

    // We need to look up the primary group, get list of all groups
    $results2 = ldap_search($ldap,$ldap_dn,"(objectcategory=group)",array("distinguishedname","primarygrouptoken"));
    $entries2 = ldap_get_entries($ldap, $results2);

    // Remove extraneous first entry
    array_shift($entries2);
    // Loop through and find group with a matching primary group token
    foreach($entries2 as $e) {
        if($e['primarygrouptoken'][0] == $token) {
            // Primary group found, add it to output array
            $output[] = $e['distinguishedname'][0];
            // Break loop
            break;
        }
    }

    return $output;
}

function importFin($pdo, $fname) {
    Debug("IMPORT BUH", $fname);
    require_once('../lib/RExcel/reader.php');

    $data = new Spreadsheet_Excel_Reader();
    $data->setOutputEncoding('UTF-8');
    $data->read($fname);
    Debug("ARRAY", $data->sheets[0]["cells"]);
    $page = 0;
    Debug("count", count($data->sheets[$page]["cells"]));

   foreach($data->sheets[$page]["cells"] as $i => $record) {

       if(is_numeric($data->sheets[$page]["cells"][$i][1])) {

           $dt = dtYearLongFormat(trim($data->sheets[$page]["cells"][$i][5]));
           $sum = (is_numeric(trim($data->sheets[$page]["cells"][$i][10]))) ? trim($data->sheets[$page]["cells"][$i][10]) : 0;
           $bonus = (is_numeric(trim($data->sheets[$page]["cells"][$i][24]))) ? trim($data->sheets[$page]["cells"][$i][24]) : 0;

           $sql_data = array( 'mo_id' => trim($data->sheets[$page]["cells"][$i][8]),
               'dt' => DateConvert ($dt, 'db') ,
               'sum' => $sum,
               'bonus' => $bonus
           );

           if( !getFinData($pdo,$sql_data) )
               addFinData($pdo,$sql_data);
       }


   }

}



function getFinData($pdo, $sql_data) {

    $sql = "select count(id) as count from fin where dt = :dt and mo_id = :mo_id and round(sum,2) = :sum and round(bonus,2) = :bonus";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($sql_data);

    $obj = $stmt->fetchObject();
    Debug($sql, $sql_data);
    return $obj->count;
}



 function addFinData($pdo, $sql_data) {

     $sql = "INSERT INTO fin (dt, mo_id, sum, bonus) VALUES (:dt, :mo_id, :sum, :bonus )";
     $stmt = $pdo->prepare($sql);

     Debug($sql, $sql_data);
     $stmt->execute($sql_data);

 }


?>

