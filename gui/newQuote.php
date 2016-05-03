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
                        <td><input name="itemTitle" id="itemTitle" type="text" class="form-control" required/></td>
                        <td><input name="itemQty" id="itemQty" type="number" class="form-control" value="0" required/></td>
                        <td><input name="itemPrice" id="itemPrice" type="number" step="any" class="form-control" required/></td>
                        <td>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Add Item</button>
                        </td>
                    </form>
                </tr>

                <?php
                // zero out total
                $total = 0;

                // create formatter
                $formatter = new NumberFormatter('en_US',  NumberFormatter::CURRENCY);

                // display items
                foreach ($_SESSION['quote']->items as $item) {
                    echo '<tr>
                    <td>' . $item->title . '</td>
                    <td>' . $item->qty . '</td>
                    <td>' . $formatter->formatCurrency($item->price, 'USD') . '</td>
                    <td><form action="index.php?action=addItem&do=delete" method="POST"><input type="hidden" name="itemId" value="' . $item->id . '"><button class="btn btn-lg btn-primary btn-block" type="submit">Delete</button></form></td>
                    </form>
                  </tr>';
                    $total += $item->price * $item->qty;
                }
                echo '<tr><td></td><td>Total : </td><td>' . $formatter->formatCurrency($total, 'USD') . '</td><td></td></tr>';
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
                                      placeholder="Message" required></textarea></td>
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
                      </tr>
                      <tr>
                        <td>
                            <form action="index.php?action=addNote&do=delete" method="POST"><input type="hidden" name="noteId" value="' . $note->id . '"><button class="btn btn-lg btn-primary btn-block" type="submit">Delete</button></form>
                        </td>
                      </tr>';} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-2 col-md-offset-5 text-center">
            <form action="index.php?action=confirmEmail" method="POST">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Close Quote</button>
            </form>
        </div>
    </div>
</div>