<!--add Product-->
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
	<link rel="stylesheet" type="text/css" href="../css/UserDetails.css">
		<!--<script src="script.js"></script>-->
  </head>

  <body>
	<!--Include header-->
	<?php include '../../../src/server/include/header.php'; ?>
	<main>
		<?php 
			include '../include/db_credentials.php'; 
			

			//connect to database
			try {
				$pdo = new PDO($dsn, $user, $pass, $options);
			} catch (\PDOException $e) {
				throw new \PDOException($e->getMessage(), (int)$e->getCode());
			}
			
			echo('<div id="box">
					<div id="Products">
						<form action="add.php?filter=Product" method="post" enctype="multipart/form-data">
							<h2>Add Product</h2>
							<div class="catagories">
							<p>Product\'s Name:</p>
							<input type="text" name="pName" placeholder="Product Name">
							<p>Product\'s Description:</p>
							<input type="textbox" name="description" placeholder="Description">
							<p>Product\'s Price:</p>
							<input type="text" name="price" placeholder="Price">				
							<p>Product\'s Category:</p>
							<input type="text" name="category" placeholder="Category">
							<p>Add a photo:</p>
							<input type="file" name="fileToUpload"  id="fileToUpload" class="box"/>
							<input type="submit" value="Add Product" class="button"/>
							
							</div>
						</form>
					</div>
				</div>;');
				
		?>
		
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>
 </html>
