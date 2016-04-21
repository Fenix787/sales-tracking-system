<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1>Select a customer</h1>
            <form class="salesrepgui-form" action="index.php?action=newQuote" method="POST">
                <select class="selectpicker form-control" name="inputCustomer" data-live-search="true">';
                    <?php
                    // check session for customer list
                    $customers = isset($_SESSION['customers']) ? $_SESSION['customers'] : $cqc->getCustList();

                    foreach ($customers as $customer) {
                        echo "\n<option>" . $customer['name'] . "</option>";
                    }
                    ?>
                </select>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Create Quote</button>
            </form>
        </div>
    </div>
</div>