<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Create Account</title>
    <link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
    <link rel="stylesheet" type="text/css" href="../css/form.css">
		<script type="text/javascript" src="../script/createAccount.js"></script>
  </head>

  <body>
	<!--Include header-->
  <?php
    session_start();

    include '/src/server/include/header.php';


    if (isset($_SESSION['email'])){
      $message = "Already Logged In";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='/index.php'</script>";
      die();
     }
  ?>

    <main>
      <!-- page content -->
      <!--createAccount Form-->
      <form name="createAccount" id="create" method="post" action="createAccountPHP.php" onsubmit="return preventDefault()">
        <fieldset>
          <legend>Create Account</legend>
          <div>
            <label>First Name:</label>
            <input type="text" name="fName" class="box"/>
          </div>
          <div>
            <label>Last Name:</label>
            <input type="text" name="lName" class="box"/>
          </div>
          <div>
            <label>Email:</label>
            <input type="text" name="email" class="box"/>
          </div>
          <div>
            <label>Confirm Email:</label>
            <input type="text" name="cEmail" class="box"/>
          </div>
          <div>
            <label>Password:</label>
            <input type="password" name="password" class="box"/>
          </div>
          <p class="notes">Password must be 6 characters long and contain a number</p>
          <div>
            <label>Confirm Password:</label>
            <input type="password" name="cPassword" class="box"/>
          </div>
          <div class="centered">
            <input type="submit" value="Create Account" class="button"/>
          </div>
          <div class="centered">
            <input type="button" onclick="location.href='login.php'" value="Already Have an Acount" class="button"/>
          </div>

        </fieldset>
      </form>
    </main>

    <?php include '/src/server/include/footer.php' ?>

  </body>

  <foot>
  </foot>
</html>
