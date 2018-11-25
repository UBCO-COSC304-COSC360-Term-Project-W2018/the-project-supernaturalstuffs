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
	<link rel="stylesheet" type="text/css" href="../css/details.css">
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
			
			
			//check if All or another selection
			if(!(isset($_GET["filter"]))){
				$sql = 'SELECT * FROM Orders';
			}else{
				$sql = 'SELECT * FROM Orders WHERE OrderID LIKE orderID= ? OR trackingNymber LIKE trackingNumber = ?';
			}
			
			
			$statement = $pdo->prepare($sql);
			$statement->execute(array($_GET["filter"],$_GET["filter"]));
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		
			echo '<table>';
					echo '<tr><th>Order ID</th><th>Total Price</th><th>Tracking Number</th><th>User ID</th><th>Store ID</th></tr>';
			foreach ($rows as $row) {
				echo	'<tr><td>' . $row['orderID'] . '</td><td>' . $row['totalPrice'] . '</td><td>' . $row['trackingNumber'] . '</td><td>' . $row['userID'] . '</td><td>' . $row['storeID'] . '</td><td><a href="orderDetails.php?filter=' . $row['orderID'] . '">Select Product</a></td></tr>';
			}
			echo '</table>';
		?>
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>