<?php
/*
//sending an image to the database
  //This has to be in your form header
      enctype="multipart/form-data"

  //this is used for selecting a file
  <div>
    <label>Add a photo:</label>
    <input type="file" name="fileToUpload"  id="fileToUpload" class="box"/>
  </div>

  //put this at the top of the page that handles ur form
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  //put this inside the method that checks if it is a post
    //product photo
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

  //this goes outside of the post and checks the size
    //image constraints
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 9000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif") {
        echo "Sorry, only PNG files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    }

  //this goes about ur insert
    //image Stuff
    $imagedata = file_get_contents($_FILES['fileToUpload']['tmp_name']);

  //this goes in your INSERT
  $statement->bindValue(':imagedata', $imagedata, PDO::PARAM_STR);



//to get an image from the SQL
    /printing user image
    /*$sql = "SELECT image FROM User where email = :email";
    $statement = $pdo->prepare($sql);
    $statement->bindParam(':email', $custE, PDO::PARAM_STR);
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($rows as $row) {}

    $image = $row['image'];
    $type = "png";
    echo '<img src = "data:image/'.$type.';base64, '.base64_encode($image).'"/>';

*/
 ?>
