<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Checkout</title>
  </head>
  <body>
    <?php
      include '../../../src/server/include/header.php';

      include '../include/db_credentials.php';

      $userE = null;
      if (!isset($_SESSION['email'])){
        header('Location: login.php');
      }else{
        $userE = $_SESSION['email'];
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        /** Get first name **/
        $fName = null;
        if (isset($_POST['fName'])) {
            $fName = $_POST['fName'];
        }
        /** Get last name **/
        $lName = null;
        if (isset($_POST['lName'])) {
            $lName = $_POST['lName'];
        }
        /** Get country **/
        $country = null;
        if (isset($_POST['country'])) {
            $country = $_POST['country'];
        }
        /** Get province**/
        $province = null;
        if (isset($_POST['province'])) {
            $province = $_POST['province'];
        }
        /** Get town**/
        $town = null;
        if (isset($_POST['town'])) {
            $town = $_POST['town'];
        }
        /** Get street **/
        $street = null;
        if (isset($_POST['street'])) {
            $street = $_POST['street'];
        }
        /** Get last name **/
        $postalCode = null;
        if (isset($_POST['postalCode'])) {
            $postalCode = $_POST['postalCode'];
        }
        /** Get country **/
        $phoneNum = null;
        if (isset($_POST['phoneNum'])) {
            $phoneNum = $_POST['phoneNum'];
        }
        /** Get province**/
        $email = null;
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
        }
        /** Get town**/
        $delivery = null;
        if (isset($_POST['delivery'])) {
            $delivery = $_POST['delivery'];
        }
      }
      if($_SERVER["REQUEST_METHOD"] == "GET"){
        header('Location: checkout.php');
      }

      //check to see if all not null values are entered
      if ($fName == null){
        $message = "Please enter your first name";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($lName == null){
        $message = "Please enter your last namee";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($country == null){
        $message = "Please enter the country you are sending it to";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($province == null){
        $message = "Please enter the province you are sending it to";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($town == null){
        $message = "Please enter the town you are sending it to";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($street == null){
        $message = "Please enter the street you are sending it to";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($postalCode == null){
        $message = "Please enter the postal code of the address you provided";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($phoneNum == null){
        $message = "Please enter a phone number";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($email == null){
        $message = "Please enter an email";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }else if ($delivery == null){
        $message = "Please select a delivery method";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='checkout.php'</script>";
        die();
      }

      $_SESSION['shipInfo']['fName'] = $fName;
      $_SESSION['shipInfo']['lName'] = $lName;
      $_SESSION['shipInfo']['country'] = $country;
      $_SESSION['shipInfo']['province'] = $province;
      $_SESSION['shipInfo']['town'] = $town;
      $_SESSION['shipInfo']['street'] = $street;
      $_SESSION['shipInfo']['postalCode'] = $postalCode;
      $_SESSION['shipInfo']['phoneNum'] = $phoneNum;
      $_SESSION['shipInfo']['email'] = $email;
      $_SESSION['shipInfo']['delivery'] = $delivery;

      $_SESSION['next'] = "next";

      echo "window.location.href='checkout.php'</script>";
      die();

     ?>
  </body>
</html>
