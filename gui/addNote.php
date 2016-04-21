<?php
$noteSubject = isset($_POST['noteSubject']) ? $_POST['noteSubject'] : '';
$noteMessage = isset($_POST['noteMessage']) ? $_POST['noteMessage'] : '';

// verify that we have data for subject and message
if ($noteSubject != '' && $noteMessage != '' && $_SESSION['quote']->id != -1) {
    // build the input into a new note object
    $note = new Note(array('id' => -1, 'quoteid' => $_SESSION['quote']->id, 'subject' => $noteSubject, 'message' => $noteMessage));

    // pass data to controller
    $note->id = $cqc->addNote($note);

    // store note is session
    $_SESSION['quote']->notes[$note->id] = $note;
}

// display the quote
include("newQuote.php");
?>
