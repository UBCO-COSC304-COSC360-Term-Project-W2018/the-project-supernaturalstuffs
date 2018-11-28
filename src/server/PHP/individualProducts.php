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
	<?php include '../../../src/server/include/header.php'; ?>
    <main>
          <?php
            echo '<div id = "container">';
            echo '<div id ="productbox">';
              $image = $_GET['img'];
              $type = "png";
            echo '<img class="image" src = "data:image/'.$type.';base64, '.base64_encode($image).'"/>';

            echo '</div>';
            echo '<div id="reviews">';
            echo  '<h1>Reviews</h1>';
                echo '<img id="star" src="../images/star.png" alt="rating image"/>';
            echo '</div>';
            echo '</div>';


          $pID = $_GET['pID'];
          $pName = $_GET['pName'];
          $price = $_GET['price'];
          $desc = $_GET['description'];

          echo '<div id ="box">';
          echo '<div class="productinfo">';
          echo "<p>". $pName . "</p>";
          echo "<p>". $desc . "</p>";
          echo "<p>". $price . "</p>";
          echo	'<a href=\'addToCart.php?pID='.$row['pID'].'&pName='.$row['pName'].'&price='.$row['price']."&description=".$row['description'].'\'><p class="addCart">Add to Cart</p></a>';
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
