<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Create Account</title>
  </head>

  <body>
    <?php
      include '../../../src/server/include/header.php';

      include '../include/db_credentials.php';

      /*$target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));*/

      if (isset($_SESSION['email'])){
  	     header('Location: /index.php');
       }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        /** Get first name **/
        $custFN = null;
        if (isset($_POST['fName'])) {
            $custFN = $_POST['fName'];
        }
        /** Get last name **/
        $custLN = null;
        if (isset($_POST['lName'])) {
            $custLN = $_POST['lName'];
        }
        /** Get email **/
        $custE = null;
        if (isset($_POST['email'])) {
            $custE = $_POST['email'];
        }
        /** Get password **/
        $custPW = null;
        if (isset($_POST['password'])) {
            $custPW = $_POST['password'];
        }
        /*//user photo
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }*/
      }
      if($_SERVER["REQUEST_METHOD"] == "GET"){
        header('Location: createAccount.php');
      }

      //check to see if all not null values are entered
      if ($custFN == null){
        $message = "Please enter a first name";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='createAccount.php'</script>";
        die();
      }else if ($custLN == null){
        $message = "Please enter a last name";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='createAccount.php'</script>";
        die();
      }else if ($custE == null){
        $message = "Please enter an email";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='createAccount.php'</script>";
        die();
      }else if ($custPW == null){
        $message = "Please enter a password";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='createAccount.php'</script>";
        die();
      }

      /*//image constraints
      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 100000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }*/

      //connect to database
      try {
          $pdo = new PDO($dsn, $user, $pass, $options);
      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }

      //check if email already exists
      $sql = "SELECT email FROM User" ;
      $statement = $pdo->prepare($sql);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {}
      if ($row['email'] == $custE){
        $message = "Error: Email Address Already in Use";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='createAccount.php'</script>";
        die();
      }

      /*//image Stuff
      $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);
      $sql = "INSERT INTO userImages (userID, contentType, image) VALUES(?,?,?)";
      $stmt = mysqli_stmt_init($connection);
      mysqli_stmt_prepare($stmt, $sql);

      $null = NULL;
      mysqli_stmt_bind_param($stmt, "isb", $userID, $imageFileType, $null);
      mysqli_stmt_send_long_data($stmt, 2 , $imagedata);
      $result = mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
      mysqli_stmt_close($stmt);  */

      //insert user into user
      $sql2 = "INSERT INTO User VALUES (DEFAULT ,:username ,:password ,:firstname ,:lastname ,:email)";
      $custUN = "TEST";
      $statement = $pdo->prepare($sql2);
      $statement->bindValue(':username', $custUN, PDO::PARAM_STR);
      $statement->bindValue(':password', MD5($custPW), PDO::PARAM_STR);
      $statement->bindValue(':firstname', $custFN, PDO::PARAM_STR);
      $statement->bindValue(':lastname', $custLN, PDO::PARAM_STR);
      $statement->bindValue(':email', $custE, PDO::PARAM_STR);
      $insert = $statement->execute();

      // get new users id
      $sql3 = "SELECT userID,email FROM User WHERE email = :email";
      $statement = $pdo->prepare($sql3);
      $statement->bindParam(':email', $custE, PDO::PARAM_STR);
      $statement->execute();
      $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows2 as $row2) {}
      $userID = $row2['userID'];

      //make them a Customer
      $sql4 = "INSERT INTO Customer VALUES (:userID)";
      $statement = $pdo->prepare($sql4);
      $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
      $insert = $statement->execute();

      /*//test features user
      $sql5 = "SELECT userID,email,password FROM User" ;
      $statement = $pdo->prepare($sql5);
      $statement->execute();
      $rows3 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows3 as $row3) {
        echo $row3['userID'] . " ";
        echo $row3['email'] . " ";
        echo $row3['password'] . " <br>";
      }


      //test features customer
      $sql6 = "SELECT userID FROM Customer" ;
      $statement = $pdo->prepare($sql6);
      $statement->execute();
      $rows3 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows3 as $row3) {
        echo $row3['userID'] . " <br>";
      }*/

      //do me want them to login in now or automatically be logged in
      $_SESSION['email'] = $custE;
      echo "<script type='text/javascript'>window.location.href='/index.php'</script>";
    ?>
  </body>
</html>
