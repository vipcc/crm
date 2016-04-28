<?php

function GetTabProfile($pdo, $param) {

    $data = array( 'group_id' => $_SESSION['_GID'], 'page_id' => $param['page'], 'tab' => $param['tab'] );
    $sql = 'select * from tabs where gid = :group_id and page_id = :page_id and ind = :tab';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    foreach ($stmt as $row) {
        $obj = array( "success" => 'true',
            "name" => $row['name'],
            "title" => $row['title'],
            "div" => $row['div'],
            "tbl" => $row['tbl'],
            "toolbar" => $row['toolbar']
        );
    }

    Debug("GetTabObjects", $obj);

    return $obj;

}

//---------------------------------------------------------------------------------------------

function AddPhones($pdo, $parent, $pid, $phones)
{
    Debug("phoness:", $phones);
    foreach($phones as $key => $value)
    {
        Debug("phoness:", "key:" . $key . " val:" . $value);

        $data = array( 'tp' => $key, 'name' => $value );

        $sql = 'SELECT id FROM phone WHERE tp = :tp and name = :name';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $obj = $stmt->fetchObject();
        $id = $obj->id;

        if($id > 0) {
            $sql = "update phone set state=1 where id=$id";
            Debug("update phones", $sql . " id=$id");
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "INSERT INTO phone (tp, name) VALUES (:tp, :name)";
            Debug("insert phones", $sql . " tp=$tp  name=$name");
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);

            $id = $pdo->lastInsertId();
        }

        LinkPhone($pdo, $parent, $pid, $id);
    }

    return 1;
}

//---------------------------------------------------------------------------------------------

function UpdatePhones($pdo, $parent, $pid, $phones)
{

    $sql = "delete from " . $parent . "_contact where  pid = :pid";
    Debug("update phones", $sql . " pid=$pid");
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
    $stmt->execute();

    AddPhones($pdo, $parent, $pid, $phones);

    return 1;
}

//---------------------------------------------------------------------------------------------

function LinkPhone($pdo, $parent, $pid, $contact_id)
{
    $data = array( 'pid' => $pid, 'contact_id' => $contact_id );

    $sql = "INSERT INTO " . $parent . "_contact (pid, contact_id) VALUES (:pid, :contact_id)";
    Debug("update phones", $sql . " pid=$pid contact_id=$contact_id");
    $stmt = $pdo->prepare($sql);

    $stmt->execute($data);
    $id = $pdo->lastInsertId();

    return $id;
}

