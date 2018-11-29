<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
	<link href='https://fonts.googleapis.com/css?family=Almendra Display' rel='stylesheet'>
    <link rel="stylesheet" href="../css/reset.css" />
    <link rel="stylesheet" href="../css/header-footer.css" />
    <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
		<!--<script src="script.js"></script>-->
  </head>

  <body>
	<!--Include header-->
	<?php
  include '../../../src/server/include/header.php';

  if (isset($_SESSION['email'])){
     $userE = $_SESSION['email'];
   }else{
     header('Location: /index.php');
   }

   try {
       $pdo = new PDO($dsn, $user, $pass, $options);
   } catch (\PDOException $e) {
       throw new \PDOException($e->getMessage(), (int)$e->getCode());
   }

   //get userID from session
   $sql = "SELECT userID FROM User WHERE email = :email";
   $statement = $pdo->prepare($sql);
   $statement->bindParam(':email', $custE, PDO::PARAM_STR);
   $statement->execute();
   $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
   foreach ($rows as $row) {}

   $userID = $row['userID'];

   //get userID from session
   $sql = "SELECT userID FROM Admin WHERE userID = :userID";
   $statement = $pdo->prepare($sql);
   $statement->bindParam(':userID', $userID, PDO::PARAM_STR);
   $statement->execute();
   $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
   $numAdmin = "0";
   foreach ($rows as $row) {
     $numAdmin = $numAdmin + "1";
   }

   if($numAdmin <= "0"){
     $message = "Please login to a valid admin account or check with administration you still have your admin privileges";
     echo "<script type='text/javascript'>alert('$message');
     window.location.href='/index.php'</script>";
     die();
   }

  ?>
	<main>
		<div id="box">
			<div id="Users">
				<form action="usersInformation.php" method="get">
					<h2>Users</h2>
					<div class="catagories">
						<input name="filter" type="text" class="search" placeholder="Search...">
						<a href="userForm.php" method="get"><p>Add Users</p></a>
						<a href="customerList.php"><p>Customer List</p></a>
					</div>
				</form>
			</div>
			<div id="Products">
				<form action="productsInformation.php" method="get">
					<h2>Products</h2>
					<div class="catagories">
						<input name="filter" type="text" class="search" placeholder="Search...">
						<a href="productForm.php"><p>Add Products</p></a>
					</div>
				</form>
			</div>
			<div id="Orders">
				<form action="ordersInformation.php" method="get">
					<h2>Orders</h2>
					<div class="catagories">
						<input name="filter" type="text" class="search" placeholder="Search...">
						<a href="orderList.php"><p>Order History</p></a>
						<a href="orderForm.php"><p>Add Orders</p></a>
					</div>
				</form>
			</div>
		</div>
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>
