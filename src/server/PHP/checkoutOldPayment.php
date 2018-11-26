<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
  </head>
  <body>
    <?php
    include '../../../src/server/include/header.php'; 
    //currently not in use but if i can get my button thing to work it will be
    //put this is payment in checkout
    /*
      <?php
        if (isset($_SESSION['pay'])){
        echo "<div class='centered'>";
        echo "<input type='button' onclick='location.href='checkoutOldPayment.php'' value='Use saved payment information' class='button'/>";
        echo "</div>";
        }else{
        echo "<div class='centered'><input type='button' onclick='location.href='checkoutOldPayment.php'' value='Use new payment information' class='button'/></div>";
        }
        echo("<div id='payment'>");
        if(isset($_SESSION['pay'])){
        echo "<script type='text/javascript'>document.getElementById('payment').classList.remove('hide')</script>";
        }else{
        echo "<script type='text/javascript'>document.getElementById('payment').classList.add('hide')</script>";
        }
      ?>
    */

    if (isset($_SESSION['pay'])){
      unset($_SESSION['pay']);
      echo "<script type='text/javascript'>alert('pay is not set!')</script>";
      header('Location: checkout.php');
    }else{
      $_SESSION['pay'] = "yes";
      echo "<script type='text/javascript'>alert('" . $_SESSION['pay'] . " is now set!')</script>";
      header('Location: checkout.php');
    }

    //make sure to unset after i use it check to see if set if set then undo
    ?>
  </body>
</html>
