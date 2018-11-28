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

    <form class="Main" name="createAccount" id="create" method="post" action="handlePhototoProduct.php" enctype="multipart/form-data">
      <fieldset>
        <legend>Add Photo to product</legend>
        <div>
          <label>Product ID</label>
          <input type="text" name="pID" class="box"/>
        </div>
        <div>
          <label>Add a photo:</label>
          <input type="file" name="fileToUpload"  id="fileToUpload" class="box"/>
        </div>
        <div class="centered">
          <input type="submit" value="add image" class="button"/>
        </div>

      </fieldset>
    </form>

    </main>
    </body>
  </html>
