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
    <header>
			<h1><a href="../../../index.html"><img src="../images/logo.png">Super(natural) Store</a></h1>
			<div id="search-cart">
				<input type="text" class="searchHome" placeholder="Search...">
				<img src="../images/search.png" alt="search" id="search">
				<a href="cart.html"><img src="../images/cart.png" alt="shopping cart" id="cart"></a>
			</div>
			<nav>
				<ul>
					<li><a href="../../../index.html">Home</a></li>
					<li><a href="contact-FAQ.html">Contact</a></li>
					<li><a href="accountDetails.html">Account</a></li>
				</ul>
				<ul id="login-signup">
					<li><a href="login.html" class="login-signup">Login</a></li>
					<li><a href="createAccount.html" class="login-signup">Signup</a></li>
				</ul>
			</nav>
		</header>
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
            include 'include/db_credentials.php';

            /** Get customer id most likely in session**/
            /*session_start();
            $userID = null;
            if (isset($_SESSION['userID'])) {
                $custE = $_POST['email'];
            }*/


            try {
                $pdo = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
          ?>

				  <p>You have never placed an order before!</p>
				</div>
			  </div>

			  <div id="paymentInfo">
				<h3>Payment Info</h3>
  				<form name="savePayment" method="post" action="http://www.randyconnolly.com/tests/process.php" id="savePayment" onsubmit="return checkPayment()">
  				  <fieldset>
    					<div id="payment">
    					  <div>
      						<label>Payment Method:</label>
      						<select id="payMethod">
      						  <option>Visa</option>
      						  <option>Mastercard</option>
      						  <option>American Express</option>
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

			  <div id="orderHistory">
				<h3>Change Password</h3>
				<form name="changePassword" id="changePass" method="post" action="http://www.randyconnolly.com/tests/process.php" onsubmit="return checkPass()">
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

			  <p id="signout"><a href="login.html">Sign Out</a></p>

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
    </main>

    <footer>
      <div id="topF">
        <div id="detailFooter">
          <a href="contact-FAQ.html"><p>Find a store</p></a>
          <a href="#"><p>Sign up for emails</p></a>
          <a href="contact-FAQ.html"><p>Contact</p></a>
        </div>
        <div class="socials">
          <a href="https://www.facebook.com"><img src="../images/Facebook.png" alt="Facebook link"></a>
          <a href="https://www.youtube.com"><img src="../images/YouTube.png" alt="Youtube link"></a>
          <a href="https://www.instagram.com"><img src="../images/Instagram.png" alt="Instagram link"></a>
          <a href="https://www.twitter.com"><img src="../images/Twitter.png" alt="Twitter link"></a>
        </div>
      </div>
      <div id="bottom">
        <p> &copy; 2017-2018, Super(natural) Store, inc. All Rights Reserved</p>
        <p>Terms of Use</p>
        <p>Privacy Policy</p>
      </div>
    </footer>
  </body>

  <foot>
  </foot>
</html>
