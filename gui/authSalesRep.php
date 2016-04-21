<?php
$username = isset($_POST['inputUsername']) ? $_POST['inputUsername'] : '';
$password = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : '';

$authMsg = '';

// check for logout tag
$do = isset($_REQUEST['do']) ? $_REQUEST['do'] : '';
if ($do == 'logout') {
    $authMsg = '<h3>' . $cqc->authSalesRep(-1, -1) . '</h3>';
} else if ($username != '' && $password != '') {
    $authMsg = '<h3>' . $cqc->authSalesRep($username, $password) . '</h3>';
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <form class="salesrepgui-form" action="index.php?action=authSalesRep" method="POST">
                <h2 class="salesrepgui-form-heading">Please sign in</h2>
                <?php echo $authMsg; ?>
                <label for="inputUsername" class="sr-only">Username</label>
                <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username"
                       required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="inputPassword" class="form-control"
                       placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </form>
        </div>
    </div>
</div>