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
			$sql = 'SELECT * FROM Product WHERE pID = ?';
			$statement = $pdo->prepare($sql);
			$statement->execute(array($_GET["filter"]));
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

			echo('<div id="box">
					<div id="Products">
						<h2>Product</h2>
						<div class="catagories">');
						echo '<p>Product Details</p>';
						//List Product details
						echo '<table>';
								echo '<tr><th>Product ID</th><th>Product Name</th><th>Description</th><th>Price</th><th>Category</th><th>Delete</th></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['pID'] . '</td><td>' . $row['pName'] . '</td><td>' . $row['description'] . '</td><td>' . $row['price'] . '</td><td>' . $row['category'] . '</td><td><a href="delete.php?filter=Product&info=' . $row['pID'] . '">Delete Product</a></td></tr>';
						}
						echo '</table>';

						//Products Reviews
						$sql = "SELECT * FROM Reviews WHERE pID <= ?;";
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_GET['filter']));
						$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
						echo "<p>Users's Reviews of Product</p>";

						echo '<table>';
							echo '<tr><td>UserID</th><th>ProductID</th><th>Review</th><th>Delete</th></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['pID'] . '</td><td>' . $row['comment'] . '</td><td><a href="delete.php?filter=Review&info=' . $row['userID'] . '">Delete Review</a></td></tr>';
						}
						echo '</table>';

						//Edit prodcut information
						//Remove comments, Remove product
						echo(' <form class="Main" name="createAccount" id="create" method="post" action="update.php?filter=Product&pID=' . $row['pID'] . '" enctype="multipart/form-data">

							<fieldset>
								  <legend>Update Product<legend>
								  <div>
										<label>Product Name:</label>
										<input type="text" name="pName" class="box"/>
								  </div>
								  <div>
										<label>Description:</label>
										<input type="text" name="description" class="box"/>
								  </div>
								   <div>
										<label>Price:</label>
										<input type="text" name="price" class="box"/>
								  </div>
								  <div>
										<label>Category:</label>
										<input type="text" name="category" class="box"/>
								  </div>
								  <div>
										<label>Add a photo:</label>
										<input type="file" name="fileToUpload"  id="fileToUpload" class="box"/>
								  </div>
								  <div class="centered">
										<input type="submit" value="Update Product" class="button"/>
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
