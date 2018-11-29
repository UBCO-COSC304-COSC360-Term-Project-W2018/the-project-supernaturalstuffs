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

          	echo('<h1 id="title">Shopping Cart</h1>');
            echo('<div id = "shoppingcart">');

<<<<<<< HEAD
=======
            //trying to get image
            /*if(!isset($_GET["pID"])){
              echo "<script type='text/javascript'>window.location.href='products.php'</script>";
              die();
            }
            $sql = "SELECT * FROM Product WHERE pID =". $_GET["pID"];
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rows as $row) {
              $image = $row['image'];
              $type = "png";
            }*/
>>>>>>> b8faa6b49cea82d12a8847912b66b0a10c663973

          	$total =0;
          	foreach ($productList as $name => $prod) {

              $image = $prod['image'];
              $type = "png";

              echo('<div class="items"/>');
              //echo('<img class="image" src="../images/ghostbusters-logo.png" alt="product image"/>');
              //echo '<img class ="image" src = "data:image/'.$type.';base64, '.base64_encode($image).'"/>';
              echo	'<a href="individualProducts.php?pID='.$prod['pID'].'"><img class="image" src = "data:image/'.$type.';base64, '.base64_encode($image).'"/></a>';

              echo('<div class="productinfo">');
          		echo("<p>". $prod['pName'] . "</p>");
          		echo('<p id="desc">' . $prod['description'] . "</p>");

          		echo("<p>". $prod['quantity'] . "</p>");
          		$price = $prod['price'];

          		echo("<p>".str_replace("USD","$",money_format('%i',$prod['price']))."</p>");
          		//echo("<td align=\"right\">" . str_replace("USD","$",money_format('%i',$prod['quantity']*$price)) . "</td></tr>");
              //echo '<input class ="button" type="button" name="remove" value="Remove" onclick="location.href="products.php"/>';
              echo "<form  name='updateForm' method='get' action='UpdateQuantityCart.php' id='quantityForm'>";
                echo "<input type='number' name='quantity' id='quantityInput'/>";
                echo "<input class ='addCart' type='submit' name='update' value='Update' id='update'/>";
                echo "<input type='hidden' value='".$prod['pID']."' name='pID'/>";
              echo "</form>";
              echo("<a href='?pid=".$prod['pID']."'><p class=\"addCart\">Remove</p></a>");

            	echo("</div>");
              echo("</div>");
          		$total = $total +$prod['quantity']*$prod['price'];
          	}
            echo("</div>");
            echo("</div>");


            echo ('<div id ="summary">');
            echo ('<h1>Summary</h1>');
            echo ('<div id ="totals">');
            echo ("<p id=\"total\"> Total: $".$total. "</p>");
            echo ('<div>
              <a href="checkout.php" ><p class="addCart">Checkout</p></a>
              <a href="products.php" ><p class="addCart">Continue Shopping</p></a>
            </div>');
            echo ('</div>');
            echo ('</div>');

          } else{
          	echo("<H1>Your shopping cart is empty!</H1>");
            echo '<a href="products.php" ><p class="addCart">Continue Shopping</p></a>';
          }

          if(isset($_GET['pid'])){
            removeItem($productList);
          }

          function removeItem($productList){
            unset($productList[$_GET['pid']]);
            $_SESSION['productList'] = $productList;
            unset($_GET['pid']);
            echo "<script type='text/javascript'>window.location.href='cart.php'</script>";
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
