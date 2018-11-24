<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <?php
      include '../include/db_credentials.php';

      session_start();
      $username = null;
      if (isset($_SESSION['email'])){
  	     header('Location: home.php');
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
        header('Location: /src/client/html/login.html');
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
        window.location.href='/src/client/html/login.html'</script>";
        die();
      }else if ($row == null){
        $message = "Error: Incorrect Email";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/login.html'</script>";
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
        window.location.href='/src/client/html/login.html'</script>";
        die();
      }else if($row2['password'] != $custPW) {
        $message = "Error: Incorrect Password";
        echo "<script type='text/javascript'>alert('$message');
      	window.location.href='/src/client/html/login.html'</script>";
      	die();
      }

      $_SESSION('email') = $custE;
      //change header-pass the user is logged in via session
      echo "<script type='text/javascript'>alert('Email " . $custE . " Exists With Password " . $custPW . ");
      window.location.href='/index.php'</script>";
    ?>
  </body>
</html>
