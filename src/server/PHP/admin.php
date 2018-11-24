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
	<?php include '/src/server/include/header.php'; ?>
	<main>
		<div id="box">
			<div id="Users">
				<h2>Users</h2>
				<div class="catagories">
					<p>Customer List</p>
					<input type="text" class="search" placeholder="Search...">
					<p>User Details</p>
					<p>Enable</p>
					<p>Disable</p>
					<p>Comments</p>
					<p>Edit</p>
					<p>Order History<p>
				</div>
			</div>
			<div id="Products">
				<h2>Products</h2>
				<div class="catagories">
					<p>Adding</p>
					<p>Product information</p>
					<p>browse</p>
					<hr>
					<p>Edit<p>
					<input type="text" class="search" placeholder="Search...">
					<p>Product information</p>
					<p>Delete</p>
					<p>Save Changes</p>
				</div>
			</div>
			<div id="Orders">
				<h2>Orders</h2>
				<div class="catagories">
					<input type="text" class="search" placeholder="Search...">
					<p>Order History</p>
					<p>Order Information</p>
					<p>Delete</p>
					<p>Save Changes</p>
				</div>
			</div>
		</div>
	</main>
	<!--Footer include-->
	<?php include 'src/server/include/footer.php'; ?>

 </body>

</html>
