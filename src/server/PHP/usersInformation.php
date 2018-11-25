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
			
			//List customers based on search information by name, email, or post
			$sql = 'SELECT * FROM Customer NATURAL JOIN User WHERE firstName LIKE "%' . $_GET["filter"] . '%" OR lastName LIKE "%' . $_GET["filter"] . '%" OR email LIKE "%' . $_GET["filter"] . '%";';
			$statement = $pdo->prepare($sql);
			$statement->execute();
			$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
			echo '<table>';
					echo '<tr><td>UserId</td><td>Username</td><td>First Name</td><td>Last Name</td><td>Email</td></tr>';
			foreach ($rows as $row) {
				echo	'<tr><td>' . $row['userID'] . '</td><td>' . $row['username'] . '</td><td>' . $row['firstName'] . '</td><td>' . $row['lastName'] . '</td><td>' . $row['email'] . '</td></tr>';
				echo '<tr><td rowspan="4"><a href="UserDetails.php?filter=' . $row['userID'] . '">Select User</a></td></tr>';
			}
			echo '</table>';
		?>
	</main>
	<!--Footer include-->
	<?php include '../../../src/server/include/footer.php'; ?>


 </body>

</html>