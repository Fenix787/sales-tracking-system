<?php
/*
	CreateQuote.php
	
	This class provides connections between the GUI and the DB interfaces

*/

include_once "LegacyDB.php";
include_once "QuoteDB.php";
include_once "SalesRepDB.php";

class CreateQuote
{

    private $ldb;
    private $qdb;
    private $srdb;

    public function __construct()
    {
        // constructor
    }

    public function authSalesRep($username, $password)
    {
        // if user is not authorized yet
        if ($_SESSION['salesrep']->id == -1 && $username != '-1' && $password != '-1') {
            // connect to salesrep db
            if (! isset($this->srdb)) { $this->srdb = new SalesRepDB; }

            // get auth data
            $authUser = $this->srdb->getPassword($username);

            // salt the password entered by user
            $hashedpw = hash('sha256', $password . $authUser->salt);

            // compare the password entered by the user to the one on file
            if ($hashedpw == $authUser->password) {
                // store salesrep data in session
                $_SESSION['salesrep'] = $authUser;
                trace("authenticated salesrep stored in session");
                // redirect to index
                echo '<script type="text/javascript">window.location = "index.php"</script>';
                exit();
            } else {
                // password does not match
                return "Password does not match.";
            }
        } // if username and password are -1 process logout
        else if ($username == '-1' && $password == '-1') {
            session_unset();
            session_destroy();
            trace("user logged out, session destroyed");
            return "You have been logged out.";
        } else {
            trace("user already logged in.");
            echo '<script type="text/javascript">window.location = "index.php"</script>';
            exit();
        }

    }

    public function getCustList()
    {
        // connect to legacy datbase
        if (! isset($this->ldb)) { $this->ldb = new LegacyDB; }

        // return the customer list from the legacy database
        return $this->ldb->getCustList();
    }

    public function newQuote($salesrepid, $customer)
    {
        // connect to quote db
        if (! isset($this->qdb)) { $this->qdb = new QuoteDB; }

        // store quote in database and return a local copy
        return $this->qdb->newQuote($salesrepid, $customer);
    }

    public function addItem($item)
    {
        // connect to quote db
        if (! isset($this->qdb)) { $this->qdb = new QuoteDB; }

        // store item in database and return the generated id
        return $this->qdb->newItem($item);
    }

    public function updateItem($item)
    {
        // connect to quote db
        if (! isset($this->qdb)) { $this->qdb = new QuoteDB; }

        // update item
        $this->qdb->updateItem($item);
    }

    public function updateNote($note)
    {
        // connect to quote db
        if (! isset($this->qdb)) { $this->qdb = new QuoteDB; }

        // update note
        $this->qdb->updateNote($note);
    }


    public function addNote($note)
    {
        // connect to quote db
        if (! isset($this->qdb)) { $this->qdb = new QuoteDB; }

        // verify quote has been created, and data for the note exists
        return $this->qdb->newNote($note);
    }

    public function confirmEmail($quoteid, $email)
    {
        // connect to quote db
        if (! isset($this->qdb)) { $this->qdb = new QuoteDB; }

        // store email address and status for quote
        $this->qdb->confirmEmail($quoteid, $email);
        $this->sanctionQuote($quoteid);
    }

    public function sanctionQuote($quoteid)
    {
        // connect to quote db
        if (! isset($this->qdb)) { $this->qdb = new QuoteDB; }

        // sanction quote in database
        $this->qdb->sanctionQuote($quoteid, 1);
    }

    public function getCust()
    {
        return $_SESSION['quote']->customer;
    }

}

?>