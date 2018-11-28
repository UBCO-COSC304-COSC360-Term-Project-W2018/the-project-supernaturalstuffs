<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Forgot Password</title>
  </head>

  <body>
    <!--Include header-->
    <?php
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;

      require '../include/Exception.php';
      require '../include/SMTP.php';
      require '../include/PHPMailer.php';

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
       foreach ($rows as $row) {

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
       }

       //figure out how to end an email
       $password = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnoprstuvwxyz", 5)), 0, 5);

       $sql = "UPDATE User SET password = :pass WHERE email = :email";
       $statement = $pdo->prepare($sql);
       $statement->bindValue(':pass', MD5($password), PDO::PARAM_STR);
       $statement->bindValue(':email', $custE, PDO::PARAM_STR);
       $statement->execute();


       $mail = new PHPMailer(true);                              // Passing true enables exceptions
       try {
           //Server settings
           $mail->isSMTP();                                      // Set mailer to use SMTP
           $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
           $mail->SMTPAuth = true;                               // Enable SMTP authentication
           $mail->Username = 'supernaturalstore1234@gmail.com';                 // SMTP username
           $mail->Password = 'Supernatural1';                           // SMTP password
           $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
           $mail->Port = 587;                                    // TCP port to connect to

           //Recipients
           $mail->setFrom('supernaturalstore1234@gmail.com', 'The Supernatural Store');
           $mail->addAddress($custE);     // Add a recipient
           $mail->addReplyTo('supernaturalstore1234@gmail.com', 'The Supernatual Store');

           //Content
           $mail->isHTML(true);                                  // Set email format to HTML
           $mail->Subject = 'Super(natural) Store - Password Reset';
           $mail->Body    = 'This is your new password ' .$password. '. <b>Login NOW @ https://supernaturalstore.worobetz.ca/src/server/PHP/login.php</b>';
           $mail->AltBody = 'This is your new password ' .$password. '. Login NOW @ https://supernaturalstore.worobetz.ca/src/server/PHP/login.php';

           $mail->send();
           echo 'Message has been sent';
       } catch (Exception $e) {
           echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
       }

       $message = "Your password has been changed. Check Email for new password!";
       echo "<script type='text/javascript'>alert('$message');
       window.location.href='login.php'</script>";
       die();

    ?>

  <main>
  </main>

  </body>

  <foot>
  </foot>
</html>
