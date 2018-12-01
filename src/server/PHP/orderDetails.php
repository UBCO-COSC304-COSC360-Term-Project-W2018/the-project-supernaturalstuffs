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

      //get userID from session
      $sql = "SELECT userID FROM User WHERE email = :email";
      $statement = $pdo->prepare($sql);
      $statement->bindParam(':email', $custE, PDO::PARAM_STR);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {}

      $userID = $row['userID'];

      //get userID from session
      $sql = "SELECT userID FROM Admin WHERE userID = :userID";
      $statement = $pdo->prepare($sql);
      $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      $numAdmin = "0";
      foreach ($rows as $row) {
        $numAdmin = $numAdmin + "1";
      }

      if($numAdmin <= "0"){
        $message = "Please login to a valid admin account or check with administration you still have your admin privileges";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/index.php'</script>";
        die();
      }

			//List all customers
			//CHECK: Figure out prepared statements
			$sql = 'SELECT * FROM Orders WHERE orderID= ?';
			$statement = $pdo->prepare($sql);
			$statement->execute(array($_GET["filter"]));
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

			echo('<div id="box">
					<div id="Orders">
						<h2>Product</h2>
						<div class="catagories">');
						echo '<p>Order Details</p>';
						//List Order details
						echo '<table>';
								echo '<tr><th>Order ID</th><th>Total Price</th><th>Tracking Number</th><th>User ID</th><th>Store ID</th><th>Delete</th></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['orderID'] . '</td><td>' . $row['totalPrice'] . '</td><td>' . $row['trackingNumber'] . '</td><td>' . $row['userID'] . '</td><td>' . $row['storeID'] . '</td><td><a href="delete.php?filter=Order&info=' . $row['orderID'] . '">Delete Order</a></td></tr>';
						}
						echo '</table>';


						//Edit order information
						//Remove order

			echo(		'</div>
					</div>
				</div>;');

		?>

	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>
