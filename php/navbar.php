<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Sales Tracking System
                <small><?php echo $version; ?></small>
            </a>
        </div>
        <ul class="nav navbar-nav">
            <?php
            if ($_SESSION['salesrep']->id == -1) {
                echo '<li><a href="index.php?action=authSalesRep">Login</a></li>';
            } else {
                echo '<li><a href="index.php?action=authSalesRep&do=logout">Logout</a></li>';
                if ($_SESSION['quote']->id == -1) {
                    echo '<li><a href="index.php?action=selectCust">Create New Quote</a></li>';
                } else {
                    echo '<li><a href="index.php?action=newQuote">View Quote</a></li>' . "\n" .
                        '<li><a href="index.php?action=confirmEmail">Close Quote</a></li>';
                }
            } ?>
        </ul>
    </div>
</nav>