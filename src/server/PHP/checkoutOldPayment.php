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
      echo "<script type='text/javascript'>alert('pay is not set!')</script>";
      header('Location: checkout.php');
    }else{
      $_SESSION['pay'] = "yes";
      echo "<script type='text/javascript'>alert('" . $_SESSION['pay'] . " is now set!')</script>";
      header('Location: checkout.php');
    }

    //payment to session
    $sql6 = "SELECT * FROM PaymentMethod WHERE userID = :userID" ;
    $statement = $pdo->prepare($sql6);
    $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
    $statement->execute();
    $rows3 = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows3 as $row3) {}

    $_SESSION['payInfo']['method'] = $row3['method'];
    $_SESSION['payInfo']['name'] = $row3['nameOnCard'];
    $_SESSION['payInfo']['cNum'] = $row3['cardNumber'];
    $_SESSION['payInfo']['exDate'] = $row3['expirationDate'];
    $_SESSION['payInfo']['csv'] = $row3['csv'];
    $_SESSION['payInfo']['uID'] = $userID;

    $message = "Payment Information Cleared / saved to session";
    echo "<script type='text/javascript'>alert('$message');
    window.location.href='checkout.php'</script>";
    die();
    //make sure to unset after i use it check to see if set if set then undo
    ?>
  </body>
</html>
