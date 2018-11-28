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
      <?php
        include '../include/db_credentials.php';

        try {
  				$pdo = new PDO($dsn, $user, $pass, $options);
  			} catch (\PDOException $e) {
  				throw new \PDOException($e->getMessage(), (int)$e->getCode());
  			}


          $productList = null;
          if (isset($_SESSION['productList'])){
          	$productList = $_SESSION['productList'];
            echo('<div id = "container">');
            echo('<div id = "shoppingcart">');
          	echo('<h1>Shopping Cart</h1>');


          	$total =0;
          	foreach ($productList as $name => $prod) {
              echo('<div class="items"/>');
              echo('<img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>');
              echo('<div class="productinfo">');
          		echo("<p>". $prod['pName'] . "</p>");
          		echo("<p>" . $prod['description'] . "</p>");

          		echo("<p>". $prod['quantity'] . "</p>");
          		$price = $prod['price'];
              echo '<input class ="button" type="button" name="remove" value="Remove" onclick="location.href="products.php"/>'

          		echo("<p>".str_replace("USD","$",money_format('%i',$price))."</p>");
          		//echo("<td align=\"right\">" . str_replace("USD","$",money_format('%i',$prod['quantity']*$price)) . "</td></tr>");
          		echo("</div>");
              echo("</div>");
          		$total = $total +$prod['quantity']*$price;
          	}
            echo("</div>");
            echo("</div>");

            echo ('<div id ="summary">');
            echo ('<h1>Summary</h1>');
            echo ('<div id ="totals">');
            echo ("<h3 id=\"total\"> Total:".$total. "</h3>");
            echo ('<div>
              <a href="checkout.php" ><p class="button">Continue Shooping</p></a>
              <a href="products.php" ><p class="button">Continue Shooping</p></a>

            </div>');
            echo ('</div>');
            echo ('</div>');

          } else{
          	echo("<H1>Your shopping cart is empty!</H1>");
            echo("<input class =\"button\" type=\"button\" name=\"continue\" value=\"Continue Shopping\" onclick=\"location.href=\"products.php\"/>");
          }

        ?>
      </div>
    </main>
    <!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>
  </body>

  <foot>
  </foot>
</html>
