<?php
/*
	LegacyDB.php
	
	This class provides functions to access the legacy customer database

*/

include_once "MySQLSuper.php";

class LegacyDB extends MySQLSuper
{

    // database configuration
    function __construct()
    {
	    $this->host = "blitz.cs.niu.edu";
	    $this->user = "student";
	    $this->pass = "student";
	    $this->db_name = "csci467";

        // super constructor
        $this->super_construct();

        // trace if any errors
        if ($this->error != "") {
            trace($this->error);
        }
        else {
            trace("connected to legacy db");
        }
    }

    public function getCustList()
    {
        $this->query("SELECT name FROM customers");
        return $this->resultset();
    }

    public function getCust($id)
    {
        $this->query("SELECT * FROM customers where id = " . $id);
        return $this->single();
    }


}


?>
