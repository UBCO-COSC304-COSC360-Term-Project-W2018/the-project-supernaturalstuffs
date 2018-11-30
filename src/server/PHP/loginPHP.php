<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <?php
      session_start();

      include '../include/db_credentials.php';

      if (isset($_SESSION['email'])){
        $message = "Already Logged In";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/index.php'</script>";
        die();
       }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        /** Get email **/
        $custE = null;
        if (isset($_POST['email'])) {
            $custE = $_POST['email'];
        }
        /** Get password **/
        $custPW = null;
        if (isset($_POST['password'])) {
            $custPW = $_POST['password'];
        }
      }
      if($_SERVER["REQUEST_METHOD"] == "GET"){
        header('Location: login.php');
      }

      try {
          $pdo = new PDO($dsn, $user, $pass, $options);
      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }

      $sql = "SELECT email FROM User WHERE email = :email";
      $statement = $pdo->prepare($sql);
      $statement->bindParam(':email', $custE, PDO::PARAM_STR);
      $statement->execute();
      $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows as $row) {}

      //check to see if email exists
      if ($custE == null){
        $message = "Please enter an email";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='login.php'</script>";
        die();
      }else if ($row == null){
        $message = "Error: Incorrect Email";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='login.php'</script>";
        die();
      }

      $sql2 = "SELECT password FROM User WHERE email = :email" ;
      $statement = $pdo->prepare($sql2);
      $statement->bindParam(':email',$custE, PDO::PARAM_STR);
      $statement->execute();
      $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows2 as $row2) {}

      //check to see if password is correcrt
      if ($custPW == null){
        $message = "Please enter a password";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='login.php'</script>";
        die();
      }else if($row2['password'] != MD5($custPW)) {
        $message = "Error: Incorrect Password";
        echo "<script type='text/javascript'>alert('$message');
      	window.location.href='login.php'</script>";
      	die();
      }

      //make it so if disabled you cant Login

      $sql3 = "SELECT userID, status FROM User WHERE email = :email" ;
      $statement = $pdo->prepare($sql3);
      $statement->bindParam(':email',$custE, PDO::PARAM_STR);
      $statement->execute();
      $rows3 = $statement->fetchAll(PDO::FETCH_ASSOC);
      foreach ($rows3 as $row3) {}

      $userID = $row3['userID'];

      if($row3['status'] == "0"){
        $message = "Your account has been disabled, please contact administration for more info!";
        echo "<script type='text/javascript'>alert('$message');
      	window.location.href='login.php'</script>";
      	die();
      }


      //restore cart to session cart and delete
      $productList = array();
      //check if cart is stored for user
      $sql2 = "SELECT userID FROM Cart WHERE userID = :userID" ;
      $statement = $pdo->prepare($sql2);
      $statement->bindParam(':userID',$userID, PDO::PARAM_INT);
      $statement->execute();
      $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
      $numRows = "0";
      foreach ($rows2 as $row2) {
        $numRows = $numRows + 1;
      }

      if($numRows > "0"){
        //get product id and repopulate session cart
        $sql = "SELECT pID, quantity FROM Cart WHERE userID = :userID" ;
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':userID',$userID, PDO::PARAM_INT);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {

          $quantity = $row['quantity'];
          $pID = $row['pID'];
          //get product info where pID
          $sql3 = "SELECT * FROM Product WHERE pID = :pID" ;
          $statement = $pdo->prepare($sql3);
          $statement->bindParam(':pID',$pID, PDO::PARAM_INT);
          $statement->execute();
          $rows2 = $statement->fetchAll(PDO::FETCH_ASSOC);
          foreach ($rows3 as $row3) {
            $productList[$pID] = array( "pID"=>$pID, "pName"=>$row['pName'], "price"=>$row['price'], "description"=>$row['description'],"quantity"=>$quantity );
          }

        }
      }

      //delete items from database Cart
      $sql = 'DELETE FROM cart WHERE userID = :userID';
      $statement = $pdo->prepare($sql);
      $statement->bindParam(':userID',$userID, PDO::PARAM_INT);
      $statement->execute();


      $_SESSION['email'] = $custE;
      //change header-pass the user is logged in via session
      echo "<script type='text/javascript'>window.location.href='/index.php'</script>";
    ?>
  </body>
</html>
