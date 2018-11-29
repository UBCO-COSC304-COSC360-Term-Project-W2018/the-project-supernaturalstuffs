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

			if($_GET['filter']='User'){
				//Update User
					//Update First Name
					if(isset($_POST['firstName']) && !empty($_POST['firstName'])){
						$sql = 'UPDATE User SET firstName = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['firstName'], $_GET['userID']));
					}
					//Update Last Name
					if(isset($_POST['lastName']) && !empty($_POST['lastName'])){
						$sql = 'UPDATE User SET lastName = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['lastName'], $_GET['userID']));
					}
					//Update User Name
					if(isset($_POST['username']) && !empty($_POST['username'])){
						$sql = 'UPDATE User SET username = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['username'], $_GET['userID']));
					}
					//Update Email
					if(isset($_POST['email']) && !empty($_POST['email'])){
						$sql = 'UPDATE User SET email = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['email'], $_GET['userID']));
					}
					//Update Status
					if(isset($_POST['status'])&& !empty($_POST['status'])){
						$sql = 'UPDATE User SET status = ? WHERE userID = ?';
						$statement = $pdo->prepare($sql);
						$statement->execute(array($_POST['status'], $_GET['userID']));
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
