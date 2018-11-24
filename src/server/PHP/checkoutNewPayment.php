<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
  </head>
  <body>
    <?php
      session_start();

      include '../include/db_credentials.php';

      $userE = null;
      if (!isset($_SESSION['email'])){
        header('Location: login.php');
      }else{
        $userE = $_SESSION['email'];
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        /** Get method **/
        $method = null;
        if (isset($_POST['submit'])) {
            $method = $_POST['payMethod'];
        }
        /** Get name **/
        $name = null;
        if (isset($_POST['cardName'])) {
            $name = $_POST['cardName'];
        }
        /** Get card num **/
        $cNum = null;
        if (isset($_POST['cardNumber'])) {
            $cNum = $_POST['cardNumber'];
        }
        /** Get expirationDate**/
        $expDate = null;
        if (isset($_POST['exDate'])) {
            $expDate = $_POST['exDate'];
        }
        /** Get csv**/
        $csv = null;
        if (isset($_POST['secCode'])) {
            $csv = $_POST['secCode'];
        }
      }
      if($_SERVER["REQUEST_METHOD"] == "GET"){
        header('Location: checkout.php');
      }

      //check to see if all not null values are entered
      if ($method == null){
        $message = "Please select a method";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($name == null){
        $message = "Please enter a card holder name";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($cNum == null){
        $message = "Please enter a card number";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($expDate == null){
        $message = "Please enter a expiration date";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($csv == null){
        $message = "Please enter a csv";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }

      try {
          $pdo = new PDO($dsn, $user, $pass, $options);
      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }

      //get userID from session
      $sql = "SELECT userID FROM User WHERE email = :email";
      $statement = $pdo->prepare($sql);
      $statement->bindParam(':email', $userE, PDO::PARAM_STR);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {}

      $userID = $row['userID'];

      //check if payment method exists for $userID
      $sql = "SELECT cardNumber FROM PaymentMethod WHERE userID = :userID";
      $statement = $pdo->prepare($sql);
      $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      //find number of rows
      $numRows = 0;
      foreach ($rows as $row) {
        $numRows = $numRows + 1;
      }

      if($numRows > 0){
        //if payment method exists update information
        $sql2 = "UPDATE PaymentMethod SET method=:method, nameOnCard=:name, cardNumber=:cNum, expirationDate=:expDate, csv=:csv WHERE userID = :userID";
        $statement = $pdo->prepare($sql2);
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
        $statement->bindValue(':method', $method, PDO::PARAM_STR);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':cNum', $cNum, PDO::PARAM_STR);
        $statement->bindValue(':expDate', $expDate, PDO::PARAM_STR);
        $statement->bindValue(':csv', $csv, PDO::PARAM_STR);
        $statement->execute();
      }else{
        //if payment method does not exist insert payment method into PaymentMethod
        $sql2 = "INSERT INTO PaymentMethod VALUES (:method ,:name ,:cNum ,:expDate ,:csv, :userID)";
        $statement = $pdo->prepare($sql2);
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
        $statement->bindValue(':method', $method, PDO::PARAM_STR);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':cNum', $cNum, PDO::PARAM_STR);
        $statement->bindValue(':expDate', $expDate, PDO::PARAM_STR);
        $statement->bindValue(':csv', $csv, PDO::PARAM_STR);
        $statement->execute();
      }

      /*//payment test
      $sql6 = "SELECT cardNumber FROM PaymentMethod" ;
      $statement = $pdo->prepare($sql6);
      $statement->execute();
      $rows3 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows3 as $row3) {
        $x = $row3['cardNumber'];
        echo "<script type='text/javascript'>alert('$x')</script>";
      }*/

      $message = "Payment Information Cleared";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='checkout.php'</script>";
      die();

     ?>
  </body>
</html>
