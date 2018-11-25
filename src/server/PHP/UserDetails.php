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
			
			//List all customers
			$sql = 'SELECT * FROM Customer NATURAL JOIN User WHERE userID="' . $_GET("filter") . '"';
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			echo('<div id="box">
					<div id="Users">
						<h2>Users</h2>
						<div class="catagories">');
							
						echo '<table>';
								echo '<tr><td>UserId</td><td>Username</td><td>First Name</td><td>Last Name</td><td>Email</td></tr>';
						foreach ($rows as $row) {
							echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['username'] . '</td><td>' . $row['firstName'] . '</td><td>' . $row['lastName'] . '</td><td>' . $row['email'] . '</td></tr>';
						}
						echo '</table>';
								
			echo(		'</div>
					</div>
				</div>;');
		?>
		
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>