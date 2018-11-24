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
				<p id="sortButton">Sort by</p>
				<div id="box">
					<?php 
						include '../include/db_credentials.php'; 
						
						echo var_dump($_GET);

						
						//connect to database
						try {
							$pdo = new PDO($dsn, $user, $pass, $options);
						} catch (\PDOException $e) {
							throw new \PDOException($e->getMessage(), (int)$e->getCode());
						}
						
						//check if email already exists
						$sql = 'SELECT * FROM Product WHERE pName LIKE "%' . $_GET["sort"] . '%";';
						$statement = $pdo->prepare($sql);
						$statement->execute();
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						foreach ($rows as $row) {
							echo '<div class="productBox">';
							echo	'<a href="individualProducts.php"><img src="../images/ghostbusters-logo.png" alt="productimage"></a>';
							echo	'<p>' . $row["pName"] . '</p>';
							echo	'<p>' . $row["description"] . '</p>';
							echo	'<p>' . $row["price"] . '</p>';
							echo	'<p class="addCart">Add to Cart</p>';
							echo '</div>';
						}
						
					?>
				</div>
			</div>
		</main>
		<!--Footer include-->
		<?php include '../../../src/server/include/footer.php'; ?>
   </body>
   <foot>
   </foot>
</html>
