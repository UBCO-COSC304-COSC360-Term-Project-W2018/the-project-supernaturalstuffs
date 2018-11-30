<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <?php
    session_start();
    $userE = null;
    if(isset($_SESSION['email'])){
      $userE = $_SESSION['email'];
      echo "<script type='text/javascript'>alert('Logging out " . $_SESSION['email'] . "!')</script>";


      try {
          $pdo = new PDO($dsn, $user, $pass, $options);
      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
      
      //get userID from Email
      $sql3 = "SELECT userID FROM User WHERE email = :email";
      $statement = $pdo->prepare($sql3);
      $statement->bindParam(':email', $userE, PDO::PARAM_STR);
      $statement->execute();
      $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows2 as $row2) {}
      $userID = $row2['userID'];

      //save cart to database
      $cart=null;
      if(isset($_SESSION['productList'])){
        $cart=$_SESSION['productList'];
        foreach ($cart as $pID => $cartitem){
          $pID = $cartitem['pID'];

          //insert user into user
          $sql2 = "INSERT INTO Cart VALUES (:userID ,:pID)";
          $custUN = $custFN . $custLN;
          $statement = $pdo->prepare($sql2);
          $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
          $statement->bindValue(':pID', $pID, PDO::PARAM_INT);
          $insert = $statement->execute();

        }
      }

      session_unset();
      header('Location: login.php');
    }else{
      echo "<script type='text/javascript'>alert('You aren't logged in. Sorry!')</script>";
      header('Location: login.php');
    }
    ?>
  </body>
</html>
