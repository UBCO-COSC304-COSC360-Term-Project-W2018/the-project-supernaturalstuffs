<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Account Details</title>
	<link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../css/accountDetails.css" />
    <link rel="stylesheet" type="text/css" href="../css/form.css">
    <script type="text/javascript" src="../script/savePayment.js"></script>
    <script type="text/javascript" src="../script/changePass.js"></script>
		<!--<script src="script.js"></script>-->
  </head>

  <body>
    <!--Include header-->
	<?php include '../../../src/server/include/header.php'; ?>
    <!--Main content of page-->
    <main>
      <div id="flex-conatiner">
		<div id="flexItem">
			<div id="accountDetails">
			  <h2>Account Details</h2>

			  <div id="orderHistory">
				<h3>Order History</h3>
				<div id="pastOrder">

          <?php

            include '../include/db_credentials.php';

            $custE = null;
            if (isset($_SESSION['email'])){
               $custE = $_SESSION['email'];
             }else{
               header('Location: login.php');
             }

             try {
                 $pdo = new PDO($dsn, $user, $pass, $options);
             } catch (\PDOException $e) {
                 throw new \PDOException($e->getMessage(), (int)$e->getCode());
             }

            //get userID from session
            $sql = "SELECT userID FROM User WHERE email = :email";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':email', $custE, PDO::PARAM_STR);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {}

            $userID = $row['userID'];

            //get all orders from $userID
            $sql = "SELECT orderID, totalPrice, trackingNumber FROM Orders WHERE userID = :userID ORDER BY orderID DESC";
            $statement = $pdo->prepare($sql);
            $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            //find number of rows
            $numRows = 0;
            foreach ($rows as $row) {
              $numRows = $numRows + 1;
            }
            if($numRows > 0){
              echo("<table>");
              echo("<tr><th>Order ID</th><th>Total Price</th><th>Tracking Number</th></tr>");
              foreach ($rows as $row) {
                echo("<tr><td>".$row['orderID']."</td><td>".$row['totalPrice']."</td><td>".$row['trackingNumber']."</td></tr>");
                //add products here
              }
              echo("</table>");
            }else{
              echo("<p>You have never placed an order before!</p>");
            }
          ?>
				</div>
			  </div>

			  <div id="paymentInfo">
				<h3>Payment Info</h3>
  				<form class="Main" name="savePayment" method="post" action="savePayment.php" id="savePayment" onsubmit="return checkPayment()">
  				  <fieldset>
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
      						<input type="submit" name="submit" value="Save Card" class="button"/>
    					  </div>
    					</div>
  				  </fieldset>
  				</form>
			  </div>

			  <div id="changePassBlock">
				<h3>Change Password</h3>
				<form name="changePassword" class="Main" id="changePass" method="post" action="changePass.php" onsubmit="return checkPass()">
				  <fieldset>
  					<div>
  					  <label>Current Password:</label>
  					  <input type="password" name="curPassword" class="box"/>
  					</div>
  					<div>
  					  <label>New Password:</label>
  					  <input type="password" name="newPassword" class="box"/>
  					</div>
  					<p class="notes">Password must be 6 characters long and contain a number</p>
  					<div>
  					  <label>Confirm Password:</label>
  					  <input type="password" name="cPassword" class="box"/>
  					</div>
  					<div class="centered">
  					  <input type="submit" value="Change Password" class="button"/>
  					</div>
				  </fieldset>
				</form>
			  </div>

			  <p id="signout"><a href="logout.php">Sign Out</a></p>

			</div>
		<div>

		<div id="flexItem2">
			<div id = "shoppingcart">
			  <h2>Wish List</h2>

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

      <?php
      $sql = "SELECT image FROM User where email = :email";
      $statement = $pdo->prepare($sql);
      $statement->bindParam(':email', $custE, PDO::PARAM_STR);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {}

      $image = $row['image'];
      $type = "png";
      echo '<img src = "data:image/'.$type.';base64, '.base64_encode($image).'"/>';

      ?>
    </main>

    <?php include '../../../src/server/include/footer.php' ?>
  </body>

  <foot>
  </foot>
</html>
