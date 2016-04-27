<?php

/*
	Database PDO Wrapper Class
	Constructed using PDO tutorial from
	http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/

    Modified and exapnded 4-16
	
	This class facilitates access to a mysql databse using the
	PHP PDO Library. It supports using bind variables to prevent
	SQL injection.
	
*/

class MySQLSuper
{

    // configuration
    protected $host;
    protected $user;
    protected $pass;
    protected $db_name;
    protected $table_name;
    protected $dbh;
    protected $error;
    protected $stmt;

    // default super constructor
    protected function super_construct()
    {
        // Create new database object
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Create a new PDO instanace
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
            trace($this->error);
        }
    }

    // query method
    public function query($query)
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    // bind method
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // execute method
    public function execute()
    {
        return $this->stmt->execute();
    }

    // resultset method
    public function resultset()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // single method
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    // rowcount method
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }

    // lastinsertid method
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }

    // begin transaction method
    public function beginTransaction()
    {
        return $this->dbh->beginTransaction();
    }

    // end transaction method
    public function endTransaction()
    {
        return $this->dbh->commit();
    }

    // cancel transaction method
    public function cancelTransaction()
    {
        return $this->dbh->rollBack();
    }

    // dump debug method
    public function debugDumpParams()
    {
        return $this->stmt->debugDumpParams();
    }

    // update and bind on single item in table
    public function updateBindSingle($id, $paramName, $paramData)
    {
        // prepare update query
        $this->query("Update " . $this->table_name . " SET " . $paramName . "=:paramData WHERE id=:id");

        // bind item parameters
        $this->bind(":id", $id);
        $this->bind(":paramData", $paramData);

        // execute built query and return result
        return $this->execute();
    }

    public function disconnect () {
        $this->stmt = null;
        $this->dbh = null;
    }
}

?>