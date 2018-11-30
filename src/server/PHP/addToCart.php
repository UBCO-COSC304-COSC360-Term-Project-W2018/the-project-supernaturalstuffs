<?php
    // Get the current list of products
    session_start();

    include '../include/db_credentials.php';

    $productList = null;
    if (isset($_SESSION['productList'])){
    	$productList = $_SESSION['productList'];
    } else{ 	// No products currently in list.  Create a list.
    	$productList = array();
    }
    // Add new product selected
    // Get product information
    if(isset($_GET['pID']) && isset($_GET['pName']) && isset($_GET['price'])){
    	$pID = $_GET['pID'];
    	$pName = $_GET['pName'];
    	$price = $_GET['price'];
      $description = $_GET['description'];
    } else {
    	header('Location: products.php');
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

    //check to make sure we have it in stock if not return a message saying we dont

    // Update quantity if add same item to order again
    if ( isset($productList[$pID]) && $stock >= ($productList[$pID]['quantity'] + 1) ){
    	$productList[$pID]['quantity'] = $productList[$pID]['quantity'] + 1;
        /*$productList[$pID]['price'] = $productList[$pID]['quantity'] * $price;*/
    } else if(isset($productList[$pID]) && $stock < ($productList[$pID]['quantity'] + 1) ){
      $message = "We are greatly sorry for the inconvience, we only have " .$stock. " remaining and you asked for ".($productList[$pID]['quantity'] + 1);
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='products.php'</script>";
      die();
    } else if($stock <= "0"){
      $message = "We are greatly sorry for the inconvience, this item is out of stock";
      echo "<script type='text/javascript'>alert('$message');
      window.location.href='products.php'</script>";
      die();
    }else {
    	$productList[$pID] = array( "pID"=>$pID, "pName"=>$pName, "price"=>$price, "description"=>$description,"quantity"=>1 );
    }
    $_SESSION['productList'] = $productList;

    //set number of items in cart
    $numRows = 0;
    foreach($productList as $item){
      $numRows = $numRows + 1;
    }
    echo "<script type='text/javascript'>document.getElementById('inCart').innerHTML = '".$numRows."';</script>";

    echo "<script type='text/javascript'>window.location.href='cart.php'</script>";
    die();
    //header('Location: showcart.php');
?>
