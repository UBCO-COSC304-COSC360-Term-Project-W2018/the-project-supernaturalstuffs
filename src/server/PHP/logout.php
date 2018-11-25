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
      unset($_SESSION['email']);
      unset($_SESSION['next']);

      unset($_SESSION['shipInfo']['fName']);
      unset($_SESSION['shipInfo']['lName']);
      unset($_SESSION['shipInfo']['country']);
      unset($_SESSION['shipInfo']['province']);
      unset($_SESSION['shipInfo']['town']);
      unset($_SESSION['shipInfo']['street']);
      unset($_SESSION['shipInfo']['postalCode']);
      unset($_SESSION['shipInfo']['phoneNum']);
      unset($_SESSION['shipInfo']['email']);
      unset($_SESSION['shipInfo']['delivery']);
      
      unset($_SESSION['payInfo']['method']);
      unset($_SESSION['payInfo']['name']);
      unset($_SESSION['payInfo']['cNum']);
      unset($_SESSION['payInfo']['exDate']);
      unset($_SESSION['payInfo']['csv']);
      unset($_SESSION['payInfo']['uID']);
      header('Location: login.php');
    }else{
      echo "<script type='text/javascript'>alert('You aren't logged in. Sorry!')</script>";
      header('Location: login.php');
    }
    ?>
  </body>
</html>
