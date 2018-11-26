<!--add-->
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
			//Check where the source came from
			if($_GET['filter']=='User'){
				$sql = 'INSERT INTO User VALUES (DEFAULT, ?, ?, ?, ?, ?)';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_POST['username'], MD5($_POST['password']), $_POST['firstname'], $_POST['lastname'], $_POST['email']));
				echo '<p>Added Successfully</p>';
			}else if($_GET['filter']=='Product'){
				//Needs an image section
				$sql = 'INSERT INTO Product VALUES (DEFAULT, ?, ?, ?, ?)';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_POST['pName'], $_POST['description'], $_POST['price'], $_POST['category']));
				echo '<p>Added Successfully</p>';
			}else if($_GET['filter']=='Order'){
				//Needs more because if they are adding an order they are also 
				//adding a shipment 
				$sql = 'INSERT INTO Orders VALUES (DEFAULT, ?, ?, ?, ?)';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_POST['totalPrice'], $_POST['trackingNumber'], $_POST['userID'], $_POST['storeID']));
				echo '<p>Added Successfully</p>';
			}else{
				echo '<p>Invalid source</p>';
			}
			
		?>
		
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>
 </html>