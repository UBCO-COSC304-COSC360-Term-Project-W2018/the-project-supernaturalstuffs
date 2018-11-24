  <head>
    <meta charset="utf-8">
    <title></title>
	<link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
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
			$sql = 'SELECT * FROM Orders';
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			echo '<table>';
					echo '<tr><td>OrderID</td><td>Total Price</td><td>Tracking number</td><td>UserID</td><td>StoreID</td></tr>';
			foreach ($rows as $row) {
				echo	'<tr><td>' . $row['orderID'] . '</td><td>' . $row['totalPrice'] . '</td><td>' . $row['trackingNumber'] . '</td><td>' . $row['userID'] . '</td><td>' . $row['storeID'] . '</td></tr>';
			}
			echo '<tr rowspan="4"><td>Total Price: BLANK</td></tr>';
			echo '</table>';
		?>
		<div id="box">
			<div id="Users">
				<form action="userInformation.php" method="get">
					<h2>Users</h2>
					<div class="catagories">
						<a href="UserDetails.php"><p>Customer List</p></a>
						<input type="text" class="search" placeholder="Search...">
						<p>User Details</p>
						<p>Enable</p>
						<p>Disable</p>
						<p>Comments</p>
						<p>Edit</p>
						<p>Order History<p>
					</div>
				</form>
			</div>
		</div>
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>