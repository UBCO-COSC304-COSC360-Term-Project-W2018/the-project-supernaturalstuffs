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
		} else {
			header('Location: products.php');
		}

		// Update quantity if add same item to order again
		if (isset($productList[$id])){
			$productList[$pID]['quantity'] = $productList[$pID]['quantity'] + 1;
		} else {
			$productList[$pID] = array( "pID"=>$pID, "pName"=>$name, "price"=>$price, "quantity"=>1 );
		}

		$_SESSION['productList'] = $productList;
		header('Location: products.php');
?>
