<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Order</title>
    <link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
      <link rel="stylesheet" href="../css/reset.css" />
      <link rel="stylesheet" href="../css/header-footer.css" />
      <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
      <link rel="stylesheet" type="text/css" href="../css/accountDetails.css" />
      <link rel="stylesheet" type="text/css" href="../css/form.css">
  </head>
  <body>
    <?php include '../../../src/server/include/header.php'; ?>
  	<main>
    <?php
      include '../include/db_credentials.php';

      //check if logged in
      if (!isset($_SESSION['email'])){
        $message = "You aren't logged in";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='/index.php'</script>";
        die();
      }

      if (isset($_SESSION['productList'])) {
        $cart = $_SESSION['productList'];
      } else {
        $cart = null;
      }

      if (isset($_SESSION['storeID'])) {
        $storeID = $_SESSION['storeID'];
      } else {
        $storeID = 1;
      }

      $totalPrice = 0;
      if ($cart == null) {
          $message = "You need to add items to your cart";
          echo "<script type='text/javascript'>alert('$message');
      	window.location.href='products.php'</script>";
      	die();
      } else {
          foreach ($cart as $pID => $cartitem) {
              $totalPrice = $totalPrice + $cartitem['quantity']*$cartitem['price'];
          }
      }

       if(isset($_SESSION['payInfo']['uID'])){
         $userID = $_SESSION['payInfo']['uID'];
       }else{
         $message = "Missing a piece/all of your payment info";
         echo "<script type='text/javascript'>alert('$message');
         window.location.href='/checkout.php'</script>";
         die();
       }

       //get shipping info
       if(isset($_SESSION['shipInfo']['fName']) && isset($_SESSION['shipInfo']['lName']) && isset($_SESSION['shipInfo']['country']) && isset($_SESSION['shipInfo']['province']) && isset($_SESSION['shipInfo']['town'])){
         $shipFName = $_SESSION['shipInfo']['fName'];
         $shipLName = $_SESSION['shipInfo']['lName'];
         $shipCountry = $_SESSION['shipInfo']['country'];
         $shipProvince = $_SESSION['shipInfo']['province'];
         $shipTown = $_SESSION['shipInfo']['town'];
       }else{
         $message = "Missing a piece/all of your payment info";
         echo "<script type='text/javascript'>alert('$message');
         window.location.href='/index.php'</script>";
         die();
       }
       if(isset($_SESSION['shipInfo']['street']) && isset($_SESSION['shipInfo']['postalCode']) && isset($_SESSION['shipInfo']['phoneNum']) && isset($_SESSION['shipInfo']['email']) && isset($_SESSION['shipInfo']['delivery'])){
         $shipStreet = $_SESSION['shipInfo']['street'];
         $shipPostalCode = $_SESSION['shipInfo']['postalCode'];
         $shipPhoneNum = $_SESSION['shipInfo']['phoneNum'];
         $shipEmail = $_SESSION['shipInfo']['email'];
         $shipDelivery = $_SESSION['shipInfo']['delivery'];
       }else{
         $message = "Missing a piece/all of your payment info";
         echo "<script type='text/javascript'>alert('$message');
         window.location.href='/index.php'</script>";
         die();
       }

       //get ship method
       if($shipDelivery == "100.00" ){
         $shipMethod = "Drone";
       }elseif ($shipDelivery == "250.00") {
         $shipMethod = "Instantaneous";
       }else {
         $shipMethod = "Standard";
       }
       //get current date
       $shipDate = date("Y/m/d");

      //connect to database
       try {
           $pdo = new PDO($dsn, $user, $pass, $options);
       } catch (\PDOException $e) {
           throw new \PDOException($e->getMessage(), (int)$e->getCode());
       }

       //insert shipping info and get tracking number
       $sql = "INSERT INTO Shipment VALUES (DEFAULT ,:method ,:status ,:shipDate ,:firstName ,:lastName, :country ,:province ,:city ,:street ,:postalCode ,:email)";
       $status = "Your item has been successifully delivered to this location";
       $statement = $pdo->prepare($sql);
       $statement->bindValue(':method', $shipMethod, PDO::PARAM_STR);
       $statement->bindValue(':status', $status, PDO::PARAM_STR);
       $statement->bindValue(':shipDate', $shipDate, PDO::PARAM_STR);
       $statement->bindValue(':firstName', $shipFName, PDO::PARAM_STR);
       $statement->bindValue(':lastName', $shipLName, PDO::PARAM_STR);
       $statement->bindValue(':country', $shipCountry, PDO::PARAM_STR);
       $statement->bindValue(':province', $shipProvince, PDO::PARAM_STR);
       $statement->bindValue(':city', $shipTown, PDO::PARAM_STR);
       $statement->bindValue(':street', $shipStreet, PDO::PARAM_STR);
       $statement->bindValue(':postalCode', $shipPostalCode, PDO::PARAM_STR);
       $statement->bindValue(':email', $shipEmail, PDO::PARAM_STR);
       $insert = $statement->execute();

       //get tracking number
       $sql = "SELECT trackingNumber FROM Shipment ORDER BY trackingNumber DESC LIMIT 1";
       $statement = $pdo->prepare($sql);
       $statement->execute();
       $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
       foreach ($rows as $row) {
       }
       $trackingNumber = $row['trackingNumber'];

       //get store id - store in session Please

       //insert into order
       $sql2 = "INSERT INTO Orders VALUES (DEFAULT ,:totalPrice ,:trackingNumber ,:userID ,:storeID)";
       $statement = $pdo->prepare($sql2);
       $statement->bindValue(':totalPrice', $totalPrice, PDO::PARAM_STR);
       $statement->bindValue(':trackingNumber', $trackingNumber, PDO::PARAM_STR);
       $statement->bindValue(':userID', $userID, PDO::PARAM_STR);
       $statement->bindValue(':storeID', $storeID, PDO::PARAM_STR);
       $insert = $statement->execute();

       //get orderID
       $sql = "SELECT orderID FROM Orders ORDER BY orderID DESC LIMIT 1";
       $statement = $pdo->prepare($sql);
       $statement->execute();
       $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
       foreach ($rows as $row) {
       }
       $orderID = $row['orderID'];

       //for each product in session product list
       $totalPrice = 0;
       if ($cart != null) {
         foreach ($cart as $pID => $cartitem) {
           //put all the products InOrder
           $sql2 = "INSERT INTO InOrder VALUES (:orderID ,:pID ,:quantity)";
           $statement = $pdo->prepare($sql2);
           $statement->bindValue(':orderID', $orderID, PDO::PARAM_STR);
           $statement->bindValue(':pID', $cartitem['pID'], PDO::PARAM_STR);
           $statement->bindValue(':quantity', $cartitem['quantity'], PDO::PARAM_STR);
           $insert = $statement->execute();

           //get current stock at store for that product
           $sql = "SELECT quantity FROM Stock WHERE storeID = :storeID AND pID = :pID";
           $statement = $pdo->prepare($sql);
           $statement->bindParam(':storeID', $storeID, PDO::PARAM_STR);
           $statement->bindParam(':pID', $cartitem['pID'], PDO::PARAM_STR);
           $statement->execute();
           $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
           foreach ($rows as $row) {}

           if ($row == null){
             $message = "item not at this store sorry we messed up";
             echo "<script type='text/javascript'>alert('$message');
             window.location.href='login.php'</script>";
             die();
           }else{
             $newQuantity = $row['quantity'] - $cartitem['quantity'];
           }

           //decrease the stock at the store
           $sql2 = "UPDATE Stock SET quantity=:quantity WHERE storeID = :storeID AND pID = :pID";
           $statement = $pdo->prepare($sql2);
           $statement->bindValue(':quantity', $newQuantity, PDO::PARAM_INT);
           $statement->bindValue(':storeID', $storeID, PDO::PARAM_STR);
           $statement->bindValue(':pID', $cartitem['pID'], PDO::PARAM_STR);
           $statement->execute();

         }
       }
       /** Print out order summary **/
        echo('<h1>Your Order Summary</h1>');
        echo("<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th>");
        echo("<th>Price</th><th>Subtotal</th></tr>");

        $total = 0;
        foreach ($cart as $id => $prod) {
        		echo("<tr><td>". $prod['pID'] . "</td>");
        		echo("<td>" . $prod['pName'] . "</td>");

        		echo("<td align=\"center\">". $prod['quantity'] . "</td>");
        		$price = $prod['price'];

        		echo("<td align=\"right\">".str_replace("USD","$",money_format('%i',$price))."</td>");
        		echo("<td align=\"right\">" . str_replace("USD","$",money_format('%i',$prod['quantity']*$price)) . "</td></tr>");
        		echo("</tr>");
        		$total = $total +$prod['quantity']*$price;
        }
        echo("<tr><td colspan=\"4\" align=\"right\"><b>Product Total</b></td><td align=\"right\">".str_replace("USD","$",money_format('%i',$total))."</td></tr>");
        $total = $total + $shipDelivery;
        echo("<tr><td colspan=\"4\" align=\"right\"><b>Shipping Total</b></td><td align=\"right\">".str_replace("USD","$",money_format('%i',$shipDelivery))."</td></tr>");
        echo("<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td><td align=\"right\">".str_replace("USD","$",money_format('%i',$total))."</td></tr>");
        echo("</table>");
        echo("<h1>Order completed. Will be shipped soon...</h1>");
        echo("<h1>Your order reference number is: " . $orderID . '</h1>');
        $sql4 = "SELECT firstName, lastName FROM User WHERE userID = :userID";
        $statement = $pdo->prepare($sql4);
        $statement->bindParam(':userID',$userID, PDO::PARAM_STR);
        $statement->execute();
        $rows4 = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows4 as $row4) {}
        echo("<h1>Shipping to customer: " . $userID . ", Name: " . $row4['firstName'] ." ". $row4['lastName'] . '</h1>');

      //unset sessions
      unset($_SESSION['shipInfo']['fName']);
      unset($_SESSION['shipInfo']['lName']);
      unset($_SESSION['shipInfo']['country']);
      unset($_SESSION['shipInfo']['province']);
      unset($_SESSION['shipInfo']['town']);
      unset($_SESSION['shipInfo']['street']);
      unset($_SESSION['shipInfo']['postalCode']);
      unset($_SESSION['shipInfo']['phoneNum']);
      unset($_SESSION['shipInfo']['email']);
      unset($_SESSION['shipInfo']['delivery']);

      unset( $_SESSION['storeID']);
      unset($_SESSION['payInfo']['uID']);
      unset($_SESSION['productList']);
    ?>

    </main>
    <!--Footer include-->
    <?php include '../../../src/server/include/footer.php'; ?>
  </body>
</html>
