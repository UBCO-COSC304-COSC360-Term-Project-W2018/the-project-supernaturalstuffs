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

			//List all orders
			$sql = 'SELECT * FROM Orders';
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			echo '<table>';
					echo '<tr><td>OrderID</td><td>Total Price</td><td>Tracking number</td><td>UserID</td><td>StoreID</td></tr>';
			foreach ($rows as $row) {
				echo	'<tr><td>' . $row['orderID'] . '</td><td>' . $row['totalPrice'] . '</td><td>' . $row['trackingNumber'] . '</td><td>' . $row['userID'] . '</td><td>' . $row['storeID'] . '</td></tr>';
			}
			$sql2 = 'SELECT SUM(totalPrice) FROM Orders';
			$statement2 = $pdo->prepare($sql2);
			$statement2->execute();
			$rows2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
			foreach($rows2 as $row) {
				echo '<tr><td colspan="5">Total Revenue: ' . $row['SUM(totalPrice)'] . '</td></tr>';
			}
			echo '</table>';
		?>
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>
