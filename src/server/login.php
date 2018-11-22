<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <?php
      include 'include/db_credentials.php';

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
      echo "<script type='text/javascript'>alert('test1')</script>";
      try {
          $pdo = new PDO($dsn, $user, $pass, $options);
      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }
      echo "<script type='text/javascript'>alert('test2')</script>";
      $sql = "SELECT email FROM User WHERE email = :email";
      $statement = $pdo->prepare($sql);
      $statement->bindParm(':email', $custE, PDO::PARAM_STR);
      $row = statement->execute();
      echo $row['email'];
      echo "<script type='text/javascript'>alert('test3')</script>";
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
      echo "<script type='text/javascript'>alert('test4')</script>";
      $sql2 = "SELECT password FROM User WHERE password = :pass AND email = :email" ;
      $statement = $pdo->prepare($sql2);
      $statement->bindParm(':pass',$custPW, PDO::PARAM_STR);
      $statement->bindParm(':email',$custE, PDO::PARAM_STR);
      $row2 = statement->execute();
      //check to see if password if password is correcr
      if ($custPW == null){
        $message = "Please enter a password";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/src/client/html/login.html'</script>";
        die();
      }else if($row2 == null) {
        $message = "Error: Incorrect Password";
        echo "<script type='text/javascript'>alert('$message');
      	window.location.href='/src/client/html/login.html'</script>";
      	die();
      }
      echo "<script type='text/javascript'>alert('test5')</script>";
      //change header-pass the user is logged in vie session
      echo("Email " . $custE . "Exists With Password" . $custPW);
    ?>
  </body>
</html>
