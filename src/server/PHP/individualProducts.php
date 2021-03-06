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


            if(!isset($_GET["pID"])){
              echo "<script type='text/javascript'>window.location.href='products.php'</script>";
              die();

            }

            $sql = "SELECT * FROM Product WHERE pID =". $_GET["pID"];
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

            echo '<div id = "container">';
            foreach ($rows as $row) {
              $pID = $row['pID'];
              $image = $row['image'];
              $type = "png";
              $name = $row["pName"];
              $price = $row["price"];
              $desc = $row["description"];
            }

              echo '<div id = "productbox">';
              echo '<img class ="image" src = "data:image/'.$type.';base64, '.base64_encode($image).'"/>';
              echo '</div>';

              echo '<div id="reviews">';
              echo '<h1>Comments</h1>';
              $sql = 'SELECT * FROM CommentsOn WHERE pID = '.$pID.'';
              $statement = $pdo->prepare($sql);
              $statement->execute();
              $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);

              foreach ($rows2 as $row2) {
                $uID = $row2['userID'];

                $sql = 'SELECT username FROM User WHERE userID = '.$uID.'';
                $statement = $pdo->prepare($sql);
                $statement->execute();
                $rows3 = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows3 as $row3) {
                  $user = $row3['username'];
                }
                echo '<p>' . $user . ": ". $row2['comment'] . '</p>';
              }
              echo '<form class="review" method="post" action="reviews.php?id='.$pID.'">';
              echo '<div>';
              echo '<p>Write a comment: </p>';
              echo '<input type="text" id="textbox" name="comment"/>';
              echo '</div>';
              echo '<input type ="submit" value="Submit" class="addCart" id="margin">';
              echo '</form>';
              echo '</div>';


              echo '</div>';

              echo '<div id ="box">';
              echo '<div class="productinfo">';
              echo	'<h1>' . $name . '</h1>';
              echo	'<p>$' . $price . '</p>';
              echo	'<p>' . $desc . '</p>';
              echo	'<a href=\'addToCart.php?pID='.$row['pID'].'&pName='.$row['pName'].'&price='.$row['price']."&description=".$row['description'].'\'><p class="addCart">Add to Cart</p></a>';
              echo '<a href="products.php" ><p class="addCart">Continue Shopping</p></a>';
              echo '</div>';
              echo '</div>';

          ?>

    </main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>
  </body>

  <foot>
  </foot>
</html>
