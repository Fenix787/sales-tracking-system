<?php
$itemTitle = isset($_POST['itemTitle']) ? $_POST['itemTitle'] : '';
$itemQty = isset($_POST['itemQty']) ? $_POST['itemQty'] : 0;
$itemPrice = isset($_POST['itemPrice']) ? $_POST['itemPrice'] : 0;
$itemId = isset($_POST['itemId']) ? $_POST['itemId'] : 0;
$do = isset($_REQUEST['do']) ? $_REQUEST['do'] : '';

// verify that we have data for subject and message
if ($itemTitle != '' && $itemQty != '' && $itemPrice != '' && $_SESSION['quote']->id != -1) {
    // build the input into a new item object
    $item = new Item(array('id' => -1, 'quoteid' => $_SESSION['quote']->id, 'title' => $itemTitle, 'qty' => $itemQty, 'price' => $itemPrice));

    // pass data to controller
    $item->id = $cqc->addItem($item);

    // store item in session
    $_SESSION['quote']->items[$item->id] = $item;
    trace("created new item and stored in db and session");
}
else if ($do == "delete" && $itemId != 0) {
    // remove item from db and session
    $cqc->updateItem(new Item(array('id' => $itemId, 'quoteid' => -1)));
    unset($_SESSION['quote']->items[$itemId]);
    trace("removed item from db and session");
}

// display the quote
include("newQuote.php");
?>