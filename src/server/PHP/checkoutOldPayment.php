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
      if (isset($_POST['payMethod'])) {
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
    $sql = "SELECT * FROM PaymentMethod WHERE userID = :userID";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    //find number of rows
    $numRows = 0;
    foreach ($rows as $row) {
      $numRows = $numRows + 1;
    }
    if($numRows <= 0){
      $message = "You dont have a payment method saved";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='checkout.php'</script>";
      die();
    }


    $_SESSION['payInfo']['uID'] = $userID;

    echo "<script type='text/javascript'>window.location.href='order.php'</script>";
    die();





    ?>
  </body>
</html>
