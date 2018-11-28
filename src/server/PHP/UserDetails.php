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
			
			//List all customers
			$sql = 'SELECT * FROM Customer NATURAL JOIN User WHERE userID=?';
			$statement = $pdo->prepare($sql);
			$statement->execute(array($_GET['filter']));
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			echo('<div id="box">
					<div id="Users">
						<h2>User</h2>
						<div class="catagories">');
						echo '<p>User Details</p>';
						//List users details
						echo '<table>';
								echo '<tr><th>UserId</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Status</th><th>Delete</th></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['username'] . '</td><td>' . $row['firstName'] . '</td><td>' . $row['lastName'] . '</td><td>' . $row['email'] . '</td><td>' . $row['status'] . '</td><td><a href="delete.php?filter=User&info=' . $row['userID'] . '">Delete User</a></td></tr>';
						}
						echo '</table>';
						
						//List all User Order history
						$sql = 'SELECT * FROM Orders WHERE userID=?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_GET['filter']));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						echo "<p>User's Order History</p>";
						echo '<table>';
							echo '<tr><th>OrderID</th><th>Total Price</th><th>Tracking number</th><th>UserID</th><th>StoreID</th><th>Delete</th></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['orderID'] . '</td><td>' . $row['totalPrice'] . '</td><td>' . $row['trackingNumber'] . '</td><td>' . $row['userID'] . '</td><td>' . $row['storeID'] . '</td><td><a href="delete.php?filter=Order&info=' . $row['orderID'] . '">Delete Order</a></td></tr>';
						}
						echo '<tr rowspan="4"><td>Total Price: BLANK</td></tr>';
						echo '</table>';
						
						//User's Reviews
						$sql = 'SELECT * FROM Reviews WHERE userID=?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_GET['filter']));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						echo "<p>User's Reviews</p>";
						
						echo '<table>';
							echo '<tr><th>UserID</th><th>ProductID</th><th>Review</th><th>Delete</th></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['pID'] . '</td><td>' . $row['review'] . '</td><td><a href="delete.php?filter=Review&info=' . $row['userID'] . '">Delete Review</a></td></tr>';
						}
						echo '</table>';
						
						//User's Comments
						$sql = 'SELECT * FROM CommentsOn WHERE userID=?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_GET['filter']));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						echo "<p>User's Comments</p>";
						
						echo '<table>';
							echo '<tr><th>UserID</th><th>ProductID</th><th>Comment</th><th>Delete</th></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['pID'] . '</td><td>' . $row['comment'] . '</td><td><a href="delete.php?filter=Comment&info=' . $row['userID'] . '">Delete Comment</a></td></tr>';
						}
						echo '</table>';
						
						//Edit user information and enable or disable user
						//Remove comments, Remove user, edit user
								
			echo(		'</div>
					</div>
				</div>;');
				
		?>
		
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>