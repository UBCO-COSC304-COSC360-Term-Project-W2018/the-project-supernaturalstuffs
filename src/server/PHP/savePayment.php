<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Change Payment Info</title>
  </head>
  <body>
    <?php
      include '../include/db_credentials.php';

      session_start();
      $userE = null;
      if (!isset($_SESSION['email'])){
        header('Location: login.php');
      }else{
        $userE = $_SESSION['email'];
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        /** Get method **/
        $method = null;
        if (isset($_POST['method'])) {
            $method = $_POST['method'];
        }
        /** Get name **/
        $name = null;
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }
        /** Get card num **/
        $cNum = null;
        if (isset($_POST['cardNumber'])) {
            $cNum = $_POST['cardNumber'];
        }
        /** Get expirationDate**/
        $expDate = null;
        if (isset($_POST['expirationDate'])) {
            $expDate = $_POST['expirationDate'];
        }
        /** Get csv**/
        $csv = null;
        if (isset($_POST['csv'])) {
            $csv = $_POST['csv'];
        }
      }
      if($_SERVER["REQUEST_METHOD"] == "GET"){
        header('Location: /src/server/PHP/accountDetails.php');
      }

      //check to see if all not null values are entered
      if ($method == null){
        $message = "Please select a method";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }else if ($name == null){
        $message = "Please enter a card holder name";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }else if ($cNum == null){
        $message = "Please enter a card number";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }else if ($expDate == null){
        $message = "Please enter a expiration date";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
        die();
      }else if ($csv == null){
        $message = "Please enter a csv";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/createAccount.html'</script>";
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
      $statement->bindParam(':email', $custE, PDO::PARAM_STR);
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

      if($rows /*Make sure it has a row*/){
        //if payment method exists update information
        $sql2 = "UPDATE PaymentMethod SET method=:method, nameOnCard=:name, cardNumber=:cNumb, expirationDate=:expDate, csv=:csv WHERE userID = :userID";
        $statement = $pdo->prepare($sql2);
        $statement->bindValue(':userID', $custID, PDO::PARAM_INT);
        $statement->bindValue(':method', $method, PDO::PARAM_STR);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':cNum', $cNum, PDO::PARAM_STR);
        $statement->bindValue(':expDate', $expDate, PDO::PARAM_STR);
        $statement->bindValue(':csv', $csv, PDO::PARAM_STR);
        $statement->execute();
      }else{
        //if payment method does not exist insert payment method into PaymentMethod
        $sql2 = "INSERT INTO PaymentMethod VALUES (:userID ,:method ,:name ,:cNum ,:expDate ,:csv)";
        $statement = $pdo->prepare($sql2);
        $statement->bindValue(':userID', $custID, PDO::PARAM_INT);
        $statement->bindValue(':method', $method, PDO::PARAM_STR);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':cNum', $cNum, PDO::PARAM_STR);
        $statement->bindValue(':expDate', $expDate, PDO::PARAM_STR);
        $statement->bindValue(':csv', $csv, PDO::PARAM_STR);
        $statement->execute();
      }

      $message = "Payment Information Updated";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='/src/server/PHP/accountDetails.php'</script>";
      die();

     ?>
  </body>
</html>
