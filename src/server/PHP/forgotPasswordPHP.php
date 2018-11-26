<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
  </head>

  <body>
    <!--Include header-->
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
       }

       if($_SERVER["REQUEST_METHOD"] == "GET"){
         header('Location: createAccount.php');
       }

       try {
           $pdo = new PDO($dsn, $user, $pass, $options);
       } catch (\PDOException $e) {
           throw new \PDOException($e->getMessage(), (int)$e->getCode());
       }

       $sql = "SELECT email, password FROM User WHERE email = :email";
       $statement = $pdo->prepare($sql);
       $statement->bindParam(':email', $custE, PDO::PARAM_STR);
       $statement->execute();
       $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
       foreach ($rows as $row) {}

       //check to see if email exists
       if ($custE == null){
         $message = "Please enter an email";
         echo "<script type='text/javascript'>alert('$message');
         window.location.href='forgotPassword.php'</script>";
         die();
       }else if ($row == null){
         $message = "Error: An account doesn't exist for this email";
         echo "<script type='text/javascript'>alert('$message');
         window.location.href='createAccount.php'</script>";
         die();
       }

       //figure out how to end an email

    ?>

  <main>
  </main>

  </body>

  <foot>
  </foot>
</html>
