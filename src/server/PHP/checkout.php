<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
<link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <link rel="stylesheet" type="text/css" href="../css/checkout.css">
		<script type="text/javascript" src="../script/checkout-shipment.js"></script>
    <script type="text/javascript" src="../script/checkout-payment.js"></script>
  </head>

  <body>
   <!--Include header-->
	<?php
      session_start();

      include '../../../src/server/include/header.php';

      $custE = null;
      if (isset($_SESSION['email'])){
         $custE = $_SESSION['email'];
       }else{
         header('Location: login.php');
       }
   ?>
    <main>
      <!-- page content -->
      <!--Checkout Forms-->
      <div id="flex-container">
        <div id="formBox">
          <!--Shipment Form-->
          <form class="Main" name="shipForm" method="post" action="http://www.randyconnolly.com/tests/process.php" onsubmit="return checkShipping()" id="shipForm">
            <fieldset>
              <legend>Shipment</legend>
              <div id="shipment">
                <div id="name">
                  <div>
                    <label>First Name:</label>
                    <input type="text" name="fName" class="box"/>
                  </div>
                  <div>
                    <label>Last Name:</label>
                    <input type="text" name="lName" class="box"/>
                  </div>
                </div>
                <div id="address">
                  <div>
                    <label>Country:</label>
                    <input type="text" name="country" class="box"/>
                  </div>
                  <div>
                    <label>Province:</label>
                    <input type="text" name="province" class="box"/>
                  </div>
                  <div>
                    <label>Town:</label>
                    <input type="text" name="town" class="box"/>
                  </div>
                  <div>
                    <label>Street:</label>
                    <input type="text" name="street" class="box"/>
                  </div>
                  <div>
                    <label>Postal Code:</label>
                    <input type="text" name="postalCode" class="box"/>
                  </div>
                  <p class="notes">Format: A#A #A#</p>
                </div>
                <div id="contactInfo">
                  <div>
                    <label>Phone Number:</label>
                    <input type="text" name="phoneNum" class="box"/>
                  </div>
                  <p class="notes">Format: X-XXX-XXX-XXXX</p>
                  <div>
                    <label>Email:</label>
                    <input type="text" name="email" class="box"/>
                  </div>
                </div>
                <div id="shipmentMethod">
                  <label>Select Delivery Method</label><br/>
                  <input type="radio" name="delivery" value="standard ($0.00)" checked="checked">Standard<br/>
                  <input type="radio" name="delivery" value="drone ($100.00)">Drone<br/>
                  <input type="radio" name="delivery" value="Instantaneous ($250.00)">Instantaneous
                </div>
                <div class="centered">
                  <input type="submit" value="Continue To Payment" class="button" />
                </div>
              </div>
            </fieldset>
          </form>
          <!--Payment Form-->
          <form class="Main" name="payForm" method="post" action="checkoutNewPayment.php" id="payForm" onsubmit="return checkPayment()">
            <fieldset>
              <legend>Payment</legend>
              <!--</form>-->
              <div id="payment">
                <div>
                  <label>Payment Method:</label>
      						<select name="payMethod" id="payMethod">
      						  <option value="Visa">Visa</option>
      						  <option value="Mastercard">Mastercard</option>
      						  <option value="American Express">American Express</option>
      						</select>
                </div>
                <div>
                  <label>Name On Card:</label>
                  <input type="text" name="cardName" class="box"/>
                </div>
                <div>
                  <label>Card Number:</label>
                  <input type="text" name="cardNumber" class="box"/>
                </div>
                <div>
                  <label>Expiration Date:</label>
                  <input type="month" name="exDate" class="box"/>
                </div>
                <div>
                  <label>Security Code:</label>
                  <input type="text" name="secCode" class="box"/>
                </div>
                <p class="notes">Format: XXX</p>
                <div class="centered">
                  <input type="submit" value="Confirm Checkout" class="button"/>
                </div>
              </div>
            </fieldset>
        </form>
        </div>

        <div id="right-side">
          <div id="summary">
            <h2>Summary</h2>
            <div class="summary1">
              <p class="money">Subtotal:</p>
              <p class="money">Delivery:</p>
              <p class="money">Taxes:</p>
              <p class="total">Total:</p>
            </div>
            <div class="summary2">
              <p class="money">$2000.00 </p>
              <p class="money">$100.00 </p>
              <p class="money">$252.00</p>
              <p class="total">$2352.00</p>
            </div>
            <div class="centered">
              <input type="button" onclick="location.href='products.html'" value="Continue Shopping" class="button"/>
            </div>
          </div>

          <div id = "shoppingcart">
            <h2>Shopping Cart</h2>
            <div class="items">
              <img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>
              <div class="productinfo">
                <p>Product name:</p>
                <p>Desciption:</p>
                <p>Price:</p>
                <p>Quantity:</p>
                <input class ="button" type="button" name="delete" value="Delete" />
              </div>
            </div>

            <div class="items">
              <img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>
              <div class="productinfo">
                <p>Product name:</p>
                <p>Desciption:</p>
                <p>Price:</p>
                <p>Quantity:</p>
                <input class ="button" type="button" name="delete" value="Delete" />
              </div>
            </div>

            <div class="items">
              <img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>
              <div class="productinfo">
                <p>Product name:</p>
                <p>Desciption:</p>
                <p>Price:</p>
                <p>Quantity:</p>
                <input class ="button" type="button" name="delete" value="Delete" />
              </div>
            </div>
          </div>
        </div>

      </div>
    </main>
    <?php include '../../../src/server/include/footer.php'; ?>
  </body>

  <foot>
  </foot>
</html>
