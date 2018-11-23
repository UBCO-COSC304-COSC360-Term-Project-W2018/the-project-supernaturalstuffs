<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  
  <body>
	<!--Include header-->
	<?php include '/src/server/include/header.php'; ?>
    <?php
      include '../include/db_credentials.php';

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

      //check to see if all not null values are entered
      if ($custFN == null){
        $message = "Please enter a first name";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }else if ($custLN == null){
        $message = "Please enter a last name";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }else if ($custE == null){
        $message = "Please enter an email";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }else if ($custPW == null){
        $message = "Please enter a password";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }

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
          window.location.href='/src/client/html/createAccount.html'</script>";
          die();
        }

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

      //get new users userID
      $userID = null;
      $sql3 = "SELECT userID FROM User WHERE email = :email";
      $statement = $pdo->prepare($sql3);
      $statement->bindParam(':email', $custE, PDO::PARAM_STR);
      $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows2 as $row2) {
        $userID = $row2['userID'];
        echo("User ID '.$userID.' come on");
      }
      $userID = $row2['userID'];
      echo("User ID '.$userID.' come on");
      //make them a Customer
      /*$sql4 = "INSERT INTO Customer VALUES (:userID)";
      $statement = $pdo->prepare($sql4);
      $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
      $insert = $statement->execute();*/

      //test features user
      $sql5 = "SELECT userID,email,password FROM User" ;
      $statement = $pdo->prepare($sql5);
      $statement->execute();
      $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows2 as $row2) {
        echo $row2['userID'] . " ";
        echo $row2['email'] . " ";
        echo $row2['password'] . " ";
      }

      //test features customer
    /*  $sql6 = "SELECT userID FROM Customer" ;
      $statement = $pdo->prepare($sql6);
      $statement->execute();
      $rows3 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows3 as $row3) {
        echo $row3['userID'] . " ";
      }*/

      //do me want them to login in now or automatically be logged in
    //  echo "<script type='text/javascript'>alert('Customer ' . $custFN . ' ' . $custLN . ' was added');
    //  window.location.href='/src/html.login.html'</script>";
    ?>
  </body>
</html>
