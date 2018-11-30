<!--add Product-->
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

			echo('<div id="box">
					<div id="Products">
						<form action="add.php?filter=Product" method="post" enctype="multipart/form-data">
							<h2>Add Product</h2>
							<div class="catagories">
							<p>Product\'s Name:</p>
							<input type="text" name="pName" placeholder="Product Name" required="true">
							<p>Product\'s Description:</p>
							<input type="textbox" name="description" placeholder="Description" required="true">
							<p>Product\'s Price:</p>
							<input type="text" name="price" placeholder="Price" required="true">
							<p>Product\'s Category:</p>
							<input type="text" name="category" placeholder="Category" required="true">
							<p>Add a photo:</p>
							<input type="file" name="fileToUpload"  id="fileToUpload" class="box" required="true"/>
							<input type="submit" value="Add Product" class="button"/>

							</div>
						</form>
					</div>
				</div>;');

		?>

	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>
 </html>
