<!DOCTYPE html>
<html>  
  <head>
    <meta charset="utf-8">
    <title></title>
	<link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<link rel="stylesheet" type="text/css" href="../css/UserDetails.css">
		<!--<script src="script.js"></script>-->
  </head>

  <body>
	<!--Include header-->
	<?php include '../../../src/server/include/header.php'; ?>
	<main>
		<?php 
			include '../include/db_credentials.php'; 
			

			//connect to database
			try {
				$pdo = new PDO($dsn, $user, $pass, $options);
			} catch (\PDOException $e) {
				throw new \PDOException($e->getMessage(), (int)$e->getCode());
			}
			
			//List all customers
			$sql = 'SELECT * FROM Product pID = ?';
			$statement = $pdo->prepare($sql);
			$statement->execute(array($_GET['filter']));
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			echo('<div id="box">
					<div id="Prodcucts">
						<h2>Product</h2>
						<div class="catagories">');
						echo '<p>Product Details</p>';
						//List Product details
						echo '<table>';
								echo '<tr><th>Product ID</th><th>Product Name</th><th>Description</th><th>Price</th><th>Category</th></th>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['pID'] . '</td><td>' . $row['pName'] . '</td><td>' . $row['description'] . '</td><td>' . $row['price'] . '</td><td>' . $row['category'] . '</td></tr>';
						}
						echo '</table>';
						
						//User's Reviews
						$sql = "SELECT * FROM Reviews WHERE pID <= ?;";
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_GET['filter']));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						echo "<p>User's Reviews</p>";
						
						echo '<table>';
							echo '<tr><td>UserID</td><td>ProductID</td><td>Comment/Review</td></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['pID'] . '</td><td>' . $row['comment'] . '</td></tr>';
						}
						echo '</table>';
						
						//Edit prodcut information
						//Remove comments, Remove product
								
			echo(		'</div>
					</div>
				</div>;');
				
		?>
		
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>