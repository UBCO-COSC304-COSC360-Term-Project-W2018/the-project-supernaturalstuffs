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
    if (!isset($_SESSION['email'])){
      header('Location: login.php');
    }else{
      $userE = $_SESSION['email'];
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
      header('Location: /src/server/PHP/accountDetails.php');
    }

    //check to see if all not null values are entered
    if ($curPass == null){
      $message = "Please enter your current password";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='/src/client/html/accountDetails.html'</script>";
      die();
    }else if ($newPass == null){
      $message = "Please enter a new password";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='/src/client/html/accountDetails.html'</script>";
      die();
    }

    $sql2 = "UPDATE User SET password = :newPass WHERE email = :userE";
    $statement = $pdo->prepare($sql2);
    $statement->bindValue(':newPass', $newPass, PDO::PARAM_INT);
    $statement->bindValue(':email', $userE, PDO::PARAM_INT);
    $statement->execute();

    $message = "Your password has been updated. Do not forget it!";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href='/src/server/PHP/accountDetails.php'</script>";
    die();
    ?>
  </body>
</html>
