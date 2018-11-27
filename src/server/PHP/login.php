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
      <!-- page content -->

      <!--Login Form-->
      <form class="Main" name="login" id="log" method="post" action="loginPHP.php" onsubmit="return checkLogin()">
        <fieldset>
          <legend>Login</legend>
          <div>
            <label>Email:</label>
            <input type="text" name="email" class="box" id="eInput"/>
          </div>
          <div class="centered">
            <input type="button" onclick="location.href='forgotPassword.php'" value="Forgot Password?" class="button" id="forgotPass"/>
          </div>
          <div>
            <label>Password:</label>
            <input type="password" name="password" class="box" id="pInput"/>
          </div>
          <div class="centered">
            <input type="checkbox" name="staySignedIn" value="yes">Keep me signed in.
          </div>
          <div class="centered">
            <input type="submit" value="Login" class="button"/>
          </div>
          <div class="centered">
            <input type="button" onclick="location.href='createAccount.php'" value="Create Account" class="button"/>
          </div>
        </fieldset>
      </form>
    </main>

    <?php include '../../../src/server/include/footer.php' ?>

  </body>

  <foot>
  </foot>
</html>
