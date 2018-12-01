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

			//Check where the source came from
			if($_GET['filter']=='User'){

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

				 $sql = 'INSERT INTO User VALUES (DEFAULT, ?, ?, ?, ?, ?, :imagedata, DEFAULT)';
				$statement = $pdo->prepare($sql);
				$statement->bindValue(':imagedata', $imagedata, PDO::PARAM_STR);
				$statement->execute(array($_POST['username'], MD5($_POST['password']), $_POST['firstname'], $_POST['lastname'], $_POST['email'],  $imagedata));

				$message = "User added to database ";
				 echo "<script type='text/javascript'>alert('$message');
				  window.location.href='userForm.php'</script>";
				  die();


			}else if($_GET['filter']=='Product'){

				$target_dir = "../uploads/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


				$userID = $_POST['pName'];

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

				//Needs an image section
				$sql = 'INSERT INTO Product VALUES (DEFAULT, ?, ?, ?, ?, ?)';
				$statement = $pdo->prepare($sql);
				$statement->bindValue(':imagedata', $imagedata, PDO::PARAM_STR);
				$statement->execute(array($_POST['pName'], $_POST['description'], $_POST['price'], $_POST['category'], $imagedata));

        $message = "Product added successfully";
				echo "<script type='text/javascript'>alert('$message');
			  window.location.href='productForm.php'</script>";
		    die();

			}else{
        $message = "Incorrect Source";
				echo "<script type='text/javascript'>alert('$message');
			  window.location.href='admin.php'</script>";
		    die();
			}

		?>

	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>
 </html>
