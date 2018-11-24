<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
	<link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/cart.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
		<!--<script src="script.js"></script>-->
  </head>

  <body>
	<!--Include header-->
	<?php include '../../../src/server/include/header.php'; ?>
    <!-- page content delete button -->
    <main>
      <div id="flex">
        <div id="container">
          <div id = "shoppingcart">
            <h1>Shopping Cart</h1>

            <div class="items"/>
              <img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>
              <div class="productinfo">
                <p>Product name</p>
                <p>Desciption</p>
                <p>Price</p>
                <p>Quantity</p>
                <input class ="button" type="button" name="delete" value="Delete" />
              </div>
            </div>

            <div class="items"/>
              <img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>
              <div class="productinfo">
                <p>Product name</p>
                <p>Desciption</p>
                <p>Price</p>
                <p>Quantity</p>
                <input class ="button" type="button" name="delete" value="Delete" />
              </div>
            </div>

            <div class="items"/>
              <img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>
              <div class="productinfo">
                <p>Product name</p>
                <p>Desciption</p>
                <p>Price</p>
                <p>Quantity</p>
                <input class ="button" type="button" name="delete" value="Delete" />
              </div>
            </div>

          </div>
        </div>


        <div id ="summary">
            <h1>Summary</h1>
            <div id = "totals">
              <p class="money">Subtotal: </p>
              <p class="money">Delivery: </p>
              <p class="money">Taxes: </p>
              <h3 id="total">Total: </h3>
              <div>
                <input class ="button" type="button" name="continue" value="Continue Shopping" onclick="location.href='products.html'"/>
                <input class ="button" type="button" name="checkout" value="Checkout" onclick="location.href='checkout.html'"/>
              </div>
            </div>
        </div>

      </div>
    </main>
    <!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>
  </body>

  <foot>
  </foot>
</html>
