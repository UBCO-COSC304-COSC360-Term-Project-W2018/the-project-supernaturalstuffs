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
      if (isset($_GET['email'])) {
          $custE = $_GET['email'];
      }
      /** Get password **/
      $custPW = null;
      if (isset($_GET['password'])) {
          $custPW = $_GET['password'];
      }

      try {
          $pdo = new PDO($dsn, $user, $pass, $options);
      } catch (\PDOException $e) {
          throw new \PDOException($e->getMessage(), (int)$e->getCode());
      }

      $sql = "SELECT email" . "FROM User" . "WHERE email = " . $email;
      $results = sqlsrv_query($pdo, $sql, array());
      $row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC);
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

      $sql2 = "SELECT password FROM User WHERE password = ? AND email = ?" ;
      $results2 = sqlsrv_query($con, $sql2, array($custPW,$custE));
      $row2 = sqlsrv_fetch_array($results2, SQLSRV_FETCH_ASSOC);
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

      //change header-pass the user is logged in vie session
      echo("Email " . $custE . "Exists With Password" . $custPW);
    ?>
  </body>
</html>
