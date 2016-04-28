<?php




class Model {
    protected $ini;
    protected $pdo;
    protected $sql;
    protected $data;
    protected $result;


    public function __construct($ini) {
        $this->ini = $ini;
        // Database connection
        $host = $ini['mysql']['host'];
        $db = $ini['mysql']['db'];
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        try {
            $this->pdo = new PDO($dsn, $ini['mysql']['user'], $ini['mysql']['pass'], $opt);
        } catch (PDOException $e) {
            Debug('Connect to DB EXCEPTION', $e);
        }

        $this->sql = "";
        $this->data = array();

    }
//---------------------------------------------------------------------------------------------------------------
    public function getRegionList() {

        $records = array();

        $stmt = $this->pdo->prepare('SELECT * FROM region WHERE state = 1 order by name');
        $stmt->execute();
        foreach ($stmt as $row)
        {
            array_push ( $records, $row );
        }

        return $records;

    }


    public function GetClinicList() {

        $this->sql = 'select clinic.id, clinic.name, reg.name as region from clinic '
            . ' left join region as reg on reg.id=clinic.region '
            . ' where clinic.state=1 order by clinic.name';

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute();
        $records = $stmt->fetchAll();

        return $records;
    }
//------------------------------------------------------------------------------------------
    public function GetSpecialList()
    {

        $this->sql = 'select id, name from special where state=1 order by name';

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute();
        $records = $stmt->fetchAll();

        return $records;
    }

//---------------------------------------------------------------------------------------------------------------
    public function getSearchSpecial($keyword)
    {
        $rec = array();
        $this->sql = "select id, name as value from special where name LIKE CONCAT('%', :keyword, '%')";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            array_push ($rec, $row);

        }

        return $rec;

    }
//---------------------------------------------------------------------------------------------------------------
    public function getSearchClinic($keyword)
    {
        $rec = array();
        $this->sql = "select id, name as value from clinic where name LIKE CONCAT('%', :keyword, '%')";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            array_push ($rec, $row);

        }

        return $rec;

    }

//--------------------------------------------------------------------------------------------------------------
    public function checkDictSpecial($value) {
        $id = $this->getFieldId("special", "name", $value);
        if( $id <= 0 ) {

            $this->data = array( 'name' => $value );
            $this->sql = "INSERT INTO special (name) VALUES (:name)";
            $stmt = $this->pdo->prepare($this->sql);

            $stmt->execute($this->data);
            $id = $this->pdo->lastInsertId();
        }

        return $id;
    }
//--------------------------------------------------------------------------------------------------------------
    public function checkDictClinic($value) {
        $id = $this->getFieldId("clinic", "name", $value);
        if( $id <= 0 ) {

            $this->data = array( 'name' => $value );
            $this->sql = "INSERT INTO clinic (name) VALUES (:name)";
            $stmt = $this->pdo->prepare($this->sql);

            $stmt->execute($this->data);
            $id = $this->pdo->lastInsertId();
        }

        return $id;
    }
//--------------------------------------------------------------------------------------------------------------

    public function getContactList($table, $pid)
    {

        $this->sql = 'select phone.tp, phone.name from `phone` '
            . ' left join ' . $table . ' as m on m.contact_id = phone.id '
            . ' where m.pid = :pid';

        $stmt = $this->pdo->prepare($this->sql);
        $param = array('pid' => $pid);

        $stmt->execute($param);
        $this->records = $stmt->fetchAll();

        return $this->records;
    }

    //---------------------------------------------------------------------------------------------------------
    function getGroupList()
    {

        $this->sql = 'SELECT id, name FROM groups';
    //   $this->records = $this->pdo->query($this->sql)->fetchAll(PDO::FETCH_KEY_PAIR);
        $this->records = $this->pdo->query($this->sql)->fetchAll();

        return $this->records;
    }

    //---------------------------------------------------------------------------------------------------------
    public function getUserList($gid = 0, $id = 0)
    {
        $gid_sql = ($gid > 0) ? " and gid = $gid" : "";
        $id_sql = ($id > 0) ? " and id = $id" : "";

        $this->sql = 'select id, name, login from `users`'
            . ' where state = 1' . $gid_sql . $id_sql
            . ' order by name';

        $this->records = $this->pdo->query($this->sql)->fetchAll();
        return $this->records;

    }

    //---------------------------------------------------------------------------------------------------------



    public function AddPhones($parent, $pid, $phones)
    {

        foreach($phones as $key => $value)
        {

            $this->data = array( 'tp' => $key, 'name' => $value );

            $this->sql = 'SELECT id FROM phone WHERE tp = :tp and name = :name';
            $stmt = $this->pdo->prepare($this->sql);
            $stmt->execute($this->data);
            $obj = $stmt->fetchObject();
            $id = $obj->id;

            if($id > 0) {
                $this->sql = "update phone set state=1 where id=$id";

                $stmt = $this->pdo->prepare($this->sql);
                $stmt->execute();
            } else {
                $this->sql = "INSERT INTO phone (tp, name) VALUES (:tp, :name)";

                $stmt = $this->pdo->prepare($this->sql);
                $stmt->execute($this->data);

                $id = $this->pdo->lastInsertId();
            }

            $this->LinkPhone($parent, $pid, $id);
        }

        return 1;
    }

//---------------------------------------------------------------------------------------------

    public function UpdatePhones($parent, $pid, $phones)
    {

        $this->sql = "delete from " . $parent . "_contact where  pid = :pid";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
        $stmt->execute();

        $this->AddPhones($parent, $pid, $phones);

        return 1;
    }

//---------------------------------------------------------------------------------------------

    public function LinkPhone($parent, $pid, $contact_id)
    {
        $this->data = array( 'pid' => $pid, 'contact_id' => $contact_id );

        $this->sql = "INSERT INTO " . $parent . "_contact (pid, contact_id) VALUES (:pid, :contact_id)";

        $stmt = $this->pdo->prepare($this->sql);

        $stmt->execute($this->data);
        $id = $this->pdo->lastInsertId();

        return $id;
    }

//---------------------------------------------------------------------------------------------

    public function getFieldData($id, $field, $table)
    {
        $this->data = array( 'id' => $id, 'field' => $field, 'table' => $table );
        $this->sql = 'select :field from :table where id = :id';

        $stmt = $this->pdo->prepare($this->sql);

        $stmt->execute($this->data);
        $obj = $stmt->fetchObject();

        return $obj->$field;
    }

//---------------------------------------------------------------------------------------------

    public function getFieldId($table, $field, $value)
    {
        $this->data = array( 'value' => $value );
        $this->sql = "select id from $table where $field = :value";

        $stmt = $this->pdo->prepare($this->sql);

        $stmt->execute($this->data);
        $obj = $stmt->fetchObject();

        return $obj->id;
    }

    //---------------------------------------------------------------------------------------------

    public function getUserByLogin($login)
    {
        $this->sql = "select id, name, gid from users where login = :login";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->bindParam(':login', $login, PDO::PARAM_INT);
        $stmt->execute();

        foreach ($stmt as $row) {
            $obj = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "gid" => $row['gid']
            );
        }

        return $obj;
    }


    //---------------------------------------------------------------------------------------------
    public function checkClinic($name, $region)
    {
        $this->data = array( 'name' => $name, 'region' => $region );
        $this->sql = "select id from clinic where region = :region and name = :name";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $obj = $stmt->fetchObject();

        if($obj->id > 0) {
            $this->sql = "update clinic set state = 1 where id = :id";
            $stmt = $this->pdo->prepare($this->sql);
            $stmt->bindParam(':id', $obj->id, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $obj->id;
    }

    public function checkSpecial($name)
    {
        $this->data = array( 'name' => $name );
        $this->sql = "select id from special where name = :name";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $obj = $stmt->fetchObject();

        if($obj->id > 0) {
            $this->sql = "update special set state = 1 where id = :id";
            $stmt = $this->pdo->prepare($this->sql);
            $stmt->bindParam(':id', $obj->id, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $obj->id;
    }

    //---------------------------------------------------------------------------------------------

    public function checkUser($name,$login)
    {
        $this->data = array( 'name' => $name, 'login' => $login );
        $this->sql = "select id from users where name = :name and login = :login";

        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->data);

        $obj = $stmt->fetchObject();

        if($obj->id > 0) {
            $this->sql = "update users set state = 1 where id = :id";
            $stmt = $this->pdo->prepare($this->sql);
            $stmt->bindParam(':id', $obj->id, PDO::PARAM_INT);
            $stmt->execute();
        }

        return $obj->id;
    }

    //---------------------------------------------------------------------------------------------------------------
    public function getUsersForManager()
    {

        $this->sql = 'select id, name, login from `users`'
            . ' where state = 1 and gid=103 and id NOT IN ( SELECT user FROM manager)'
            . ' order by name';

        $this->records = $this->pdo->query($this->sql)->fetchAll();
        return $this->records;

    }
//---------------------------------------------------------------------------------------------

    public function getACL($gid, $param)
    {

        $item = ($param['id'] > 0) ? 1 : 0;
        $this->data = array( 'gid' => $gid, 'page' => $param['page'], 'tab' => $param['tab'], 'item' => $item );

        $this->sql = "select btn_add, btn_save, btn_del, confirm, deconfirm from acl where gid = :gid and page = :page and tab = :tab and item = :item";

        $stmt = $this->pdo->prepare($this->sql);

        $stmt->execute($this->data);

        foreach ($stmt as $row) {
            $obj = array(
                "btn_add" => $row['btn_add'],
                "btn_save" => $row['btn_save'],
                "btn_del" => $row['btn_del'],
                "confirm" => $row['confirm'],
                "deconfirm" => $row['deconfirm']
            );
        }

        return $obj;
    }

//---------------------------------------------------------------------------------------------

    public function getEditACL($gid, $param)
    {

        $this->data = array( 'gid' => $gid, 'page' => $param['page'], 'tab' => $param['tab'] );

        $this->sql = "select edit, permission from edit_acl where gid = :gid and page = :page and tab = :tab";

        $stmt = $this->pdo->prepare($this->sql);

        $stmt->execute($this->data);

        $this->records = $stmt->fetchAll();

        return $this->records;
    }


}