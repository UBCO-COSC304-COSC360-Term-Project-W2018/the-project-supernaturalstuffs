<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<?php
	include 'include/db_credentials.php';
	$con = sqlsrv_connect($server, $connectionInfo);
	echo("<h1>Connecting to database.</h1><p>");
	if( $con === false ) {
		die( print_r( sqlsrv_errors(), true));
	}
	$fileName = "./data/supernatural_sql.ddl";
	$file = file_get_contents($fileName, true);
	$file = mb_convert_encoding($file, 'UTF-8', mb_detect_encoding($file, 'UTF-8, ISO-8859-1', true));
	$lines = explode(";", $file);
	echo("<ol>");
	foreach ($lines as $line){
		$line = trim($line);
		if($line != ""){
			echo("<li>".$line . ";</li><br/>");
			sqlsrv_query($con, $line, array());
		}
	}
	sqlsrv_close($con);
	echo("</p><h2>Database loading complete!</h2>");
?>
</body>
</html>
