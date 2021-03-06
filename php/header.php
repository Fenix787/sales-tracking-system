<?php session_start();
header('Content-type: text/html; charset=latin1_swedish_ci');
$version = "v0.4.7"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=latin1_swedish_ci">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="Sales quote creation system">
        <meta name="author" content="Undergrand Group 4">

        <title>Sales Tracking System <?php echo $version; ?></title>
        <!-- Bootstrap core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome core CSS -->
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Bootstrap Select core CSS -->
        <link href="../bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
        <!-- Bootstrap theme -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../bower_components/bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <link href="css/system.css" rel="stylesheet">
    </head>
<?php

ini_set('display_errors', 'On');
include "CreateQuote.php";

$logText = "";
$logCount = 0;

function trace($text)
{
    global $logText;
    global $logCount;
    $logCount++;
    $logText .= $logCount . ' |' . $text . '<br>';
}

$cqc = new CreateQuote;
trace("CreateQuote controller created");

if (!isset($_SESSION['quote'])) {
    $_SESSION['quote'] = new Quote;
    trace("empty quote stored in session");
}
if (!isset($_SESSION['salesrep'])) {
    $_SESSION['salesrep'] = new SalesRep(array());
    trace("empty salesrep stored in session");
}

?>