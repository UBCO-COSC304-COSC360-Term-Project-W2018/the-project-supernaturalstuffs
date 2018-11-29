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
			
			if($_GET['filter']='User'){
				//Update User	
					//Update First Name
					if(isset($_POST['firstName'])){
						$sql = 'UPDATE User SET firstName = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['firstName'], $_GET['userID']));
					}
					//Update Last Name
					if(isset($_POST['lastName'])){
						$sql = 'UPDATE User SET lastName = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['lastName'], $_GET['userID']));
					}
					//Update User Name
					if(isset($_POST['userName'])){
						$sql = 'UPDATE User SET username = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['username'], $_GET['userID']));
					}
					//Update Email
					if(isset($_POST['email'])){
						$sql = 'UPDATE User SET email = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['email'], $_GET['userID']));
					}
					//Update Status
					if(isset($_POST['status'])){
						$sql = 'UPDATE User SET status = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['email'], $_GET['userID']));
					}
					//UpdatePhoto
					
			}else if($_GET['filter']='Order'){
				//DELETE Order
				$sql = 'DELETE FROM Shipment WHERE orderID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
				
				$sql = 'DELETE FROM Orders WHERE orderID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
			}else if($_GET['filter']='Review'){
				//DELETE Review
				$sql = 'DELETE FROM Review WHERE userID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
			}else if($_GET['filter']='Comment'){
				//DELETE Comment
				$sql = 'DELETE FROM CommentsOn WHERE userID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
			}else if($_GET['filter']='Product'){
				//DELETE Product
				$sql = 'DELETE FROM Product WHERE pID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
			}else{
				echo '<p>Wrong source</p>';

			}
				
			

				
		?>
		
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>