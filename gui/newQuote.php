<?php
$inputCustomer = isset($_POST['inputCustomer']) ? $_POST['inputCustomer'] : '';

// on first load inputCustomer is passed in and a new quote needs to be created in the database
if ($inputCustomer != '') {
    $_SESSION['quote']->customer = $inputCustomer;
    $_SESSION['quote']->salesrep = $_SESSION['salesrep']->id;
    $_SESSION['quote']->id = $cqc->newQuote($_SESSION['salesrep']->id, $inputCustomer);
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>New Quote for <?php echo $_SESSION['quote']->customer; ?> </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 text-center">
            <h2>Items</h2>
            <table class="table table-bordered table-condensed">
                <tbody>
                <tr>
                    <td>Item</td>
                    <td>Qty</td>
                    <td>Price</td>
                    <td>Save</td>
                </tr>
                <tr>
                    <form action="index.php?action=addItem" method="POST">
                        <td><input name="itemTitle" id="itemTitle" type="text" class="form-control"/></td>
                        <td><input name="itemQty" id="itemQty" type="text" class="form-control" value=0/></td>
                        <td><input name="itemPrice" id="itemPrice" type="text" class="form-control"/></td>
                        <td>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Item</button>
                        </td>
                    </form>
                </tr>

                <?php $total = 0;
                foreach ($_SESSION['quote']->items as $item) {
                    echo '<tr>
                    <td>' . $item->title . '</td>
                    <td>' . $item->qty . '</td>
                    <td>$' . $item->price . '</td>
                    <td></td>
                    </form>
                  </tr>';
                    $total += $item->price * $item->qty;
                }
                echo '<tr><td></td><td>Total : </td><td>$' . $total . '</td><td></td></tr>';
                ?>
                </tbody>
            </table>
        </div>


        <div class="col-md-4 text-center">
            <h2>Notes</h2>
            <table class="table table-bordered table-condensed">
                <tbody>
                <form action="index.php?action=addNote" method="POST">
                    <tr>
                        <td><input type="text" id="noteSubject" name="noteSubject" class="form-control"
                                   placeholder="Subject" required></td>
                    </tr>
                    <tr>
                        <td><textarea id="noteMessage" name="noteMessage" class="form-control" rows="5"
                                      placeholder="Message"></textarea></td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Note</button>
                        </td>
                    </tr>
                </form>
                <?php foreach ($_SESSION['quote']->notes as $note) {
                    echo '<tr>
                        <td>' . $note->subject . '</td>
                      </tr>
                      <tr>
                        <td>' . $note->message . '</td>
                      </tr>';
                } ?>
                </tbody>
                </form>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <form action="index.php?action=confirmEmail" method="POST">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Attach Email and Close Quote</button>
            </form>
        </div>
    </div>
</div>