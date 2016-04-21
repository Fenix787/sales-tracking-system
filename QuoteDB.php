<?php
/*
	QuoteDB Class
	
	This class provides functions to access quotes, and their items and notes

*/

include_once "MySQLSuper.php";

class QuoteDB extends MySQLSuper {
	
	// database configuration
    function __construct() {
        $this->host       = "localhost";
        $this->user       = "csci467";
        $this->pass       = "huskies";
        $this->db_name    = "Sales";
        $this->table_name = "Quote";
        
        $this->super_construct();
        trace($this->error);
   }
   
   public function newQuote($salesrepid,$customer) {
       // prepare insert query
       $this->query("INSERT INTO Quote (id,salesrep,status,cust,discount,comission) VALUES (NULL,:salesrepid,0,:customer,NULL,NULL)");
       
       // bind quote parameters
       $this->bind(":salesrepid",$salesrepid);
       $this->bind(":customer",$customer);
       
       // execute built query
       $this->execute();
       trace("created new quote in database");
       
       // return quote id
       return $this->dbh->lastInsertId();
   }
   
   public function newItem($item) {
       // prepare insert query
       $this->query("INSERT INTO Item (id,quote,title,price,qty) VALUES (NULL,:quote,:title,:price,:qty)");
       
       // bind item parameters
       $this->bind(":quote",$item->quoteid);
       $this->bind(":title",$item->title);
       $this->bind(":price",$item->price);
       $this->bind(":qty",$item->qty);
       
       // execute built query
       $this->execute();   
       trace("created new item in database");
       
       // return item id
       return $this->dbh->lastInsertId();
   }
   
   public function newNote($note) { 
       // prepare insert query
       $this->query("INSERT INTO Note (id,quote,subject,message) VALUES (NULL,:quote,:subject,:message)");
       
       // bind item parameters
       $this->bind(":quote",$note->quoteid);
       $this->bind(":subject",$note->subject);
       $this->bind(":message",$note->message);
       
       // execute built query
       $this->execute(); 
       trace("created new note in databse");
       
       // return note id
       return $this->dbh->lastInsertId();
   }
   
   public function confirmEmail($quoteid,$email) {
       // pass data to reuseable single item update function  
       if ($this->updateBindSingle($quoteid,"email",$email) == False){
           trace("Error attaching email: " . $email . " to quote :" . $quoteid);
       }
       else {
           trace("Attached email to quote");
       }
   }
   
   public function sanctionQuote($quoteid,$status) {
       // pass data to reuseable single item update function  
       if ($this->updateBindSingle($quoteid,"status",$status) == False) {
           trace("Error sanctioning quote: " . $quoteid . " with status :" . $status);
       }
       else {
           trace("Sanctioned quote");
       }
   }
}

class Item {
	var $id;
    var $quoteid;
	var $title;
	var $price;
	var $qty;
    
	// populate item
	function __construct($row) {
		$this->id = isset($row['id']) ? $row['id'] : -1;
        $this->quoteid = isset($row['quoteid']) ? $row['quoteid'] : 0;
		$this->title = isset($row['title']) ? $row['title'] : '';
		$this->price = isset($row['price']) ? $row['price'] : 0;
		$this->qty = isset($row['qty']) ? $row['qty'] : 0;
	}
}

class Note {
    var $id;
    var $quoteid;
	var $subject;
	var $message;
    
	// populate note
	function __construct($row) {
		$this->id = isset($row['id']) ? $row['id'] : -1;
        $this->quoteid = isset($row['quoteid']) ? $row['quoteid'] : 0;
		$this->subject = isset($row['subject']) ? $row['subject'] : '';
		$this->message = isset($row['message']) ? $row['message'] : '';
	}
}

class Quote {
    var $id;
	var $customer;
	var $email;
    var $items;
    var $notes;
    var $salesrep;
    
    // empty quote
	function __construct() {
		$this->id = 0;
		$this->customer = '';
		$this->email = '';
        $this->items = array();
        $this->notes = array();
        $salesrep = 0;
	}
}
?>