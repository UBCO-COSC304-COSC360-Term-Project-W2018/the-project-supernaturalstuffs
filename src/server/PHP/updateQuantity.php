<?php
    // Get the current list of products
    session_start();
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
    // Update quantity
    if ($quantity > "0"){
    	$productList[$pID]['quantity'] = $quantity;
    } else {
      unset($cart[$_GET['pID']]);
      $_SESSION['productList'] = $cart;
      unset($_GET['pID']);
    }
    $_SESSION['productList'] = $productList;

    echo "<script type='text/javascript'>window.location.href='checkout.php'</script>";
    die();
    //header('Location: showcart.php');
?>
