<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <?php
    session_start();
    if(isset($_SESSION['email'])){
      echo "<script type='text/javascript'>alert('Logging out " . $_SESSION['email'] . "!')</script>";
      session_unset();
      header('Location: login.php');
    }else{
      echo "<script type='text/javascript'>alert('You aren't logged in. Sorry!')</script>";
      header('Location: login.php');
    }
    ?>
  </body>
</html>
