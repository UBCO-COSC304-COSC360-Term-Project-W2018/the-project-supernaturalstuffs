<?php
    // Get the current list of products
    session_start();
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
    // Update quantity if add same item to order again
    if (isset($productList[$pID])){
    	$productList[$pID]['quantity'] = $productList[$pID]['quantity'] + 1;
        /*$productList[$pID]['price'] = $productList[$pID]['quantity'] * $price;*/
    } else {
    	$productList[$pID] = array( "pID"=>$pID, "pName"=>$pName, "price"=>$price, "description"=>$description,"quantity"=>1 );
    }
    $_SESSION['productList'] = $productList;
    /*if(isset($_GET['pID'])){
      removeItem($productList);
    }
    function removeItem($productList){
      unset($productList[$_GET['pID']]);
      $_SESSION['productList'] = $productList;
      header('Location: cart.php');
    }*/
    //once lina finishes cart go show cart for now popup
    echo "<script type='text/javascript'>window.location.href='cart.php'</script>";
    die();
    //header('Location: showcart.php');
?>
