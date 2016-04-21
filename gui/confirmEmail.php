<?php
$inputEmail = isset($_POST['inputEmail']) ? $_POST['inputEmail'] : '';

// on first load inputCustomer is passed in and a new quote needs to be created in the database
if ($inputEmail != '') {
    $cqc->confirmEmail($_SESSION['quote']->id, $inputEmail);
    
    // clear data from the previous entry
    $_SESSION['quote'] = new Quote();

    // redirect back to home
    echo '<script>window.location = "index.php";</script>';
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <form class="salesrepgui-form" action="index.php?action=confirmEmail" method="POST">
                <h2>Customer Contact</h2>
                <label for="inputEmail" class="sr-only">Email Address</label>
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Enter email"
                       required autofocus>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Finish Quote</button>
            </form>
        </div>
    </div>
</div>