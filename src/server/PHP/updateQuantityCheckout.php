<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>updateQuantity</title>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
  </head>

	<body>
    <?php
        // Get the current list of products
        session_start();

        include '../include/db_credentials.php';

        $productList = null;
        if (isset($_SESSION['productList'])){
        	$productList = $_SESSION['productList'];
        }

        // Get input
        if(isset($_GET['pID']) && isset($_GET['quantity'])){
        	$pID = $_GET['pID'];
        	$quantity = $_GET['quantity'];
        } else {
        	header('Location: checkout.php');
        }

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "SELECT quantity FROM Stock WHERE pID = :pID";
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':pID', $pID, PDO::PARAM_STR);
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {}

        $stock = $row['quantity'];
        //check how much we have remain and dont change if selection is more
        //tell them the amount remaining and let them try again

        // Update quantity
        if ($quantity > "0" && $quantity <= $stock){
        	$productList[$pID]['quantity'] = $quantity;
        } else if($quantity > $stock){
          $message = "We are greatly sorry for the inconvience, we only have " .$stock. " remaining and you asked for ".$quantity;
          echo "<script type='text/javascript'>alert('$message');
          window.location.href='checkout.php'</script>";
          die();
        } else {
          unset($productList[$_GET['pID']]);
          $_SESSION['productList'] = $productList;
          unset($_GET['pID']);
        }
        $_SESSION['productList'] = $productList;

        echo "<script type='text/javascript'>window.location.href='checkout.php'</script>";
        die();
        //header('Location: showcart.php');
    ?>
  </body>
</html>
