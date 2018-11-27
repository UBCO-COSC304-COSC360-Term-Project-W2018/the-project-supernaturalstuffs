<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
		<script type="text/javascript" src="../script/login.js"></script>
  </head>

	<body>
		<!--Include header-->
    <?php
      include '../../../src/server/include/header.php';

      if (isset($_SESSION['email'])){
        $message = "Already Logged In";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/index.php'</script>";
        die();
       }
    ?>

    <main>
      <form class="Main" name="forgotPass" id="forgotPass" method="post" action="forgotPasswordPHP.php">
        <fieldset>
          <legend>Reset Password</legend>
          <div>
            <label>Email:</label>
            <input type="text" name="email" class="box" id="eInput"/>
          </div>
          <div class="centered">
            <input type="submit" value="Send Email" class="button"/>
          </div>
        </fieldset>
      </form>
    </main>

    <?php include '../../../src/server/include/footer.php' ?>
  </body>

  <foot>
  </foot>
</html>
