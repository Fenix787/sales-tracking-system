<?php
include_once "SalesRepDB.php";
include_once "LegacyDB.php";
include_once "QuoteDB.php";

include "php/header.php";
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

include('gui/' . $action . '.php');

// trace request
trace(print_r($_REQUEST, true));

// print trace
echo '<pre>' . $logText . '</pre>';
include "php/footer.php";
?>