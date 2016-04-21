<div class="container"><div class="row"><div class="col-lg-12 text-center">
      <form class="salesrepgui-form" action="index.php?action=authSalesRep" method="POST">
        <h2 class="salesrepgui-form-heading">Please sign in</h2>
        <h3><?php
              $username = isset($_POST['inputUsername']) ? $_POST['inputUsername'] : '';
              $password = isset($_POST['inputPassword']) ? $_POST['inputPassword'] : '';

              if ($username != '' && $password != '') {
                echo $cqc->authSalesRep($username,$password);
                }
        ?></h3>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
      <form class="salesrepgui-form" action="index.php?action=authSalesRep" method="POST">
      <input type="hidden" name="inputUsername" value="-1">
      <input type="hidden" name="inputPassword" value="-1">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Logout</button>
      </form>
</div></div></div>