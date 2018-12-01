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
      //lock out of admin
      include '../include/db_credentials.php';

      if (isset($_SESSION['email'])){
         $userE = $_SESSION['email'];
       }else{
         header('Location: /index.php');
       }

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
       //lock out of admin ends

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
							echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['pID'] . '</td><td>' . $row['comment'] . '</td><td><a href="delete.php?filter=Comment&info=' . $row['userID'] . '&info2=' . $row['pID'] . '">Delete Comment</a></td></tr>';
						}
						echo '</table>';

						//Edit user information and enable or disable user
						//Remove comments, Remove user, edit user
						echo(' <form class="Main" name="createAccount" id="create" method="post" action="update.php?filter=User&userID=' . $row['userID'] . '" enctype="multipart/form-data">

								<fieldset>
								  <legend>Update User<legend>
								  <div>
										<label>First Name:</label>
										<input type="text" name="firstName" class="box" style="background-color: white;
                  	color: black; border: 2px solid black;"/>
								  </div>
								  <div>
										<label>Last Name:</label>
										<input type="text" name="lastName" class="box" style="background-color: white;
                  	color: black; border: 2px solid black;"/>
								  </div>
								   <div>
										<label>Username:</label>
										<input type="text" name="username" class="box" style="background-color: white;
                  	color: black; border: 2px solid black;"/>
								  </div>
								  <div>
										<label>Email:</label>
										<input type="text" name="email" class="box" style="background-color: white;
                  	color: black; border: 2px solid black;"/>
								  </div>
								  <div>
										<label>Password:</label>
										<input type="text" name="password" class="box" style="background-color: white;
                  	color: black; border: 2px solid black;"/>
								  </div>
									<p class="notes">Password must be 6 characters long and contain a number</p>
								  <div>
										<label>Add a photo:</label>
										<input type="file" name="fileToUpload"  id="fileToUpload" class="box" />
								  </div>
								  <div>
									<label>Status of User 1 for enable false for disable:</label>
									<input type="text" name="status" class="box"/>
								  </div>
								  <div class="centered">
										<input type="submit" value="Update User" class="button"/>
								  </div>
							</fieldset>
						</form>');

			echo(		'</div>
					</div>
				</div>');

		?>

	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>
