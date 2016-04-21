<?php
/*
	SalesRepGUI Class
	
	This class provides functions to interact with the GUI

*/

class SalesRepGUI {
    
    public function authSalesRep() {

        // display login form
        echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">
      <form class="form-signin" action="index.php?action=authSalesRep" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div></div></div>';    
    }
        
    public function selectCust() {
        // get customers from session
        $customers = isset($_SESSION['customers']) ? $_SESSION['customers'] : array();
        
        // present list of customers
		echo '<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <h1>Select a customer</h1>
                <form class="form-signin" action="index.php?action=newQuote" method="POST">
            <select class="selectpicker form-control" name="customer" data-live-search="true">';
        
        foreach($customers as $customer) {
            echo "\n<option>" . $customer['name'] . "</option>";
        }

        echo '</select>
            <p><button class="btn btn-lg btn-primary btn-block" type="submit">Create Quote</button></p>
            </form></div></div></div>';
    }
    
    public function newQuote() {
        // init total
        $_SESSION['total'] = 0;
        
        // get customer
        $customer = isset($_SESSION['customer']) ? $_SESSION['customer'] : '';

        // title 
        echo '    <div class="container"><div class="row"><div class="col-md-12 text-center">
            <h1>New Quote for ' . $customer . '</h1></div></div>
            <div class="row"><div class="col-md-8 text-center">
            <h2>Items</h2>';
        // item display
        echo '<table class="table table-bordered table-condensed">
      <tbody>
        <tr>
          <td>Item</td>
          <td>Qty</td>
          <td>Price</td>
          <td>Save</td>
        </tr>
        <tr>
          <form action="index.php?action=addItem" method="POST">
          <td><input name="itemTitle" id="itemTitle" type="text" class="form-control" /></td>
          <td><input name="itemQty" id="itemQty" type="text" class="form-control" value=0 /></td>
          <td><input name="itemPrice" id="itemPrice" type="text" class="form-control" /></td>
          <td><button class="btn btn-lg btn-primary btn-block" type="submit">Add Item</button></td>
          </form>
        </tr>';
            
        // this is where we load items already in the quote
        $this->addItem();
        
        echo '<tr><td></td><td>Total : </td><td>$' . $_SESSION['total'] . '</td><td></td></tr>
        </tbody>
    </table>
    </div>';
    
        // note display
            
        echo '    <div class="col-md-4 text-center">
                        <h2>Notes</h2>
                        <table class="table table-bordered table-condensed">
                          <tbody>
                            <form action="index.php?action=addNote" method="POST">
                            <tr>
                              <td><input type="text" id="noteSubject" name="noteSubject" class="form-control" placeholder="Subject" required></td>
                            </tr>
                            <tr>
                              <td><textarea id="noteMessage" name="noteMessage" class="form-control" rows="5" placeholder="Message"></textarea></td>
                            </tr>
                            <tr>
                              <td><button class="btn btn-lg btn-primary btn-block" type="submit">Add Note</button></td>
                            </tr>
                            </form>';
                        
        // this is where we load notes already in the quote
        $this->addNote();
            
        echo '</tbody></form>
                        </table></div></div></div>
                        <div class="container"><div class="row"><div class="col-md-12 text-center">
                        <form action="index.php?action=confirmEmail" method="POST"><button class="btn btn-lg btn-primary btn-block" type="submit">Attach Email and Close Quote</button></form>
            </div></div>';
    }
    
    public function addItem() {
        $items = isset($_SESSION['items']) ? $_SESSION['items'] : array();
        foreach($items as $item) {
            echo '<tr>
                    <td>' . $item['title'] . '</td>
                    <td>' . $item['qty'] . '</td>
                    <td>$' . $item['price'] . '</td>
                    <td></td>
                    </form>
                  </tr>';
            $_SESSION['total'] += $item['price'] * $item['qty'];
        }
    }
    
    public function addNote() {
        $notes = isset($_SESSION['notes']) ? $_SESSION['notes'] : array();
        foreach($notes as $note) {
           echo '<tr>
                        <td>' . $note['subject'] . '</td>
                      </tr>
                      <tr>
                        <td>' . $note['message'] . '</td>
                      </tr>';
        }
    }
    
    public function confirmEmail() {
        // display form to enter email address
        echo '<div class="container"><div class="row"><div class="col-lg-12 text-center">
                    <form class="form-signin" action="index.php?action=confirmEmail" method="POST">
                    <h2>Customer Contact</h2>
                    <label for="inputEmail" class="sr-only">Email Address</label>
                    <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Enter email" required autofocus>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Finish Quote</button>
                    </form>
                    </div></div></div>';
    } 
}

?>