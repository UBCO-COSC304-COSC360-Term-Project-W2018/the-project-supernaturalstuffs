<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title></title>
	  <link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
      <link rel="stylesheet" href="../css/reset.css" />
      <link rel="stylesheet" href="../css/header-footer.css" />
      <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="../css/Product.css">
      <!--<script src="script.js"></script>-->
   </head>
   <body>
		<!--Include header-->
		<?php include '../../../src/server/include/header.php'; ?>
		<main>
			<!--Include ProductSidebar-->
			<?php include '../../../src/server/include/productSidebar.php'; ?>
			 <div id="contentRight">
				<?php
						include '../include/db_credentials.php';


						//connect to database
						try {
							$pdo = new PDO($dsn, $user, $pass, $options);
						} catch (\PDOException $e) {
							throw new \PDOException($e->getMessage(), (int)$e->getCode());
						}
						echo('<p id="sortButton">Sort by</p>
							<div id="box">');


							//check if All or another selection
							if(!(isset($_GET["filter"]))){
								$sql = 'SELECT * FROM Product';

							}else{
								$sql = 'SELECT * FROM Product WHERE pName LIKE "%' . $_GET["filter"] . '%" OR category LIKE "%' . $_GET["filter"] . '";';
							}

							$statement = $pdo->prepare($sql);
							$statement->execute();
							$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


							foreach ($rows as $row) {
								echo '<div class="productBox">';
								echo	'<a href="individualProducts.php"><img src="../images/ghostbusters-logo.png" alt="productimage"></a>';
								echo	'<p>' . $row["pName"] . '</p>';
								echo	'<p>' . $row["description"] . '</p>';
								echo	'<p>' . $row["price"] . '</p>';
								echo	'<p class="addCart"><a href=\'addToCart.php?id='.$row['pID'].'&name='.$row['pName'].'&price='.$row['price'].'\'>Add to Cart</a></p>';
								echo '</div>';
							}
						echo '</div>';
					?>
			</div>
		</main>
		<!--Footer include-->
		<?php include '../../../src/server/include/footer.php'; ?>
   </body>
   <foot>
   </foot>
</html>
