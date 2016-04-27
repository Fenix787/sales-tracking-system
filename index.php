<?php
include_once "SalesRepDB.php";
include_once "LegacyDB.php";
include_once "QuoteDB.php";

// header
include "php/header.php";

// navbar
include "php/navbar.php";

// preform the specified task, default to home if not logged in
if (isset($_GET['action']) && $_SESSION['salesrep']->id != -1) {
    $action = $_GET['action'];
}
else if ($_SESSION['salesrep']->id != -1) {
    $action = 'selectCust';
}
else {
    $action = 'authSalesRep';
}

// body
include('gui/' . $action . '.php');

// trace request
trace(print_r($_REQUEST, true));

// print trace
//  uncomment this line to debug only, it is possible that a PDO exception could
//  cause the username and password used to connect to the mysql server to be displayed.
//echo '<pre>' . $logText . '</pre>';

// footer
include "php/footer.php";
?>