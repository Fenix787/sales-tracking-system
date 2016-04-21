<?php
/*
	SalesRepDB.php
	
	This class provides functions to access data related to sales reps

*/

include_once "MySQLSuper.php";

class SalesRepDB extends MySQLSuper
{

    // database configuration
    function __construct()
    {
        $this->host = "localhost";
        $this->user = "csci467";
        $this->pass = "huskies";
        $this->db_name = "Sales";

        $this->super_construct();
    }

    public function getPassword($username)
    {
        $this->query("SELECT id,username,password,salt FROM SalesRep WHERE username=:user");
        $this->bind(":user", $username);
        return new SalesRep($this->single());
    }

}

class SalesRep
{
    var $id;
    var $username;
    var $salt;
    var $password;

    // populate salesrep
    function __construct($row)
    {
        $this->id = isset($row['id']) ? $row['id'] : -1;
        $this->username = isset($row['username']) ? $row['username'] : '';
        $this->salt = isset($row['salt']) ? $row['salt'] : '';
        $this->password = isset($row['password']) ? $row['password'] : '';
    }
}

?>