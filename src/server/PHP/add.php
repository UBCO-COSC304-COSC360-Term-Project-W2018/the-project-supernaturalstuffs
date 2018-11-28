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
				$sql = 'INSERT INTO User VALUES (DEFAULT, ?, ?, ?, ?, ?, NULL, DEFAULT)';
				$statement = $pdo->prepare($sql);
				$statement->execute(array($_POST['username'], MD5($_POST['password']), $_POST['firstname'], $_POST['lastname'], $_POST['email']));
			
				$target_dir = "../uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

					  
				$userID = $_POST['email'];
						
				//user photo
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
				}
					  

				  //image constraints
				  // Check if file already exists
				  if (file_exists($target_file)) {
					  echo "Sorry, file already exists.";
					  $uploadOk = 0;
				  }
				  // Check file size
				  if ($_FILES["fileToUpload"]["size"] > 9000000) {
					  echo "Sorry, your file is too large.";
					  $uploadOk = 0;
				  }
				  // Allow certain file formats
				  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
					  echo "Sorry, only PNG files are allowed.";
					  $uploadOk = 0;
				  }

				  // Check if $uploadOk is set to 0 by an error
				  if ($uploadOk == 0) {
					  echo "Sorry, your file was not uploaded.";
				  // if everything is ok, try to upload file
				  }

				  //image Stuff
				  $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);

				  $sql = "UPDATE User SET image = :imagedata WHERE userID = :userID";
				  $statement = $pdo->prepare($sql);
				  $statement->bindValue(':imagedata', $imagedata, PDO::PARAM_STR);
				  $statement->bindValue(':userID', $userID, PDO::PARAM_STR);
				  $statement->execute();

				  $message = "Photo added to ".$userID;
				 /* echo "<script type='text/javascript'>alert('$message');
				  window.location.href='addProductPicForm.php'</script>";*/
				  die();

			
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