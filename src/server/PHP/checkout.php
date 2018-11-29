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
      include '../../../src/server/include/header.php';

      $custE = null;
      if (isset($_SESSION['email'])){
         $custE = $_SESSION['email'];
      }else{
         header('Location: login.php');
      }
      //unset session payInfo after checkout

      //create a dummy Cart
      try {
          $pdo = new PDO($dsn, $user, $pass, $options);
      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }

      if (isset($_SESSION['productList'])) {
        $cart = $_SESSION['productList'];
      } else {
        $cart = null;
        $message = "cant checkout with an empty cart";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='products.php'</script>";
      }

      $total = 0;
      if ($cart == null) {
          $message = "You need to add items to your cart";
          echo "<script type='text/javascript'>alert('$message');
      	window.location.href='products.php'</script>";
      	die();
      } else {
          foreach ($cart as $pID => $cartitem) {
              $total = $total + $cartitem['quantity']*$cartitem['price'];
          }
      }

   ?>
    <main>
      <!-- page content -->
      <!--Checkout Forms-->
      <div id="flex-container">
        <div id="formBox">
          <!--Shipment Form-->
          <form class="Main" name="shipForm" method="post" action="checkoutShipping.php" onsubmit="return checkShipping()" id="shipForm">
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
                  <input type="radio" name="delivery" value="0.00" checked="checked">Standard(+$0.00)<br/>
                  <input type="radio" name="delivery" value="100.00">Drone(+$100.00)<br/>
                  <input type="radio" name="delivery" value="250.00">Instantaneous(+$250.00)
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
              <div id='payment'>
                <?php
                if(isset($_SESSION['next'])){
                  echo "<script type='text/javascript'>document.getElementById('payment').classList.remove('hide')</script>";
                  echo "<script type='text/javascript'>document.getElementById('shipment').classList.add('hide')</script>";
                  unset($_SESSION['next']);
                }else{
                  echo "<script type='text/javascript'>document.getElementById('payment').classList.add('hide')</script>";
                  echo "<script type='text/javascript'>document.getElementById('shipment').classList.remove('hide')</script>";
                }

                   ?>
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
        <!--set user info session payInfo to null-->

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
              <?php
                $delivery = "0.00";
                if(isset($_SESSION['shipInfo']['delivery'])){
                  $delivery = $_SESSION['shipInfo']['delivery'];
                }
                $tax=($total+$delivery)*'0.12';
                echo("<p class='money'>$". str_replace("USD","$",money_format('%i',$total)) ."</p>");
                echo("<p class='money'>$". str_replace("USD","$",money_format('%i',$delivery)) ." </p>");
                echo("<p class='money'>$".str_replace("USD","$",money_format('%i',$tax))."</p>");
                $total=($total + $delivery + $tax);
                echo("<p class='total'>$".str_replace("USD","$",money_format('%i',$total))."</p>");
               ?>
            </div>
            <div class="centered">
              <input type="button" onclick="location.href='products.php'" value="Continue Shopping" class="button"/>
            </div>
          </div>

          <div id = "shoppingcart">
            <h2>Shopping Cart</h2>
            <?php
            if (isset($_SESSION['productList'])){
              foreach ($cart as $pID => $cartitem){
                echo "<div class='items'>";
                  echo "<img class='image' src='../images/ghostbusters-logo.png'alt='product image'/>";
                  echo "<div class='productinfo'>";
                    echo "<p>Product name: ".$cartitem['pName']."</p>";
                    echo "<p>Price: ".str_replace("USD","$",money_format('%i',$cartitem['price']))."</p>";
                    echo "<p>Quantity: ".$cartitem['quantity']."</p>";
                    echo "<input class ='button' type='button' name='delete' value='delete' onclick='href=\"?pID='".$cartitem['pID']."'\"/>";
                    // onclick='href=?id=".$cartitem['pID']."' made me mad
                  echo "</div>";
                echo "</div>";
              }
            }else{
              echo("<p>Your shopping cart is empty!</p>");
            }

            //remove item
            if(isset($_GET['pID'])){
            	removeItem($productList);
            }

            function removeItem($productList){
            	unset($productList[$_GET['pID']]);
            	$_SESSION['productList'] = $productList;
              unset($_GET['pID']);
            	header('Location: checkout.php');
            }
             ?>

          </div>
        </div>

      </div>
    </main>
    <?php include '../../../src/server/include/footer.php'; ?>
  </body>

  <foot>
  </foot>
</html>
