<?php
/*
	LegacyDB Class
	
	This class provides functions to access the legacy customer database

*/

include_once "MySQLSuper.php";

class LegacyDB extends MySQLSuper {
	
	// database configuration
    function __construct() {
        $this->host      = "localhost";
        $this->user      = "csci467";
        $this->pass      = "huskies";
        $this->db_name   = "LegacyCustomer";
        
        // call super construct
        $this->super_construct();
   }
    
    public function getCustList() {
        $this->query("SELECT name FROM customers");
        return $this->resultset();
    }
    
    public function getCust($id) {
        $this->query("SELECT * FROM customers where id = " . $id);
        return $this->single(); 
    }
	

}
	

?>