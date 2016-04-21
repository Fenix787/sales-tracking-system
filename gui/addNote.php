<?php
$noteSubject = isset($_POST['noteSubject']) ? $_POST['noteSubject'] : '';
$noteMessage = isset($_POST['noteMessage']) ? $_POST['noteMessage'] : '';
$noteId = isset($_POST['noteId']) ? $_POST['noteId'] : 0;
$do = isset($_REQUEST['do']) ? $_REQUEST['do'] : '';

// verify that we have data for subject and message
if ($noteSubject != '' && $noteMessage != '' && $_SESSION['quote']->id != -1) {
    // build the input into a new note object
    $note = new Note(array('id' => -1, 'quoteid' => $_SESSION['quote']->id, 'subject' => $noteSubject, 'message' => $noteMessage));

    // pass data to controller
    $note->id = $cqc->addNote($note);

    // store note in session
    $_SESSION['quote']->notes[$note->id] = $note;
}
else if ($do == "delete" && $noteId != 0) {
    // remove item from db and session
    $cqc->updateNote(new Note(array('id' => $noteId, 'quoteid' => -1)));
    unset($_SESSION['quote']->notes[$noteId]);
    trace("removed note from db and session");
}


// display the quote
include("newQuote.php");
?>
