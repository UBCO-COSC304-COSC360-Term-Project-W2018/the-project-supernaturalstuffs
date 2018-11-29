<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
	<link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" href="../css/individualProducts.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
		<!--<script src="script.js"></script>-->
  </head>

  <body>
	<!--Include header-->
    <main>
          <?php
            include '../../../src/server/include/header.php';

            //connect to database
						try {
							$pdo = new PDO($dsn, $user, $pass, $options);
						} catch (\PDOException $e) {
							throw new \PDOException($e->getMessage(), (int)$e->getCode());
						}


            if(isset($_GET["pID"])){
              $sql = "SELECT * FROM Product WHERE pID =". $_GET["pID"];

            }else{
              echo "<script type='text/javascript'>window.location.href='products.php'</script>";
              die();
            }

            $statement = $pdo->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            echo '<div id = "container">';
            foreach ($rows as $row) {
              $image = $row['image'];
              $type = "png";
              $name = $row["pName"];
              $price = $row["price"];
              $desc = $row["description"];
            }

              echo '<div id = "productbox">';
              echo "<img class='image' src = 'data:image/".$type.";base64, ".base64_encode($image)."/>";
              echo '</div>';

              echo '<div id="reviews">';

              echo  '<h1>Reviews</h1>';
                echo '<img id="star" src="../images/star.png" alt="rating image"/>';
              echo '</div>';

              echo '</div>';
              echo '<div id ="box">';
              echo '<div class="productinfo">';
              echo	'<p>' . $name . '</p>';
              echo	'<p>' . $price . '</p>';
              echo	'<p>' . $desc . '</p>';
              echo	'<a class = "addCart" href=\'addToCart.php?pID='.$row['pID'].'&pName='.$row['pName'].'&price='.$row['price']."&description=".$row['description'].'\'><p class="addCart">Add to Cart</p></a>';
              echo '</div>';
              echo '</div>';


/*
          $pID = $_GET['pID'];
          $pName = $_GET['pName'];
          $price = $_GET['price'];
          $desc = $_GET['description'];

          echo '<div id ="box">';
          echo '<div class="productinfo">';
          echo "<p>". $pName . "</p>";
          echo "<p>". $desc . "</p>";
          echo "<p>". $price . "</p>";
          echo	'<a href=\'addToCart.php?pID='.$pID.'&pName='.$pName.'&price='.$price."&description=".$desc.'\'><p class="addCart">Add to Cart</p></a>';
          echo '</div>';
          echo '</div>';*/
          ?>

    </main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>
  </body>

  <foot>
  </foot>
</html>
