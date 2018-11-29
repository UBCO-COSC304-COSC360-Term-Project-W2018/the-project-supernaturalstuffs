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
						echo(' <form class="Main" name="createAccount" id="create" method="post" action="update.php?filter=User&userID=' . $row['userID'] . '" enctype="multipart/form-data">

							<fieldset>
								  <legend>Update Product<legend>
								  <div>
										<label>First Name:</label>
										<input type="text" name="firstName" class="box"/>
								  </div>
								  <div>
										<label>Last Name:</label>
										<input type="text" name="lastName" class="box"/>
								  </div>
								   <div>
										<label>Username:</label>
										<input type="text" name="username" class="box"/>
								  </div>
								  <div>
										<label>Email:</label>
										<input type="text" name="email" class="box"/>
								  </div>
								  <div>
										<label>Password:</label>
										<input type="text" name="password" class="box"/>
								  </div>
									<p class="notes">Password must be 6 characters long and contain a number</p>
								  <div>
										<label>Add a photo:</label>
										<input type="file" name="fileToUpload"  id="fileToUpload" class="box"/>
								  </div>
								  <div>
									<label>Status of User 1 for true 0 for false:</label>
									<input type="text" name="status" class="box"/>
								  </div>
								  <div class="centered">
										<input type="submit" value="Update User" class="button"/>
								  </div>
							</fieldset>
						</form>');
								
			echo(		'</div>
					</div>
				</div>;');
				
		?>
		
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>