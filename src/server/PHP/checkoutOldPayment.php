<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
  </head>
  <body>
    <?php
    session_start();

    if (isset($_SESSION['pay'])){
      unset($_SESSION['pay']);
      header('Location: checkout.php');
    }else{
      $_SESSION['pay'] = "yes";
      header('Location: checkout.php');
    }

    //make sure to unset after i use it check to see if set if set then undo
    ?>
  </body>
</html>
