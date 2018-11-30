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

			if($_GET['filter']=='User'){
				//DELETE USER
				$sql = 'DELETE FROM User WHERE userID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
        $message = "Deleted";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='usersInformation.php'</script>";
        die();
			}else if($_GET['filter']=='Order'){
        //get tracking number
        $sql = 'SELECT trackingNumber FROM Orders WHERE orderID = :orderID';
        $statement = $pdo->prepare($sql);
        $statement->bindValue(':orderID', $_GET['info'], PDO::PARAM_INT);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {}
        $trackingNumber = $row['trackingNumber'];

        //increase quantity of product again

      	//DELETE Order
        $sql = 'DELETE FROM InOrder WHERE orderID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));

				$sql = 'DELETE FROM Orders WHERE orderID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));

        $sql = 'DELETE FROM Shipment WHERE trackingNumber = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($trackingNumber));

			}else if($_GET['filter']=='Review'){
				//DELETE Review
				$sql = 'DELETE FROM Review WHERE userID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
			}else if($_GET['filter']=='Comment'){
				//DELETE Comment
				$sql = 'DELETE FROM CommentsOn WHERE userID = ? AND pid = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info'], $_GET['info2']));
			}else if($_GET['filter']=='Product'){
				//DELETE Product
				$sql = 'DELETE FROM Product WHERE pID = ?';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_GET['info']));
        $message = "Deleted";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='productsInformation.php'</script>";
        die();
			}else{
				echo '<p>Wrong source</p>';

			}



		?>

	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>
