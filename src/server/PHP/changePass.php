<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Change Payment Info</title>
  </head>
  <body>
    <?php
    session_start();

    include '../include/db_credentials.php';

    $userE = null;
    if (isset($_SESSION['email'])){
      $userE = $_SESSION['email'];
    }else{
      header('Location: login.php');
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      /** Get method **/
      $curPass = null;
      if (isset($_POST['curPassword'])) {
          $curPass = $_POST['curPassword'];
      }
      /** Get name **/
      $newPass = null;
      if (isset($_POST['newPassword'])) {
          $newPass = $_POST['newPassword'];
      }
    }
    if($_SERVER["REQUEST_METHOD"] == "GET"){
      header('Location: accountDetails.php');
    }

    //check to see if all not null values are entered
    if ($curPass == null){
      $message = "Please enter your current password";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='accountDetails.php'</script>";
      die();
    }else if ($newPass == null){
      $message = "Please enter a new password";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='accountDetails.php'</script>";
      die();
    }

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    //check to make sure proper password
    $sql2 = "SELECT password FROM User WHERE email = :email" ;
    $statement = $pdo->prepare($sql2);
    $statement->bindParam(':email',$userE, PDO::PARAM_STR);
    $statement->execute();
    $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows2 as $row2) {}

    //check to see if password is correcrt
    $y = MD5($curPass);
    $x = $row2['password'];
    echo "<script type='text/javascript'>alert('$y')</script>";
    echo "<script type='text/javascript'>alert('$x')</script>";
    if($row2['password'] != MD5($curPass)) {
      $message = "Error: Incorrect Password";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='accountDetails.php'</script>";
      die();
    }

    $sql = "UPDATE User SET password = :pass WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':pass', MD5($newPass), PDO::PARAM_STR);
    $statement->bindValue(':email', $userE, PDO::PARAM_STR);
    $statement->execute();

    $message = "Your password has been updated. Do not forget it!";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href='accountDetails.php'</script>";
    die();
    ?>
  </body>
</html>
