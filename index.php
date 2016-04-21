<!DOCTYPE html>
<html lang="en">
<?php include "php/header.php"; ?>

<body role="document">

<?php include "php/navbar.php"; ?>

<?php
// preform the specified task, default to home if not logged in
trace(print_r($_REQUEST, true));
if (array_key_exists('action', $_REQUEST) && $_SESSION['salesrep']->id != -1) {
    $action = $_GET['action'];
}
else if ($_SESSION['salesrep']->id != -1) {
    $action = 'selectCust';
}
else {
    $action = 'authSalesRep';
}

include('gui/' . $action . '.php');
include "php/footer.php"; ?>

</body>
</html>