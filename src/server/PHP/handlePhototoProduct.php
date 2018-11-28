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

      $target_dir = "../uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        /** Get pID **/
        $pID = null;
        if (isset($_POST['pID'])) {
            $pID = $_POST['pID'];
        }
        //user photo
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
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

			//connect to database
			try {
				$pdo = new PDO($dsn, $user, $pass, $options);
			} catch (\PDOException $e) {
				throw new \PDOException($e->getMessage(), (int)$e->getCode());
			}

      //image Stuff
      $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);

      $sql = "UPDATE Product SET image = :imagedate WHERE pID = :pID";
      $statement = $pdo->prepare($sql);
      $statement->bindValue(':imagedata', $imagedata, PDO::PARAM_STR);
      $statement->bindValue(':pID', $pID, PDO::PARAM_STR);
      $statement->execute();

      $message = "Photo added to ".$pID;
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='addProductPicForm.php'</script>";
      die();

      ?>
    </main>
    </body>
  </html>
